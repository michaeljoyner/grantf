let NewsletterUnsubscribe = {
    formEl: document.querySelector('#newsletter-unsubscribe'),

    handleSubmit(ev) {
        NewsletterUnsubscribe.formEl.classList.remove('failed')
        ev.preventDefault();
        let req  = new XMLHttpRequest();
        let fd = new FormData(NewsletterUnsubscribe.formEl);

        req.open('POST', '/newsletter/unsubscribe');

        req.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        req.onreadystatechange = (ev) => {
            if (req.readyState == 4) {
                if (req.status == 200) {
                    NewsletterUnsubscribe.showSuccess(ev);
                } else {
                    NewsletterUnsubscribe.failResponse(req.status);
                }
            }
        }
        req.send(fd);
        return false;
    },

    showSuccess(ev) {
        NewsletterUnsubscribe.setResponseTextAndClass('You have been unsubcribed', 'success');
    },

    failResponse(status) {
        if(status === 400) {
            return NewsletterUnsubscribe.setResponseTextAndClass('That email address is not on the mailing list', 'spent');
        }

        if(status === 422) {
            return NewsletterUnsubscribe.formEl.classList.add('invalid');
        }

        NewsletterUnsubscribe.setResponseTextAndClass('Oops, something went wrong. Please try again later.', 'failed');
    },

    setResponseTextAndClass(message, formClass) {
        document.querySelector('#newsletter-unsubscribe .success-panel').innerHTML = message;
        NewsletterUnsubscribe.formEl.classList.add(formClass);
    }
}

module.exports =  NewsletterUnsubscribe;