<?php
/**
 * Process steps.
 *
 * @package Mursi_Digital
 */

?>
<section class="section">
	<div class="container">
		<div class="section-head reveal">
			<span class="eyebrow"><?php esc_html_e( 'How We Work', 'mursi-digital' ); ?></span>
			<h2><?php esc_html_e( 'A simple, transparent process', 'mursi-digital' ); ?></h2>
			<p><?php esc_html_e( 'You always know what is happening, what comes next and when it will be done.', 'mursi-digital' ); ?></p>
		</div>
		<div class="grid grid-4 steps">
			<?php foreach ( mursi_process() as $step ) : ?>
				<div class="step reveal">
					<h3><?php echo esc_html( $step['title'] ); ?></h3>
					<p><?php echo esc_html( $step['text'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
