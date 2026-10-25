/**
 * Mursi Digital — front-end interactions (no dependencies).
 */
(function () {
	'use strict';

	// Sticky header shadow.
	var header = document.getElementById('site-header');
	if (header) {
		var onScroll = function () {
			header.classList.toggle('is-scrolled', window.scrollY > 8);
		};
		window.addEventListener('scroll', onScroll, { passive: true });
		onScroll();
	}

	// Mobile menu.
	var toggle = document.querySelector('.nav-toggle');
	var nav = document.getElementById('primary-nav');
	if (toggle && nav) {
		var setOpen = function (open) {
			nav.classList.toggle('is-open', open);
			document.body.classList.toggle('nav-open', open);
			toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
		};
		toggle.addEventListener('click', function () {
			setOpen(!nav.classList.contains('is-open'));
		});
		document.addEventListener('keydown', function (e) {
			if (e.key === 'Escape') setOpen(false);
		});
		nav.addEventListener('click', function (e) {
			if (e.target.closest('a')) setOpen(false);
		});
	}

	// FAQ accordion.
	document.querySelectorAll('.faq-q').forEach(function (btn) {
		btn.addEventListener('click', function () {
			var item = btn.closest('.faq-item');
			var open = !item.classList.contains('is-open');
			item.classList.toggle('is-open', open);
			btn.setAttribute('aria-expanded', open ? 'true' : 'false');
		});
	});

	// Pricing tabs.
	document.querySelectorAll('[data-pricing]').forEach(function (wrap) {
		var tabs = wrap.querySelectorAll('.pricing-tab');
		tabs.forEach(function (tab) {
			tab.addEventListener('click', function () {
				tabs.forEach(function (t) {
					var active = t === tab;
					t.classList.toggle('is-active', active);
					t.setAttribute('aria-selected', active ? 'true' : 'false');
					var panel = document.getElementById(t.getAttribute('aria-controls'));
					if (panel) panel.hidden = !active;
				});
			});
		});
	});

	// Portfolio filter.
	var filterBar = document.querySelector('[data-filter]');
	var filterGrid = document.querySelector('[data-filter-grid]');
	if (filterBar && filterGrid) {
		filterBar.addEventListener('click', function (e) {
			var btn = e.target.closest('.filter-btn');
			if (!btn) return;
			var value = btn.getAttribute('data-filter-value');
			filterBar.querySelectorAll('.filter-btn').forEach(function (b) {
				b.classList.toggle('is-active', b === btn);
			});
			filterGrid.querySelectorAll('.project-card').forEach(function (card) {
				var types = (card.getAttribute('data-types') || '').split(' ');
				card.classList.toggle('is-hidden', value !== '*' && types.indexOf(value) === -1);
			});
		});
	}

	// Contact form: preselect ?service=, then send to formEndpoint or open the email app.
	var form = document.querySelector('[data-contact-form]');
	if (form) {
		var notice = document.querySelector('[data-form-notice]');
		var showNotice = function (type, text) {
			notice.className = 'notice notice--' + type;
			notice.textContent = text;
			notice.hidden = false;
		};

		var params = new URLSearchParams(window.location.search);
		var serviceSlug = params.get('service');
		if (serviceSlug) {
			var option = form.querySelector('#cf-service option[data-slug="' + serviceSlug.replace(/[^a-z0-9-]/g, '') + '"]');
			if (option) option.selected = true;
		}

		form.addEventListener('submit', function (e) {
			e.preventDefault();
			var fields = form.elements;
			if (fields.website.value) return; // Honeypot: bots fill the hidden field.

			var name = fields.name.value.trim();
			var email = fields.email.value.trim();
			var message = fields.message.value.trim();
			if (!name || !message || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
				showNotice('error', 'Please fill in your name, a valid email and your message.');
				return;
			}

			var endpoint = form.getAttribute('data-endpoint');
			if (endpoint) {
				var button = form.querySelector('[type="submit"]');
				button.disabled = true;
				fetch(endpoint, { method: 'POST', body: new FormData(form), headers: { Accept: 'application/json' } })
					.then(function (res) {
						if (!res.ok) throw new Error(res.status);
						form.reset();
						showNotice('success', 'Thank you! Your message has been sent. We will get back to you within 24 hours.');
					})
					.catch(function () {
						showNotice('error', 'Sorry, something went wrong. Please try again or contact us on WhatsApp.');
					})
					.then(function () {
						button.disabled = false;
					});
				return;
			}

			var body = [
				'Name: ' + name,
				'Email: ' + email,
				'Phone: ' + fields.phone.value.trim(),
				'Service: ' + fields.service.value,
				'Budget: ' + fields.budget.value,
				'',
				message,
			].join('\n');
			window.location.href = 'mailto:' + form.getAttribute('data-email') +
				'?subject=' + encodeURIComponent('New enquiry from ' + name) +
				'&body=' + encodeURIComponent(body);
			showNotice('success', 'Your email app should open with your message ready to send.');
		});
	}

	// Scroll reveal.
	var revealEls = document.querySelectorAll('.reveal');
	if ('IntersectionObserver' in window) {
		var io = new IntersectionObserver(function (entries) {
			entries.forEach(function (entry) {
				if (entry.isIntersecting) {
					entry.target.classList.add('is-visible');
					io.unobserve(entry.target);
				}
			});
		}, { rootMargin: '0px 0px -40px 0px', threshold: 0.08 });
		revealEls.forEach(function (el) { io.observe(el); });
	} else {
		revealEls.forEach(function (el) { el.classList.add('is-visible'); });
	}
})();
