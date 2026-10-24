<?php
/**
 * Customizer settings: contact details, social links, brand color.
 *
 * @package Mursi_Digital
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Default option values.
 *
 * @return array
 */
function mursi_option_defaults() {
	return array(
		'brand_color' => '#2563eb',
		'email'       => 'mursidigital.agency@gmail.com',
		'phone'       => '+92 300 0000000',
		'whatsapp'    => '',
		'address'     => 'Pakistan',
		'city'        => '',
		'hours'       => 'Mon – Sat, 10:00 AM – 7:00 PM',
		'map_embed'   => '',
		'booking_url' => '',
		'facebook'    => '',
		'instagram'   => '',
		'linkedin'    => '',
		'x'           => '',
		'youtube'     => '',
	);
}

/**
 * Register Customizer panel and settings.
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager.
 */
function mursi_customize_register( $wp_customize ) {
	$defaults = mursi_option_defaults();

	$wp_customize->add_section(
		'mursi_contact',
		array(
			'title'    => __( 'Mursi: Contact & Business Info', 'mursi-digital' ),
			'priority' => 30,
		)
	);

	$text_fields = array(
		'email'       => array( __( 'Email', 'mursi-digital' ), 'sanitize_email', 'email' ),
		'phone'       => array( __( 'Phone (displayed)', 'mursi-digital' ), 'sanitize_text_field', 'text' ),
		'whatsapp'    => array( __( 'WhatsApp number with country code (e.g. 923001234567)', 'mursi-digital' ), 'sanitize_text_field', 'text' ),
		'address'     => array( __( 'Address / Country', 'mursi-digital' ), 'sanitize_text_field', 'text' ),
		'city'        => array( __( 'City (used for Local SEO schema)', 'mursi-digital' ), 'sanitize_text_field', 'text' ),
		'hours'       => array( __( 'Working hours', 'mursi-digital' ), 'sanitize_text_field', 'text' ),
		'booking_url' => array( __( 'Booking link (Calendly etc.) — leave empty to use Contact page', 'mursi-digital' ), 'esc_url_raw', 'url' ),
		'map_embed'   => array( __( 'Google Maps embed URL (the src="" from the embed code)', 'mursi-digital' ), 'esc_url_raw', 'url' ),
	);

	foreach ( $text_fields as $key => $field ) {
		$wp_customize->add_setting(
			'mursi_' . $key,
			array(
				'default'           => $defaults[ $key ],
				'sanitize_callback' => $field[1],
			)
		);
		$wp_customize->add_control(
			'mursi_' . $key,
			array(
				'label'   => $field[0],
				'section' => 'mursi_contact',
				'type'    => $field[2],
			)
		);
	}

	$wp_customize->add_section(
		'mursi_social',
		array(
			'title'    => __( 'Mursi: Social Links', 'mursi-digital' ),
			'priority' => 31,
		)
	);

	foreach ( array( 'facebook', 'instagram', 'linkedin', 'x', 'youtube' ) as $network ) {
		$wp_customize->add_setting(
			'mursi_' . $network,
			array(
				'default'           => '',
				'sanitize_callback' => 'esc_url_raw',
			)
		);
		$wp_customize->add_control(
			'mursi_' . $network,
			array(
				'label'   => ucfirst( 'x' === $network ? 'X (Twitter)' : $network ),
				'section' => 'mursi_social',
				'type'    => 'url',
			)
		);
	}

	$wp_customize->add_setting(
		'mursi_brand_color',
		array(
			'default'           => $defaults['brand_color'],
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'mursi_brand_color',
			array(
				'label'   => __( 'Brand color', 'mursi-digital' ),
				'section' => 'colors',
			)
		)
	);
}
add_action( 'customize_register', 'mursi_customize_register' );

/**
 * Darken/lighten a hex color.
 *
 * @param string $hex    Hex color.
 * @param float  $amount -1..1, negative darkens, positive mixes with white.
 * @return string
 */
function mursi_shade( $hex, $amount ) {
	$hex = ltrim( $hex, '#' );
	if ( 3 === strlen( $hex ) ) {
		$hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
	}
	$rgb = array_map( 'hexdec', str_split( $hex, 2 ) );
	foreach ( $rgb as &$c ) {
		$c = $amount < 0 ? $c * ( 1 + $amount ) : $c + ( 255 - $c ) * $amount;
		$c = max( 0, min( 255, (int) round( $c ) ) );
	}
	return sprintf( '#%02x%02x%02x', $rgb[0], $rgb[1], $rgb[2] );
}

/**
 * Output brand color CSS variables when changed from the default.
 */
function mursi_brand_color_css() {
	$color = sanitize_hex_color( mursi_option( 'brand_color' ) );
	if ( ! $color || '#2563eb' === strtolower( $color ) ) {
		return;
	}
	printf(
		"<style id=\"mursi-brand\">:root{--brand:%s;--brand-dark:%s;--brand-soft:%s;}</style>\n",
		esc_html( $color ),
		esc_html( mursi_shade( $color, -0.18 ) ),
		esc_html( mursi_shade( $color, 0.92 ) )
	);
}
add_action( 'wp_head', 'mursi_brand_color_css', 20 );
