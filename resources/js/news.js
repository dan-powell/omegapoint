import {load} from "webfontloader";

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
