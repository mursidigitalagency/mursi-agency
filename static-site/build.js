/**
 * Static site generator: turns data.js into plain HTML pages.
 * Usage: node build.js
 */
'use strict';

const fs = require('fs');
const path = require('path');
const data = require('./data');

const { config, services } = data;
const OUT = __dirname;
const YEAR = new Date().getFullYear();

/* --------------------------------------------------------------------------
   Helpers
   -------------------------------------------------------------------------- */

function esc(str) {
	return String(str == null ? '' : str)
		.replace(/&/g, '&amp;')
		.replace(/</g, '&lt;')
		.replace(/>/g, '&gt;')
		.replace(/"/g, '&quot;')
		.replace(/'/g, '&#39;');
}

function pageUrl(slug) {
	return slug === 'home' ? 'index.html' : slug + '.html';
}

function bookingUrl() {
	return config.bookingUrl || pageUrl('contact');
}

function whatsappUrl(message) {
	const number = String(config.whatsapp || '').replace(/\D+/g, '');
	if (!number) return '';
	const text = message || 'Hi Mursi Digital! I would like to discuss a project.';
	return 'https://wa.me/' + number + '?text=' + encodeURIComponent(text);
}

function telHref(phone) {
	return 'tel:' + String(phone).replace(/[^\d+]/g, '');
}

function absUrl(file) {
	if (!config.siteUrl) return '';
	return config.siteUrl.replace(/\/+$/, '') + '/' + (file === 'index.html' ? '' : file);
}

function jsonLd(obj) {
	return '<script type="application/ld+json">' + JSON.stringify(obj).replace(/</g, '\\u003c') + '</script>';
}

const ICONS = {
	bot: '<rect x="4" y="8" width="16" height="12" rx="3"/><path d="M12 8V4"/><circle cx="12" cy="3" r="1"/><circle cx="9" cy="14" r="1.2"/><circle cx="15" cy="14" r="1.2"/><path d="M2 13v3M22 13v3"/>',
	layout: '<rect x="3" y="4" width="18" height="16" rx="2"/><path d="M3 9h18M9 20V9"/>',
	pin: '<path d="M12 22s7-6.1 7-12a7 7 0 1 0-14 0c0 5.9 7 12 7 12z"/><circle cx="12" cy="10" r="2.5"/>',
	zap: '<path d="M13 2 4 14h7l-1 8 9-12h-7l1-8z"/>',
	target: '<circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="5"/><circle cx="12" cy="12" r="1"/>',
	users: '<circle cx="9" cy="8" r="3.5"/><path d="M2.5 20a6.5 6.5 0 0 1 13 0"/><path d="M16 4.5a3.5 3.5 0 0 1 0 7M21.5 20a6.5 6.5 0 0 0-4-6"/>',
	chart: '<path d="M3 3v18h18"/><path d="m7 15 4-4 3 3 5-6"/>',
	shield: '<path d="M12 3 4 6v6c0 5 3.4 8.5 8 9 4.6-.5 8-4 8-9V6l-8-3z"/><path d="m9 12 2 2 4-4"/>',
	clock: '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>',
	check: '<path d="M5 12l5 5L20 7"/>',
	mail: '<rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/>',
	phone: '<path d="M5 4h4l2 5-2.5 1.5a11 11 0 0 0 5 5L15 13l5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2"/>',
	arrow: '<path d="M5 12h14M13 6l6 6-6 6"/>',
	code: '<path d="m8 16-4-4 4-4M16 8l4 4-4 4M14 4l-4 16"/>',
	search: '<circle cx="11" cy="11" r="7"/><path d="m20 20-4-4"/>',
	star: '<path d="m12 3 2.8 5.7 6.2.9-4.5 4.4 1 6.2L12 17.3 6.5 20.2l1-6.2L3 9.6l6.2-.9L12 3z"/>',
	heart: '<path d="M12 20s-8-4.6-8-10.5A4.5 4.5 0 0 1 12 7a4.5 4.5 0 0 1 8 2.5C20 15.4 12 20 12 20z"/>',
	menu: '<path d="M4 7h16M4 12h16M4 17h16"/>',
	close: '<path d="M6 6l12 12M18 6 6 18"/>',
	image: '<rect x="3" y="4" width="18" height="16" rx="2"/><circle cx="9" cy="10" r="2"/><path d="m21 16-5-5-9 9"/>',
	cart: '<circle cx="9" cy="20" r="1.5"/><circle cx="18" cy="20" r="1.5"/><path d="M3 4h2l2.4 11.2a2 2 0 0 0 2 1.6h7.7a2 2 0 0 0 2-1.5L21 8H6"/>',
	gauge: '<path d="M12 14l4-4"/><path d="M3.5 18a9 9 0 1 1 17 0"/>',
	link: '<path d="M10 14a5 5 0 0 0 7 0l3-3a5 5 0 0 0-7-7l-1 1"/><path d="M14 10a5 5 0 0 0-7 0l-3 3a5 5 0 0 0 7 7l1-1"/>',
	message: '<path d="M21 12a8 8 0 0 1-11.6 7.1L4 20l1-4.6A8 8 0 1 1 21 12z"/>',
	workflow: '<rect x="3" y="3" width="6" height="6" rx="1.5"/><rect x="15" y="15" width="6" height="6" rx="1.5"/><path d="M6 9v4a2 2 0 0 0 2 2h7"/>',
	pen: '<path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z"/>',
	file: '<path d="M14 3H6a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9l-6-6z"/><path d="M14 3v6h6M8 13h8M8 17h5"/>',
};

const BRAND_ICONS = {
	whatsapp: '<path fill="currentColor" d="M12 2a10 10 0 0 0-8.6 15.1L2 22l5-1.3A10 10 0 1 0 12 2zm0 18.2a8.2 8.2 0 0 1-4.2-1.1l-.3-.2-3 .8.8-2.9-.2-.3A8.2 8.2 0 1 1 12 20.2zm4.5-6.1c-.2-.1-1.5-.7-1.7-.8s-.4-.1-.6.1-.7.8-.8 1-.3.2-.5.1a6.7 6.7 0 0 1-3.3-2.9c-.3-.4.2-.4.7-1.4.1-.2 0-.3 0-.4l-.8-1.8c-.2-.5-.4-.4-.6-.4h-.5a1 1 0 0 0-.7.3 3 3 0 0 0-.9 2.2 5.1 5.1 0 0 0 1.1 2.7 11.7 11.7 0 0 0 4.5 4c1.7.7 2.3.8 3.2.6a2.7 2.7 0 0 0 1.8-1.2 2.2 2.2 0 0 0 .1-1.3c0-.1-.2-.2-.5-.3z"/>',
	facebook: '<path fill="currentColor" d="M14 8h3V4h-3a4 4 0 0 0-4 4v2H8v4h2v8h4v-8h3l1-4h-4V8z"/>',
	instagram: '<rect x="3" y="3" width="18" height="18" rx="5" fill="none" stroke="currentColor" stroke-width="2"/><circle cx="12" cy="12" r="4" fill="none" stroke="currentColor" stroke-width="2"/><circle cx="17.5" cy="6.5" r="1.2" fill="currentColor"/>',
	linkedin: '<path fill="currentColor" d="M4 9h4v12H4zM6 3a2 2 0 1 1 0 4 2 2 0 0 1 0-4zM10 9h3.8v1.7A4.2 4.2 0 0 1 17.6 9C21 9 22 11 22 14.4V21h-4v-5.8c0-1.4 0-3.2-2-3.2s-2.2 1.5-2.2 3.1V21H10z"/>',
	x: '<path fill="currentColor" d="M17.8 3h3.1l-6.8 7.8L22 21h-6.2l-4.9-6.4L5.3 21H2.2l7.3-8.3L2 3h6.4l4.4 5.8zm-1.1 16.2h1.7L7.4 4.7H5.6z"/>',
	youtube: '<path fill="currentColor" d="M22 8.2a3 3 0 0 0-2.1-2.1C18 5.6 12 5.6 12 5.6s-6 0-7.9.5A3 3 0 0 0 2 8.2 31 31 0 0 0 1.6 12 31 31 0 0 0 2 15.8a3 3 0 0 0 2.1 2.1c1.9.5 7.9.5 7.9.5s6 0 7.9-.5a3 3 0 0 0 2.1-2.1 31 31 0 0 0 .4-3.8 31 31 0 0 0-.4-3.8zM10 15V9l5.2 3z"/>',
};

function icon(name) {
	if (BRAND_ICONS[name]) {
		return '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">' + BRAND_ICONS[name] + '</svg>';
	}
	if (!ICONS[name]) return '';
	return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">' + ICONS[name] + '</svg>';
}

function map(list, fn) {
	return list.map(fn).join('\n');
}

/* --------------------------------------------------------------------------
   Layout
   -------------------------------------------------------------------------- */

function brand() {
	return `<a class="site-brand" href="index.html" rel="home">
	<span class="brand-mark" aria-hidden="true">M</span>
	<span class="brand-text">Mursi <span>Digital</span></span>
</a>`;
}

function navItem(slug, label, current) {
	const cls = slug === current ? ' class="current-menu-item"' : '';
	const aria = slug === current ? ' aria-current="page"' : '';
	return `<li${cls}><a href="${pageUrl(slug)}"${aria}>${esc(label)}</a></li>`;
}

function header(current) {
	const isService = Object.prototype.hasOwnProperty.call(services, current);
	return `<a class="skip-link screen-reader-text" href="#main">Skip to content</a>

<header class="site-header" id="site-header">
	<div class="container header-inner">
		${brand()}

		<nav class="primary-nav" id="primary-nav" aria-label="Primary">
			<ul id="primary-menu">
				${navItem('home', 'Home', current)}
				<li class="menu-item-has-children${isService ? ' current-menu-item' : ''}"><a href="index.html#services">Services</a>
					<ul class="sub-menu">
						${map(Object.keys(services), (slug) => navItem(slug, services[slug].title, current))}
					</ul>
				</li>
				${navItem('portfolio', 'Portfolio', current)}
				${navItem('pricing', 'Pricing', current)}
				${navItem('about', 'About', current)}
				${navItem('contact', 'Contact', current)}
			</ul>
			<a class="btn btn--primary btn--block mobile-cta" href="${esc(bookingUrl())}">Book a Free Call</a>
		</nav>

		<div class="header-cta">
			<a class="btn btn--primary" href="${esc(bookingUrl())}">Book a Free Call</a>
			<button class="nav-toggle" type="button" aria-controls="primary-nav" aria-expanded="false">
				<span class="screen-reader-text">Menu</span>
				<span class="icon-open">${icon('menu')}</span>
			</button>
		</div>
	</div>
</header>`;
}

function footer() {
	const wa = whatsappUrl();
	const socials = Object.keys(config.socials).filter((n) => config.socials[n]);
	const contact = [];
	if (config.email) contact.push(`<li><a href="mailto:${esc(config.email)}">${esc(config.email)}</a></li>`);
	if (config.phone) contact.push(`<li><a href="${esc(telHref(config.phone))}">${esc(config.phone)}</a></li>`);
	if (config.address) contact.push(`<li>${esc(config.address)}</li>`);
	if (config.hours) contact.push(`<li>${esc(config.hours)}</li>`);

	return `<footer class="site-footer">
	<div class="container">
		<div class="footer-grid">
			<div class="footer-brand">
				${brand()}
				<p>Mursi Digital Solutions helps businesses grow with AI Automation, high-converting WordPress websites and Local SEO.</p>
				<div class="socials">
					${map(socials, (n) => `<a href="${esc(config.socials[n])}" target="_blank" rel="noopener" aria-label="${esc(n.charAt(0).toUpperCase() + n.slice(1))}">${icon(n)}</a>`)}
				</div>
			</div>

			<div>
				<h4>Services</h4>
				<ul>
					${map(Object.keys(services), (slug) => `<li><a href="${pageUrl(slug)}">${esc(services[slug].title)}</a></li>`)}
				</ul>
			</div>

			<div>
				<h4>Company</h4>
				<ul>
					<li><a href="about.html">About</a></li>
					<li><a href="portfolio.html">Portfolio</a></li>
					<li><a href="pricing.html">Pricing</a></li>
					<li><a href="contact.html">Contact</a></li>
				</ul>
			</div>

			<div>
				<h4>Get in touch</h4>
				<ul>
					${contact.join('\n')}
				</ul>
			</div>
		</div>

		<div class="footer-bottom">
			<span>&copy; ${YEAR} Mursi Digital Solutions. All rights reserved.</span>
			<span>AI Automation · Web Design &amp; Development · Local SEO</span>
		</div>
	</div>
</footer>
${wa ? `\n<a class="wa-float" href="${esc(wa)}" target="_blank" rel="noopener" aria-label="Chat on WhatsApp">${icon('whatsapp')}</a>` : ''}`;
}

/**
 * Full HTML document. FAQs collected while rendering the body are printed as
 * one FAQPage schema block, like the theme's mursi_faq_registry().
 */
function layout({ slug, title, description, body, schema = [], faqs = [] }) {
	const blocks = schema.slice();
	if (faqs.length) {
		blocks.push({
			'@context': 'https://schema.org',
			'@type': 'FAQPage',
			mainEntity: faqs.map((f) => ({
				'@type': 'Question',
				name: f.q,
				acceptedAnswer: { '@type': 'Answer', text: f.a },
			})),
		});
	}
	const canonical = absUrl(pageUrl(slug));

	return `<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>${esc(title)}</title>
	<meta name="description" content="${esc(description)}">
	${canonical ? `<link rel="canonical" href="${esc(canonical)}">` : ''}
	<script>document.documentElement.className = document.documentElement.className.replace('no-js', 'js');</script>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&amp;display=swap">
	<link rel="stylesheet" href="assets/css/style.css">
	${blocks.map(jsonLd).join('\n\t')}
</head>
<body>
${header(slug)}

<main id="main" class="site-main">
${body}
</main>

${footer()}

<script src="assets/js/main.js"></script>
</body>
</html>
`;
}

/* --------------------------------------------------------------------------
   Sections (port of template-parts/*)
   -------------------------------------------------------------------------- */

function pageHero({ eyebrow = '', title, text = '', buttons = true }) {
	return `<section class="page-hero">
	<div class="container">
		${eyebrow ? `<span class="eyebrow">${esc(eyebrow)}</span>` : ''}
		<h1>${esc(title)}</h1>
		${text ? `<p>${esc(text)}</p>` : ''}
		${buttons ? `<div class="btn-row">
			<a class="btn btn--primary" href="${esc(bookingUrl())}">Book a Free Call ${icon('arrow')}</a>
			<a class="btn btn--ghost" href="portfolio.html">See Our Work</a>
		</div>` : ''}
	</div>
</section>`;
}

function servicesGrid({
	exclude = '',
	title = 'Everything you need to grow online',
	text = 'Three focused services that work together: a website that converts, automation that saves time, and Local SEO that brings customers to you.',
} = {}) {
	const slugs = Object.keys(services).filter((s) => s !== exclude);
	return `<section class="section" id="services">
	<div class="container">
		<div class="section-head reveal">
			<span class="eyebrow">Our Services</span>
			<h2>${esc(title)}</h2>
			<p>${esc(text)}</p>
		</div>
		<div class="grid grid-3">
			${map(slugs, (slug) => {
				const s = services[slug];
				return `<article class="card reveal">
				<div class="icon-wrap">${icon(s.icon)}</div>
				<h3>${esc(s.title)}</h3>
				<p>${esc(s.short)}</p>
				<ul>
					${map(s.bullets, (b) => `<li>${esc(b)}</li>`)}
				</ul>
				<a class="card-link" href="${pageUrl(slug)}">Learn more ${icon('arrow')}</a>
			</article>`;
			})}
		</div>
	</div>
</section>`;
}

function whyUs() {
	return `<section class="section section--alt">
	<div class="container split">
		<div class="reveal">
			<span class="eyebrow">Why Mursi Digital</span>
			<h2>A partner who cares about your results, not just the deliverable</h2>
			<p>We combine design, development, automation and SEO under one roof — so your website, marketing and operations work together instead of in silos.</p>
			<a class="btn btn--primary" href="about.html">About Us ${icon('arrow')}</a>
		</div>
		<div class="grid" style="gap:28px">
			${map(data.whyUs, (item) => `<div class="feature reveal">
				<div class="icon-wrap">${icon(item.icon)}</div>
				<div>
					<h3>${esc(item.title)}</h3>
					<p>${esc(item.text)}</p>
				</div>
			</div>`)}
		</div>
	</div>
</section>`;
}

function processSection() {
	return `<section class="section">
	<div class="container">
		<div class="section-head reveal">
			<span class="eyebrow">How We Work</span>
			<h2>A simple, transparent process</h2>
			<p>You always know what is happening, what comes next and when it will be done.</p>
		</div>
		<div class="grid grid-4 steps">
			${map(data.processSteps, (step) => `<div class="step reveal">
				<h3>${esc(step.title)}</h3>
				<p>${esc(step.text)}</p>
			</div>`)}
		</div>
	</div>
</section>`;
}

function projectTypeName(slug) {
	return services[slug] ? services[slug].title : slug;
}

function projectCard(p) {
	const types = p.types || [];
	const thumb = p.image
		? `<img src="${esc(p.image)}" alt="" loading="lazy">`
		: icon('image');
	const titleHtml = p.url
		? `<a href="${esc(p.url)}" target="_blank" rel="noopener">${esc(p.title)}</a>`
		: esc(p.title);
	return `<article class="project-card reveal" data-types="${esc(types.join(' '))}">
	<div class="project-thumb">${thumb}</div>
	<div class="project-body">
		${types.length ? `<span class="project-tag">${esc(projectTypeName(types[0]))}</span>` : ''}
		<h3>${titleHtml}</h3>
		<p>${esc(p.excerpt || '')}</p>
	</div>
</article>`;
}

function portfolioPreview({ type = '', count = 3 } = {}) {
	const list = data.projects.filter((p) => !type || (p.types || []).includes(type)).slice(0, count);
	if (!list.length) return '';
	return `<section class="section section--alt">
	<div class="container">
		<div class="section-head reveal">
			<span class="eyebrow">Recent Work</span>
			<h2>Projects we are proud of</h2>
		</div>
		<div class="grid grid-3">
			${map(list, projectCard)}
		</div>
		<p class="text-center mt-lg">
			<a class="btn btn--ghost" href="portfolio.html">View Full Portfolio ${icon('arrow')}</a>
		</p>
	</div>
</section>`;
}

function testimonials() {
	return `<section class="section">
	<div class="container">
		<div class="section-head reveal">
			<span class="eyebrow">Testimonials</span>
			<h2>What our clients say</h2>
		</div>
		<div class="grid grid-3">
			${map(data.testimonials, (t) => `<figure class="testimonial reveal" style="margin:0">
				<div class="stars" aria-label="5 out of 5 stars">★★★★★</div>
				<blockquote>“${esc(t.text)}”</blockquote>
				<figcaption class="testimonial-author">
					<span class="avatar" aria-hidden="true">${esc(t.name.charAt(0))}</span>
					<span>
						<strong>${esc(t.name)}</strong>
						<small>${esc(t.role)}</small>
					</span>
				</figcaption>
			</figure>`)}
		</div>
	</div>
</section>`;
}

let faqCounter = 0;

function faqSection({ faqs, title = 'Frequently asked questions', alt = true }) {
	if (!faqs || !faqs.length) return '';
	const id = 'faq-' + ++faqCounter;
	return `<section class="section${alt ? ' section--alt' : ''}">
	<div class="container">
		<div class="section-head reveal">
			<span class="eyebrow">FAQ</span>
			<h2>${esc(title)}</h2>
		</div>
		<div class="faq">
			${map(faqs, (f, i) => `<div class="faq-item reveal">
				<button class="faq-q" type="button" aria-expanded="false" aria-controls="${id}-${i}">
					<span>${esc(f.q)}</span>
					<span class="plus" aria-hidden="true">+</span>
				</button>
				<div class="faq-a" id="${id}-${i}" role="region">
					<div><p>${esc(f.a)}</p></div>
				</div>
			</div>`)}
		</div>
	</div>
</section>`;
}

function cta({
	title = 'Ready to grow your business?',
	text = 'Book a free 30-minute strategy call. We will review your website, Google presence and workflows — and show you exactly where the quick wins are.',
} = {}) {
	const wa = whatsappUrl();
	return `<section class="section section--tight">
	<div class="container">
		<div class="cta-band reveal">
			<div>
				<h2>${esc(title)}</h2>
				<p>${esc(text)}</p>
			</div>
			<div class="btn-row">
				<a class="btn btn--white" href="${esc(bookingUrl())}">Book a Free Call</a>
				${wa ? `<a class="btn btn--ghost" href="${esc(wa)}" target="_blank" rel="noopener">WhatsApp Us</a>` : ''}
			</div>
		</div>
	</div>
</section>`;
}

function pricingTable({ only = '' } = {}) {
	let slugs = Object.keys(data.pricing);
	if (only) slugs = slugs.filter((s) => s === only);
	if (!slugs.length) return '';
	const tabs = slugs.length > 1
		? `<div class="pricing-tabs" role="tablist">
		${map(slugs, (slug, i) => `<button class="pricing-tab${i === 0 ? ' is-active' : ''}" type="button" role="tab" id="tab-${slug}" aria-controls="panel-${slug}" aria-selected="${i === 0}">${esc(services[slug].title)}</button>`)}
	</div>`
		: '';

	return `<div class="pricing" data-pricing>
	${tabs}
	${map(slugs, (slug, i) => `<div class="pricing-panel grid grid-3" role="tabpanel" id="panel-${slug}" aria-labelledby="tab-${slug}"${i === 0 ? '' : ' hidden'}>
		${map(data.pricing[slug], (plan) => `<div class="price-card${plan.featured ? ' is-featured' : ''}">
			${plan.featured ? '<span class="price-badge">Most Popular</span>' : ''}
			<h3>${esc(plan.name)}</h3>
			<p class="price-desc">${esc(plan.desc)}</p>
			<div class="price">${esc(plan.price)} <small>${esc(plan.period)}</small></div>
			<ul class="check-list">
				${map(plan.features, (f) => `<li>${esc(f)}</li>`)}
			</ul>
			<a class="btn ${plan.featured ? 'btn--primary' : 'btn--ghost'} btn--block" href="contact.html?service=${slug}">Get Started</a>
		</div>`)}
	</div>`)}
	<p class="pricing-note">Need something custom? Every business is different — book a free call for a tailored quote.</p>
</div>`;
}

function contactForm() {
	return `<div class="form-card" id="contact-form">
	<h2 style="font-size:1.6rem">Tell us about your project</h2>
	<p style="color:var(--muted)">Fill in the form and we will reply within 24 hours with next steps.</p>

	<div class="notice" role="status" hidden data-form-notice></div>

	<form method="post" action="${esc(config.formEndpoint || '#')}" data-contact-form data-endpoint="${esc(config.formEndpoint)}" data-email="${esc(config.email)}" novalidate>
		<div class="hp-field" aria-hidden="true">
			<label for="cf-website">Website</label>
			<input type="text" id="cf-website" name="website" tabindex="-1" autocomplete="off">
		</div>

		<div class="form-row">
			<div class="field">
				<label for="cf-name">Full name *</label>
				<input type="text" id="cf-name" name="name" required autocomplete="name">
			</div>
			<div class="field">
				<label for="cf-email">Email *</label>
				<input type="email" id="cf-email" name="email" required autocomplete="email">
			</div>
		</div>
		<div class="form-row">
			<div class="field">
				<label for="cf-phone">Phone / WhatsApp</label>
				<input type="tel" id="cf-phone" name="phone" autocomplete="tel">
			</div>
			<div class="field">
				<label for="cf-service">Service</label>
				<select id="cf-service" name="service">
					${map(Object.keys(services), (slug) => `<option value="${esc(services[slug].title)}" data-slug="${slug}">${esc(services[slug].title)}</option>`)}
					<option value="Not sure yet">Not sure yet</option>
				</select>
			</div>
		</div>
		<div class="field">
			<label for="cf-budget">Budget</label>
			<select id="cf-budget" name="budget">
				<option>Under $300</option>
				<option>$300 – $700</option>
				<option>$700 – $1,500</option>
				<option>$1,500+</option>
				<option>Monthly retainer</option>
			</select>
		</div>
		<div class="field">
			<label for="cf-message">Project details *</label>
			<textarea id="cf-message" name="message" required placeholder="Tell us about your business and what you want to achieve…"></textarea>
		</div>
		<button class="btn btn--primary btn--block" type="submit">Send Message</button>
	</form>
</div>`;
}

/* --------------------------------------------------------------------------
   Pages
   -------------------------------------------------------------------------- */

function homePage() {
	const serviceList = Object.keys(services).map((slug) => services[slug]);
	const sameAs = Object.values(config.socials).filter(Boolean);
	const schema = {
		'@context': 'https://schema.org',
		'@type': 'ProfessionalService',
		name: 'Mursi Digital Solutions',
		email: config.email,
		telephone: config.phone,
		description: 'AI Automation, Web Design & Development and Local SEO agency.',
		address: { '@type': 'PostalAddress', streetAddress: config.address, addressLocality: config.city },
		hasOfferCatalog: {
			'@type': 'OfferCatalog',
			name: 'Digital Services',
			itemListElement: Object.keys(services).map((slug) => {
				const item = { '@type': 'Service', name: services[slug].title, description: services[slug].short };
				if (absUrl(pageUrl(slug))) item.url = absUrl(pageUrl(slug));
				return { '@type': 'Offer', itemOffered: item };
			}),
		},
	};
	if (config.siteUrl) schema.url = absUrl('index.html');
	if (sameAs.length) schema.sameAs = sameAs;

	const body = `<section class="hero">
	<div class="container hero-grid">
		<div class="reveal">
			<span class="eyebrow">AI Automation · Web Design · Local SEO</span>
			<h1>
				Websites, automation &amp; SEO that
				<span class="accent">grow your business</span>
			</h1>
			<p class="hero-lead">Mursi Digital Solutions builds high-converting WordPress websites, AI automations that save hours every week, and Local SEO that puts you on the map — literally.</p>
			<div class="btn-row">
				<a class="btn btn--primary" href="${esc(bookingUrl())}">Book a Free Call ${icon('arrow')}</a>
				<a class="btn btn--ghost" href="portfolio.html">View Our Work</a>
			</div>
			<div class="hero-trust">
				<span>${icon('check')} Free strategy call</span>
				<span>${icon('check')} Fast delivery</span>
				<span>${icon('check')} Ongoing support</span>
			</div>
		</div>

		<div class="hero-card reveal" aria-hidden="true">
			<h3>What we help you achieve</h3>
			${map(serviceList, (s) => `<div class="hero-stat">
				<div class="icon-wrap">${icon(s.icon)}</div>
				<div>
					<strong>${esc(s.title)}</strong>
					<small>${esc(s.bullets[0])}</small>
				</div>
			</div>`)}
		</div>
	</div>
</section>

${servicesGrid()}
${whyUs()}
${processSection()}
${portfolioPreview()}
${testimonials()}
${faqSection({ faqs: data.homeFaqs })}
${cta()}`;

	return layout({
		slug: 'home',
		title: 'Mursi Digital Solutions — AI Automation, Web Design & Local SEO',
		description: 'Mursi Digital Solutions builds high-converting WordPress websites, AI automations that save hours every week, and Local SEO that puts you on the map.',
		body,
		schema: [schema],
		faqs: data.homeFaqs,
	});
}

function servicePage(slug) {
	const s = services[slug];
	const body = `${pageHero({ eyebrow: s.title, title: s.headline, text: s.intro })}

<section class="section">
	<div class="container split">
		<div class="reveal">
			<span class="eyebrow">Sound familiar?</span>
			<h2>Problems we solve</h2>
			<ul class="check-list">
				${map(s.problems, (p) => `<li>${esc(p)}</li>`)}
			</ul>
		</div>
		<div class="panel reveal">
			<div class="icon-wrap">${icon(s.icon)}</div>
			<h3>${esc(s.title)}</h3>
			<p>${esc(s.short)}</p>
			<ul class="check-list">
				${map(s.bullets, (b) => `<li>${esc(b)}</li>`)}
			</ul>
			<a class="btn btn--primary" href="contact.html?service=${slug}">Get a Free Quote</a>
		</div>
	</div>
</section>

<section class="section section--alt">
	<div class="container">
		<div class="section-head reveal">
			<span class="eyebrow">What's Included</span>
			<h2>Our ${esc(s.title)} services</h2>
		</div>
		<div class="grid grid-3">
			${map(s.included, (item) => `<div class="card reveal">
				<div class="icon-wrap">${icon(item.icon)}</div>
				<h3>${esc(item.title)}</h3>
				<p>${esc(item.text)}</p>
			</div>`)}
		</div>
	</div>
</section>

${processSection()}

<section class="section section--alt">
	<div class="container">
		<div class="section-head reveal">
			<span class="eyebrow">Pricing</span>
			<h2>Simple, transparent packages</h2>
		</div>
		${pricingTable({ only: slug })}
	</div>
</section>

${portfolioPreview({ type: slug })}
${faqSection({ faqs: s.faqs, alt: false })}
${servicesGrid({ exclude: slug, title: 'Other ways we can help', text: 'Our services work best together — combine them for bigger results.' })}
${cta()}`;

	return layout({
		slug,
		title: s.title + ' — Mursi Digital Solutions',
		description: s.short,
		body,
		faqs: s.faqs,
	});
}

function aboutPage() {
	const body = `${pageHero({
		eyebrow: 'About Us',
		title: 'We help businesses work smarter and grow faster',
		text: 'Mursi Digital Solutions is a digital agency specialising in AI Automation, WordPress website design & development, and Local SEO.',
		buttons: false,
	})}

<section class="section">
	<div class="container split">
		<div class="reveal">
			<span class="eyebrow">Our Story</span>
			<h2>Built to make modern technology simple for every business</h2>
			<p>Mursi Digital Solutions started with a simple idea: small and growing businesses deserve the same quality websites, automation and marketing that big brands have — without the big-agency price tag or complexity.</p>
			<p>Today we design and build WordPress websites, set up AI-powered automations, and run Local SEO campaigns for clients who want real, measurable growth. Every project gets personal attention, clear communication and support long after launch.</p>
		</div>
		<div class="panel reveal">
			<h3>Our Mission</h3>
			<p>To help businesses win more customers and save time by combining great design, smart automation and local visibility.</p>
			<h3>Our Vision</h3>
			<p style="margin:0">To be the most trusted growth partner for local and small businesses — locally and around the world.</p>
		</div>
	</div>
</section>

<section class="section section--alt section--tight">
	<div class="container">
		<div class="stats reveal">
			${map(data.aboutStats, (st) => `<div><strong>${esc(st.value)}</strong><span>${esc(st.label)}</span></div>`)}
		</div>
	</div>
</section>

<section class="section">
	<div class="container">
		<div class="section-head reveal">
			<span class="eyebrow">Our Values</span>
			<h2>What we stand for</h2>
		</div>
		<div class="grid grid-4">
			${map(data.aboutValues, (v) => `<div class="card reveal">
				<div class="icon-wrap">${icon(v.icon)}</div>
				<h3>${esc(v.title)}</h3>
				<p style="margin:0">${esc(v.text)}</p>
			</div>`)}
		</div>
	</div>
</section>

<section class="section section--alt">
	<div class="container">
		<div class="section-head reveal">
			<span class="eyebrow">Tools &amp; Platforms</span>
			<h2>The stack we work with</h2>
		</div>
		<div class="chips reveal">
			${map(data.aboutTools, (t) => `<span class="chip">${esc(t)}</span>`)}
		</div>
	</div>
</section>

${processSection()}
${cta()}`;

	return layout({
		slug: 'about',
		title: 'About — Mursi Digital Solutions',
		description: 'Mursi Digital Solutions is a digital agency specialising in AI Automation, WordPress website design & development, and Local SEO.',
		body,
	});
}

function portfolioPage() {
	const used = Object.keys(services).filter((slug) => data.projects.some((p) => (p.types || []).includes(slug)));
	const filter = used.length > 1
		? `<div class="filter-bar" data-filter>
			<button class="filter-btn is-active" type="button" data-filter-value="*">All</button>
			${map(used, (slug) => `<button class="filter-btn" type="button" data-filter-value="${slug}">${esc(services[slug].title)}</button>`)}
		</div>`
		: '';
	const content = data.projects.length
		? `${filter}
		<div class="grid grid-3" data-filter-grid>
			${map(data.projects, projectCard)}
		</div>`
		: `<div class="empty-state">
			<p>Projects coming soon.</p>
		</div>`;

	const body = `${pageHero({
		eyebrow: 'Portfolio',
		title: 'Our recent work',
		text: 'Websites, automations and Local SEO campaigns that delivered real results for our clients.',
		buttons: false,
	})}

<section class="section">
	<div class="container">
		${content}
	</div>
</section>

${testimonials()}
${cta()}`;

	return layout({
		slug: 'portfolio',
		title: 'Portfolio — Mursi Digital Solutions',
		description: 'Websites, automations and Local SEO campaigns that delivered real results for our clients.',
		body,
	});
}

function pricingPage() {
	const body = `${pageHero({
		eyebrow: 'Pricing',
		title: 'Simple, transparent pricing',
		text: 'Choose a package that fits your stage. No hidden fees — and every plan starts with a free strategy call.',
		buttons: false,
	})}

<section class="section">
	<div class="container">
		${pricingTable()}
	</div>
</section>

${faqSection({ faqs: data.pricingFaqs })}
${cta()}`;

	return layout({
		slug: 'pricing',
		title: 'Pricing — Mursi Digital Solutions',
		description: 'Simple, transparent pricing for AI Automation, Web Design & Development and Local SEO.',
		body,
		faqs: data.pricingFaqs,
	});
}

function contactItem(iconName, label, valueHtml) {
	return `<div class="contact-item">
				<div class="icon-wrap">${icon(iconName)}</div>
				<div>
					<strong>${esc(label)}</strong>
					${valueHtml}
				</div>
			</div>`;
}

function contactPage() {
	const wa = whatsappUrl();
	const items = [];
	if (wa) items.push(contactItem('whatsapp', 'WhatsApp', `<a href="${esc(wa)}" target="_blank" rel="noopener">Chat with us now</a>`));
	if (config.email) items.push(contactItem('mail', 'Email', `<a href="mailto:${esc(config.email)}">${esc(config.email)}</a>`));
	if (config.phone) items.push(contactItem('phone', 'Phone', `<a href="${esc(telHref(config.phone))}">${esc(config.phone)}</a>`));
	items.push(contactItem('clock', 'Working hours', `<span>${esc(config.hours)}</span>`));
	if (config.address) items.push(contactItem('pin', 'Location', `<span>${esc(config.address)}</span>`));

	const body = `${pageHero({
		eyebrow: 'Contact',
		title: 'Let\'s talk about your project',
		text: 'Tell us what you need and we will get back to you within 24 hours with ideas, a plan and a quote.',
		buttons: false,
	})}

<section class="section">
	<div class="container contact-grid">
		${contactForm()}

		<aside class="contact-info">
			${items.join('\n\t\t\t')}
		</aside>
	</div>
	${config.mapEmbed ? `<div class="container mt-lg map-embed">
		<iframe src="${esc(config.mapEmbed)}" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Our location on Google Maps"></iframe>
	</div>` : ''}
</section>`;

	return layout({
		slug: 'contact',
		title: 'Contact — Mursi Digital Solutions',
		description: 'Tell us what you need and we will get back to you within 24 hours with ideas, a plan and a quote.',
		body,
	});
}

function notFoundPage() {
	const body = `<section class="page-hero" style="padding:120px 0">
	<div class="container">
		<span class="eyebrow">404</span>
		<h1>Page not found</h1>
		<p>The page you are looking for doesn't exist or has been moved.</p>
		<div class="btn-row">
			<a class="btn btn--primary" href="index.html">Back to Home</a>
			<a class="btn btn--ghost" href="contact.html">Contact Us</a>
		</div>
	</div>
</section>`;

	return layout({
		slug: '404',
		title: 'Page not found — Mursi Digital Solutions',
		description: 'The page you are looking for doesn\'t exist or has been moved.',
		body,
	});
}

/* --------------------------------------------------------------------------
   Write files
   -------------------------------------------------------------------------- */

const pages = {
	'index.html': homePage(),
	'about.html': aboutPage(),
	'portfolio.html': portfolioPage(),
	'pricing.html': pricingPage(),
	'contact.html': contactPage(),
	'404.html': notFoundPage(),
};
Object.keys(services).forEach((slug) => {
	pages[pageUrl(slug)] = servicePage(slug);
});

Object.keys(pages).forEach((file) => {
	// Drop whitespace-only lines left by empty optional blocks.
	const html = pages[file].replace(/\n[ \t]*(?=\n)/g, '');
	fs.writeFileSync(path.join(OUT, file), html);
	console.log('wrote ' + file);
});
