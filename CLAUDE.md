# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## What this is

A **static website** (plain HTML, CSS, vanilla JavaScript) for Mursi Digital Solutions, an agency selling AI Automation, Web Design & Development (UX/UI + WordPress), and Local SEO. The site lives in `static-site/`; the repo root holds only docs. Site copy is English. No framework, no npm dependencies, no jQuery, no server-side code. (The site *sells* WordPress development; the site itself is not WordPress.)

## Commands

There is no lint or test tooling. Node is the only requirement.

- Regenerate pages: `node static-site/build.js` (run after any change to `data.js` or `build.js`)
- JS syntax check: `node --check static-site/assets/js/main.js`
- Preview: open `static-site/index.html` in a browser. Pages use relative links, so they work from `file://`.

## Architecture

**Content is data, pages are generated.** All copy, prices, FAQs, testimonials, projects and settings live in `static-site/data.js` (CommonJS). `static-site/build.js` turns it into the `.html` files. Never edit the generated `.html` files by hand; change `data.js` (content) or `build.js` (markup) and rebuild. Commit the regenerated HTML together with the source change.

**Service slugs are the join key.** The three service slugs `ai-automation`, `web-design-development`, `local-seo` link together:
- keys of `services` and `pricing` in `data.js`
- the generated page file name (`<slug>.html`)
- the `types` of entries in `projects`, used for the portfolio filter and the "Recent Work" section on service pages
- the `?service=` query arg that preselects the contact form dropdown (matched against `data-slug` on the `<option>`)

Renaming a slug means changing all of these together.

**`build.js` structure.** Helpers (`esc`, `pageUrl`, `bookingUrl`, `whatsappUrl`, `icon`), then `layout()` (head, header, footer, JSON-LD), then section functions mirroring reusable blocks (`pageHero`, `servicesGrid`, `faqSection`, `pricingTable`, `cta`, …) that take an options object with defaults, then one function per page. Add a page by writing a page function and registering it in the `pages` map at the bottom.

**Settings.** `config` in `data.js` holds email, phone, WhatsApp, booking URL, map embed, form endpoint, site URL and social links. WhatsApp buttons only render when `config.whatsapp` is set. `bookingUrl()` falls back to `contact.html`. Brand color is the `--brand*` CSS variables in `style.css`.

**Schema.** The home page gets `ProfessionalService` JSON-LD. Pages pass their rendered FAQs to `layout({ faqs })`, which prints one combined `FAQPage` block. Absolute URLs (canonical, schema `url`) are only emitted when `config.siteUrl` is set.

**Contact form.** No backend. `main.js` validates the form and checks the honeypot field `website`. If the form has a `data-endpoint` (from `config.formEndpoint`), it posts `FormData` there with `fetch`. Otherwise it opens a prefilled `mailto:` to `config.email`.

**Front end.** All styles are in `static-site/assets/css/style.css` (design tokens as CSS variables at the top). `static-site/assets/js/main.js` is dependency-free vanilla JS: sticky header, mobile menu, FAQ accordion, pricing tabs, portfolio filter, contact form, scroll reveal. `<html>` starts with `no-js`, swapped to `js` by an inline script in `<head>`, so `.reveal` content stays visible without JS.

## Conventions

- Escape every interpolated value in `build.js` templates with `esc()`. Icon SVGs from `icon()` are trusted and inserted raw.
- Icons are inline SVGs in `ICONS` / `BRAND_ICONS` in `build.js`; add new icons there rather than adding image files or icon fonts.
- Keep `main.js` ES5-style (`var`, `function`), matching the existing code.
- Testimonials, prices and About-page stats are placeholders and must not be presented as real data.
