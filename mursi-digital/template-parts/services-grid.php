<?php
/**
 * Services cards.
 *
 * Args: exclude (slug to skip), title, text.
 *
 * @package Mursi_Digital
 */

$args = wp_parse_args(
	$args,
	array(
		'exclude' => '',
		'title'   => __( 'Everything you need to grow online', 'mursi-digital' ),
		'text'    => __( 'Three focused services that work together: a website that converts, automation that saves time, and Local SEO that brings customers to you.', 'mursi-digital' ),
	)
);
?>
<section class="section" id="services">
	<div class="container">
		<div class="section-head reveal">
			<span class="eyebrow"><?php esc_html_e( 'Our Services', 'mursi-digital' ); ?></span>
			<h2><?php echo esc_html( $args['title'] ); ?></h2>
			<p><?php echo esc_html( $args['text'] ); ?></p>
		</div>
		<div class="grid grid-3">
			<?php
			foreach ( mursi_services() as $slug => $service ) :
				if ( $slug === $args['exclude'] ) {
					continue;
				}
				?>
				<article class="card reveal">
					<div class="icon-wrap"><?php mursi_the_icon( $service['icon'] ); ?></div>
					<h3><?php echo esc_html( $service['title'] ); ?></h3>
					<p><?php echo esc_html( $service['short'] ); ?></p>
					<ul>
						<?php foreach ( $service['bullets'] as $bullet ) : ?>
							<li><?php echo esc_html( $bullet ); ?></li>
						<?php endforeach; ?>
					</ul>
					<a class="card-link" href="<?php echo esc_url( mursi_page_url( $slug ) ); ?>"><?php esc_html_e( 'Learn more', 'mursi-digital' ); ?> <?php mursi_the_icon( 'arrow' ); ?></a>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
