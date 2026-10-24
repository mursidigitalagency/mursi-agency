<?php
/**
 * Template Name: About Page
 *
 * @package Mursi_Digital
 */

get_header();

$mursi_tools = array( 'WordPress', 'Elementor', 'WooCommerce', 'Figma', 'n8n', 'Make', 'Zapier', 'OpenAI', 'Claude', 'WhatsApp API', 'Google Business Profile', 'Search Console', 'Google Analytics', 'Ahrefs', 'GoHighLevel', 'HubSpot' );

$mursi_values = array(
	array( 'icon' => 'heart', 'title' => __( 'Honesty', 'mursi-digital' ), 'text' => __( 'Clear pricing, realistic timelines and no fake promises.', 'mursi-digital' ) ),
	array( 'icon' => 'target', 'title' => __( 'Results', 'mursi-digital' ), 'text' => __( 'We measure success by your leads, sales and time saved.', 'mursi-digital' ) ),
	array( 'icon' => 'zap', 'title' => __( 'Speed', 'mursi-digital' ), 'text' => __( 'Fast communication and fast delivery, every time.', 'mursi-digital' ) ),
	array( 'icon' => 'users', 'title' => __( 'Partnership', 'mursi-digital' ), 'text' => __( 'We treat your business like our own and stay with you long-term.', 'mursi-digital' ) ),
);

while ( have_posts() ) :
	the_post();

	mursi_part(
		'page-hero',
		array(
			'eyebrow' => __( 'About Us', 'mursi-digital' ),
			'title'   => __( 'We help businesses work smarter and grow faster', 'mursi-digital' ),
			'text'    => __( 'Mursi Digital Solutions is a digital agency specialising in AI Automation, WordPress website design & development, and Local SEO.', 'mursi-digital' ),
			'buttons' => false,
		)
	);
	?>

	<section class="section">
		<div class="container split">
			<div class="reveal">
				<span class="eyebrow"><?php esc_html_e( 'Our Story', 'mursi-digital' ); ?></span>
				<h2><?php esc_html_e( 'Built to make modern technology simple for every business', 'mursi-digital' ); ?></h2>
				<?php if ( get_the_content() ) : ?>
					<div class="entry-content" style="margin:0"><?php the_content(); ?></div>
				<?php else : ?>
					<p><?php esc_html_e( 'Mursi Digital Solutions started with a simple idea: small and growing businesses deserve the same quality websites, automation and marketing that big brands have — without the big-agency price tag or complexity.', 'mursi-digital' ); ?></p>
					<p><?php esc_html_e( 'Today we design and build WordPress websites, set up AI-powered automations, and run Local SEO campaigns for clients who want real, measurable growth. Every project gets personal attention, clear communication and support long after launch.', 'mursi-digital' ); ?></p>
				<?php endif; ?>
			</div>
			<div class="panel reveal">
				<h3><?php esc_html_e( 'Our Mission', 'mursi-digital' ); ?></h3>
				<p><?php esc_html_e( 'To help businesses win more customers and save time by combining great design, smart automation and local visibility.', 'mursi-digital' ); ?></p>
				<h3><?php esc_html_e( 'Our Vision', 'mursi-digital' ); ?></h3>
				<p style="margin:0"><?php esc_html_e( 'To be the most trusted growth partner for local and small businesses — locally and around the world.', 'mursi-digital' ); ?></p>
			</div>
		</div>
	</section>

	<section class="section section--alt section--tight">
		<div class="container">
			<div class="stats reveal">
				<div><strong>50+</strong><span><?php esc_html_e( 'Projects delivered', 'mursi-digital' ); ?></span></div>
				<div><strong>30+</strong><span><?php esc_html_e( 'Happy clients', 'mursi-digital' ); ?></span></div>
				<div><strong>1,000+</strong><span><?php esc_html_e( 'Hours saved by automation', 'mursi-digital' ); ?></span></div>
				<div><strong>24h</strong><span><?php esc_html_e( 'Average response time', 'mursi-digital' ); ?></span></div>
			</div>
		</div>
	</section>

	<section class="section">
		<div class="container">
			<div class="section-head reveal">
				<span class="eyebrow"><?php esc_html_e( 'Our Values', 'mursi-digital' ); ?></span>
				<h2><?php esc_html_e( 'What we stand for', 'mursi-digital' ); ?></h2>
			</div>
			<div class="grid grid-4">
				<?php foreach ( $mursi_values as $value ) : ?>
					<div class="card reveal">
						<div class="icon-wrap"><?php mursi_the_icon( $value['icon'] ); ?></div>
						<h3><?php echo esc_html( $value['title'] ); ?></h3>
						<p style="margin:0"><?php echo esc_html( $value['text'] ); ?></p>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="section section--alt">
		<div class="container">
			<div class="section-head reveal">
				<span class="eyebrow"><?php esc_html_e( 'Tools & Platforms', 'mursi-digital' ); ?></span>
				<h2><?php esc_html_e( 'The stack we work with', 'mursi-digital' ); ?></h2>
			</div>
			<div class="chips reveal">
				<?php foreach ( $mursi_tools as $tool ) : ?>
					<span class="chip"><?php echo esc_html( $tool ); ?></span>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<?php
	mursi_part( 'process' );
	mursi_part( 'cta' );
endwhile;

get_footer();
