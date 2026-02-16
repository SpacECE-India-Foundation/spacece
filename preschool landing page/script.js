// ============================================
// SPACEECE PRESCHOOL - JAVASCRIPT
// ============================================

// Wait for DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    
    // ============================================
    // MOBILE MENU TOGGLE
    // ============================================
    const mobileToggle = document.getElementById('mobileToggle');
    const nav = document.getElementById('nav');
    
    if (mobileToggle && nav) {
        mobileToggle.addEventListener('click', function() {
            this.classList.toggle('active');
            nav.classList.toggle('active');
            
            // Prevent body scroll when menu is open
            if (nav.classList.contains('active')) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = '';
            }
        });
        
        // Close menu when clicking on a link
        const navLinks = nav.querySelectorAll('a');
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                mobileToggle.classList.remove('active');
                nav.classList.remove('active');
                document.body.style.overflow = '';
            });
        });
    }
    
    // ============================================
    // STICKY HEADER ON SCROLL
    // ============================================
    const header = document.getElementById('header');
    let lastScroll = 0;
    
    window.addEventListener('scroll', function() {
        const currentScroll = window.pageYOffset;
        
        // Add scrolled class for shadow effect
        if (currentScroll > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
        
        lastScroll = currentScroll;
    });
    
    // ============================================
    // SMOOTH SCROLL FOR ANCHOR LINKS
    // ============================================
    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    
    anchorLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            
            // Skip if it's just "#"
            if (href === '#') {
                e.preventDefault();
                return;
            }
            
            const target = document.querySelector(href);
            
            if (target) {
                e.preventDefault();
                
                const headerHeight = header.offsetHeight;
                const targetPosition = target.offsetTop - headerHeight - 20;
                
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
    
    // ============================================
    // INTERSECTION OBSERVER FOR ANIMATIONS
    // ============================================
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);
    
    // Observe sections for fade-in animation
    const sections = document.querySelectorAll('section');
    sections.forEach(section => {
        section.style.opacity = '0';
        section.style.transform = 'translateY(30px)';
        section.style.transition = 'opacity 0.8s ease, transform 0.8s ease';
        observer.observe(section);
    });
    
    // ============================================
    // FORM VALIDATION & SUBMISSION
    // ============================================
    const contactForm = document.getElementById('contactForm');
    
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form values
            const formData = {
                parentName: document.getElementById('parentName').value,
                phone: document.getElementById('phone').value,
                email: document.getElementById('email').value,
                childName: document.getElementById('childName').value,
                childAge: document.getElementById('childAge').value,
                program: document.getElementById('program').value,
                message: document.getElementById('message').value
            };
            
            // Validate required fields
            if (!formData.parentName || !formData.phone) {
                showNotification('Please fill in all required fields', 'error');
                return;
            }
            
            // Validate phone number (basic validation for Indian numbers)
            const phoneRegex = /^[6-9]\d{9}$/;
            if (!phoneRegex.test(formData.phone.replace(/\s+/g, ''))) {
                showNotification('Please enter a valid 10-digit phone number', 'error');
                return;
            }
            
            // Validate email if provided
            if (formData.email) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(formData.email)) {
                    showNotification('Please enter a valid email address', 'error');
                    return;
                }
            }
            
            // Simulate form submission (replace with actual API call)
            console.log('Form submitted:', formData);
            
            // Show success message
            showNotification('Thank you! We will contact you within 24 hours.', 'success');
            
            // Reset form
            contactForm.reset();
            
            // In production, you would send this data to your server:
            /*
            fetch('/api/contact', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(formData)
            })
            .then(response => response.json())
            .then(data => {
                showNotification('Thank you! We will contact you within 24 hours.', 'success');
                contactForm.reset();
            })
            .catch(error => {
                showNotification('Something went wrong. Please try again.', 'error');
            });
            */
        });
    }
    
    // ============================================
    // NOTIFICATION SYSTEM
    // ============================================
    function showNotification(message, type = 'success') {
        // Create notification element if it doesn't exist
        let notification = document.getElementById('notification');
        
        if (!notification) {
            notification = document.createElement('div');
            notification.id = 'notification';
            notification.style.cssText = `
                position: fixed;
                top: 100px;
                right: 20px;
                padding: 16px 24px;
                border-radius: 8px;
                font-weight: 600;
                font-family: 'Fredoka', sans-serif;
                box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2);
                z-index: 10000;
                transform: translateX(400px);
                transition: transform 0.3s ease;
                max-width: 350px;
            `;
            document.body.appendChild(notification);
        }
        
        // Set notification style based on type
        if (type === 'success') {
            notification.style.backgroundColor = '#F4A300';
            notification.style.color = '#000000';
        } else {
            notification.style.backgroundColor = '#DC3545';
            notification.style.color = '#FFFFFF';
        }
        
        // Set message
        notification.textContent = message;
        
        // Show notification
        setTimeout(() => {
            notification.style.transform = 'translateX(0)';
        }, 100);
        
        // Hide notification after 4 seconds
        setTimeout(() => {
            notification.style.transform = 'translateX(400px)';
        }, 4000);
    }
    
    // ============================================
    // LAZY LOADING FOR IMAGES (if you add images later)
    // ============================================
    const lazyImages = document.querySelectorAll('img[data-src]');
    
    if (lazyImages.length > 0) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.removeAttribute('data-src');
                    imageObserver.unobserve(img);
                }
            });
        });
        
        lazyImages.forEach(img => imageObserver.observe(img));
    }
    
    // ============================================
    // COUNTER ANIMATION FOR STATS (if needed)
    // ============================================
    function animateCounter(element, target, duration = 2000) {
        const start = 0;
        const increment = target / (duration / 16);
        let current = start;
        
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                element.textContent = target;
                clearInterval(timer);
            } else {
                element.textContent = Math.floor(current);
            }
        }, 16);
    }
    
    // ============================================
    // TESTIMONIALS CAROUSEL AUTO-PLAY (Optional Enhancement)
    // ============================================
    const testimonialCards = document.querySelectorAll('.testimonial-card');
    if (testimonialCards.length > 0) {
        let currentTestimonial = 0;
        
        // This can be expanded to create a carousel effect
        // For now, we're using a grid layout which is more accessible
    }
    
    // ============================================
    // MOBILE STICKY CTA SHOW/HIDE ON SCROLL
    // ============================================
    const mobileCta = document.querySelector('.mobile-sticky-cta');
    const admissionSection = document.getElementById('admission');
    
    if (mobileCta && admissionSection) {
        const ctaObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    mobileCta.style.display = 'none';
                } else {
                    mobileCta.style.display = 'block';
                }
            });
        }, {
            threshold: 0.1
        });
        
        ctaObserver.observe(admissionSection);
    }
    
    // ============================================
    // PROGRAM CARDS HOVER EFFECT ENHANCEMENT
    // ============================================
    const programCards = document.querySelectorAll('.program-card');
    
    programCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px) scale(1.02)';
        });
        
        card.addEventListener('mouseleave', function() {
            if (this.classList.contains('featured')) {
                this.style.transform = 'translateY(0) scale(1)';
            } else {
                this.style.transform = 'translateY(0) scale(1)';
            }
        });
    });
    
    // ============================================
    // TRACK ANALYTICS EVENTS (Optional - integrate with Google Analytics)
    // ============================================
    function trackEvent(category, action, label) {
        if (typeof gtag !== 'undefined') {
            gtag('event', action, {
                'event_category': category,
                'event_label': label
            });
        }
        console.log('Event tracked:', category, action, label);
    }
    
    // Track CTA button clicks
    const ctaButtons = document.querySelectorAll('.btn-primary, .btn-secondary');
    ctaButtons.forEach(button => {
        button.addEventListener('click', function() {
            const buttonText = this.textContent.trim();
            trackEvent('CTA', 'click', buttonText);
        });
    });
    
    // Track WhatsApp button clicks
    const whatsappButton = document.querySelector('.whatsapp-float');
    if (whatsappButton) {
        whatsappButton.addEventListener('click', function() {
            trackEvent('Contact', 'click', 'WhatsApp');
        });
    }
    
    // Track program card clicks
    const programLinks = document.querySelectorAll('.program-link');
    programLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const programTitle = this.closest('.program-card').querySelector('.program-title').textContent;
            trackEvent('Program', 'click', programTitle);
        });
    });
    
    // ============================================
    // PERFORMANCE OPTIMIZATION
    // ============================================
    
    // Debounce function for scroll events
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }
    
    // ============================================
    // ACCESSIBILITY ENHANCEMENTS
    // ============================================
    
    // Add keyboard navigation for cards
    const interactiveCards = document.querySelectorAll('.program-card, .area-card, .gain-card');
    
    interactiveCards.forEach(card => {
        // Make cards focusable
        card.setAttribute('tabindex', '0');
        
        // Add keyboard support
        card.addEventListener('keypress', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                const link = this.querySelector('a');
                if (link) {
                    link.click();
                }
            }
        });
    });
    
    // ============================================
    // CONSOLE WELCOME MESSAGE
    // ============================================
    console.log('%c👋 Welcome to SpaceECE Preschool!', 'font-size: 20px; font-weight: bold; color: #F4A300;');
    console.log('%cWhere Little Stars Shine Bright ⭐', 'font-size: 14px; color: #666;');
    console.log('%cInterested in joining our team? Email us at careers@spaceece.com', 'font-size: 12px; color: #999;');
    
    // ============================================
    // INITIALIZATION COMPLETE
    // ============================================
    console.log('✅ SpaceECE landing page initialized successfully');
});

// ============================================
// UTILITY FUNCTIONS
// ============================================

// Get query parameters from URL
function getQueryParam(param) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(param);
}

// Check if element is in viewport
function isInViewport(element) {
    const rect = element.getBoundingClientRect();
    return (
        rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
}

// Format phone number
function formatPhoneNumber(phoneNumber) {
    const cleaned = ('' + phoneNumber).replace(/\D/g, '');
    const match = cleaned.match(/^(\d{5})(\d{5})$/);
    if (match) {
        return match[1] + ' ' + match[2];
    }
    return phoneNumber;
}

// ============================================
// EXPORT FOR TESTING (if needed)
// ============================================
if (typeof module !== 'undefined' && module.exports) {
    module.exports = {
        formatPhoneNumber,
        isInViewport,
        getQueryParam
    };
}
