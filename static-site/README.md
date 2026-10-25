# Mursi Digital — static HTML/CSS/JS site

Plain HTML version of the WordPress theme. No WordPress, PHP or database is needed: open `index.html` in a browser, or upload this folder to any static host (Netlify, Vercel, GitHub Pages, cPanel).

## Files

- `*.html` — generated pages (don't edit them by hand)
- `assets/css/style.css` — all styles; change `--brand` at the top to restyle
- `assets/js/main.js` — menu, FAQ, pricing tabs, portfolio filter, contact form
- `data.js` — **all text, prices, FAQs, projects and contact details**
- `build.js` — regenerates the HTML from `data.js`

## Changing content

1. Edit `data.js` (email, phone, WhatsApp, prices, FAQs, projects…).
2. Run `node build.js`.

## Contact form

Without a server the form can't send email by itself. In `data.js` → `config`:

- `formEndpoint` empty: the form opens the visitor's email app with the message filled in.
- `formEndpoint` set to a form service URL (e.g. Formspree): the form posts there and shows a success message.

## Before launch

Testimonials, prices and About-page stats are placeholders — replace them in `data.js`. Set `siteUrl` once you have a domain (used for canonical links and schema).
