let NewsletterSignup = {
    formEl: document.querySelector('#newsletter-form'),

    handleSubmit(ev) {
        NewsletterSignup.formEl.classList.remove('failed')
        ev.preventDefault();
        let req  = new XMLHttpRequest();
        let fd = new FormData(NewsletterSignup.formEl);

        req.open('POST', '/newsletter/subscribe');

        req.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        req.onreadystatechange = (ev) => {
            if (req.readyState == 4) {
                if (req.status == 200) {
                    NewsletterSignup.showSuccess(ev);
                } else {
                    NewsletterSignup.failResponse(req.status);
                }
            }
        }
        req.send(fd);
        return false;
    },

    showSuccess(ev) {
        NewsletterSignup.formEl.classList.add('success');
    },

    failResponse(status) {
        if(status === 400) {
            return NewsletterSignup.setResponseTextAndClass('You are already subscribed', 'spent');
        }

        if(status === 422) {
            return NewsletterSignup.formEl.classList.add('invalid');
        }

        NewsletterSignup.setResponseTextAndClass('Oops, something went wrong. Please try again later.', 'failed');
    },

    setResponseTextAndClass(message, formClass) {
        document.querySelector('#newsletter-form .success-panel').innerHTML = message;
        NewsletterSignup.formEl.classList.add(formClass);
    }
}

module.exports =  NewsletterSignup;