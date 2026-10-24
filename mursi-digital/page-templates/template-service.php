<?php
/**
 * Template Name: Service Page
 *
 * Content comes from mursi_services() in inc/data.php, matched by the page slug
 * (ai-automation, web-design-development, local-seo). Any text added in the
 * editor is shown under the intro.
 *
 * @package Mursi_Digital
 */

get_header();

$mursi_slug    = get_post_field( 'post_name', get_queried_object_id() );
$mursi_service = mursi_get_service( $mursi_slug );

while ( have_posts() ) :
	the_post();

	if ( ! $mursi_service ) :
		mursi_part( 'page-hero', array( 'buttons' => false ) );
		?>
		<section class="section"><div class="container entry-content">
			<p><?php esc_html_e( 'This page uses the Service Page template but its slug does not match a service. Use one of: ai-automation, web-design-development, local-seo.', 'mursi-digital' ); ?></p>
			<?php the_content(); ?>
		</div></section>
		<?php
		continue;
	endif;

	mursi_part(
		'page-hero',
		array(
			'eyebrow' => $mursi_service['title'],
			'title'   => $mursi_service['headline'],
			'text'    => $mursi_service['intro'],
		)
	);
	?>

	<section class="section">
		<div class="container split">
			<div class="reveal">
				<span class="eyebrow"><?php esc_html_e( 'Sound familiar?', 'mursi-digital' ); ?></span>
				<h2><?php esc_html_e( 'Problems we solve', 'mursi-digital' ); ?></h2>
				<ul class="check-list">
					<?php foreach ( $mursi_service['problems'] as $problem ) : ?>
						<li><?php echo esc_html( $problem ); ?></li>
					<?php endforeach; ?>
				</ul>
				<?php if ( get_the_content() ) : ?>
					<div class="entry-content" style="margin:0"><?php the_content(); ?></div>
				<?php endif; ?>
			</div>
			<div class="panel reveal">
				<div class="icon-wrap"><?php mursi_the_icon( $mursi_service['icon'] ); ?></div>
				<h3><?php echo esc_html( $mursi_service['title'] ); ?></h3>
				<p><?php echo esc_html( $mursi_service['short'] ); ?></p>
				<ul class="check-list">
					<?php foreach ( $mursi_service['bullets'] as $bullet ) : ?>
						<li><?php echo esc_html( $bullet ); ?></li>
					<?php endforeach; ?>
				</ul>
				<a class="btn btn--primary" href="<?php echo esc_url( add_query_arg( 'service', $mursi_slug, mursi_page_url( 'contact' ) ) ); ?>"><?php esc_html_e( 'Get a Free Quote', 'mursi-digital' ); ?></a>
			</div>
		</div>
	</section>

	<section class="section section--alt">
		<div class="container">
			<div class="section-head reveal">
				<span class="eyebrow"><?php esc_html_e( 'What\'s Included', 'mursi-digital' ); ?></span>
				<h2>
					<?php
					/* translators: %s: service name */
					echo esc_html( sprintf( __( 'Our %s services', 'mursi-digital' ), $mursi_service['title'] ) );
					?>
				</h2>
			</div>
			<div class="grid grid-3">
				<?php foreach ( $mursi_service['included'] as $item ) : ?>
					<div class="card reveal">
						<div class="icon-wrap"><?php mursi_the_icon( $item['icon'] ); ?></div>
						<h3><?php echo esc_html( $item['title'] ); ?></h3>
						<p><?php echo esc_html( $item['text'] ); ?></p>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<?php
	mursi_part( 'process' );
	?>

	<section class="section section--alt">
		<div class="container">
			<div class="section-head reveal">
				<span class="eyebrow"><?php esc_html_e( 'Pricing', 'mursi-digital' ); ?></span>
				<h2><?php esc_html_e( 'Simple, transparent packages', 'mursi-digital' ); ?></h2>
			</div>
			<?php mursi_part( 'pricing-table', array( 'only' => $mursi_slug ) ); ?>
		</div>
	</section>

	<?php
	mursi_part( 'portfolio-preview', array( 'type' => $mursi_slug ) );
	mursi_part(
		'faq',
		array(
			'faqs' => $mursi_service['faqs'],
			'alt'  => false,
		)
	);
	mursi_part(
		'services-grid',
		array(
			'exclude' => $mursi_slug,
			'title'   => __( 'Other ways we can help', 'mursi-digital' ),
			'text'    => __( 'Our services work best together — combine them for bigger results.', 'mursi-digital' ),
		)
	);
	mursi_part( 'cta' );
endwhile;

get_footer();
