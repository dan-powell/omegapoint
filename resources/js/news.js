import {load} from "webfontloader";
import autoAnimate from '@formkit/auto-animate';
import { gsap } from "gsap";

window.human = function() {
    console.log('human');
    load({
        google: {
            families: ['Righteous', 'Geo']
        }
    });
    document.querySelector(':root').style.setProperty('--font-heading', '"Righteous", serif');
    document.querySelector(':root').style.setProperty('--font-body', '"Geo", serif');
}

window.alien = function() {
    console.log('alien');
    load({
        google: {
            families: ['Linefont']
        }
    });
    document.querySelector(':root').style.setProperty('--font-heading', '"Linefont", serif');
    document.querySelector(':root').style.setProperty('--font-body', '"Linefont", serif');
}


window.robot = function() {
    console.log('robot');
    load({
        google: {
            families: ['Libre Barcode 128']
        }
    });
    document.querySelector(':root').style.setProperty('--font-heading', '"Libre Barcode 128"');
    document.querySelector(':root').style.setProperty('--font-body', '"Libre Barcode 128"');
}


document.addEventListener("alpine:init", () => {
    Alpine.data("flip", () => ({
        controller: null,
        listeners: [],
        init() {
            this.controller = autoAnimate(this.$el);
        },
        destroy() {
            this.controller.disable();
        }
    }));
});

Livewire.on('articleListChanged', (options) => {
    document.getElementById('article-list').scrollIntoView();
})


const logo = document.getElementById('js-logo');
const logo_bits = document.querySelectorAll('.HeaderLogo-dynamic');
let tllogo = gsap.timeline({repeat: 0, repeatDelay: 0, delay: 3, autoRemoveChildren: true});
tllogo.eventCallback("onComplete", function() {

    tllogo = gsap.timeline();
    tllogo.pause()
    tllogo.to(logo_bits, {width: "auto", duration: 0.25});
    logo.addEventListener("mouseenter", () => tllogo.play());
    logo.addEventListener("mouseleave", () => tllogo.reverse())
});    
tllogo.to(logo_bits, {width: 0, duration: 1, ease: "bounce.out"});







const marquee = document.getElementById('js-marquee');
const tl = gsap.timeline({repeat: -1, repeatDelay: 0});
tl.to(marquee, {xPercent: -100, duration: 30, ease: "none"});

marquee.addEventListener("mouseenter", () => gsap.to(tl, {timeScale: 0, overwrite: true}));
marquee.addEventListener("mouseleave", () => gsap.to(tl, {timeScale: 1, overwrite: true}));


  