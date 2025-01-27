import './shared/bootstrap';
import {} from "./shared/overlay";

(function() {

    let sidebar = new Overlay('.Wrapper_overlay', '.js-overlay', {
        open: 'false', // Initial state
        class_open: 'is-open', // Class applied to overlay when active
        class_open_control: 'is-active', // Class applied to buttons when active
        class_open_body: 'has-openOverlay', // Class applied to body when active
        callback_open: function() {
            // open_sidebar();
        },
        callback_close: function() {
            // close_sidebar();
        }
    });

})();
