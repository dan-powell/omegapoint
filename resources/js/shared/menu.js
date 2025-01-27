/*

# Menu

v1.2.0 -  Added support only one menu open at time
v1.1.1 -  Fix for error if element does not exist
v1.1.0 -  Added support for z-index on submenus
v1.0.0 - Intial release

Handles the display of submenus by adding classes on click. All styling must be handled seperately. Can be used to create expanding menus, and/or dropdowns.
Clicking a button will add a class to the menu item. Clicking again will remove the class. Clicking outside of either the item, or the menu will remove the class.
CSS must be used to show/hide/animate the menu. Only works on click – there is no support for hover, so 'parent' links will either need to be nested with the submenu, or use a seperate button to activate the dropdown.

## Usage

Intialization:

var foo = new Menu('dropdown-id');
Pass in the id of the root menu element.

Any link/button that will open a submenu must have a 'dropdown' attribute:

<a class="Menu-link" dropdown>
    Open submenu
</a>

The 'open' class is applied to the parent element of the link/button clicked.

## Public Methods

foo.toggle(element)
Swaps the state between open/closed closed/open.
The control element (button) must be passed in as a property.

foo.open(element)
Activates a menu.
The control element (button) must be passed in as a property.

foo.closeall()
Deactivates all open menus

## Options

Custom options

var foo = new Menu('.dropdown-id', {
  class_open: 'is-open', // Class applied to menu when active
  zindex: 900, // The number from which to increase the z-index of submenus when opened (allows recently clicked submenus to appear over each another). Set to false to disable.
  single: false, // Setting to true only allows one menu open at a time.
});

## Tips and Tricks

Custom target
It is possible to declare a specific target by add 'data-target="<css selector>"'. Note that the target element must reside somewhere within the menu.

Aria Controls
If the target menu has an 'aria-expanded="true/false"' attribute, this will be changed dynamically.

Keyboard navigation
Submenus will open on any keypress (except special keys e.g. arrow keys, tab etc.). To ensure a link/button can be focused on by the user, add 'tabbindex="0"' as an attribute on the link/button itself.


## Example

<nav class="Menu" id="js-menu">
    <ul class="Menu-root" role="menubar" aria-hidden="false">
        <li class="Menu-item is-top" role="menuitem" aria-haspopup="true" aria-expanded="false">
            <a class="Menu-link" data-dropdown tabindex="0">
                <span class="Menu-link-text">Menu Basic </span>
                <span class="fa fa-caret-down"></span>
            </a>
            <ul class="Menu-sub" role="menu" aria-label="submenu">
                <li class="Menu-item" role="menuitem">
                    <a href="/" class="Menu-link is-parent">
                        <span class="Menu-link-text">Parent</span>
                    </a>
                </li>
                <li class="Menu-item" role="menuitem">
                    <a href="/" class="Menu-link">
                        <span class="Menu-link-text">Link</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>

<script>
    var menu = new Menu('js-menu');
</script>

    <style>
    .Menu-root {
        margin: 0;
        padding:0;
        list-style: none;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
    }
    .Menu-sub {
        margin: 0;
        padding:0;
        list-style: none;
        position: absolute;
        top: 0;
        left: 100%;
        min-width: 12em;
        // Animation
        visibility: hidden;
        opacity: 0;
        z-index: -1;
        transform: translateY(-2em);
        transition:
            all 0.2s ease-in-out 0s,
            visibility 0s linear 0.2s,
            z-index 0s linear 0.2s;
        will-change: opacity, transform;
    }
    .Menu-item {
        margin: 0;
        padding:0;
        list-style: none;
        display: flex;
        flex-wrap: wrap;
        position: relative;
    }
    .Menu-item.is-top {
        display: block;
    }
    .Menu-item.is-top > .Menu-sub {
        left: auto;
        top: auto;
    }
    .Menu-item.is-open > .Menu-sub {
        // Animation
        visibility: visible;
        z-index: 1;
        opacity: 1;
        transform: translateY(0%);
        transition-delay: 0s, 0s, 0s; // this removes the transition delay so the menu will be visible while the other styles transition
    }
    // Menu Link (a)
    .Menu-link {
        flex: 1 1 auto;
        display: inline-block;
        padding: 0.5em;
    }
    // Mobile
    @media screen and (max-width: 760px) {
        .Menu-root {
            flex-direction: column;
        }
        .Menu-item {
            overflow: hidden;
        }
        .Menu-item.is-open > .Menu-sub {
            max-height: 100vh;
            transform: none;
            transition: all 0.4s ease-in-out;
        }
        .Menu-link {
            width: 100%;
        }
        .Menu-sub {
            flex: 1 1 100%;
            padding-left: 2em;
            position: relative;
            max-height: 0;
            // Reset Animations
            visibility: visible;
            opacity: 1;
            z-index: 1;
            transform: none;
            transition: all 0.4s ease-in-out;
            will-change: height;
        }
    }
</style>

*/

