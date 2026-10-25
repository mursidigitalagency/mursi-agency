# Mursi Digital Solutions — Website

Static website for **Mursi Digital Solutions** (AI Automation · Web Design & Development · Local SEO).
Plain HTML, CSS and vanilla JavaScript in [`static-site/`](static-site/). No server, database or framework needed.

## Run / deploy

- **Preview:** open `static-site/index.html` in a browser.
- **Deploy:** upload the contents of `static-site/` to any static host (Netlify, Vercel, GitHub Pages, cPanel).

## Editing content

All text, prices, FAQs, testimonials, projects and contact details live in
[`static-site/data.js`](static-site/data.js). After editing it, regenerate the pages:

```
cd static-site
node build.js
```

Don't edit the `.html` files by hand; `build.js` overwrites them.

### Settings (`config` in `data.js`)

- `email`, `phone`, `address`, `city`, `hours`: shown in the footer and on the Contact page.
- `whatsapp`: number with country code, e.g. `923001234567`. Enables the floating WhatsApp button and WhatsApp CTAs.
- `bookingUrl`: Calendly or similar. Empty = "Book a Free Call" goes to the Contact page.
- `mapEmbed`: the `src` from a Google Maps embed code.
- `formEndpoint`: see *Contact form* below.
- `siteUrl`: your domain, e.g. `https://mursidigital.com`. Used for canonical links and schema.
- `socials`: Facebook, Instagram, LinkedIn, X and YouTube URLs.

To change the brand color, edit `--brand`, `--brand-dark` and `--brand-soft` at the top of `static-site/assets/css/style.css`.

### Portfolio

Add projects to the `projects` array in `data.js` (`title`, `excerpt`, `types` using service slugs, optional `image` and `url`). Until there are projects, the Portfolio page shows "Projects coming soon".

### Contact form

There is no server, so the form can't send email by itself:

- `formEndpoint` empty: the form opens the visitor's email app with the message filled in.
- `formEndpoint` set to a form service URL (e.g. Formspree): the form posts there and shows a success message.

> ⚠️ Replace the placeholder **testimonials**, **prices** and **About page stats** (50+ projects, etc.) with your real numbers before going live.

## Features

- Light, clean, responsive design (Inter font, CSS variables, no framework, no jQuery)
- Home, 3 service pages, About, Portfolio (filterable), Pricing (tabs), Contact, 404
- Floating WhatsApp button
- Local SEO schema (`ProfessionalService` JSON-LD) + `FAQPage` schema for every FAQ section
- Accessible: skip link, focus states, ARIA on menu/FAQ/tabs, reduced-motion support

## File map

```
static-site/
  data.js             all content and settings
  build.js            generates the .html pages from data.js
  *.html              generated pages
  assets/css/style.css
  assets/js/main.js   mobile menu, FAQ, pricing tabs, portfolio filter, contact form, scroll reveal
```
