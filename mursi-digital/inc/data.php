<?php
/**
 * Site content: services, pricing, FAQs, testimonials.
 * Edit the text here to update the website copy in one place.
 *
 * @package Mursi_Digital
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Services, keyed by the slug of their WordPress page.
 * Create pages with these slugs and assign the "Service Page" template.
 *
 * @return array
 */
function mursi_services() {
	$services = array(
		'ai-automation'          => array(
			'title'    => __( 'AI Automation', 'mursi-digital' ),
			'icon'     => 'bot',
			'short'    => __( 'Save hours every week with AI chatbots, smart workflows and automated lead follow-up that work 24/7.', 'mursi-digital' ),
			'headline' => __( 'Put your busywork on autopilot with AI', 'mursi-digital' ),
			'intro'    => __( 'We design and build AI-powered automations that answer customers instantly, capture and qualify leads, and connect your tools — so your team can focus on work that actually grows the business.', 'mursi-digital' ),
			'bullets'  => array(
				__( 'AI chatbots for website & WhatsApp', 'mursi-digital' ),
				__( 'Workflow automation (n8n, Make, Zapier)', 'mursi-digital' ),
				__( 'Lead capture & CRM integrations', 'mursi-digital' ),
			),
			'problems' => array(
				__( 'Leads wait hours (or days) for a reply and go to competitors', 'mursi-digital' ),
				__( 'Your team copies data between apps by hand', 'mursi-digital' ),
				__( 'The same customer questions get answered again and again', 'mursi-digital' ),
				__( 'No clear view of where leads come from or what happens to them', 'mursi-digital' ),
			),
			'included' => array(
				array( 'icon' => 'message', 'title' => __( 'AI Chatbots', 'mursi-digital' ), 'text' => __( 'Trained on your business to answer FAQs, book appointments and collect leads on your website, WhatsApp or Messenger.', 'mursi-digital' ) ),
				array( 'icon' => 'workflow', 'title' => __( 'Workflow Automation', 'mursi-digital' ), 'text' => __( 'Connect forms, email, sheets, CRMs and payment tools with n8n, Make or Zapier — no more copy-paste.', 'mursi-digital' ) ),
				array( 'icon' => 'users', 'title' => __( 'Lead Management', 'mursi-digital' ), 'text' => __( 'Auto-capture, qualify and route leads to the right person with instant follow-up emails and messages.', 'mursi-digital' ) ),
				array( 'icon' => 'link', 'title' => __( 'CRM & App Integrations', 'mursi-digital' ), 'text' => __( 'HubSpot, GoHighLevel, Google Workspace, WooCommerce and more — your data flows where it should.', 'mursi-digital' ) ),
				array( 'icon' => 'file', 'title' => __( 'AI Content & Docs', 'mursi-digital' ), 'text' => __( 'Automatically generate proposals, reports, replies and summaries using AI with your brand voice.', 'mursi-digital' ) ),
				array( 'icon' => 'chart', 'title' => __( 'Reporting Dashboards', 'mursi-digital' ), 'text' => __( 'See leads, response times and results in one simple dashboard updated automatically.', 'mursi-digital' ) ),
			),
			'faqs'     => array(
				array( 'q' => __( 'Do I need technical knowledge to use the automations?', 'mursi-digital' ), 'a' => __( 'No. We build, test and hand over everything with a short training video. You just use it — we handle the technical side.', 'mursi-digital' ) ),
				array( 'q' => __( 'Which tools do you work with?', 'mursi-digital' ), 'a' => __( 'n8n, Make, Zapier, OpenAI / Claude, WhatsApp Business API, Google Workspace, HubSpot, GoHighLevel, WooCommerce and most tools that have an API.', 'mursi-digital' ) ),
				array( 'q' => __( 'Is my business data safe?', 'mursi-digital' ), 'a' => __( 'Yes. We use secure, reputable platforms, limit access to only what is needed, and can self-host automations (e.g. n8n) for extra control.', 'mursi-digital' ) ),
			),
		),
		'web-design-development' => array(
			'title'    => __( 'Web Design & Development', 'mursi-digital' ),
			'icon'     => 'layout',
			'short'    => __( 'Fast, beautiful WordPress websites with UX/UI design that turns visitors into customers.', 'mursi-digital' ),
			'headline' => __( 'WordPress websites designed to convert', 'mursi-digital' ),
			'intro'    => __( 'From UX research and UI design to custom WordPress development, we build websites that look professional, load fast, rank on Google and make it easy for visitors to contact you.', 'mursi-digital' ),
			'bullets'  => array(
				__( 'UX/UI design in Figma', 'mursi-digital' ),
				__( 'Custom WordPress & WooCommerce', 'mursi-digital' ),
				__( 'Speed, security & maintenance', 'mursi-digital' ),
			),
			'problems' => array(
				__( 'Your current website looks outdated and hurts trust', 'mursi-digital' ),
				__( 'Visitors leave without calling or filling the form', 'mursi-digital' ),
				__( 'The site is slow, especially on mobile', 'mursi-digital' ),
				__( 'You can\'t update content without calling a developer', 'mursi-digital' ),
			),
			'included' => array(
				array( 'icon' => 'pen', 'title' => __( 'UX/UI Design', 'mursi-digital' ), 'text' => __( 'User research, wireframes and pixel-perfect Figma designs you approve before a single line of code is written.', 'mursi-digital' ) ),
				array( 'icon' => 'code', 'title' => __( 'WordPress Development', 'mursi-digital' ), 'text' => __( 'Custom themes or Elementor builds that are clean, lightweight and easy for you to edit.', 'mursi-digital' ) ),
				array( 'icon' => 'cart', 'title' => __( 'WooCommerce Stores', 'mursi-digital' ), 'text' => __( 'Online stores with local payment gateways, delivery options and smooth checkout.', 'mursi-digital' ) ),
				array( 'icon' => 'gauge', 'title' => __( 'Speed Optimization', 'mursi-digital' ), 'text' => __( 'Core Web Vitals tuning, image optimization and caching for 90+ PageSpeed scores.', 'mursi-digital' ) ),
				array( 'icon' => 'search', 'title' => __( 'SEO-Ready Build', 'mursi-digital' ), 'text' => __( 'Clean structure, schema markup, meta tags and sitemaps set up from day one.', 'mursi-digital' ) ),
				array( 'icon' => 'shield', 'title' => __( 'Care & Maintenance', 'mursi-digital' ), 'text' => __( 'Updates, backups, security monitoring and small content changes every month.', 'mursi-digital' ) ),
			),
			'faqs'     => array(
				array( 'q' => __( 'How long does a website take?', 'mursi-digital' ), 'a' => __( 'A business website usually takes 2–4 weeks; online stores 4–6 weeks. You get a clear timeline before we start.', 'mursi-digital' ) ),
				array( 'q' => __( 'Will I be able to edit the website myself?', 'mursi-digital' ), 'a' => __( 'Yes. We build on WordPress and give you a training video so you can update text, images, blog posts and products easily.', 'mursi-digital' ) ),
				array( 'q' => __( 'Do you provide hosting and domain?', 'mursi-digital' ), 'a' => __( 'We can recommend and set up fast, reliable hosting and your domain, or work with your existing provider.', 'mursi-digital' ) ),
			),
		),
		'local-seo'              => array(
			'title'    => __( 'Local SEO', 'mursi-digital' ),
			'icon'     => 'pin',
			'short'    => __( 'Rank in Google Maps and local search so nearby customers find and call you first.', 'mursi-digital' ),
			'headline' => __( 'Get found by customers near you', 'mursi-digital' ),
			'intro'    => __( 'We help local businesses show up in the Google Map Pack and "near me" searches with a proven Local SEO system — Google Business Profile optimization, citations, reviews and on-page SEO.', 'mursi-digital' ),
			'bullets'  => array(
				__( 'Google Business Profile optimization', 'mursi-digital' ),
				__( 'Local citations & on-page SEO', 'mursi-digital' ),
				__( 'Review strategy & monthly reports', 'mursi-digital' ),
			),
			'problems' => array(
				__( 'Competitors show up on Google Maps — you don\'t', 'mursi-digital' ),
				__( 'Your Google Business Profile is incomplete or unverified', 'mursi-digital' ),
				__( 'Few reviews, or no system to get more', 'mursi-digital' ),
				__( 'Website traffic doesn\'t turn into calls or visits', 'mursi-digital' ),
			),
			'included' => array(
				array( 'icon' => 'pin', 'title' => __( 'Google Business Profile', 'mursi-digital' ), 'text' => __( 'Full setup and optimization: categories, services, photos, posts, Q&A and weekly updates.', 'mursi-digital' ) ),
				array( 'icon' => 'link', 'title' => __( 'Local Citations', 'mursi-digital' ), 'text' => __( 'Consistent name, address and phone listings on trusted directories to build local authority.', 'mursi-digital' ) ),
				array( 'icon' => 'search', 'title' => __( 'On-Page Local SEO', 'mursi-digital' ), 'text' => __( 'Location pages, keyword optimization, local schema and internal linking on your website.', 'mursi-digital' ) ),
				array( 'icon' => 'star', 'title' => __( 'Review Generation', 'mursi-digital' ), 'text' => __( 'Simple automated system to ask happy customers for Google reviews and respond professionally.', 'mursi-digital' ) ),
				array( 'icon' => 'target', 'title' => __( 'Competitor Analysis', 'mursi-digital' ), 'text' => __( 'Find out why competitors rank and build a clear plan to outrank them in your area.', 'mursi-digital' ) ),
				array( 'icon' => 'chart', 'title' => __( 'Rank Tracking & Reports', 'mursi-digital' ), 'text' => __( 'Monthly reports on map rankings, calls, direction requests and website visits.', 'mursi-digital' ) ),
			),
			'faqs'     => array(
				array( 'q' => __( 'How long until I see results?', 'mursi-digital' ), 'a' => __( 'Most clients see movement in Google Maps within 30–60 days, with strong results in 3–6 months depending on competition.', 'mursi-digital' ) ),
				array( 'q' => __( 'Do you guarantee #1 ranking?', 'mursi-digital' ), 'a' => __( 'No honest agency can guarantee rankings — Google controls that. We guarantee proven, transparent work and monthly reporting so you see the progress.', 'mursi-digital' ) ),
				array( 'q' => __( 'I don\'t have a physical shop. Can I still do Local SEO?', 'mursi-digital' ), 'a' => __( 'Yes. Service-area businesses (plumbers, consultants, cleaners, etc.) can rank locally with a properly set-up Business Profile that hides the address.', 'mursi-digital' ) ),
			),
		),
	);

	return apply_filters( 'mursi_services', $services );
}

