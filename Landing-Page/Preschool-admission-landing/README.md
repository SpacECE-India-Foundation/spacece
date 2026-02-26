# SpacECE Preschool Landing Page

A production-ready preschool admissions landing page for **SpacECE Foundation (Pune)** built with plain HTML, CSS, and JavaScript.

## Tech Stack
- HTML5
- CSS3
- Vanilla JavaScript

## Project Structure
- `index.html` - Main page markup
- `style.css` - Source stylesheet
- `style.min.css` - Minified stylesheet (production)
- `script.js` - Source script
- `script.min.js` - Minified script (production)
- `images/` - Image assets (JPEG + optimized WebP)

## How To Run Locally
No build step is required to run.

### Option 1: Open directly
- Open `index.html` in a browser.

### Option 2: Local server (recommended)
```bash
# Python 3
python -m http.server 8000

# then open
http://localhost:8000
```

## Current Production Asset Setup
`index.html` is configured to use:
- `style.min.css`
- `script.min.js` with `defer`
- WebP image sources for optimized assets

## Performance Optimizations Applied
- Added minified production assets:
  - `style.min.css`
  - `script.min.js`
- Switched primary image references to WebP:
  - `images/space.ece.logo.webp`
  - `images/unnamed_1771745946431.webp`
- Added image loading/perf attributes where relevant:
  - `loading="lazy"`
  - `decoding="async"`
  - explicit `width` and `height`
- Added font loading improvements:
  - `preconnect` to Google Fonts domains
  - reduced weights to `400` and `600`
  - `display=swap`
- Added preload for key above-the-fold image
- Updated script loading to non-blocking:
  - `<script src="./script.min.js" defer></script>`
- Reduced non-essential background animation workload
- Added runtime autoplay pause logic for testimonial slider when offscreen/tab hidden

## Content/UX Updates Included
- Location/content normalized to **Pune**
- Footer cleaned and corrected (contact, copyright, social icons)
- Testimonials converted to responsive slider (desktop/tablet/mobile card counts)
- Hero + admissions CTA messaging unified
- CTA sketch-arrow enhancement on the primary hero visit CTA

## Regenerating Minified Files
If you edit `style.css` or `script.js`, regenerate minified files:

```bash
# from project root
npm install terser clean-css-cli --no-save
npx cleancss -o style.min.css style.css
npx terser script.js -c -m -o script.min.js
```

## Deployment Notes
This is a static site. Deploy by uploading repository contents to any static host:
- GitHub Pages
- Netlify
- Vercel
- Any Nginx/Apache static hosting

## Git History (This Optimization Pass)
Main areas changed:
- Performance optimization (fonts/images/minified assets/script loading)
- Footer, hero, visit-section copy corrections
- CTA arrow and testimonial slider behavior improvements

## Contact Details Used In Site
- SpacECE Foundation - Udaan Center
- Raikar Nagar, Dhayari, Pune, Maharashtra
- Phone: +91 99999 99999
- Email: hello@spacece.in

---
© 2026 SpacECE Foundation. All rights reserved.
