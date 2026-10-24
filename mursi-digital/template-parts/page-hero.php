<?php
/**
 * Inner page hero.
 *
 * Args: eyebrow, title, text, buttons (bool).
 *
 * @package Mursi_Digital
 */

$args = wp_parse_args(
	$args,
	array(
		'eyebrow' => '',
		'title'   => get_the_title(),
		'text'    => '',
		'buttons' => true,
	)
);
?>
<section class="page-hero">
	<div class="container">
		<?php if ( $args['eyebrow'] ) : ?>
			<span class="eyebrow"><?php echo esc_html( $args['eyebrow'] ); ?></span>
		<?php endif; ?>
		<h1><?php echo esc_html( $args['title'] ); ?></h1>
		<?php if ( $args['text'] ) : ?>
			<p><?php echo esc_html( $args['text'] ); ?></p>
		<?php endif; ?>
		<?php if ( $args['buttons'] ) : ?>
			<div class="btn-row">
				<a class="btn btn--primary" href="<?php echo esc_url( mursi_booking_url() ); ?>"><?php esc_html_e( 'Book a Free Call', 'mursi-digital' ); ?> <?php mursi_the_icon( 'arrow' ); ?></a>
				<a class="btn btn--ghost" href="<?php echo esc_url( mursi_page_url( 'portfolio' ) ); ?>"><?php esc_html_e( 'See Our Work', 'mursi-digital' ); ?></a>
			</div>
		<?php endif; ?>
	</div>
</section>
