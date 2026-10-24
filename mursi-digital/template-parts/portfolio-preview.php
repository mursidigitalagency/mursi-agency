<?php
/**
 * Latest projects preview.
 *
 * Args: type (project_type slug to filter by), count.
 *
 * @package Mursi_Digital
 */

$args = wp_parse_args(
	$args,
	array(
		'type'  => '',
		'count' => 3,
	)
);

$mursi_query_args = array(
	'post_type'      => 'project',
	'posts_per_page' => (int) $args['count'],
	'no_found_rows'  => true,
);
if ( $args['type'] ) {
	$mursi_query_args['tax_query'] = array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
		array(
			'taxonomy' => 'project_type',
			'field'    => 'slug',
			'terms'    => $args['type'],
		),
	);
}
$mursi_projects = new WP_Query( $mursi_query_args );

if ( ! $mursi_projects->have_posts() ) {
	return;
}
?>
<section class="section section--alt">
	<div class="container">
		<div class="section-head reveal">
			<span class="eyebrow"><?php esc_html_e( 'Recent Work', 'mursi-digital' ); ?></span>
			<h2><?php esc_html_e( 'Projects we are proud of', 'mursi-digital' ); ?></h2>
		</div>
		<div class="grid grid-3">
			<?php
			while ( $mursi_projects->have_posts() ) {
				$mursi_projects->the_post();
				get_template_part( 'template-parts/project-card' );
			}
			wp_reset_postdata();
			?>
		</div>
		<p class="text-center mt-lg">
			<a class="btn btn--ghost" href="<?php echo esc_url( mursi_page_url( 'portfolio' ) ); ?>"><?php esc_html_e( 'View Full Portfolio', 'mursi-digital' ); ?> <?php mursi_the_icon( 'arrow' ); ?></a>
		</p>
	</div>
</section>
