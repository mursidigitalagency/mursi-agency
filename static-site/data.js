/**
 * Site content and settings.
 * Edit the text here, then run `node build.js` to regenerate the HTML pages.
 */

// Contact details, links and form settings (replaces the WordPress Customizer).
const config = {
	siteUrl: '', // e.g. 'https://mursidigital.com' — used for schema URLs; leave empty until you have a domain.
	email: 'mursidigital.agency@gmail.com',
	phone: '+92 300 0000000',
	whatsapp: '', // with country code, e.g. '923001234567'. Empty hides all WhatsApp buttons.
	address: 'Pakistan',
	city: '',
	hours: 'Mon – Sat, 10:00 AM – 7:00 PM',
	mapEmbed: '', // the src="" from a Google Maps embed code
	bookingUrl: '', // Calendly etc. Empty = Contact page.
	formEndpoint: '', // e.g. a Formspree URL. Empty = the form opens the visitor's email app instead.
	socials: {
		facebook: '',
		instagram: '',
		linkedin: '',
		x: '',
		youtube: '',
	},
};

// Services, keyed by slug. Each slug becomes a page: <slug>.html.
const services = {
	'ai-automation': {
		title: 'AI Automation',
		icon: 'bot',
		short: 'Save hours every week with AI chatbots, smart workflows and automated lead follow-up that work 24/7.',
		headline: 'Put your busywork on autopilot with AI',
		intro: 'We design and build AI-powered automations that answer customers instantly, capture and qualify leads, and connect your tools — so your team can focus on work that actually grows the business.',
		bullets: [
			'AI chatbots for website & WhatsApp',
			'Workflow automation (n8n, Make, Zapier)',
			'Lead capture & CRM integrations',
		],
		problems: [
			'Leads wait hours (or days) for a reply and go to competitors',
			'Your team copies data between apps by hand',
			'The same customer questions get answered again and again',
			'No clear view of where leads come from or what happens to them',
		],
		included: [
			{ icon: 'message', title: 'AI Chatbots', text: 'Trained on your business to answer FAQs, book appointments and collect leads on your website, WhatsApp or Messenger.' },
			{ icon: 'workflow', title: 'Workflow Automation', text: 'Connect forms, email, sheets, CRMs and payment tools with n8n, Make or Zapier — no more copy-paste.' },
			{ icon: 'users', title: 'Lead Management', text: 'Auto-capture, qualify and route leads to the right person with instant follow-up emails and messages.' },
			{ icon: 'link', title: 'CRM & App Integrations', text: 'HubSpot, GoHighLevel, Google Workspace, WooCommerce and more — your data flows where it should.' },
			{ icon: 'file', title: 'AI Content & Docs', text: 'Automatically generate proposals, reports, replies and summaries using AI with your brand voice.' },
			{ icon: 'chart', title: 'Reporting Dashboards', text: 'See leads, response times and results in one simple dashboard updated automatically.' },
		],
		faqs: [
			{ q: 'Do I need technical knowledge to use the automations?', a: 'No. We build, test and hand over everything with a short training video. You just use it — we handle the technical side.' },
			{ q: 'Which tools do you work with?', a: 'n8n, Make, Zapier, OpenAI / Claude, WhatsApp Business API, Google Workspace, HubSpot, GoHighLevel, WooCommerce and most tools that have an API.' },
			{ q: 'Is my business data safe?', a: 'Yes. We use secure, reputable platforms, limit access to only what is needed, and can self-host automations (e.g. n8n) for extra control.' },
		],
	},
	'web-design-development': {
		title: 'Web Design & Development',
		icon: 'layout',
		short: 'Fast, beautiful WordPress websites with UX/UI design that turns visitors into customers.',
		headline: 'WordPress websites designed to convert',
		intro: 'From UX research and UI design to custom WordPress development, we build websites that look professional, load fast, rank on Google and make it easy for visitors to contact you.',
		bullets: [
			'UX/UI design in Figma',
			'Custom WordPress & WooCommerce',
			'Speed, security & maintenance',
		],
		problems: [
			'Your current website looks outdated and hurts trust',
			'Visitors leave without calling or filling the form',
			'The site is slow, especially on mobile',
			'You can\'t update content without calling a developer',
		],
		included: [
			{ icon: 'pen', title: 'UX/UI Design', text: 'User research, wireframes and pixel-perfect Figma designs you approve before a single line of code is written.' },
			{ icon: 'code', title: 'WordPress Development', text: 'Custom themes or Elementor builds that are clean, lightweight and easy for you to edit.' },
			{ icon: 'cart', title: 'WooCommerce Stores', text: 'Online stores with local payment gateways, delivery options and smooth checkout.' },
			{ icon: 'gauge', title: 'Speed Optimization', text: 'Core Web Vitals tuning, image optimization and caching for 90+ PageSpeed scores.' },
			{ icon: 'search', title: 'SEO-Ready Build', text: 'Clean structure, schema markup, meta tags and sitemaps set up from day one.' },
			{ icon: 'shield', title: 'Care & Maintenance', text: 'Updates, backups, security monitoring and small content changes every month.' },
		],
		faqs: [
			{ q: 'How long does a website take?', a: 'A business website usually takes 2–4 weeks; online stores 4–6 weeks. You get a clear timeline before we start.' },
			{ q: 'Will I be able to edit the website myself?', a: 'Yes. We build on WordPress and give you a training video so you can update text, images, blog posts and products easily.' },
			{ q: 'Do you provide hosting and domain?', a: 'We can recommend and set up fast, reliable hosting and your domain, or work with your existing provider.' },
		],
	},
	'local-seo': {
		title: 'Local SEO',
		icon: 'pin',
		short: 'Rank in Google Maps and local search so nearby customers find and call you first.',
		headline: 'Get found by customers near you',
		intro: 'We help local businesses show up in the Google Map Pack and "near me" searches with a proven Local SEO system — Google Business Profile optimization, citations, reviews and on-page SEO.',
		bullets: [
			'Google Business Profile optimization',
			'Local citations & on-page SEO',
			'Review strategy & monthly reports',
		],
		problems: [
			'Competitors show up on Google Maps — you don\'t',
			'Your Google Business Profile is incomplete or unverified',
			'Few reviews, or no system to get more',
			'Website traffic doesn\'t turn into calls or visits',
		],
		included: [
			{ icon: 'pin', title: 'Google Business Profile', text: 'Full setup and optimization: categories, services, photos, posts, Q&A and weekly updates.' },
			{ icon: 'link', title: 'Local Citations', text: 'Consistent name, address and phone listings on trusted directories to build local authority.' },
			{ icon: 'search', title: 'On-Page Local SEO', text: 'Location pages, keyword optimization, local schema and internal linking on your website.' },
			{ icon: 'star', title: 'Review Generation', text: 'Simple automated system to ask happy customers for Google reviews and respond professionally.' },
			{ icon: 'target', title: 'Competitor Analysis', text: 'Find out why competitors rank and build a clear plan to outrank them in your area.' },
			{ icon: 'chart', title: 'Rank Tracking & Reports', text: 'Monthly reports on map rankings, calls, direction requests and website visits.' },
		],
		faqs: [
			{ q: 'How long until I see results?', a: 'Most clients see movement in Google Maps within 30–60 days, with strong results in 3–6 months depending on competition.' },
			{ q: 'Do you guarantee #1 ranking?', a: 'No honest agency can guarantee rankings — Google controls that. We guarantee proven, transparent work and monthly reporting so you see the progress.' },
			{ q: 'I don\'t have a physical shop. Can I still do Local SEO?', a: 'Yes. Service-area businesses (plumbers, consultants, cleaners, etc.) can rank locally with a properly set-up Business Profile that hides the address.' },
		],
	},
};

