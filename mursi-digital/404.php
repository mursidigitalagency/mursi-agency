<?php
/**
 * 404 page.
 *
 * @package Mursi_Digital
 */

get_header();
?>
<section class="page-hero" style="padding:120px 0">
	<div class="container">
		<span class="eyebrow">404</span>
		<h1><?php esc_html_e( 'Page not found', 'mursi-digital' ); ?></h1>
		<p><?php esc_html_e( 'The page you are looking for doesn\'t exist or has been moved.', 'mursi-digital' ); ?></p>
		<div class="btn-row">
			<a class="btn btn--primary" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Back to Home', 'mursi-digital' ); ?></a>
			<a class="btn btn--ghost" href="<?php echo esc_url( mursi_page_url( 'contact' ) ); ?>"><?php esc_html_e( 'Contact Us', 'mursi-digital' ); ?></a>
		</div>
	</div>
</section>
<?php
get_footer();
