<footer class="main-footer">
    <div class="footer-logo-box">
        <img src="/images/assets/logo_sm.png" alt="small logo">
    </div>
    <div class="footer-flex-box">
        <section class="footer-social">
            <p class="footer-section-header intro-text">please follow</p>
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
                <p class="error-message">Your email address is not valid.</p>
                <input type="email" name="email" required  placeholder="Your email address">
                <button type="submit">Sign up</button>
                <div class="success-panel">Thanks for subscribing!</div>
            </form>
        </section>
    </div>
</footer>