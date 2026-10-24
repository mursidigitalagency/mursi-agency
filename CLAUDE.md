# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## What this is

A custom **classic (PHP) WordPress theme** for Mursi Digital Solutions, an agency selling AI Automation, Web Design & Development (UX/UI + WordPress), and Local SEO. The theme lives in `mursi-digital/`; the repo root holds only docs. Site copy is English. No build step, no Composer/npm, no jQuery, no page-builder dependency.

## Commands

There is no build, lint or test tooling in the repo, and PHP is not installed on the dev machine, so PHP cannot be linted or run locally.

- JS syntax check: `node --check mursi-digital/assets/js/main.js`
- Package for install: zip the `mursi-digital` folder itself (the zip must contain the folder), then WP Admin → Appearance → Themes → Upload.
- Real testing happens on a WordPress install (LocalWP or staging). See `README.md` for the required page slugs/templates and Customizer setup.

## Architecture

**Content is data, not templates.** All marketing copy (services, pricing, FAQs, testimonials, process steps, "why us") is returned by functions in `inc/data.php` (`mursi_services()`, `mursi_pricing()`, `mursi_home_faqs()`, etc.). Templates loop over these arrays. To change site text or prices, edit `inc/data.php`, not the templates. `mursi_services()` is filterable via `mursi_services`.

**Service slugs are the join key.** The three service slugs `ai-automation`, `web-design-development`, `local-seo` link together:
- keys of `mursi_services()` and `mursi_pricing()`
- the WordPress page slug that `page-templates/template-service.php` reads (`post_name`) to pick which service to render
- `project_type` taxonomy term slugs (auto-created on `after_switch_theme` in `inc/post-types.php`), used for the portfolio filter and related projects
- the `?service=` query arg that preselects the contact form dropdown

Renaming a slug means changing all of these together.

**Page URLs resolve by slug.** `mursi_page_url( 'contact' )` (in `inc/helpers.php`) looks up a page by path and falls back to `home_url('/contact/')`, so templates link to `about`, `portfolio`, `pricing`, `contact` and the service slugs without hard-coded IDs.

**Template parts take args.** Pages are composed from `template-parts/*` via `mursi_part( $name, $args )` (wraps `get_template_part` with `$args`, WP 5.5+). Each part calls `wp_parse_args` on `$args` for its defaults.

**Options come from the Customizer.** `mursi_option( $key )` reads `mursi_<key>` theme mods with defaults from `mursi_option_defaults()` in `inc/customizer.php` (email, phone, WhatsApp, city, hours, booking URL, map embed, social links, brand color). The floating WhatsApp button and WhatsApp CTAs only render when a WhatsApp number is set. `mursi_booking_url()` falls back to the Contact page. A non-default brand color is injected as CSS variable overrides (`--brand`, `--brand-dark`, `--brand-soft`) in `wp_head`.

**Schema.** `inc/schema.php` prints `ProfessionalService` JSON-LD on the front page. Every rendered `template-parts/faq.php` registers its Q&As via `mursi_faq_registry()`, and one combined `FAQPage` JSON-LD is printed in `wp_footer`, so FAQ parts must render before the footer.

**Contact form.** `template-parts/contact-form.php` posts to `admin-post.php` (`action=mursi_contact`), handled in `inc/contact-form.php` (nonce, honeypot field `website`, sanitization, `wp_mail` to the Customizer email). Result is shown through a `?contact=sent|invalid|error` redirect flag.

**Portfolio.** `project` CPT (rewrite slug `work`) + `project_type` taxonomy, with `_mursi_client` / `_mursi_url` meta boxes. Cards are `template-parts/project-card.php`, whose `data-types` attribute drives the JS filter.

**Front end.** All styles are in `style.css` (design tokens as CSS variables at the top). `assets/js/main.js` is dependency-free vanilla JS: sticky header, mobile menu, FAQ accordion, pricing tabs, portfolio filter, scroll reveal. The `<html>` starts with `no-js`, swapped to `js` in `wp_head`, so `.reveal` content stays visible without JS.

## Conventions

- Prefix all functions, globals in templates, and option keys with `mursi_`; text domain is `mursi-digital`.
- Follow WordPress coding standards: escape all output (`esc_html`, `esc_url`, `esc_attr`), wrap user-facing strings in `__()` / `esc_html_e()`, sanitize all input.
- Icons are inline SVGs from `mursi_icon()` / `mursi_the_icon()` in `inc/helpers.php`; add new icons there rather than adding image files or icon fonts.
- Testimonials, prices and About-page stats are placeholders and must not be presented as real data.
