<?php
/**
 * Testimonials.
 *
 * @package Mursi_Digital
 */

?>
<section class="section">
	<div class="container">
		<div class="section-head reveal">
			<span class="eyebrow"><?php esc_html_e( 'Testimonials', 'mursi-digital' ); ?></span>
			<h2><?php esc_html_e( 'What our clients say', 'mursi-digital' ); ?></h2>
		</div>
		<div class="grid grid-3">
			<?php foreach ( mursi_testimonials() as $item ) : ?>
				<figure class="testimonial reveal" style="margin:0">
					<div class="stars" aria-label="<?php esc_attr_e( '5 out of 5 stars', 'mursi-digital' ); ?>">★★★★★</div>
					<blockquote>“<?php echo esc_html( $item['text'] ); ?>”</blockquote>
					<figcaption class="testimonial-author">
						<span class="avatar" aria-hidden="true"><?php echo esc_html( mb_substr( $item['name'], 0, 1 ) ); ?></span>
						<span>
							<strong><?php echo esc_html( $item['name'] ); ?></strong>
							<small><?php echo esc_html( $item['role'] ); ?></small>
						</span>
					</figcaption>
				</figure>
			<?php endforeach; ?>
		</div>
	</div>
</section>