/**
 * Get one service by slug.
 *
 * @param string $slug Service slug.
 * @return array|null
 */
function mursi_get_service( $slug ) {
	$services = mursi_services();
	return isset( $services[ $slug ] ) ? $services[ $slug ] : null;
}

/**
 * Work process steps.
 *
 * @return array
 */
function mursi_process() {
	return array(
		array( 'title' => __( 'Discover', 'mursi-digital' ), 'text' => __( 'A free call to understand your business, goals and what is holding growth back.', 'mursi-digital' ) ),
		array( 'title' => __( 'Plan & Design', 'mursi-digital' ), 'text' => __( 'A clear strategy, timeline and designs you approve before we build.', 'mursi-digital' ) ),
		array( 'title' => __( 'Build & Launch', 'mursi-digital' ), 'text' => __( 'We develop, test and launch — keeping you updated at every step.', 'mursi-digital' ) ),
		array( 'title' => __( 'Grow & Support', 'mursi-digital' ), 'text' => __( 'Ongoing optimization, reporting and support to keep results improving.', 'mursi-digital' ) ),
	);
}

/**
 * "Why choose us" points.
 *
 * @return array
 */
function mursi_why_us() {
	return array(
		array( 'icon' => 'target', 'title' => __( 'Results-focused', 'mursi-digital' ), 'text' => __( 'Every website, automation and SEO task is tied to leads, sales and time saved.', 'mursi-digital' ) ),
		array( 'icon' => 'zap', 'title' => __( 'Fast delivery', 'mursi-digital' ), 'text' => __( 'Clear timelines and quick turnaround without cutting corners.', 'mursi-digital' ) ),
		array( 'icon' => 'message', 'title' => __( 'Clear communication', 'mursi-digital' ), 'text' => __( 'One point of contact, regular updates and no confusing tech jargon.', 'mursi-digital' ) ),
		array( 'icon' => 'shield', 'title' => __( 'Ongoing support', 'mursi-digital' ), 'text' => __( 'We don\'t disappear after launch — support and care plans included.', 'mursi-digital' ) ),
	);
}

