// Simple button animation effect

document.querySelectorAll("button").forEach(btn => {
    btn.addEventListener("mouseenter", () => {
        btn.style.transform = "scale(1.05)";
        btn.style.transition = "0.3s";
    });

    btn.addEventListener("mouseleave", () => {
        btn.style.transform = "scale(1)";
    });
});

// ---- MOBILE HAMBURGER MENU ----
function toggleMobileMenu() {
    const hamburger = document.getElementById("hamburger");
    const navLinks = document.getElementById("navLinks");
    hamburger.classList.toggle("open");
    navLinks.classList.toggle("open");
}

// Auto-close mobile menu when a nav link is clicked
document.querySelectorAll(".nav-links li a").forEach(link => {
    link.addEventListener("click", () => {
        const hamburger = document.getElementById("hamburger");
        const navLinks = document.getElementById("navLinks");
        hamburger.classList.remove("open");
        navLinks.classList.remove("open");
    });
});

// ---- OFFER SECTION CAROUSEL ----
const carouselImages = [
    "assets/image1.png",
    "assets/image2.png",
    "assets/image3.png",
    "assets/image4.png"
];

function changeSlide(index) {
    // Update image
    const img = document.getElementById("offerImg");
    if (img) {
        img.style.opacity = "0";
        img.style.transition = "opacity 0.3s ease";
        setTimeout(() => {
            img.src = carouselImages[index];
            img.style.opacity = "1";
        }, 300);
    }

    // Update dots
    document.querySelectorAll(".dot").forEach((dot, i) => {
        dot.classList.toggle("active", i === index);
    });
}

// Auto-slide every 3 seconds
let currentSlide = 0;
setInterval(() => {
    currentSlide = (currentSlide + 1) % carouselImages.length;
    changeSlide(currentSlide);
}, 3000);

// ---- TESTIMONIALS REDESIGN (Fan-Stack Logic) ----
let activeTesti = 2; // Middle card starts as active (0-4)
const testiStack = document.getElementById("testiStack");
const testiCardsList = () => document.querySelectorAll(".testi-card-stack");
const testiDots = () => document.querySelectorAll(".pager-dot");

function updateTestiStack() {
    const cards = testiCardsList();
    const dots = testiDots();
    const total = cards.length;

    cards.forEach((card, i) => {
        // Calculate relative position to activeTesti (circular)
        let pos = (i - activeTesti + 2 + total) % total;

        // Remove old position classes
        card.className = "testi-card-stack";

        // Add new position class
        card.classList.add(`p-${pos}`);

        // Handle pager
        if (i === activeTesti) {
            dots[i].classList.add("active");
            card.classList.add("active");
        } else {
            dots[i].classList.remove("active");
        }
    });
}

function jumpToTesti(index) {
    activeTesti = index;
    updateTestiStack();
}

// Auto-rotate every 5s
let testiInterval = setInterval(() => {
    activeTesti = (activeTesti + 1) % 5;
    updateTestiStack();
}, 5000);

// Initialize on load
document.addEventListener("DOMContentLoaded", () => {
    updateTestiStack();
});

// Allow clicking cards to jump
document.querySelectorAll(".testi-card-stack").forEach((card, i) => {
    card.addEventListener("click", () => {
        jumpToTesti(i);
        // Reset interval on manual interaction
        clearInterval(testiInterval);
        testiInterval = setInterval(() => {
            activeTesti = (activeTesti + 1) % 5;
            updateTestiStack();
        }, 5000);
    });
});

// ---- ENQUIRE NOW POPUP ----
function openEnquirePopup() {
    document.getElementById("enquireOverlay").classList.add("active");
    document.body.style.overflow = "hidden";
}

function closeEnquirePopup(event) {
    // If called from overlay click, only close if clicking the backdrop itself
    if (event && event.target !== document.getElementById("enquireOverlay")) return;
    document.getElementById("enquireOverlay").classList.remove("active");
    document.body.style.overflow = "";
}

function handleEnquireSubmit(event) {
    event.preventDefault();
    const btn = event.target.querySelector(".enquire-submit");
    btn.textContent = "✓ Enquiry Sent!";
    btn.style.background = "#5D005D";
    btn.style.color = "white";
    setTimeout(() => {
        document.getElementById("enquireOverlay").classList.remove("active");
        document.body.style.overflow = "";
        event.target.reset();
        btn.textContent = "Send Enquiry";
        btn.style.background = "";
        btn.style.color = "";
    }, 1800);
}

// ---- VIDEO MODAL (Enjoy Class) ----
const btnEnjoyClass = document.getElementById("btnEnjoyClass");
const videoModal = document.getElementById("videoModal");
const closeVideoModal = document.getElementById("closeVideoModal");
const heroVideo = document.getElementById("heroVideo");
const youtubeUrl = "https://www.youtube.com/embed/IZxkuVx7AGg?si=lAzA9kTEKQ18BsVL&autoplay=1"; // Updated video url

if (btnEnjoyClass && videoModal && heroVideo) {
    btnEnjoyClass.addEventListener("click", () => {
        heroVideo.src = youtubeUrl;
        videoModal.classList.add("active");
        document.body.style.overflow = "hidden";
    });

    const stopVideo = () => {
        videoModal.classList.remove("active");
        heroVideo.src = "";
        document.body.style.overflow = "";
    };

    closeVideoModal.addEventListener("click", stopVideo);

    videoModal.addEventListener("click", (e) => {
        if (e.target === videoModal) stopVideo();
    });
}


// Close popup with Escape key
document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") {
        document.getElementById("enquireOverlay").classList.remove("active");
        if (videoModal && videoModal.classList.contains("active")) {
            videoModal.classList.remove("active");
            heroVideo.src = "";
        }
        document.body.style.overflow = "";
    }
});