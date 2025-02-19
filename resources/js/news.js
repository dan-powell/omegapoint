import autoAnimate from '@formkit/auto-animate';
import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
// import AOS from 'aos';
// import 'aos/dist/aos.css';
// AOS.init();



import.meta.glob([
    '../img/news/**',
    '../icons/news/**',
    '../fonts/**',
]);

// window.human = function() {
//     console.log('human');
//     document.querySelector(':root').style.setProperty('--font-heading', '"Quantico", serif');
//     document.querySelector(':root').style.setProperty('--font-body', '"Quantico", serif');
// }

// window.alien = function() {
//     console.log('alien');
//     document.querySelector(':root').style.setProperty('--font-heading', '"The Orb Report", serif');
//     document.querySelector(':root').style.setProperty('--font-body', '"The Orb Report", serif');
// }


// window.robot = function() {
//     console.log('robot');
//     document.querySelector(':root').style.setProperty('--font-heading', '"QR Font"');
//     document.querySelector(':root').style.setProperty('--font-body', '"QR Font"');
// }


Alpine.data('lang', () => ({
    init() {
        this.lang = localStorage.getItem('lang') ?? 'human';
        if (this.lang != 'human') {
            this.setFont();
        }
    },

    lang: 'human',

    change(lang) {
        localStorage.setItem('lang', lang)
        this.lang = lang;

        this.setFont();
    },

    setFont() {
        if (this.lang == 'human') {
            document.querySelector(':root').style.setProperty('--font-heading', '"Quantico", serif');
            document.querySelector(':root').style.setProperty('--font-body', '"Quantico", serif');
        }
        if (this.lang == 'alien') {
            document.querySelector(':root').style.setProperty('--font-heading', '"The Orb Report", serif');
            document.querySelector(':root').style.setProperty('--font-body', '"The Orb Report", serif');
        }
        if (this.lang == 'robot') {
            document.querySelector(':root').style.setProperty('--font-heading', '"QR Font"');
            document.querySelector(':root').style.setProperty('--font-body', '"QR Font"');
        }
    }

}))



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
const logo_bits = document.querySelectorAll('.Header-logo-dynamic');
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




gsap.registerPlugin(ScrollTrigger);

gsap.utils.toArray(".g-fade").forEach((element, i) => {
    gsap.set(element, {opacity:0})
    gsap.from(element, {
        y: 200,
        scrollTrigger: {
            trigger: element,
            start: "top 100%"
        }
    });

});

gsap.utils.toArray(".g-anim").forEach((element, i) => {
    ScrollTrigger.batch(element.querySelectorAll('.g-fade'), {
        onEnter: batch => gsap.to(batch, {opacity: 1, y: 0, stagger: {each: 0.1}, overwrite: true}),
        onLeaveBack: batch => gsap.set(batch, {opacity: 0, y: 20, overwrite: true})
    });
});



ScrollTrigger.addEventListener("refreshInit", () => gsap.set(".g-fade", {y: 0}));