const processSteps = [
	{ title: 'Discover', text: 'A free call to understand your business, goals and what is holding growth back.' },
	{ title: 'Plan & Design', text: 'A clear strategy, timeline and designs you approve before we build.' },
	{ title: 'Build & Launch', text: 'We develop, test and launch — keeping you updated at every step.' },
	{ title: 'Grow & Support', text: 'Ongoing optimization, reporting and support to keep results improving.' },
];

const whyUs = [
	{ icon: 'target', title: 'Results-focused', text: 'Every website, automation and SEO task is tied to leads, sales and time saved.' },
	{ icon: 'zap', title: 'Fast delivery', text: 'Clear timelines and quick turnaround without cutting corners.' },
	{ icon: 'message', title: 'Clear communication', text: 'One point of contact, regular updates and no confusing tech jargon.' },
	{ icon: 'shield', title: 'Ongoing support', text: 'We don\'t disappear after launch — support and care plans included.' },
];

// Placeholder testimonials — replace with real client reviews before launch.
const testimonials = [
	{ name: 'Ahmed Raza', role: 'Owner, Raza Dental Clinic', text: 'Our new website and Google profile brought in more appointment calls in the first two months than the whole previous year. Very professional team.' },
	{ name: 'Sarah Khan', role: 'Founder, Bloom Boutique', text: 'The WooCommerce store is fast and beautiful, and the WhatsApp automation answers customers even when we are asleep. Highly recommended!' },
	{ name: 'James Miller', role: 'Director, Miller Home Services', text: 'Mursi Digital automated our lead follow-up and got us into the Google Map Pack. Response time went from hours to seconds.' },
];

const homeFaqs = [
	{ q: 'What services does Mursi Digital Solutions offer?', a: 'We offer AI Automation (chatbots, workflows, CRM integrations), Website Design & Development (UX/UI + WordPress) and Local SEO to help businesses get more leads and save time.' },
	{ q: 'Do you work with clients outside Pakistan?', a: 'Yes. We work with clients locally and internationally, fully remote, with calls scheduled around your time zone.' },
	{ q: 'How much does a project cost?', a: 'It depends on scope. See our Pricing page for starting packages, or book a free call for a custom quote.' },
	{ q: 'How do we get started?', a: 'Fill in the contact form or message us on WhatsApp. We will schedule a free strategy call and send you a proposal within 48 hours.' },
];

