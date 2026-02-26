/**
 * EduForward – Teacher Training Program Landing Page
 * script.js — Interactive functionality
 *
 * Features:
 *  1. Sticky Navbar with scroll-based class toggle
 *  2. Hamburger mobile menu
 *  3. Active nav link highlighting on scroll
 *  4. Smooth scroll for anchor links
 *  5. Curriculum Accordion
 *  6. FAQ Accordion
 *  7. Testimonial Carousel / Slider (auto-play + manual)
 *  8. Contact Form Validation
 *  9. Scroll-to-Top button
 * 10. Reveal animations on scroll (IntersectionObserver)
 */

/* ----------------------------------------------------------
   1. DOM Ready
   ---------------------------------------------------------- */
document.addEventListener('DOMContentLoaded', () => {
    initNavbar();
    initHamburger();
    initSmoothScroll();
    initCurriculumAccordion();
    initFaqAccordion();
    initTestimonialSlider();
    initFormValidation();
    initScrollTop();
    initRevealAnimations();
    initActiveNavHighlight();
});

/* ----------------------------------------------------------
   2. Navbar — Scroll-based sticky style + active class
   ---------------------------------------------------------- */
function initNavbar() {
    const navbar = document.getElementById('navbar');

    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    }, { passive: true });
}

/* ----------------------------------------------------------
   3. Hamburger Mobile Menu
   ---------------------------------------------------------- */
function initHamburger() {
    const hamburger = document.getElementById('hamburger');
    const navLinks = document.getElementById('navLinks');

    hamburger.addEventListener('click', () => {
        hamburger.classList.toggle('open');
        navLinks.classList.toggle('open');
    });

    // Close nav when a link is clicked
    navLinks.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', () => {
            hamburger.classList.remove('open');
            navLinks.classList.remove('open');
        });
    });

    // Close nav when clicking outside
    document.addEventListener('click', (e) => {
        if (!hamburger.contains(e.target) && !navLinks.contains(e.target)) {
            hamburger.classList.remove('open');
            navLinks.classList.remove('open');
        }
    });
}

/* ----------------------------------------------------------
   4. Smooth Scroll for Anchor Links
   ---------------------------------------------------------- */
function initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', (e) => {
            const targetId = anchor.getAttribute('href');
            if (targetId === '#') return;

            const target = document.querySelector(targetId);
            if (!target) return;

            e.preventDefault();

            const navbarHeight = document.getElementById('navbar').offsetHeight;
            const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - navbarHeight;

            window.scrollTo({
                top: targetPosition,
                behavior: 'smooth'
            });
        });
    });
}

/* ----------------------------------------------------------
   5. Active Nav Link Highlight on Scroll
   ---------------------------------------------------------- */
function initActiveNavHighlight() {
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.nav-links a[href^="#"]');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                navLinks.forEach(link => link.classList.remove('active-nav'));
                const activeLink = document.querySelector(`.nav-links a[href="#${entry.target.id}"]`);
                if (activeLink) activeLink.classList.add('active-nav');
            }
        });
    }, { rootMargin: '-40% 0px -50% 0px', threshold: 0 });

    sections.forEach(section => observer.observe(section));
}

/* ----------------------------------------------------------
   6. Curriculum Accordion
   ---------------------------------------------------------- */
function initCurriculumAccordion() {
    const accordionItems = document.querySelectorAll('#curriculumAccordion .accordion-item');

    accordionItems.forEach(item => {
        const header = item.querySelector('.accordion-header');

        header.addEventListener('click', () => {
            const isActive = item.classList.contains('active');

            // Close all
            accordionItems.forEach(i => i.classList.remove('active'));

            // Toggle clicked
            if (!isActive) {
                item.classList.add('active');
            }
        });
    });
}

/* ----------------------------------------------------------
   7. FAQ Accordion
   ---------------------------------------------------------- */
function initFaqAccordion() {
    const faqItems = document.querySelectorAll('#faqAccordion .faq-item');

    faqItems.forEach(item => {
        const header = item.querySelector('.faq-header');

        header.addEventListener('click', () => {
            const isActive = item.classList.contains('active');

            // Close all
            faqItems.forEach(i => i.classList.remove('active'));

            // Toggle clicked
            if (!isActive) {
                item.classList.add('active');
                // Scroll into view gently if needed
                setTimeout(() => {
                    item.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                }, 200);
            }
        });
    });
}

/* ----------------------------------------------------------
   8. Testimonial Slider / Carousel
   ---------------------------------------------------------- */
