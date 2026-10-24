<?php
/**
 * Template Name: Contact Page
 *
 * @package Mursi_Digital
 */

get_header();

mursi_part(
	'page-hero',
	array(
		'eyebrow' => __( 'Contact', 'mursi-digital' ),
		'title'   => __( 'Let\'s talk about your project', 'mursi-digital' ),
		'text'    => __( 'Tell us what you need and we will get back to you within 24 hours with ideas, a plan and a quote.', 'mursi-digital' ),
		'buttons' => false,
	)
);

$mursi_wa    = mursi_whatsapp_url();
$mursi_email = mursi_option( 'email' );
$mursi_phone = mursi_option( 'phone' );
$mursi_map   = mursi_option( 'map_embed' );
?>

<section class="section">
	<div class="container contact-grid">
		<?php get_template_part( 'template-parts/contact-form' ); ?>

		<aside class="contact-info">
			<?php if ( $mursi_wa ) : ?>
				<div class="contact-item">
					<div class="icon-wrap"><?php mursi_the_icon( 'whatsapp' ); ?></div>
					<div>
						<strong><?php esc_html_e( 'WhatsApp', 'mursi-digital' ); ?></strong>
						<a href="<?php echo esc_url( $mursi_wa ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'Chat with us now', 'mursi-digital' ); ?></a>
					</div>
				</div>
			<?php endif; ?>
			<?php if ( $mursi_email ) : ?>
				<div class="contact-item">
					<div class="icon-wrap"><?php mursi_the_icon( 'mail' ); ?></div>
					<div>
						<strong><?php esc_html_e( 'Email', 'mursi-digital' ); ?></strong>
						<a href="mailto:<?php echo esc_attr( antispambot( $mursi_email ) ); ?>"><?php echo esc_html( antispambot( $mursi_email ) ); ?></a>
					</div>
				</div>
			<?php endif; ?>
			<?php if ( $mursi_phone ) : ?>
				<div class="contact-item">
					<div class="icon-wrap"><?php mursi_the_icon( 'phone' ); ?></div>
					<div>
						<strong><?php esc_html_e( 'Phone', 'mursi-digital' ); ?></strong>
						<a href="tel:<?php echo esc_attr( preg_replace( '/[^\d+]/', '', $mursi_phone ) ); ?>"><?php echo esc_html( $mursi_phone ); ?></a>
					</div>
				</div>
			<?php endif; ?>
			<div class="contact-item">
				<div class="icon-wrap"><?php mursi_the_icon( 'clock' ); ?></div>
				<div>
					<strong><?php esc_html_e( 'Working hours', 'mursi-digital' ); ?></strong>
					<span><?php echo esc_html( mursi_option( 'hours' ) ); ?></span>
				</div>
			</div>
			<?php if ( mursi_option( 'address' ) ) : ?>
				<div class="contact-item">
					<div class="icon-wrap"><?php mursi_the_icon( 'pin' ); ?></div>
					<div>
						<strong><?php esc_html_e( 'Location', 'mursi-digital' ); ?></strong>
						<span><?php echo esc_html( mursi_option( 'address' ) ); ?></span>
					</div>
				</div>
			<?php endif; ?>
		</aside>
	</div>

	<?php if ( $mursi_map ) : ?>
		<div class="container mt-lg map-embed">
			<iframe src="<?php echo esc_url( $mursi_map ); ?>" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="<?php esc_attr_e( 'Our location on Google Maps', 'mursi-digital' ); ?>"></iframe>
		</div>
	<?php endif; ?>

	<?php
	while ( have_posts() ) {
		the_post();
		if ( get_the_content() ) {
			echo '<div class="container"><div class="entry-content mt-lg">';
			the_content();
			echo '</div></div>';
		}
	}
	?>
</section>

<?php
get_footer();
