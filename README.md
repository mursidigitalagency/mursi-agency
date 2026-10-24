# Mursi Digital Solutions — WordPress Theme

Custom, lightweight WordPress theme for **Mursi Digital Solutions** (AI Automation · Web Design & Development · Local SEO).
Theme code is in [`mursi-digital/`](mursi-digital/).

## Install

1. Zip the `mursi-digital` folder (the zip must contain the folder itself).
2. WP Admin → **Appearance → Themes → Add New → Upload Theme** → upload zip → **Activate**.

## Setup (one time)

1. **Pages** — create these pages (slug matters) and pick the template from *Page Attributes → Template*:

   | Page title | Slug | Template |
   |---|---|---|
   | Home | `home` | Default (shown via `front-page.php`) |
   | AI Automation | `ai-automation` | Service Page |
   | Web Design & Development | `web-design-development` | Service Page |
   | Local SEO | `local-seo` | Service Page |
   | About | `about` | About Page |
   | Portfolio | `portfolio` | Portfolio Page |
   | Pricing | `pricing` | Pricing Page |
   | Contact | `contact` | Contact Page |
   | Blog (optional) | `blog` | Default |

2. **Settings → Reading** → "A static page": Homepage = *Home*, Posts page = *Blog*.
3. **Settings → Permalinks** → *Post name* → Save (also refreshes portfolio URLs).
4. **Appearance → Menus** → create a menu, assign to *Primary Menu* (put the 3 service pages under a "Services" item). Until then a default menu is shown.
5. **Appearance → Customize**
   - *Site Identity*: logo, site title, tagline.
   - *Mursi: Contact & Business Info*: email, phone, **WhatsApp number** (e.g. `923001234567` — enables the floating WhatsApp button), city, hours, booking link, Google Maps embed URL.
   - *Mursi: Social Links*.
   - *Colors → Brand color* to change the blue accent.
6. **Portfolio → Add New Project**: title, description, excerpt, featured image (960×600 ideal), *Project Type* (AI Automation / Web Design & Development / Local SEO — created automatically on activation), client and live URL.
7. Install **WP Mail SMTP** so contact form emails are delivered reliably.

## Editing content

All marketing copy (services, pricing, FAQs, testimonials, process) lives in
[`mursi-digital/inc/data.php`](mursi-digital/inc/data.php). Edit the text/prices there.
Anything you type in a page's editor is also displayed on that page.

> ⚠️ Replace the placeholder **testimonials**, **prices** and **About page stats** (50+ projects, etc.) with your real numbers before going live.

## Features

- Light, clean, responsive design (Inter font, CSS variables, no page builder / no jQuery)
- Home, 3 service pages, About, Portfolio (filterable), Pricing (tabs), Contact, Blog, 404
- Portfolio custom post type with categories
- Contact form with nonce, honeypot spam protection and `wp_mail`
- Floating WhatsApp button
- Local SEO schema (`ProfessionalService` JSON-LD) + `FAQPage` schema for every FAQ section
- Accessible: skip link, focus states, ARIA on menu/FAQ/tabs, reduced-motion support

## File map

```
mursi-digital/
  style.css, functions.php, header.php, footer.php
  front-page.php, page.php, index.php, single.php, single-project.php, 404.php
  page-templates/   service, about, portfolio, pricing, contact
  template-parts/   hero, services grid, why-us, process, portfolio, testimonials, faq, pricing, cta, contact form
  inc/              data (content), customizer, post types, contact form handler, schema, helpers
  assets/js/main.js mobile menu, FAQ, pricing tabs, portfolio filter, scroll reveal
```