function initTestimonialSlider() {
    const slider = document.getElementById('testimonialSlider');
    const slides = slider.querySelectorAll('.testimonial-slide');
    const dotsWrap = document.getElementById('sliderDots');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');

    if (!slides.length) return;

    let currentIndex = 0;
    let autoPlayTimer = null;
    const AUTOPLAY_DELAY = 5000;

    // Build dots
    slides.forEach((_, idx) => {
        const dot = document.createElement('button');
        dot.className = 'dot' + (idx === 0 ? ' active' : '');
        dot.setAttribute('aria-label', `Go to slide ${idx + 1}`);
        dot.addEventListener('click', () => goToSlide(idx));
        dotsWrap.appendChild(dot);
    });

    function updateSlider() {
        slider.style.transform = `translateX(-${currentIndex * 100}%)`;
        dotsWrap.querySelectorAll('.dot').forEach((dot, idx) => {
            dot.classList.toggle('active', idx === currentIndex);
        });
    }

    function goToSlide(index) {
        currentIndex = (index + slides.length) % slides.length;
        updateSlider();
        resetAutoPlay();
    }

    function nextSlide() { goToSlide(currentIndex + 1); }
    function prevSlide() { goToSlide(currentIndex - 1); }

    function startAutoPlay() {
        autoPlayTimer = setInterval(nextSlide, AUTOPLAY_DELAY);
    }

    function resetAutoPlay() {
        clearInterval(autoPlayTimer);
        startAutoPlay();
    }

    prevBtn.addEventListener('click', prevSlide);
    nextBtn.addEventListener('click', nextSlide);

    // Touch/swipe support
    let touchStartX = 0;
    let touchEndX = 0;
    const SWIPE_THRESHOLD = 50;

    slider.addEventListener('touchstart', (e) => {
        touchStartX = e.changedTouches[0].clientX;
    }, { passive: true });

    slider.addEventListener('touchend', (e) => {
        touchEndX = e.changedTouches[0].clientX;
        const diff = touchStartX - touchEndX;

        if (Math.abs(diff) > SWIPE_THRESHOLD) {
            diff > 0 ? nextSlide() : prevSlide();
        }
    }, { passive: true });

    // Pause on hover
    slider.addEventListener('mouseenter', () => clearInterval(autoPlayTimer));
    slider.addEventListener('mouseleave', startAutoPlay);

    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
        const section = document.getElementById('testimonials');
        const rect = section.getBoundingClientRect();
        if (rect.top < window.innerHeight && rect.bottom > 0) {
            if (e.key === 'ArrowLeft') prevSlide();
            if (e.key === 'ArrowRight') nextSlide();
        }
    });

    startAutoPlay();
}

/* ----------------------------------------------------------
   9. Contact / Enroll Form Validation
   ---------------------------------------------------------- */
function initFormValidation() {
    const form = document.getElementById('enrollForm');
    const submitBtn = document.getElementById('submitBtn');
    const formSuccess = document.getElementById('formSuccess');

    if (!form) return;

    // Field references
    const fields = {
        fname: { el: document.getElementById('fname'), err: document.getElementById('fnameError') },
        femail: { el: document.getElementById('femail'), err: document.getElementById('femailError') },
        fphone: { el: document.getElementById('fphone'), err: document.getElementById('fphoneError') },
    };

    // Inline validation on blur
    Object.entries(fields).forEach(([key, field]) => {
        field.el.addEventListener('blur', () => validateField(key, field));
        field.el.addEventListener('input', () => clearError(field));
    });

    form.addEventListener('submit', (e) => {
        e.preventDefault();

        let isValid = true;

        // Validate all required fields
        Object.entries(fields).forEach(([key, field]) => {
            if (!validateField(key, field)) isValid = false;
        });

        if (!isValid) return;

        // Submit feedback — simulate async
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Submitting...';

        setTimeout(() => {
            form.reset();
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="fa-solid fa-paper-plane"></i> Submit Enrollment Request';
            formSuccess.classList.add('visible');

            // Hide success after 6s
            setTimeout(() => formSuccess.classList.remove('visible'), 6000);
        }, 1800);
    });

    /** Validate a single field and return true if valid */
    function validateField(key, field) {
        const value = field.el.value.trim();

        clearError(field);

        if (key === 'fname') {
            if (!value) {
                showError(field, 'Full name is required.');
                return false;
            }
            if (value.length < 2) {
                showError(field, 'Name must be at least 2 characters.');
                return false;
            }
        }

        if (key === 'femail') {
            if (!value) {
                showError(field, 'Email address is required.');
                return false;
            }
            const emailReg = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailReg.test(value)) {
                showError(field, 'Please enter a valid email address.');
                return false;
            }
        }

        if (key === 'fphone') {
            if (!value) {
                showError(field, 'Phone number is required.');
                return false;
            }
            const phoneReg = /^[\d\s\+\-\(\)]{7,15}$/;
            if (!phoneReg.test(value)) {
                showError(field, 'Please enter a valid phone number.');
                return false;
            }
        }

        return true;
    }

    function showError(field, msg) {
        field.el.classList.add('error');
        field.err.textContent = '⚠ ' + msg;
        field.err.classList.add('visible');
    }

    function clearError(field) {
        field.el.classList.remove('error');
        field.err.textContent = '';
        field.err.classList.remove('visible');
    }
}

/* ----------------------------------------------------------
   10. Scroll-to-Top Button
   ---------------------------------------------------------- */
function initScrollTop() {
    const btn = document.getElementById('scrollTop');
    if (!btn) return;

    window.addEventListener('scroll', () => {
        if (window.scrollY > 400) {
            btn.classList.add('visible');
        } else {
            btn.classList.remove('visible');
        }
    }, { passive: true });

    btn.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
}

/* ----------------------------------------------------------
   11. Reveal Animations via IntersectionObserver
   ---------------------------------------------------------- */
function initRevealAnimations() {
    // Add reveal class to target elements
    const revealSelectors = [
        '.feature-card',
        '.objective-card',
        '.benefit-item',
        '.visual-card',
        '.detail-card',
        '.testimonial-card',
        '.contact-detail-item',
        '.faq-item',
        '.about-content-col',
        '.about-image-col',
        '.section-header',
        '.intake-banner',
        '.enroll-form',
        '.contact-info-col',
    ];

    revealSelectors.forEach(sel => {
        document.querySelectorAll(sel).forEach((el, idx) => {
            el.classList.add('reveal');
            // Staggered delay for grid children
            const delay = Math.min(idx % 4, 3);
            if (delay > 0) el.classList.add(`reveal-delay-${delay}`);
        });
    });

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('revealed');
                observer.unobserve(entry.target);
            }
        });
    }, { rootMargin: '0px 0px -60px 0px', threshold: 0.08 });

    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
}