export default function(selector, options) {

    'use strict';

    var test = false;

    //
    // Default settings
    //

    var defaults = {
        class_open: 'is-open',
        zindex: 900,
        single: false,
    };

    //
    // Utility Methods
    //

    /**
     * Merge defaults with user options
     */
    var debug = function ( note, object ) {
        if (test == true) {
            console.log(note, object)
        }
        return defaults;
    };

    /**
     * Merge defaults with user options
     */
    var extend = function ( defaults, options ) {
        return {...defaults, ...options };
    };

    /**
     * Check if browser supports required methods
     * @return {Boolean} Returns true if all required methods are supported
     */
    var supports = function () {
        return (
            'querySelectorAll' in document &&
            'querySelector' in document &&
            'addEventListener' in window &&
            'classList' in window.Element.prototype &&
            'getAttribute' in window.Element.prototype
        );
    };


    //
    // Variables
    //

    var Menu = {}; // Object for public APIs
    var settings;
    var root;
    var zindex;

    //
    // Public Methods
    //

    /**
     * Destroy the current initialization.
     */
    Menu.destroy = function() {

        // If plugin isn't already initialized, stop
        if (!settings) return;

    };


    /**
     * Initialize
     */

    Menu.init = function(options) {

        // feature test
        if (!supports()) console.error('Menu: This browser does not support the required JavaScript methods and browser APIs.');

        // Destroy any existing initializations
        Menu.destroy();

        // Selectors and variables
        settings = extend(defaults, options || {}); // Merge user options with defaults
        zindex = settings.zindex;

        debug('settings', settings);

        // Set the root of the menu
        Menu.root = document.getElementById(selector);

        if(Menu.root !=  null) {
            // Find all dropdown buttons & setup controls
            Menu.controls = Menu.root.querySelectorAll('[data-dropdown]');
            if(Menu.controls.length > 0) {
                setup_controls();
            }
            setup_outside();
        }

    };

    /**
     * Toggles the class on a particular element
     */
    Menu.toggle = function(element) {
        var target = get_target(element);
        if(target) {

            if(settings.single) {
                Menu.closeall();
            }

            // Toggle the class
            target.classList.toggle(settings.class_open);

            // Aria control for accessibility
            if(target.hasAttribute('aria-expanded')) {
                if (target.getAttribute('aria-expanded') == 'true') {
                    target.setAttribute('aria-expanded', 'false');
                } else {
                    target.setAttribute('aria-expanded', 'true');
                }
            }

            update_zindex(target);

            debug('toggle()', element);
        }
    }

    /**
     * Toggles the class on a particular element
     */
    Menu.open = function(element) {
        var target = get_target(element);
        if(target) {

            if(settings.single) {
                Menu.closeall();
            }

            // Add the class
            target.classList.add(settings.class_open);

            // Aria control for accessibility
            if(target.hasAttribute('aria-expanded')) {
                target.setAttribute('aria-expanded', 'true');
            }

            update_zindex(target);

            debug('open()', element);
        }
    }

    /**
     * Closes all dropdowns
     */
    Menu.closeall = function() {
        for(var i = 0; i < Menu.controls.length; i++) {
            var target = get_target(Menu.controls[i]);
            if(target) {

                // Remove the class
                target.classList.remove(settings.class_open);

                // Aria control for accessibility
                if(target.hasAttribute('aria-expanded')) {
                    target.setAttribute('aria-expanded', 'false');
                }

                zindex=settings.zindex;
                target.style.zIndex = 'inherit'

                debug('close()');
            }
        }

    }

    //
    // Private Methods
    //

    /**
     * Add event listeners for clicks on controls.
     */
    var setup_controls = function() {
        for(var i = 0; i < Menu.controls.length; i++) {

            var el = Menu.controls[i];
            var action = function(el, event){
                Menu.toggle(el);
            }

            el.addEventListener('click', action.bind({}, el), true);

            // Also setup a listener for keyboard controls
            el.addEventListener('keypress', action.bind({}, el), true);

        }
    }

    /**
     * Get the dropdown target for a particular link
     */
    var get_target = function(el) {
        var target = null;
        if(typeof el.dataset != 'undefined') {
            target = el.dataset.target;
        }
        if(target) {
            var element = Menu.root.querySelector(target);
            // If a target is specified via a data tag, find and return that element...
            if(element == null) {
                console.warn('Menu: Could not find a suitable target for this element.', el);
            }
            return element;
        } else {
            // ... Otherwise, default to the parent element
            return el.parentElement;
        }
    }

    /**
     * increase the z-index of an element
     */
    var update_zindex = function(el) {
        if(settings.zindex) {
            zindex++;
            el.style.zIndex=zindex;
        }
    }

    /**
     * Add an event listener to the document to catch 'outside' clicks.
     */
    var setup_outside = function () {

        // For click events
        // Note that we don't support touch events, as that would mean the dropdown closing everytime the page is scrolled
        document.addEventListener('click', function(e){
            debug('outside click!');
            outside(e);
        }, true);

    }

    /**
     * Handle clicks on outside
     */
    var outside = function(event) {

        // Check if the event occured on a button
        var test = false;
        for(var i = 0; i < Menu.controls.length; i++) {
            if (Menu.controls[i].contains(event.target)) {
                test = true;
            }
        }

        // Check if the event occured within an dropdown
        if (test === false) {
            // If neither of the above checks are true, close the dropdown
            Menu.closeall();
        }
    }

    //
    // Initialize plugin
    //

    Menu.init(options);

    //
    // Public APIs
    //

    return Menu;

};
