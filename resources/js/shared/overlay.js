/*

# Overlay

v2.0.0 - Converted in to a regular ES5 module

Used to add classes for the display of dropdowns, flyouts and overlays.
Clicking a button will add a class to the overlay. Clicking again will remove the class. Clicking outside of either the button, or the overlay will remove the class.
CSS Classes must then be used to show/hide/animate the overlay.
Any number of buttons can be used to control any number of overlays.

## Usage

Intialization:

let foo = new Overlay('.overlay-selector', '.button-selector');

## Methods

foo.toggle()
Swaps the state between open/closed closed/open.

foo.open()
Activates overlay

foo.close()
Deactivates overlay

## Options

Custom options

let foo = new Overlay('.overlay-selector', '.button-selector', {
	open: 'false', // Initial state
	class_open: 'is-open', // Class applied to overlay when active
	class_open_control: 'is-active' // Class applied to buttons when active
    class_open_body: '' // Class applied to body when active
    callback_opened: function() {...} // Pass in a callback function to be called when overlay is opened
    callback_closed: function() {...} // Pass in a callback function to be called when overlay is closed
});

## Tips and Tricks

Buttons are optional, only an overlay needs to be declared:

let foo = new Overlay('.overlay-selector');

... so the overlay can be controlled dynamically:

<element>.addEventListener("click", foo.toggle, true);

... or just:

foo.toggle()

*/

export default function(overlay_selector, button_selector, options) {

    'use strict';

    let test = false;

    //
    // Default settings
    //

    let defaults = {
        open: 'false',
        class_open: 'is-open',
        class_open_control: 'is-active',
        class_open_body: null,
        callback_opened: {},
        callback_closed: {}
    };

    let open = false;

    //
    // Utility Methods
    //

    /**
     * Merge defaults with user options
     */
    let debug = function ( note, object ) {
        if (test == true) {
            console.log(note, object)
        }
        return defaults;
    };

    /**
     * Merge defaults with user options
     */
    let extend = function ( defaults, options ) {
        return {...defaults, ...options };
    };

    /**
     * Check if browser supports required methods
     * @return {Boolean} Returns true if all required methods are supported
     */
    let supports = function () {
        return (
            'querySelectorAll' in document &&
            'addEventListener' in window &&
            'classList' in window.Element.prototype
        );
    };

    //
    // Variables
    //

    let Overlay = {}; // Object for public APIs
    let settings;


    //
    // Public Methods
    //

    /**
     * Destroy the current initialization.
     */
    Overlay.destroy = function() {

        // If plugin isn't already initialized, stop
        if (!settings) return;

    };

    /**
     * Initialize
     */
    Overlay.init = function(options) {

        // feature test
        if (!supports()) console.error('Overlay: This browser does not support the required JavaScript methods and browser APIs.');

        // Destroy any existing initializations
        Overlay.destroy();

        // Selectors and variables
        settings = extend(defaults, options || {}); // Merge user options with defaults

        debug('settings', settings);

        // Find all the controls & overlays
        if (typeof button_selector !== 'undefined') {
            Overlay.controls = document.querySelectorAll(button_selector);
        } else {
            Overlay.controls = [];
        }
        Overlay.overlays = document.querySelectorAll(overlay_selector);

        if(Overlay.controls.length > 0) {
            setup_controls();
        }

        setup_outside();

    };

    /**
     * Toggle
     */
    Overlay.toggle = function() {

        for(let i = 0; i < Overlay.controls.length; i++) {
            Overlay.controls[i].classList.toggle(settings.class_open_control);
        }

        for(let i = 0; i < Overlay.overlays.length; i++) {
            Overlay.overlays[i].classList.toggle(settings.class_open);
        }

        if(settings.class_open_body != null) {
            document.body.classList.toggle(settings.class_open_body);
        }

        if (open === false) {
            if(typeof settings.callback_opened == 'function') {
                settings.callback_opened();
            }
            open = true
        } else {
            if(typeof settings.callback_closed == 'function') {
                settings.callback_closed();
            }
            open = false
        }

        debug('toggle()', open);

    }


    Overlay.close = function() {

        for(let i = 0; i < Overlay.controls.length; i++) {
            Overlay.controls[i].classList.remove(settings.class_open_control);
        }

        for(let i = 0; i < Overlay.overlays.length; i++) {
            Overlay.overlays[i].classList.remove(settings.class_open);
        }

        if(settings.class_open_body != null) {
            document.body.classList.remove(settings.class_open_body);
        }

        if(typeof settings.callback_closed == 'function') {
            settings.callback_closed();
        }

        open = false

        debug('close()', open);

    }

    Overlay.open = function() {

        for(let i = 0; i < Overlay.controls.length; i++) {
            Overlay.controls[i].classList.add(settings.class_open_control);
        }

        for(let i = 0; i < Overlay.overlays.length; i++) {
            Overlay.overlays[i].classList.add(settings.class_open);
        }

        if(settings.class_open_body != null) {
            document.body.classList.add(settings.class_open_body);
        }

        if(typeof settings.callback_opened == 'function') {
            settings.callback_opened();
        }

        open = true;

        if(typeof settings.callback_open == 'function') {
            settings.callback_open();
        }

        debug('open()', open);

    }

    //
    // Private Methods
    //

    /**
     * Add event listeners for clicks on controls.
     */
    let setup_controls = function() {
        for(let i = 0; i < Overlay.controls.length; i++) {

            // For touch events
            Overlay.controls[i].addEventListener('touchstart', function(e){
                debug('touch!');
                e.preventDefault();
                Overlay.toggle();
            }, true);

            // For click events
            Overlay.controls[i].addEventListener('click', function(e){
                debug('click!');
                e.preventDefault();
                Overlay.toggle();
            }, true);

        }
    }

    /**
     * Add an event listener to the document to catch 'outside' clicks.
     */
    let setup_outside = function () {

        // For touch events
        document.addEventListener('touchstart', function(e){
            debug('outside touch!');
            outside(e);
        }, true);

        // For click events
        document.addEventListener('click', function(e){
            debug('outside click!');
            outside(e);
        }, true);

    }

    /**
     * Handle clicks on outside
     */
    let outside = function(event) {

        // Check if the event occured on a button
        let test = false;
        for(let i = 0; i < Overlay.controls.length; i++) {
            if (Overlay.controls[i].contains(event.target)) {
                test = true;
            }
        }

        // Check if the event occured within an overlay
        if(test === false) {
            let test = false;
            for(let i = 0; i < Overlay.overlays.length; i++) {
                if (Overlay.overlays[i].contains(event.target)) {
                    test = true;
                }

                if (test === false) {
                    // If neither of the above checks are true, close the overlay
                    Overlay.close();
                }
            }
        }
    }


    //
    // Initialize plugin
    //

    Overlay.init(options);


    //
    // Public APIs
    //

    return Overlay;

};
