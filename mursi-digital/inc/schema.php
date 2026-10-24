<?php
/**
 * JSON-LD structured data for Local SEO.
 *
 * @package Mursi_Digital
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Print ProfessionalService schema on the front page and FAQPage schema where FAQs render.
 */
function mursi_schema() {
	if ( ! is_front_page() ) {
		return;
	}

	$same_as = array_values(
		array_filter(
			array(
				mursi_option( 'facebook' ),
				mursi_option( 'instagram' ),
				mursi_option( 'linkedin' ),
				mursi_option( 'x' ),
				mursi_option( 'youtube' ),
			)
		)
	);

	$services = array();
	foreach ( mursi_services() as $slug => $service ) {
		$services[] = array(
			'@type'       => 'Offer',
			'itemOffered' => array(
				'@type'       => 'Service',
				'name'        => $service['title'],
				'description' => $service['short'],
				'url'         => mursi_page_url( $slug ),
			),
		);
	}

	$schema = array(
		'@context'        => 'https://schema.org',
		'@type'           => 'ProfessionalService',
		'name'            => 'Mursi Digital Solutions',
		'url'             => home_url( '/' ),
		'email'           => mursi_option( 'email' ),
		'telephone'       => mursi_option( 'phone' ),
		'description'     => get_bloginfo( 'description' ),
		'address'         => array(
			'@type'           => 'PostalAddress',
			'streetAddress'   => mursi_option( 'address' ),
			'addressLocality' => mursi_option( 'city' ),
		),
		'hasOfferCatalog' => array(
			'@type'           => 'OfferCatalog',
			'name'            => 'Digital Services',
			'itemListElement' => $services,
		),
	);

	if ( has_custom_logo() ) {
		$logo = wp_get_attachment_image_url( get_theme_mod( 'custom_logo' ), 'full' );
		if ( $logo ) {
			$schema['logo']  = $logo;
			$schema['image'] = $logo;
		}
	}
	if ( $same_as ) {
		$schema['sameAs'] = $same_as;
	}

	echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . "</script>\n";
}
add_action( 'wp_head', 'mursi_schema', 30 );

/**
 * Collected FAQs printed as FAQPage schema in the footer.
 *
 * @param array|null $faqs FAQs to add; null to read.
 * @return array
 */
function mursi_faq_registry( $faqs = null ) {
	static $all = array();
	if ( is_array( $faqs ) ) {
		$all = array_merge( $all, $faqs );
	}
	return $all;
}

/**
 * Print FAQPage schema for every FAQ block rendered on the page.
 */
function mursi_faq_schema() {
	$faqs = mursi_faq_registry();
	if ( ! $faqs ) {
		return;
	}
	$entities = array();
	foreach ( $faqs as $faq ) {
		$entities[] = array(
			'@type'          => 'Question',
			'name'           => $faq['q'],
			'acceptedAnswer' => array(
				'@type' => 'Answer',
				'text'  => $faq['a'],
			),
		);
	}
	$schema = array(
		'@context'   => 'https://schema.org',
		'@type'      => 'FAQPage',
		'mainEntity' => $entities,
	);
	echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . "</script>\n";
}
add_action( 'wp_footer', 'mursi_faq_schema' );
