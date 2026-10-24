<?php
/**
 * Default page template (works with Gutenberg and Elementor).
 *
 * @package Mursi_Digital
 */

get_header();

while ( have_posts() ) :
	the_post();
	mursi_part( 'page-hero', array( 'buttons' => false ) );
	?>
	<section class="section" style="padding-top:24px">
		<div class="container">
			<div class="entry-content">
				<?php
				the_content();
				wp_link_pages();
				?>
			</div>
		</div>
	</section>
	<?php
endwhile;

get_footer();
