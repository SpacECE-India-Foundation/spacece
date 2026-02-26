/**
 * SpacECE India Foundation – Neo Doodle Preschool Landing Page
 * JavaScript: Interactions, Animations, Nav
 */

"use strict";

document.addEventListener("DOMContentLoaded", () => {
  initSplashScreen();
  initStickyHeader();
  initMobileMenu();
  initSmoothScroll();
  initScrollReveal();
  initCounterAnimation();
  initCtaSketchArrows();
  initTestimonialSlider();
  initEnrollForm();
  initFaqAccordion();
  initActiveNavHighlight();
  initTiltEffect();
  initBackToTop();
});

/* =========================
   SPLASH SCREEN
========================= */
function initSplashScreen() {
  const splash = $("#splash-screen");
  if (!splash) return;

  // Prevent scrolling while splash is active
  document.body.style.overflow = "hidden";

  // Hide splash after 2.5 seconds (gives time for logo pop and loader to finish)
  setTimeout(() => {
    splash.classList.add("hidden");
    document.body.style.overflow = ""; // Restore scrolling
  }, 2500);
}

const $ = (selector, scope = document) => scope.querySelector(selector);
const $$ = (selector, scope = document) => scope.querySelectorAll(selector);

/* =========================
   STICKY HEADER
========================= */
function initStickyHeader() {
  const header = $("#header");
  if (!header) return;

  window.addEventListener("scroll", () => {
    if (window.scrollY > 50) {
      header.classList.add("scrolled");
    } else {
      header.classList.remove("scrolled");
    }
  }, { passive: true });
}

/* =========================
   MOBILE MENU TOGGLE
========================= */
function initMobileMenu() {
  const hamburger = $("#hamburger");
  const nav = $("#mainNav");

  if (!hamburger || !nav) return;

  hamburger.addEventListener("click", () => {
    hamburger.classList.toggle("active");
    nav.classList.toggle("open");
  });

  $$(".nav__link", nav).forEach(link => {
    link.addEventListener("click", () => {
      hamburger.classList.remove("active");
      nav.classList.remove("open");
    });
  });
}

/* =========================
   SMOOTH SCROLL
========================= */
function initSmoothScroll() {
  $$('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener("click", (e) => {
      const href = anchor.getAttribute("href");
      if (!href || href === "#") return;

      const target = $(href);
      if (!target) return;

      e.preventDefault();
      const headerHeight = 84;
      const targetY = target.getBoundingClientRect().top + window.scrollY - headerHeight;

      window.scrollTo({ top: targetY, behavior: "smooth" });
    });
  });
}

/* =========================
   SCROLL REVEAL ANIMATION
========================= */
function initScrollReveal() {
  const elements = $$(".reveal");
  if (!elements.length || !("IntersectionObserver" in window)) {
    elements.forEach(el => el.classList.add("revealed"));
    return;
  }

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add("revealed");
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.15, rootMargin: "0px 0px -40px 0px" });

  elements.forEach(el => observer.observe(el));
}

/* =========================
   COUNTER / NUMBER ANIMATION
========================= */
function initCounterAnimation() {
  const counters = $$(".stat__num[data-target]");
  if (!counters.length || !("IntersectionObserver" in window)) return;

  const animateCounter = (element, target) => {
    let start = null;
    const duration = 2000;

    const step = (timestamp) => {
      if (!start) start = timestamp;
      const progress = Math.min((timestamp - start) / duration, 1);
      const eased = 1 - Math.pow(1 - progress, 3); // ease-out cubic

      element.textContent = Math.round(target * eased);

      if (progress < 1) {
        requestAnimationFrame(step);
      }
    };
    requestAnimationFrame(step);
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        const target = parseInt(entry.target.getAttribute("data-target"), 10);
        animateCounter(entry.target, target);
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.5 });

  counters.forEach(counter => observer.observe(counter));
}

