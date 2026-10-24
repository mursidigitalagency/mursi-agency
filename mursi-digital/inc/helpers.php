<?php
/**
 * Template helpers.
 *
 * @package Mursi_Digital
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * URL of a page by its slug/path, falling back to a pretty URL if the page doesn't exist yet.
 *
 * @param string $path Page path, e.g. "contact" or "services/local-seo".
 * @return string
 */
function mursi_page_url( $path ) {
	$page = get_page_by_path( $path );
	if ( $page ) {
		return get_permalink( $page );
	}
	return home_url( '/' . trailingslashit( $path ) );
}

/**
 * Get a theme option set in the Customizer.
 *
 * @param string $key Setting key without the "mursi_" prefix.
 * @return string
 */
function mursi_option( $key ) {
	$defaults = mursi_option_defaults();
	return get_theme_mod( 'mursi_' . $key, isset( $defaults[ $key ] ) ? $defaults[ $key ] : '' );
}

/**
 * "Book a call" link: Customizer booking URL, or the Contact page.
 *
 * @return string
 */
function mursi_booking_url() {
	$url = mursi_option( 'booking_url' );
	return $url ? $url : mursi_page_url( 'contact' );
}

/**
 * WhatsApp chat link built from the Customizer number.
 *
 * @param string $message Optional prefilled message.
 * @return string Empty string when no number is set.
 */
function mursi_whatsapp_url( $message = '' ) {
	$number = preg_replace( '/\D+/', '', mursi_option( 'whatsapp' ) );
	if ( ! $number ) {
		return '';
	}
	if ( '' === $message ) {
		$message = __( 'Hi Mursi Digital! I would like to discuss a project.', 'mursi-digital' );
	}
	return 'https://wa.me/' . $number . '?text=' . rawurlencode( $message );
}

/**
 * Inline SVG icon (stroke style, 24x24).
 *
 * @param string $name Icon name.
 * @return string Safe SVG markup.
 */
function mursi_icon( $name ) {
	$paths = array(
		'bot'      => '<rect x="4" y="8" width="16" height="12" rx="3"/><path d="M12 8V4"/><circle cx="12" cy="3" r="1"/><circle cx="9" cy="14" r="1.2"/><circle cx="15" cy="14" r="1.2"/><path d="M2 13v3M22 13v3"/>',
		'layout'   => '<rect x="3" y="4" width="18" height="16" rx="2"/><path d="M3 9h18M9 20V9"/>',
		'pin'      => '<path d="M12 22s7-6.1 7-12a7 7 0 1 0-14 0c0 5.9 7 12 7 12z"/><circle cx="12" cy="10" r="2.5"/>',
		'zap'      => '<path d="M13 2 4 14h7l-1 8 9-12h-7l1-8z"/>',
		'target'   => '<circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="5"/><circle cx="12" cy="12" r="1"/>',
		'users'    => '<circle cx="9" cy="8" r="3.5"/><path d="M2.5 20a6.5 6.5 0 0 1 13 0"/><path d="M16 4.5a3.5 3.5 0 0 1 0 7M21.5 20a6.5 6.5 0 0 0-4-6"/>',
		'chart'    => '<path d="M3 3v18h18"/><path d="m7 15 4-4 3 3 5-6"/>',
		'shield'   => '<path d="M12 3 4 6v6c0 5 3.4 8.5 8 9 4.6-.5 8-4 8-9V6l-8-3z"/><path d="m9 12 2 2 4-4"/>',
		'clock'    => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>',
		'check'    => '<path d="M5 12l5 5L20 7"/>',
		'mail'     => '<rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/>',
		'phone'    => '<path d="M5 4h4l2 5-2.5 1.5a11 11 0 0 0 5 5L15 13l5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2"/>',
		'arrow'    => '<path d="M5 12h14M13 6l6 6-6 6"/>',
		'code'     => '<path d="m8 16-4-4 4-4M16 8l4 4-4 4M14 4l-4 16"/>',
		'search'   => '<circle cx="11" cy="11" r="7"/><path d="m20 20-4-4"/>',
		'star'     => '<path d="m12 3 2.8 5.7 6.2.9-4.5 4.4 1 6.2L12 17.3 6.5 20.2l1-6.2L3 9.6l6.2-.9L12 3z"/>',
		'heart'    => '<path d="M12 20s-8-4.6-8-10.5A4.5 4.5 0 0 1 12 7a4.5 4.5 0 0 1 8 2.5C20 15.4 12 20 12 20z"/>',
		'menu'     => '<path d="M4 7h16M4 12h16M4 17h16"/>',
		'close'    => '<path d="M6 6l12 12M18 6 6 18"/>',
		'image'    => '<rect x="3" y="4" width="18" height="16" rx="2"/><circle cx="9" cy="10" r="2"/><path d="m21 16-5-5-9 9"/>',
		'cart'     => '<circle cx="9" cy="20" r="1.5"/><circle cx="18" cy="20" r="1.5"/><path d="M3 4h2l2.4 11.2a2 2 0 0 0 2 1.6h7.7a2 2 0 0 0 2-1.5L21 8H6"/>',
		'gauge'    => '<path d="M12 14l4-4"/><path d="M3.5 18a9 9 0 1 1 17 0"/>',
		'link'     => '<path d="M10 14a5 5 0 0 0 7 0l3-3a5 5 0 0 0-7-7l-1 1"/><path d="M14 10a5 5 0 0 0-7 0l-3 3a5 5 0 0 0 7 7l1-1"/>',
		'message'  => '<path d="M21 12a8 8 0 0 1-11.6 7.1L4 20l1-4.6A8 8 0 1 1 21 12z"/>',
		'workflow' => '<rect x="3" y="3" width="6" height="6" rx="1.5"/><rect x="15" y="15" width="6" height="6" rx="1.5"/><path d="M6 9v4a2 2 0 0 0 2 2h7"/>',
		'pen'      => '<path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z"/>',
		'file'     => '<path d="M14 3H6a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9l-6-6z"/><path d="M14 3v6h6M8 13h8M8 17h5"/>',
	);

	$brands = array(
		'whatsapp'  => '<path fill="currentColor" d="M12 2a10 10 0 0 0-8.6 15.1L2 22l5-1.3A10 10 0 1 0 12 2zm0 18.2a8.2 8.2 0 0 1-4.2-1.1l-.3-.2-3 .8.8-2.9-.2-.3A8.2 8.2 0 1 1 12 20.2zm4.5-6.1c-.2-.1-1.5-.7-1.7-.8s-.4-.1-.6.1-.7.8-.8 1-.3.2-.5.1a6.7 6.7 0 0 1-3.3-2.9c-.3-.4.2-.4.7-1.4.1-.2 0-.3 0-.4l-.8-1.8c-.2-.5-.4-.4-.6-.4h-.5a1 1 0 0 0-.7.3 3 3 0 0 0-.9 2.2 5.1 5.1 0 0 0 1.1 2.7 11.7 11.7 0 0 0 4.5 4c1.7.7 2.3.8 3.2.6a2.7 2.7 0 0 0 1.8-1.2 2.2 2.2 0 0 0 .1-1.3c0-.1-.2-.2-.5-.3z"/>',
		'facebook'  => '<path fill="currentColor" d="M14 8h3V4h-3a4 4 0 0 0-4 4v2H8v4h2v8h4v-8h3l1-4h-4V8z"/>',
		'instagram' => '<rect x="3" y="3" width="18" height="18" rx="5" fill="none" stroke="currentColor" stroke-width="2"/><circle cx="12" cy="12" r="4" fill="none" stroke="currentColor" stroke-width="2"/><circle cx="17.5" cy="6.5" r="1.2" fill="currentColor"/>',
		'linkedin'  => '<path fill="currentColor" d="M4 9h4v12H4zM6 3a2 2 0 1 1 0 4 2 2 0 0 1 0-4zM10 9h3.8v1.7A4.2 4.2 0 0 1 17.6 9C21 9 22 11 22 14.4V21h-4v-5.8c0-1.4 0-3.2-2-3.2s-2.2 1.5-2.2 3.1V21H10z"/>',
		'x'         => '<path fill="currentColor" d="M17.8 3h3.1l-6.8 7.8L22 21h-6.2l-4.9-6.4L5.3 21H2.2l7.3-8.3L2 3h6.4l4.4 5.8zm-1.1 16.2h1.7L7.4 4.7H5.6z"/>',
		'youtube'   => '<path fill="currentColor" d="M22 8.2a3 3 0 0 0-2.1-2.1C18 5.6 12 5.6 12 5.6s-6 0-7.9.5A3 3 0 0 0 2 8.2 31 31 0 0 0 1.6 12 31 31 0 0 0 2 15.8a3 3 0 0 0 2.1 2.1c1.9.5 7.9.5 7.9.5s6 0 7.9-.5a3 3 0 0 0 2.1-2.1 31 31 0 0 0 .4-3.8 31 31 0 0 0-.4-3.8zM10 15V9l5.2 3z"/>',
	);

	if ( isset( $brands[ $name ] ) ) {
		return '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">' . $brands[ $name ] . '</svg>';
	}
	if ( ! isset( $paths[ $name ] ) ) {
		return '';
	}
	return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">' . $paths[ $name ] . '</svg>';
}

