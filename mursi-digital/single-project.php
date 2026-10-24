<?php
/**
 * Single portfolio project.
 *
 * @package Mursi_Digital
 */

get_header();

while ( have_posts() ) :
	the_post();
	$mursi_terms  = get_the_terms( get_the_ID(), 'project_type' );
	$mursi_client = get_post_meta( get_the_ID(), '_mursi_client', true );
	$mursi_url    = get_post_meta( get_the_ID(), '_mursi_url', true );
	?>
	<section class="page-hero">
		<div class="container">
			<?php if ( $mursi_terms && ! is_wp_error( $mursi_terms ) ) : ?>
				<span class="eyebrow"><?php echo esc_html( $mursi_terms[0]->name ); ?></span>
			<?php endif; ?>
			<h1><?php the_title(); ?></h1>
			<?php if ( has_excerpt() ) : ?>
				<p><?php echo esc_html( get_the_excerpt() ); ?></p>
			<?php endif; ?>
			<div class="btn-row">
				<?php if ( $mursi_url ) : ?>
					<a class="btn btn--primary" href="<?php echo esc_url( $mursi_url ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'Visit Live Site', 'mursi-digital' ); ?> <?php mursi_the_icon( 'arrow' ); ?></a>
				<?php endif; ?>
				<a class="btn btn--ghost" href="<?php echo esc_url( mursi_page_url( 'portfolio' ) ); ?>"><?php esc_html_e( 'All Projects', 'mursi-digital' ); ?></a>
			</div>
		</div>
	</section>

	<section class="section" style="padding-top:24px">
		<div class="container">
			<?php if ( has_post_thumbnail() ) : ?>
				<div class="alignwide" style="margin-bottom:40px"><?php the_post_thumbnail( 'large', array( 'style' => 'border-radius:var(--radius-lg);width:100%;box-shadow:var(--shadow)' ) ); ?></div>
			<?php endif; ?>
			<?php if ( $mursi_client ) : ?>
				<p class="text-center post-meta"><strong><?php esc_html_e( 'Client:', 'mursi-digital' ); ?></strong> <?php echo esc_html( $mursi_client ); ?></p>
			<?php endif; ?>
			<div class="entry-content"><?php the_content(); ?></div>
		</div>
	</section>
	<?php
endwhile;

mursi_part(
	'cta',
	array(
		'title' => __( 'Want results like this?', 'mursi-digital' ),
		'text'  => __( 'Let\'s talk about your project — the first call is free.', 'mursi-digital' ),
	)
);
get_footer();
