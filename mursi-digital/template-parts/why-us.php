<?php
/**
 * Why choose us.
 *
 * @package Mursi_Digital
 */

?>
<section class="section section--alt">
	<div class="container split">
		<div class="reveal">
			<span class="eyebrow"><?php esc_html_e( 'Why Mursi Digital', 'mursi-digital' ); ?></span>
			<h2><?php esc_html_e( 'A partner who cares about your results, not just the deliverable', 'mursi-digital' ); ?></h2>
			<p><?php esc_html_e( 'We combine design, development, automation and SEO under one roof — so your website, marketing and operations work together instead of in silos.', 'mursi-digital' ); ?></p>
			<a class="btn btn--primary" href="<?php echo esc_url( mursi_page_url( 'about' ) ); ?>"><?php esc_html_e( 'About Us', 'mursi-digital' ); ?> <?php mursi_the_icon( 'arrow' ); ?></a>
		</div>
		<div class="grid" style="gap:28px">
			<?php foreach ( mursi_why_us() as $item ) : ?>
				<div class="feature reveal">
					<div class="icon-wrap"><?php mursi_the_icon( $item['icon'] ); ?></div>
					<div>
						<h3><?php echo esc_html( $item['title'] ); ?></h3>
						<p><?php echo esc_html( $item['text'] ); ?></p>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