/**
 * Echo an icon. SVG markup is hard-coded above, so it is safe to print.
 *
 * @param string $name Icon name.
 */
function mursi_the_icon( $name ) {
	echo mursi_icon( $name ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Brand markup (custom logo if set, otherwise text logo).
 */
function mursi_brand() {
	if ( has_custom_logo() ) {
		the_custom_logo();
		return;
	}
	?>
	<a class="site-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<span class="brand-mark" aria-hidden="true">M</span>
		<span class="brand-text">Mursi <span>Digital</span></span>
	</a>
	<?php
}

/**
 * Fallback for the primary menu when none is assigned yet.
 */
function mursi_primary_menu_fallback() {
	$services = mursi_services();
	echo '<ul id="primary-menu">';
	echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'mursi-digital' ) . '</a></li>';
	echo '<li class="menu-item-has-children"><a href="' . esc_url( home_url( '/#services' ) ) . '">' . esc_html__( 'Services', 'mursi-digital' ) . '</a><ul class="sub-menu">';
	foreach ( $services as $slug => $service ) {
		echo '<li><a href="' . esc_url( mursi_page_url( $slug ) ) . '">' . esc_html( $service['title'] ) . '</a></li>';
	}
	echo '</ul></li>';
	$pages = array(
		'portfolio' => __( 'Portfolio', 'mursi-digital' ),
		'pricing'   => __( 'Pricing', 'mursi-digital' ),
		'about'     => __( 'About', 'mursi-digital' ),
		'contact'   => __( 'Contact', 'mursi-digital' ),
	);
	foreach ( $pages as $slug => $label ) {
		echo '<li><a href="' . esc_url( mursi_page_url( $slug ) ) . '">' . esc_html( $label ) . '</a></li>';
	}
	echo '</ul>';
}

/**
 * Load a template part and pass args (WP 5.5+).
 *
 * @param string $name Part name inside template-parts/.
 * @param array  $args Args available as $args in the part.
 */
function mursi_part( $name, $args = array() ) {
	get_template_part( 'template-parts/' . $name, null, $args );
}
