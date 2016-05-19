let app = app || {};
let ContactForm = require('./components/contactform.js');
let NewsletterSignup = require('./components/newslettersignup.js');

app.init = function() {
    console.log('init');
    app.registerListeners();
}

app.toggleNavMenu = function(ev) {
    ev.preventDefault();
    let nav = document.querySelector('.main-navbar');
    if(nav.classList.contains('open')) {
        return nav.classList.remove('open');
    }

    return nav.classList.add('open');
}

app.registerListeners = function() {
    let menuToggles = document.querySelectorAll('.menu-toggle');

    [].slice.call(menuToggles).forEach((item) => {item.addEventListener('click', app.toggleNavMenu, false)});
}

if(document.querySelector('#gf-contact-form')) {
    let contactForm = new ContactForm(document.querySelector('#gf-contact-form'));
    contactForm.init();
}

if(document.querySelector('#newsletter-form')) {
    document.querySelector('#newsletter-form').addEventListener('submit', NewsletterSignup.handleSubmit, false);
}

window.myapp = app;

window.myapp.init();

