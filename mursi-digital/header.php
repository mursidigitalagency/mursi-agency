<?php
/**
 * Site header.
 *
 * @package Mursi_Digital
 */

?><!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'mursi-digital' ); ?></a>

<header class="site-header" id="site-header">
	<div class="container header-inner">
		<?php mursi_brand(); ?>

		<nav class="primary-nav" id="primary-nav" aria-label="<?php esc_attr_e( 'Primary', 'mursi-digital' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'menu_id'        => 'primary-menu',
					'fallback_cb'    => 'mursi_primary_menu_fallback',
					'depth'          => 2,
				)
			);
			?>
			<a class="btn btn--primary btn--block mobile-cta" href="<?php echo esc_url( mursi_booking_url() ); ?>"><?php esc_html_e( 'Book a Free Call', 'mursi-digital' ); ?></a>
		</nav>

		<div class="header-cta">
			<a class="btn btn--primary" href="<?php echo esc_url( mursi_booking_url() ); ?>"><?php esc_html_e( 'Book a Free Call', 'mursi-digital' ); ?></a>
			<button class="nav-toggle" type="button" aria-controls="primary-nav" aria-expanded="false">
				<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'mursi-digital' ); ?></span>
				<span class="icon-open"><?php mursi_the_icon( 'menu' ); ?></span>
			</button>
		</div>
	</div>
</header>

<main id="main" class="site-main">
