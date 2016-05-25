<footer class="main-footer">
    <div class="footer-logo-box">
        <img src="/images/assets/logo_sm.png" alt="small logo">
    </div>
    <div class="footer-flex-box">
        <section class="footer-social">
            <p class="footer-section-header intro-text">please follow me</p>
            @include('front.partials.sociallinks')
        </section>
        <section class="footer-quicklinks">
            <p class="footer-section-header intro-text">Quick links</p>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/conservation">Conservation</a></li>
                <li><a href="/speaking">Speaker</a></li>
                <li><a href="/consultant">Consultant</a></li>
                <li><a href="/blog">Blog</a></li>
                <li><a href="/contact">Contact</a></li>
            </ul>
        </section>
        <section class="newsletter-box">
            <p class="footer-section-header intro-text">Newsletter</p>
            <form action="/newsletter/subscribe" class="newsletter-form" id="newsletter-form">
                {!! csrf_field() !!}
                <p class="prompt">Sign up to receive my blog posts direct to your inbox.</p>
                <p class="error-message">Your email address is not valid.</p>
                <input type="email" name="email" required  placeholder="Your email address">
                <button type="submit" class="gf-button full-width-btn">Subscribe</button>
                <div class="success-panel">Thanks for subscribing!</div>
            </form>
        </section>
    </div>
    <p class="credits">Website designed and created by <a href="http://dymanticdesign.com" target="_blank">Dymantic Design</a></p>
</footer>