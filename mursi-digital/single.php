<?php
/**
 * Single blog post.
 *
 * @package Mursi_Digital
 */

get_header();

while ( have_posts() ) :
	the_post();
	?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<section class="page-hero">
			<div class="container">
				<p class="post-meta"><?php echo esc_html( get_the_date() ); ?> · <?php the_category( ', ' ); ?></p>
				<h1><?php the_title(); ?></h1>
			</div>
		</section>
		<section class="section" style="padding-top:24px">
			<div class="container">
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="alignwide" style="margin-bottom:40px"><?php the_post_thumbnail( 'large', array( 'style' => 'border-radius:var(--radius-lg);width:100%' ) ); ?></div>
				<?php endif; ?>
				<div class="entry-content">
					<?php
					the_content();
					wp_link_pages();
					?>
				</div>
				<?php if ( comments_open() || get_comments_number() ) : ?>
					<div class="entry-content mt-lg"><?php comments_template(); ?></div>
				<?php endif; ?>
			</div>
		</section>
	</article>
	<?php
endwhile;

mursi_part( 'cta' );
get_footer();