/**
 * Testimonials (replace with real client reviews).
 *
 * @return array
 */
function mursi_testimonials() {
	return array(
		array( 'name' => 'Ahmed Raza', 'role' => __( 'Owner, Raza Dental Clinic', 'mursi-digital' ), 'text' => __( 'Our new website and Google profile brought in more appointment calls in the first two months than the whole previous year. Very professional team.', 'mursi-digital' ) ),
		array( 'name' => 'Sarah Khan', 'role' => __( 'Founder, Bloom Boutique', 'mursi-digital' ), 'text' => __( 'The WooCommerce store is fast and beautiful, and the WhatsApp automation answers customers even when we are asleep. Highly recommended!', 'mursi-digital' ) ),
		array( 'name' => 'James Miller', 'role' => __( 'Director, Miller Home Services', 'mursi-digital' ), 'text' => __( 'Mursi Digital automated our lead follow-up and got us into the Google Map Pack. Response time went from hours to seconds.', 'mursi-digital' ) ),
	);
}

/**
 * General FAQs for the home page.
 *
 * @return array
 */
function mursi_home_faqs() {
	return array(
		array( 'q' => __( 'What services does Mursi Digital Solutions offer?', 'mursi-digital' ), 'a' => __( 'We offer AI Automation (chatbots, workflows, CRM integrations), Website Design & Development (UX/UI + WordPress) and Local SEO to help businesses get more leads and save time.', 'mursi-digital' ) ),
		array( 'q' => __( 'Do you work with clients outside Pakistan?', 'mursi-digital' ), 'a' => __( 'Yes. We work with clients locally and internationally, fully remote, with calls scheduled around your time zone.', 'mursi-digital' ) ),
		array( 'q' => __( 'How much does a project cost?', 'mursi-digital' ), 'a' => __( 'It depends on scope. See our Pricing page for starting packages, or book a free call for a custom quote.', 'mursi-digital' ) ),
		array( 'q' => __( 'How do we get started?', 'mursi-digital' ), 'a' => __( 'Fill in the contact form or message us on WhatsApp. We will schedule a free strategy call and send you a proposal within 48 hours.', 'mursi-digital' ) ),
	);
}

