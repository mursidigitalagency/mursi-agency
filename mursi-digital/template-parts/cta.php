<?php
/**
 * Call-to-action band.
 *
 * Args: title, text.
 *
 * @package Mursi_Digital
 */

$args = wp_parse_args(
	$args,
	array(
		'title' => __( 'Ready to grow your business?', 'mursi-digital' ),
		'text'  => __( 'Book a free 30-minute strategy call. We will review your website, Google presence and workflows — and show you exactly where the quick wins are.', 'mursi-digital' ),
	)
);
$mursi_wa = mursi_whatsapp_url();
?>
<section class="section section--tight">
	<div class="container">
		<div class="cta-band reveal">
			<div>
				<h2><?php echo esc_html( $args['title'] ); ?></h2>
				<p><?php echo esc_html( $args['text'] ); ?></p>
			</div>
			<div class="btn-row">
				<a class="btn btn--white" href="<?php echo esc_url( mursi_booking_url() ); ?>"><?php esc_html_e( 'Book a Free Call', 'mursi-digital' ); ?></a>
				<?php if ( $mursi_wa ) : ?>
					<a class="btn btn--ghost" href="<?php echo esc_url( $mursi_wa ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'WhatsApp Us', 'mursi-digital' ); ?></a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
