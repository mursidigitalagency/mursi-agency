<?php
/**
 * FAQ accordion (also registers FAQPage schema).
 *
 * Args: faqs (array of q/a), title, alt (bool, grey background).
 *
 * @package Mursi_Digital
 */

$args = wp_parse_args(
	$args,
	array(
		'faqs'  => array(),
		'title' => __( 'Frequently asked questions', 'mursi-digital' ),
		'alt'   => true,
	)
);

if ( ! $args['faqs'] ) {
	return;
}
mursi_faq_registry( $args['faqs'] );
$mursi_faq_id = wp_unique_id( 'faq-' );
?>
<section class="section<?php echo $args['alt'] ? ' section--alt' : ''; ?>">
	<div class="container">
		<div class="section-head reveal">
			<span class="eyebrow"><?php esc_html_e( 'FAQ', 'mursi-digital' ); ?></span>
			<h2><?php echo esc_html( $args['title'] ); ?></h2>
		</div>
		<div class="faq">
			<?php foreach ( $args['faqs'] as $i => $faq ) : ?>
				<div class="faq-item reveal">
					<button class="faq-q" type="button" aria-expanded="false" aria-controls="<?php echo esc_attr( $mursi_faq_id . '-' . $i ); ?>">
						<span><?php echo esc_html( $faq['q'] ); ?></span>
						<span class="plus" aria-hidden="true">+</span>
					</button>
					<div class="faq-a" id="<?php echo esc_attr( $mursi_faq_id . '-' . $i ); ?>" role="region">
						<div><p><?php echo esc_html( $faq['a'] ); ?></p></div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
