<footer class="modern-footer">
    <!-- Main Footer Content -->
    <div class="footer-content">
        <div class="container">
            <div class="row g-4">
                <!-- Brand Section -->
                <div class="col-lg-4 col-md-6">
                    <div class="footer-brand">
                        <div class="brand-logo">
                            <img src="{{ asset('assets/img/logo.png') }}" alt="Batik Pudjangga" class="footer-logo">
                        </div>
                        <h4 class="brand-name">Batik Pudjangga</h4>
                        <p class="brand-description">
                            Batik lukis dan tenun karya tangan yang dikerjakan dengan penuh dedikasi. Setiap motif 
                            adalah mahakarya eksklusif yang tak akan Anda temui di tempat lain.
                        </p>
                        <div class="social-links">
                        <a href="https://www.instagram.com/shopfaradisa?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" class="social-link" title="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://wa.me/6285930433717" class="social-link" title="WhatsApp">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        </div>
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div class="col-lg-2 col-md-6">
                    <div class="footer-links">
                        <h5 class="footer-title">Belanja</h5>
                        <ul class="link-list">
                            <li><a href="{{ route('shop.men') }}"><i class="fas fa-angle-right"></i> Koleksi Pria</a></li>
                            <li><a href="{{ route('shop.women') }}"><i class="fas fa-angle-right"></i> Koleksi Wanita</a></li>
                            <li><a href="{{ route('shop.pants') }}"><i class="fas fa-angle-right"></i> Pants</a></li>
                            <li><a href="{{ route('shop.oneset') }}"><i class="fas fa-angle-right"></i> One Set</a></li>
                            <li><a href="{{ route('shop.new') }}"><i class="fas fa-angle-right"></i> Produk Terbaru</a></li>
                            <li><a href="{{ route('shop.sale') }}"><i class="fas fa-angle-right"></i> Diskon</a></li>
                        </ul>
                    </div>
                </div>
                
                <!-- Customer Service -->
                <div class="col-lg-2 col-md-6">
                    <div class="footer-links">
                        <h5 class="footer-title">Support</h5>
                        <ul class="link-list">
                            <li><a href="{{ route('about') }}"><i class="fas fa-angle-right"></i> Tentang Kami</a></li>
                            <li><a href="{{ route('contact') }}"><i class="fas fa-angle-right"></i> Kontak</a></li>
                            <li><a href="{{ route('shipping.info') }}"><i class="fas fa-angle-right"></i> Informasi Pengiriman</a></li>
                            <li><a href="{{ route('return.policy') }}"><i class="fas fa-angle-right"></i> Kebijakan Pengembalian</a></li>
                            @auth
                                <li><a href="{{ route('orders.index') }}"><i class="fas fa-angle-right"></i> Track Order</a></li>
                                <li><a href="{{ route('profile.index') }}"><i class="fas fa-angle-right"></i> My Account</a></li>
                            @else
                                <li><a href="{{ route('login') }}"><i class="fas fa-angle-right"></i> Sign In</a></li>
                            @endauth
                        </ul>
                    </div>
                </div>
                
                <!-- Contact & Newsletter -->
                <div class="col-lg-4 col-md-6">
                    <div class="footer-contact">
                        <h5 class="footer-title">Get in Touch</h5>
                        
                        <div class="contact-info">
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="contact-text">
                                    <p>Pekalongan, Central Java<br>Indonesia 51113</p>
                                </div>
                            </div>
                            
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-phone-alt"></i>
                                </div>
                                <div class="contact-text">
                                    <a href="tel:+6285930433717">+62 859 3043 3717</a><br>
                                </div>
                            </div>
                            
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="contact-text">
                                   <a href="mailto:faradisaolshop1@gmail.com">faradisaolshop1@gmail.com</a><br>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Newsletter -->
                        <div class="newsletter-box">
                            <h6 class="newsletter-title">
                                <i class="fas fa-bell me-2"></i>Stay Updated
                            </h6>
                            <p class="newsletter-subtitle">Subscribe to get special offers and updates</p>
                            <form action="{{ route('subscribe') }}" method="POST" class="newsletter-form">
                                @csrf
                                <div class="input-group">
                                    <input type="email" name="email" class="form-control" 
                                           placeholder="Enter your email" required>
                                    <button class="btn btn-subscribe" type="submit">
                                        <i class="fas fa-paper-plane"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <p class="copyright-text">
                        &copy; {{ date('Y') }} <strong>Batik Pudjangga</strong>. All rights reserved.
                    </p>
                </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Decorative Wave -->
    <div class="footer-wave">
        <svg viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"></path>
        </svg>
    </div>