const pricingFaqs = [
	{ q: 'Do you require an upfront payment?', a: 'For one-time projects we take 50% upfront and 50% on completion. Monthly plans are billed at the start of each month.' },
	{ q: 'Can I cancel a monthly plan?', a: 'Yes, monthly plans have no long-term contract. Just give us 30 days notice.' },
	{ q: 'Which payment methods do you accept?', a: 'Bank transfer, JazzCash / Easypaisa (Pakistan), Payoneer, Wise and PayPal for international clients.' },
	{ q: 'Do you offer discounts for combining services?', a: 'Yes — bundle a website with Local SEO or automation and get a special package price. Ask us on the free call.' },
];

// Pricing plans per service (placeholder prices — edit to your own).
const pricing = {
	'web-design-development': [
		{ name: 'Starter', price: '$299', period: 'one-time', desc: 'A professional site for new and small businesses.', features: ['Up to 5 pages', 'Mobile-responsive design', 'Contact form + WhatsApp', 'Basic on-page SEO', '1 month support'] },
		{ name: 'Business', price: '$699', period: 'one-time', desc: 'Custom UX/UI design built to convert visitors.', featured: true, features: ['Up to 12 pages', 'Custom Figma UX/UI design', 'Blog & lead capture setup', 'Speed optimization (90+)', 'SEO & schema setup', '3 months support'] },
		{ name: 'E-commerce', price: '$1,199', period: 'starting at', desc: 'A complete WooCommerce online store.', features: ['WooCommerce store setup', 'Up to 50 products uploaded', 'Payment & shipping setup', 'Order notifications automation', '3 months support'] },
	],
	'ai-automation': [
		{ name: 'Starter', price: '$249', period: 'one-time', desc: 'One automation to save time right away.', features: ['1 workflow automation', 'Up to 3 app integrations', 'Testing & documentation', '2 weeks support'] },
		{ name: 'Growth', price: '$599', period: 'one-time', desc: 'AI chatbot + lead automation system.', featured: true, features: ['AI chatbot (website or WhatsApp)', 'Lead capture → CRM automation', 'Instant follow-up emails/messages', 'Up to 4 workflows', '1 month support'] },
		{ name: 'Scale', price: '$199', period: '/ month', desc: 'An ongoing automation partner for your team.', features: ['Unlimited small automations', 'Monitoring & fixes', 'Monthly optimization call', 'Priority support'] },
	],
	'local-seo': [
		{ name: 'Starter', price: '$149', period: '/ month', desc: 'Get your Google presence set up correctly.', features: ['Google Business Profile optimization', '10 local citations', '4 GBP posts per month', 'Monthly report'] },
		{ name: 'Growth', price: '$299', period: '/ month', desc: 'Climb into the Google Map Pack.', featured: true, features: ['Everything in Starter', '25 local citations', 'On-page local SEO', 'Review generation system', 'Rank tracking'] },
		{ name: 'Dominate', price: '$499', period: '/ month', desc: 'For competitive markets and multiple locations.', features: ['Everything in Growth', 'Location landing pages', '2 local blog posts / month', 'Competitor monitoring', 'Bi-weekly strategy calls'] },
	],
};

/*
 * Portfolio projects. `types` uses service slugs (drives the filter and the
 * "Recent Work" section on each service page). `image` is optional, e.g.
 * 'assets/img/raza-dental.jpg'. Example:
 *
 * { title: 'Raza Dental Clinic', excerpt: 'New website + Google profile.', types: ['web-design-development', 'local-seo'], image: '', url: '' },
 */
const projects = [];

// About page.
const aboutTools = ['WordPress', 'Elementor', 'WooCommerce', 'Figma', 'n8n', 'Make', 'Zapier', 'OpenAI', 'Claude', 'WhatsApp API', 'Google Business Profile', 'Search Console', 'Google Analytics', 'Ahrefs', 'GoHighLevel', 'HubSpot'];

const aboutValues = [
	{ icon: 'heart', title: 'Honesty', text: 'Clear pricing, realistic timelines and no fake promises.' },
	{ icon: 'target', title: 'Results', text: 'We measure success by your leads, sales and time saved.' },
	{ icon: 'zap', title: 'Speed', text: 'Fast communication and fast delivery, every time.' },
	{ icon: 'users', title: 'Partnership', text: 'We treat your business like our own and stay with you long-term.' },
];

// Placeholder stats — replace with real numbers before launch.
const aboutStats = [
	{ value: '50+', label: 'Projects delivered' },
	{ value: '30+', label: 'Happy clients' },
	{ value: '1,000+', label: 'Hours saved by automation' },
	{ value: '24h', label: 'Average response time' },
];

module.exports = {
	config,
	services,
	processSteps,
	whyUs,
	testimonials,
	homeFaqs,
	pricingFaqs,
	pricing,
	projects,
	aboutTools,
	aboutValues,
	aboutStats,
};
