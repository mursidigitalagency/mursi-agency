<?php
/**
 * Template Name: Portfolio Page
 *
 * @package Mursi_Digital
 */

get_header();

mursi_part(
	'page-hero',
	array(
		'eyebrow' => __( 'Portfolio', 'mursi-digital' ),
		'title'   => __( 'Our recent work', 'mursi-digital' ),
		'text'    => __( 'Websites, automations and Local SEO campaigns that delivered real results for our clients.', 'mursi-digital' ),
		'buttons' => false,
	)
);

$mursi_projects = new WP_Query(
	array(
		'post_type'      => 'project',
		'posts_per_page' => 60,
		'no_found_rows'  => true,
	)
);
$mursi_types    = get_terms(
	array(
		'taxonomy'   => 'project_type',
		'hide_empty' => true,
	)
);
?>

<section class="section">
	<div class="container">
		<?php if ( $mursi_projects->have_posts() ) : ?>
			<?php if ( $mursi_types && ! is_wp_error( $mursi_types ) && count( $mursi_types ) > 1 ) : ?>
				<div class="filter-bar" data-filter>
					<button class="filter-btn is-active" type="button" data-filter-value="*"><?php esc_html_e( 'All', 'mursi-digital' ); ?></button>
					<?php foreach ( $mursi_types as $mursi_type ) : ?>
						<button class="filter-btn" type="button" data-filter-value="<?php echo esc_attr( $mursi_type->slug ); ?>"><?php echo esc_html( $mursi_type->name ); ?></button>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

			<div class="grid grid-3" data-filter-grid>
				<?php
				while ( $mursi_projects->have_posts() ) {
					$mursi_projects->the_post();
					get_template_part( 'template-parts/project-card' );
				}
				wp_reset_postdata();
				?>
			</div>
		<?php else : ?>
			<div class="empty-state">
				<p><?php esc_html_e( 'Projects coming soon. Add them from Dashboard → Portfolio → Add New Project.', 'mursi-digital' ); ?></p>
			</div>
		<?php endif; ?>

		<?php
		while ( have_posts() ) {
			the_post();
			if ( get_the_content() ) {
				echo '<div class="entry-content mt-lg">';
				the_content();
				echo '</div>';
			}
		}
		?>
	</div>
</section>

<?php
mursi_part( 'testimonials' );
mursi_part( 'cta' );

get_footer();