</footer>

<!-- Back to Top Button -->
<button id="backToTop" class="back-to-top" aria-label="Back to top">
    <i class="fas fa-arrow-up"></i>
</button>

<style>
/* Modern Footer Styles */
.modern-footer {
    position: relative;
    background: #8B4513;
    color: #fff;
    margin-top: 80px;
    overflow: hidden;
}

.footer-wave {
    position: absolute;
    top: -1px;
    left: 0;
    width: 100%;
    overflow: hidden;
    line-height: 0;
}

.footer-wave svg {
    position: relative;
    display: block;
    width: calc(100% + 1.3px);
    height: 80px;
}

.footer-wave path {
    fill: #f8f9fa;
}

.footer-content {
    padding: 100px 0 60px;
    position: relative;
}

/* Brand Section */
.footer-brand {
    padding-right: 30px;
}

.footer-logo {
    max-width: 60px;
    margin-bottom: 15px;
    filter: brightness(0) invert(1);
}

.brand-name {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 15px;
    background: linear-gradient(135deg, #e0c097 0%, #d4a574 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.brand-description {
    color: rgba(255, 255, 255, 0.7);
    line-height: 1.8;
    margin-bottom: 25px;
    font-size: 0.95rem;
}

/* Social Links */
.social-links {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
}

.social-link {
    width: 42px;
    height: 42px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    color: #fff;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.social-link:hover {
    background: linear-gradient(135deg, #e0c097 0%, #d4a574 100%);
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(224, 192, 151, 0.3);
}

/* Footer Links */
.footer-title {
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 25px;
    position: relative;
    padding-bottom: 15px;
}

.footer-title:after {
    content: '';
    position: absolute;
    left: 0;
    bottom: 0;
    width: 40px;
    height: 3px;
    background: linear-gradient(135deg, #e0c097 0%, #d4a574 100%);
    border-radius: 2px;
}

.link-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.link-list li {
    margin-bottom: 12px;
}

.link-list a {
    color: rgba(255, 255, 255, 0.7);
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    transition: all 0.3s ease;
    font-size: 0.95rem;
}

.link-list a i {
    margin-right: 8px;
    font-size: 0.7rem;
    transition: all 0.3s ease;
}

.link-list a:hover {
    color: #e0c097;
    transform: translateX(5px);
}

.link-list a:hover i {
    transform: translateX(3px);
}

/* Contact Info */
.contact-info {
    margin-bottom: 30px;
}

.contact-item {
    display: flex;
    align-items: flex-start;
    margin-bottom: 20px;
}

.contact-icon {
    width: 40px;
    height: 40px;
    background: rgba(224, 192, 151, 0.15);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    flex-shrink: 0;
}

.contact-icon i {
    color: #e0c097;
    font-size: 1rem;
}

.contact-text {
    flex: 1;
}

.contact-text p,
.contact-text a {
    color: rgba(255, 255, 255, 0.7);
    margin: 0;
    line-height: 1.6;
    text-decoration: none;
    transition: all 0.3s ease;
}

.contact-text a:hover {
    color: #e0c097;
}

/* Newsletter */
.newsletter-box {
    background: #8B4513;
    border-radius: 15px;
    padding: 25px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.newsletter-title {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 8px;
    color: #e0c097;
}

.newsletter-subtitle {
    font-size: 0.85rem;
    color: rgba(255, 255, 255, 0.6);
    margin-bottom: 15px;
}

.newsletter-form .input-group {
    border-radius: 10px;
    overflow: hidden;
}

.newsletter-form .form-control {
    background: rgba(255, 255, 255, 0.1);
    border: none;
    color: #fff;
    padding: 12px 15px;
    font-size: 0.9rem;
}

.newsletter-form .form-control::placeholder {
    color: rgba(255, 255, 255, 0.5);
}

.newsletter-form .form-control:focus {
    background: rgba(255, 255, 255, 0.15);
    box-shadow: none;
    color: #fff;
}

.btn-subscribe {
    background: linear-gradient(135deg, #e0c097 0%, #d4a574 100%);
    border: none;
    color: #1a1a2e;
    padding: 12px 20px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-subscribe:hover {
    transform: scale(1.05);
    box-shadow: 0 5px 15px rgba(224, 192, 151, 0.4);
}

/* Footer Bottom */
.footer-bottom {
    background: rgba(0, 0, 0, 0.3);
    padding: 25px 0;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.copyright-text {
    color: rgba(255, 255, 255, 0.6);
    margin: 0;
    font-size: 0.9rem;
}

.copyright-text strong {
    color: #e0c097;
}

/* Payment Methods */
.payment-methods {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 15px;
    flex-wrap: wrap;
}

.payment-label {
    color: rgba(255, 255, 255, 0.6);
    font-size: 0.85rem;
    margin-right: 5px;
}

.payment-icon {
    height: 25px;
    opacity: 0.7;
    transition: all 0.3s ease;
    filter: brightness(0) invert(1);
}

.payment-icon:hover {
    opacity: 1;
    transform: translateY(-2px);
}

.payment-icon-font {
    font-size: 2rem;
    color: rgba(255, 255, 255, 0.7);
    transition: all 0.3s ease;
}

.payment-icon-font:hover {
    color: #e0c097;
    transform: translateY(-2px);
}

/* Back to Top Button */
.back-to-top {
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #e0c097 0%, #d4a574 100%);
    color: #1a1a2e;
    border: none;
    border-radius: 50%;
    display: none;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    cursor: pointer;
    z-index: 999;
    box-shadow: 0 5px 20px rgba(224, 192, 151, 0.3);
    transition: all 0.3s ease;
}

.back-to-top:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(224, 192, 151, 0.5);
}

/* Responsive */
@media (max-width: 991px) {
    .footer-brand {
        padding-right: 0;
        margin-bottom: 30px;
    }
    
    .footer-links {
        margin-bottom: 30px;
    }
    
    .payment-methods {
        justify-content: center;
    }
}

@media (max-width: 768px) {
    .modern-footer {
        margin-top: 60px;
    }
    
    .footer-content {
        padding: 80px 0 40px;
    }
    
    .footer-wave svg {
        height: 50px;
    }
    
    .back-to-top {
        bottom: 20px;
        right: 20px;
        width: 45px;
        height: 45px;
    }
    
    .payment-methods {
        margin-top: 15px;
    }
}

@media (max-width: 576px) {
    .social-links {
        justify-content: center;
    }
    
    .footer-title {
        text-align: center;
    }
    
    .footer-title:after {
        left: 50%;
        transform: translateX(-50%);
    }
    
    .link-list {
        text-align: center;
    }
    
    .contact-item {
        flex-direction: column;
        align-items: center;
        text-align: center;
    }
    
    .contact-icon {
        margin-right: 0;
        margin-bottom: 10px;
    }
}
</style>

<script>
// Back to Top Button Functionality
const backToTop = document.getElementById('backToTop');

window.addEventListener('scroll', function() {
    if (window.pageYOffset > 300) {
        backToTop.style.display = 'flex';
    } else {
        backToTop.style.display = 'none';
    }
});

backToTop.addEventListener('click', function(e) {
    e.preventDefault();
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
});

// Newsletter Form Enhancement
const newsletterForm = document.querySelector('.newsletter-form');
if (newsletterForm) {
    newsletterForm.addEventListener('submit', function(e) {
        const submitBtn = this.querySelector('.btn-subscribe');
        const originalHTML = submitBtn.innerHTML;
        
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
        submitBtn.disabled = true;
        
        // Reset after form processes (if using AJAX, handle in callback)
        setTimeout(() => {
            submitBtn.innerHTML = originalHTML;
            submitBtn.disabled = false;
        }, 2000);
    });
}
</script>