/* =========================
   CTA SKETCH ARROWS
========================= */
function initCtaSketchArrows() {
  const heroCandidates = $$(".hero__actions .btn");
  const targetInHero = Array.from(heroCandidates).find((el) =>
    el.textContent && el.textContent.trim() === "Book a Free Campus Visit"
  );
  const candidates = $$("a.btn, button.btn");
  const fallbackTarget = Array.from(candidates).find((el) =>
    el.textContent && el.textContent.trim() === "Book a Free Campus Visit"
  );
  const target = targetInHero || fallbackTarget;
  if (!target || target.closest(".cta-sketch-wrap")) return;

  const arrowSvg = '<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M3 16C8 10 13 11 18 8"/><path d="M14.5 5.5L20 8L16.5 13"/></svg>';
  const positions = ["top", "right", "bottom", "left", "tl", "tr", "bl", "br"];
  const wrap = document.createElement("div");
  wrap.className = "cta-sketch-wrap";
  target.parentNode.insertBefore(wrap, target);
  wrap.appendChild(target);

  const layer = document.createElement("div");
  layer.className = "cta-sketch-layer";
  layer.setAttribute("aria-hidden", "true");
  layer.innerHTML = positions.map((pos) => `<span class="cta-arrow-node ${pos}">${arrowSvg}</span>`).join("");
  wrap.appendChild(layer);

  if (!("IntersectionObserver" in window)) {
    wrap.classList.add("is-active");
    return;
  }

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      entry.target.classList.toggle("is-active", entry.isIntersecting);
    });
  }, { threshold: 0.2 });

  observer.observe(wrap);
}

/* =========================
   ACTIVE NAV HIGHLIGHT
========================= */
function initActiveNavHighlight() {
  const sections = $$("section[id]");
  const navLinks = $$(".nav__link");

  if (!sections.length || !navLinks.length || !("IntersectionObserver" in window)) return;

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        const id = entry.target.getAttribute("id");
        navLinks.forEach(link => {
          link.classList.remove("active");
          if (link.getAttribute("href") === `#${id}`) {
            link.classList.add("active");
          }
        });
      }
    });
  }, { threshold: 0.35 });

  sections.forEach(section => observer.observe(section));
}

/* =========================
   ENROLL FORM MOCK SUBMIT
========================= */
function initEnrollForm() {
  const form = $("#enrollForm");
  if (!form) return;

  form.addEventListener("submit", (e) => {
    e.preventDefault();
    const btn = form.querySelector("button[type='submit']");
    const originalText = btn.textContent;

    btn.textContent = "Sending Magic... ✨";
    btn.disabled = true;

    setTimeout(() => {
      alert("Application sent successfully! We will contact you soon.");
      btn.textContent = originalText;
      btn.disabled = false;
      form.reset();
    }, 1500);
  });
}

/* =========================
   FAQ ACCORDION
========================= */
function initFaqAccordion() {
  const accordion = $("#faqAccordion");
  if (!accordion) return;

  const questions = $$(".faq-question", accordion);
  const questionList = Array.from(questions);

  const closeItem = (btn) => {
    const panel = $("#" + btn.getAttribute("aria-controls"));
    if (!panel) return;

    btn.setAttribute("aria-expanded", "false");
    panel.classList.remove("open");
    panel.style.maxHeight = "0px";
  };

  const openItem = (btn) => {
    const panel = $("#" + btn.getAttribute("aria-controls"));
    if (!panel) return;

    btn.setAttribute("aria-expanded", "true");
    panel.classList.add("open");
    panel.style.maxHeight = panel.scrollHeight + "px";
  };

  const toggleItem = (btn) => {
    const isOpen = btn.getAttribute("aria-expanded") === "true";

    questionList.forEach((q) => {
      if (q !== btn) closeItem(q);
    });

    if (isOpen) {
      closeItem(btn);
    } else {
      openItem(btn);
    }
  };

  questionList.forEach((btn) => {
    const panel = $("#" + btn.getAttribute("aria-controls"));
    if (!panel) return;

    if (btn.getAttribute("aria-expanded") === "true") {
      panel.style.maxHeight = panel.scrollHeight + "px";
      panel.classList.add("open");
    } else {
      panel.style.maxHeight = "0px";
      panel.classList.remove("open");
    }

    btn.addEventListener("click", () => toggleItem(btn));
  });

  window.addEventListener("resize", () => {
    const openBtn = questionList.find((q) => q.getAttribute("aria-expanded") === "true");
    if (!openBtn) return;

    const panel = $("#" + openBtn.getAttribute("aria-controls"));
    if (panel) panel.style.maxHeight = panel.scrollHeight + "px";
  });
}

