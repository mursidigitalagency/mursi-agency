<?php
/**
 * Home page.
 *
 * @package Mursi_Digital
 */

get_header();
?>

<section class="hero">
	<div class="container hero-grid">
		<div class="reveal">
			<span class="eyebrow"><?php esc_html_e( 'AI Automation · Web Design · Local SEO', 'mursi-digital' ); ?></span>
			<h1>
				<?php esc_html_e( 'Websites, automation & SEO that', 'mursi-digital' ); ?>
				<span class="accent"><?php esc_html_e( 'grow your business', 'mursi-digital' ); ?></span>
			</h1>
			<p class="hero-lead"><?php esc_html_e( 'Mursi Digital Solutions builds high-converting WordPress websites, AI automations that save hours every week, and Local SEO that puts you on the map — literally.', 'mursi-digital' ); ?></p>
			<div class="btn-row">
				<a class="btn btn--primary" href="<?php echo esc_url( mursi_booking_url() ); ?>"><?php esc_html_e( 'Book a Free Call', 'mursi-digital' ); ?> <?php mursi_the_icon( 'arrow' ); ?></a>
				<a class="btn btn--ghost" href="<?php echo esc_url( mursi_page_url( 'portfolio' ) ); ?>"><?php esc_html_e( 'View Our Work', 'mursi-digital' ); ?></a>
			</div>
			<div class="hero-trust">
				<span><?php mursi_the_icon( 'check' ); ?> <?php esc_html_e( 'Free strategy call', 'mursi-digital' ); ?></span>
				<span><?php mursi_the_icon( 'check' ); ?> <?php esc_html_e( 'Fast delivery', 'mursi-digital' ); ?></span>
				<span><?php mursi_the_icon( 'check' ); ?> <?php esc_html_e( 'Ongoing support', 'mursi-digital' ); ?></span>
			</div>
		</div>

		<div class="hero-card reveal" aria-hidden="true">
			<h3><?php esc_html_e( 'What we help you achieve', 'mursi-digital' ); ?></h3>
			<?php foreach ( mursi_services() as $service ) : ?>
				<div class="hero-stat">
					<div class="icon-wrap"><?php mursi_the_icon( $service['icon'] ); ?></div>
					<div>
						<strong><?php echo esc_html( $service['title'] ); ?></strong>
						<small><?php echo esc_html( $service['bullets'][0] ); ?></small>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<?php
mursi_part( 'services-grid' );
mursi_part( 'why-us' );
mursi_part( 'process' );
mursi_part( 'portfolio-preview' );
mursi_part( 'testimonials' );
mursi_part( 'faq', array( 'faqs' => mursi_home_faqs() ) );
mursi_part( 'cta' );

get_footer();
