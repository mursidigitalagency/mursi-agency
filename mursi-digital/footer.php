<?php
/**
 * Site footer.
 *
 * @package Mursi_Digital
 */

$mursi_socials = array( 'facebook', 'instagram', 'linkedin', 'x', 'youtube' );
$mursi_wa      = mursi_whatsapp_url();
?>
</main>

<footer class="site-footer">
	<div class="container">
		<div class="footer-grid">
			<div class="footer-brand">
				<?php mursi_brand(); ?>
				<p><?php esc_html_e( 'Mursi Digital Solutions helps businesses grow with AI Automation, high-converting WordPress websites and Local SEO.', 'mursi-digital' ); ?></p>
				<div class="socials">
					<?php
					foreach ( $mursi_socials as $network ) :
						$url = mursi_option( $network );
						if ( ! $url ) {
							continue;
						}
						?>
						<a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener" aria-label="<?php echo esc_attr( ucfirst( $network ) ); ?>"><?php mursi_the_icon( $network ); ?></a>
					<?php endforeach; ?>
				</div>
			</div>

			<div>
				<h4><?php esc_html_e( 'Services', 'mursi-digital' ); ?></h4>
				<ul>
					<?php foreach ( mursi_services() as $slug => $service ) : ?>
						<li><a href="<?php echo esc_url( mursi_page_url( $slug ) ); ?>"><?php echo esc_html( $service['title'] ); ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>

			<div>
				<h4><?php esc_html_e( 'Company', 'mursi-digital' ); ?></h4>
				<?php
				if ( has_nav_menu( 'footer' ) ) {
					wp_nav_menu(
						array(
							'theme_location' => 'footer',
							'container'      => false,
							'depth'          => 1,
						)
					);
				} else {
					?>
					<ul>
						<li><a href="<?php echo esc_url( mursi_page_url( 'about' ) ); ?>"><?php esc_html_e( 'About', 'mursi-digital' ); ?></a></li>
						<li><a href="<?php echo esc_url( mursi_page_url( 'portfolio' ) ); ?>"><?php esc_html_e( 'Portfolio', 'mursi-digital' ); ?></a></li>
						<li><a href="<?php echo esc_url( mursi_page_url( 'pricing' ) ); ?>"><?php esc_html_e( 'Pricing', 'mursi-digital' ); ?></a></li>
						<li><a href="<?php echo esc_url( mursi_page_url( 'contact' ) ); ?>"><?php esc_html_e( 'Contact', 'mursi-digital' ); ?></a></li>
					</ul>
				<?php } ?>
			</div>

			<div>
				<h4><?php esc_html_e( 'Get in touch', 'mursi-digital' ); ?></h4>
				<ul>
					<?php if ( mursi_option( 'email' ) ) : ?>
						<li><a href="mailto:<?php echo esc_attr( antispambot( mursi_option( 'email' ) ) ); ?>"><?php echo esc_html( antispambot( mursi_option( 'email' ) ) ); ?></a></li>
					<?php endif; ?>
					<?php if ( mursi_option( 'phone' ) ) : ?>
						<li><a href="tel:<?php echo esc_attr( preg_replace( '/[^\d+]/', '', mursi_option( 'phone' ) ) ); ?>"><?php echo esc_html( mursi_option( 'phone' ) ); ?></a></li>
					<?php endif; ?>
					<?php if ( mursi_option( 'address' ) ) : ?>
						<li><?php echo esc_html( mursi_option( 'address' ) ); ?></li>
					<?php endif; ?>
					<?php if ( mursi_option( 'hours' ) ) : ?>
						<li><?php echo esc_html( mursi_option( 'hours' ) ); ?></li>
					<?php endif; ?>
				</ul>
			</div>
		</div>

		<div class="footer-bottom">
			<span>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> Mursi Digital Solutions. <?php esc_html_e( 'All rights reserved.', 'mursi-digital' ); ?></span>
			<span><?php esc_html_e( 'AI Automation · Web Design & Development · Local SEO', 'mursi-digital' ); ?></span>
		</div>
	</div>
</footer>

<?php if ( $mursi_wa ) : ?>
	<a class="wa-float" href="<?php echo esc_url( $mursi_wa ); ?>" target="_blank" rel="noopener" aria-label="<?php esc_attr_e( 'Chat on WhatsApp', 'mursi-digital' ); ?>"><?php mursi_the_icon( 'whatsapp' ); ?></a>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>