/* =========================
   TESTIMONIAL SLIDER
========================= */
function initTestimonialSlider() {
  const slider = $("#testimonialSlider");
  if (!slider) return;

  const viewport = $(".ts-viewport", slider);
  const track = $(".ts-track", slider);
  const prevBtn = $(".ts-nav--prev", slider);
  const nextBtn = $(".ts-nav--next", slider);
  const dotsWrap = $(".ts-dots", slider);
  if (!viewport || !track || !prevBtn || !nextBtn || !dotsWrap) return;

  const originals = Array.from($$(".ts-card", track));
  const count = originals.length;
  if (count < 2) return;

  const firstClone = originals[0].cloneNode(true);
  const lastClone = originals[count - 1].cloneNode(true);
  firstClone.classList.add("is-clone");
  lastClone.classList.add("is-clone");
  track.appendChild(firstClone);
  track.insertBefore(lastClone, originals[0]);

  let allCards = Array.from($$(".ts-card", track));
  let currentIndex = 1;
  let step = 0;
  let timer = null;
  let sliderInView = true;

  const buildDots = () => {
    dotsWrap.innerHTML = "";
    for (let i = 0; i < count; i += 1) {
      const dot = document.createElement("button");
      dot.type = "button";
      dot.className = "ts-dot";
      dot.setAttribute("aria-label", `Go to testimonial ${i + 1}`);
      dot.addEventListener("click", () => {
        currentIndex = i + 1;
        updateTrack(true);
      });
      dotsWrap.appendChild(dot);
    }
  };

  const updateDots = () => {
    const active = (currentIndex - 1 + count) % count;
    Array.from($$(".ts-dot", dotsWrap)).forEach((dot, idx) => {
      dot.classList.toggle("active", idx === active);
    });
  };

  const measure = () => {
    allCards = Array.from($$(".ts-card", track));
    const first = allCards[0];
    if (!first) return;
    const gap = parseFloat(getComputedStyle(track).gap || "0");
    step = first.getBoundingClientRect().width + gap;
  };

  const updateTrack = (animate) => {
    track.style.transition = animate ? "transform 0.6s cubic-bezier(0.4, 0, 0.2, 1)" : "none";
    track.style.transform = `translateX(${-currentIndex * step}px)`;
    updateDots();
  };

  const jumpIfClone = () => {
    if (currentIndex === 0) {
      currentIndex = count;
      updateTrack(false);
    } else if (currentIndex === count + 1) {
      currentIndex = 1;
      updateTrack(false);
    }
  };

  const goNext = () => {
    currentIndex += 1;
    updateTrack(true);
  };

  const goPrev = () => {
    currentIndex -= 1;
    updateTrack(true);
  };

  const startAuto = () => {
    if (!sliderInView) return;
    clearInterval(timer);
    timer = setInterval(goNext, 4000);
  };

  const stopAuto = () => {
    clearInterval(timer);
    timer = null;
  };

  buildDots();
  measure();
  updateTrack(false);

  nextBtn.addEventListener("click", goNext);
  prevBtn.addEventListener("click", goPrev);
  track.addEventListener("transitionend", jumpIfClone);

  slider.addEventListener("mouseenter", stopAuto);
  slider.addEventListener("mouseleave", startAuto);
  slider.addEventListener("focusin", stopAuto);
  slider.addEventListener("focusout", startAuto);

  if ("IntersectionObserver" in window) {
    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.target !== slider) return;
        sliderInView = entry.isIntersecting;
        if (sliderInView) startAuto();
        else stopAuto();
      });
    }, { threshold: 0.25 });

    observer.observe(slider);
  }

  document.addEventListener("visibilitychange", () => {
    if (document.hidden) stopAuto();
    else startAuto();
  });

  window.addEventListener("resize", () => {
    measure();
    updateTrack(false);
  }, { passive: true });

  startAuto();
}

/* =========================
   3D TILT EFFECT (DESKTOP)
========================= */
function initTiltEffect() {
  if ("ontouchstart" in window) return;

  const tiltElements = $$(".step-card, .gain-card, .g-item");

  tiltElements.forEach(el => {
    el.addEventListener("mousemove", (e) => {
      const rect = el.getBoundingClientRect();
      const x = (e.clientX - rect.left) / rect.width - 0.5;
      const y = (e.clientY - rect.top) / rect.height - 0.5;

      const tiltX = (y * -10).toFixed(2);
      const tiltY = (x * 10).toFixed(2);

      el.style.transform = `perspective(800px) rotateX(${tiltX}deg) rotateY(${tiltY}deg) scale(1.02)`;
    });

    el.addEventListener("mouseleave", () => {
      el.style.transform = "";
    });
  });
}

/* =========================
   BACK TO TOP BUTTON
========================= */
function initBackToTop() {
  const btn = $("#backToTop");
  if (!btn) return;

  window.addEventListener("scroll", () => {
    if (window.scrollY > 300) {
      btn.classList.add("visible");
    } else {
      btn.classList.remove("visible");
    }
  }, { passive: true });

  btn.addEventListener("click", () => {
    window.scrollTo({ top: 0, behavior: "smooth" });
  });
}
