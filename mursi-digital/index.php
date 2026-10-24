<?php
/**
 * Fallback template: blog index and archives.
 *
 * @package Mursi_Digital
 */

get_header();

mursi_part(
	'page-hero',
	array(
		'eyebrow' => __( 'Blog', 'mursi-digital' ),
		'title'   => is_home() ? __( 'Insights & Guides', 'mursi-digital' ) : wp_strip_all_tags( get_the_archive_title() ),
		'text'    => __( 'Tips on AI automation, WordPress and Local SEO to help your business grow.', 'mursi-digital' ),
		'buttons' => false,
	)
);
?>

<section class="section">
	<div class="container">
		<?php if ( have_posts() ) : ?>
			<div class="grid grid-3 posts-grid">
				<?php
				while ( have_posts() ) :
					the_post();
					?>
					<article id="post-<?php the_ID(); ?>" <?php post_class( 'card' ); ?>>
						<?php if ( has_post_thumbnail() ) : ?>
							<a href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true" style="display:block;margin:-30px -30px 22px;overflow:hidden;border-radius:var(--radius-lg) var(--radius-lg) 0 0">
								<?php the_post_thumbnail( 'mursi-project' ); ?>
							</a>
						<?php endif; ?>
						<p class="post-meta" style="margin-bottom:8px"><?php echo esc_html( get_the_date() ); ?></p>
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<p><?php echo esc_html( wp_strip_all_tags( get_the_excerpt() ) ); ?></p>
						<a class="card-link" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read more', 'mursi-digital' ); ?> <?php mursi_the_icon( 'arrow' ); ?></a>
					</article>
				<?php endwhile; ?>
			</div>
			<div class="pagination">
				<?php echo wp_kses_post( paginate_links() ); ?>
			</div>
		<?php else : ?>
			<div class="empty-state"><p><?php esc_html_e( 'Nothing published yet.', 'mursi-digital' ); ?></p></div>
		<?php endif; ?>
	</div>
</section>

<?php
get_footer();
