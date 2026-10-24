<?php
/**
 * Single portfolio card (used inside a project loop).
 *
 * @package Mursi_Digital
 */

$mursi_terms = get_the_terms( get_the_ID(), 'project_type' );
$mursi_slugs = ( $mursi_terms && ! is_wp_error( $mursi_terms ) ) ? wp_list_pluck( $mursi_terms, 'slug' ) : array();
?>
<article class="project-card reveal" data-types="<?php echo esc_attr( implode( ' ', $mursi_slugs ) ); ?>">
	<a class="project-thumb" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
		<?php
		if ( has_post_thumbnail() ) {
			the_post_thumbnail( 'mursi-project', array( 'loading' => 'lazy' ) );
		} else {
			mursi_the_icon( 'image' );
		}
		?>
	</a>
	<div class="project-body">
		<?php if ( $mursi_terms && ! is_wp_error( $mursi_terms ) ) : ?>
			<span class="project-tag"><?php echo esc_html( $mursi_terms[0]->name ); ?></span>
		<?php endif; ?>
		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<p><?php echo esc_html( wp_strip_all_tags( get_the_excerpt() ) ); ?></p>
	</div>
</article>
