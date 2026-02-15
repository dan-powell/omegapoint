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
        gsap.to('body', {opacity:0, duration: 0.4, onComplete: () => {this.setFont()}});
    },

    setFont() {
        if (this.lang == 'human') {
            document.querySelector(':root').style.setProperty('--font-heading', 'var(--font-heading-human)');
            document.querySelector(':root').style.setProperty('--font-body', 'var(--font-body-human)');
        }
        if (this.lang == 'alien') {
            document.querySelector(':root').style.setProperty('--font-heading', 'var(--font-heading-alien)');
            document.querySelector(':root').style.setProperty('--font-body', 'var(--font-body-alien)');
        }
        if (this.lang == 'robot') {
            document.querySelector(':root').style.setProperty('--font-heading', 'var(--font-heading-robot)');
            document.querySelector(':root').style.setProperty('--font-body', 'var(--font-body-robot)');
        }
        gsap.to('body', {opacity:1, duration: 0.6, delay: 0.1});
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

gsap.utils.toArray(".g-fadestagger").forEach((element, i) => {
    Array.from(element.children).forEach((element) => {
        gsap.set(element, {opacity:0})
    });
});




gsap.utils.toArray(".g-fadestagger").forEach((element, i) => {
    ScrollTrigger.batch(element.children, {
        onEnter: batch => gsap.to(batch, {opacity: 1, y: 0, stagger: {each: 0.1}, overwrite: true}),
        onLeaveBack: batch => gsap.set(batch, {opacity: 0, y: 20, overwrite: true})
    });
});



ScrollTrigger.addEventListener("refreshInit", () => gsap.set(".g-fadestagger", {y: 0}));
