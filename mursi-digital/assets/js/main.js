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