/**
 * Pricing plans per service (placeholder prices — edit to your own).
 *
 * @return array
 */
function mursi_pricing() {
	return array(
		'web-design-development' => array(
			array(
				'name'     => __( 'Starter', 'mursi-digital' ),
				'price'    => '$299',
				'period'   => __( 'one-time', 'mursi-digital' ),
				'desc'     => __( 'A professional site for new and small businesses.', 'mursi-digital' ),
				'features' => array( __( 'Up to 5 pages', 'mursi-digital' ), __( 'Mobile-responsive design', 'mursi-digital' ), __( 'Contact form + WhatsApp', 'mursi-digital' ), __( 'Basic on-page SEO', 'mursi-digital' ), __( '1 month support', 'mursi-digital' ) ),
			),
			array(
				'name'     => __( 'Business', 'mursi-digital' ),
				'price'    => '$699',
				'period'   => __( 'one-time', 'mursi-digital' ),
				'desc'     => __( 'Custom UX/UI design built to convert visitors.', 'mursi-digital' ),
				'featured' => true,
				'features' => array( __( 'Up to 12 pages', 'mursi-digital' ), __( 'Custom Figma UX/UI design', 'mursi-digital' ), __( 'Blog & lead capture setup', 'mursi-digital' ), __( 'Speed optimization (90+)', 'mursi-digital' ), __( 'SEO & schema setup', 'mursi-digital' ), __( '3 months support', 'mursi-digital' ) ),
			),
			array(
				'name'     => __( 'E-commerce', 'mursi-digital' ),
				'price'    => '$1,199',
				'period'   => __( 'starting at', 'mursi-digital' ),
				'desc'     => __( 'A complete WooCommerce online store.', 'mursi-digital' ),
				'features' => array( __( 'WooCommerce store setup', 'mursi-digital' ), __( 'Up to 50 products uploaded', 'mursi-digital' ), __( 'Payment & shipping setup', 'mursi-digital' ), __( 'Order notifications automation', 'mursi-digital' ), __( '3 months support', 'mursi-digital' ) ),
			),
		),
		'ai-automation'          => array(
			array(
				'name'     => __( 'Starter', 'mursi-digital' ),
				'price'    => '$249',
				'period'   => __( 'one-time', 'mursi-digital' ),
				'desc'     => __( 'One automation to save time right away.', 'mursi-digital' ),
				'features' => array( __( '1 workflow automation', 'mursi-digital' ), __( 'Up to 3 app integrations', 'mursi-digital' ), __( 'Testing & documentation', 'mursi-digital' ), __( '2 weeks support', 'mursi-digital' ) ),
			),
			array(
				'name'     => __( 'Growth', 'mursi-digital' ),
				'price'    => '$599',
				'period'   => __( 'one-time', 'mursi-digital' ),
				'desc'     => __( 'AI chatbot + lead automation system.', 'mursi-digital' ),
				'featured' => true,
				'features' => array( __( 'AI chatbot (website or WhatsApp)', 'mursi-digital' ), __( 'Lead capture → CRM automation', 'mursi-digital' ), __( 'Instant follow-up emails/messages', 'mursi-digital' ), __( 'Up to 4 workflows', 'mursi-digital' ), __( '1 month support', 'mursi-digital' ) ),
			),
			array(
				'name'     => __( 'Scale', 'mursi-digital' ),
				'price'    => '$199',
				'period'   => __( '/ month', 'mursi-digital' ),
				'desc'     => __( 'An ongoing automation partner for your team.', 'mursi-digital' ),
				'features' => array( __( 'Unlimited small automations', 'mursi-digital' ), __( 'Monitoring & fixes', 'mursi-digital' ), __( 'Monthly optimization call', 'mursi-digital' ), __( 'Priority support', 'mursi-digital' ) ),
			),
		),
		'local-seo'              => array(
			array(
				'name'     => __( 'Starter', 'mursi-digital' ),
				'price'    => '$149',
				'period'   => __( '/ month', 'mursi-digital' ),
				'desc'     => __( 'Get your Google presence set up correctly.', 'mursi-digital' ),
				'features' => array( __( 'Google Business Profile optimization', 'mursi-digital' ), __( '10 local citations', 'mursi-digital' ), __( '4 GBP posts per month', 'mursi-digital' ), __( 'Monthly report', 'mursi-digital' ) ),
			),
			array(
				'name'     => __( 'Growth', 'mursi-digital' ),
				'price'    => '$299',
				'period'   => __( '/ month', 'mursi-digital' ),
				'desc'     => __( 'Climb into the Google Map Pack.', 'mursi-digital' ),
				'featured' => true,
				'features' => array( __( 'Everything in Starter', 'mursi-digital' ), __( '25 local citations', 'mursi-digital' ), __( 'On-page local SEO', 'mursi-digital' ), __( 'Review generation system', 'mursi-digital' ), __( 'Rank tracking', 'mursi-digital' ) ),
			),
			array(
				'name'     => __( 'Dominate', 'mursi-digital' ),
				'price'    => '$499',
				'period'   => __( '/ month', 'mursi-digital' ),
				'desc'     => __( 'For competitive markets and multiple locations.', 'mursi-digital' ),
				'features' => array( __( 'Everything in Growth', 'mursi-digital' ), __( 'Location landing pages', 'mursi-digital' ), __( '2 local blog posts / month', 'mursi-digital' ), __( 'Competitor monitoring', 'mursi-digital' ), __( 'Bi-weekly strategy calls', 'mursi-digital' ) ),
			),
		),
	);
}
