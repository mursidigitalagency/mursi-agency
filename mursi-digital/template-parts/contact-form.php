<?php
/**
 * Contact form.
 *
 * @package Mursi_Digital
 */

// phpcs:disable WordPress.Security.NonceVerification.Recommended -- read-only display flags.
$mursi_status  = isset( $_GET['contact'] ) ? sanitize_key( $_GET['contact'] ) : '';
$mursi_service = isset( $_GET['service'] ) ? sanitize_key( $_GET['service'] ) : '';
// phpcs:enable

$mursi_messages = array(
	'sent'    => array( 'success', __( 'Thank you! Your message has been sent. We will get back to you within 24 hours.', 'mursi-digital' ) ),
	'invalid' => array( 'error', __( 'Please fill in your name, a valid email and your message.', 'mursi-digital' ) ),
	'error'   => array( 'error', __( 'Sorry, something went wrong. Please try again or contact us on WhatsApp.', 'mursi-digital' ) ),
);
?>
<div class="form-card" id="contact-form">
	<h2 style="font-size:1.6rem"><?php esc_html_e( 'Tell us about your project', 'mursi-digital' ); ?></h2>
	<p style="color:var(--muted)"><?php esc_html_e( 'Fill in the form and we will reply within 24 hours with next steps.', 'mursi-digital' ); ?></p>

	<?php if ( isset( $mursi_messages[ $mursi_status ] ) ) : ?>
		<div class="notice notice--<?php echo esc_attr( $mursi_messages[ $mursi_status ][0] ); ?>" role="status"><?php echo esc_html( $mursi_messages[ $mursi_status ][1] ); ?></div>
	<?php endif; ?>

	<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
		<input type="hidden" name="action" value="mursi_contact">
		<?php wp_nonce_field( 'mursi_contact', 'mursi_contact_nonce' ); ?>
		<div class="hp-field" aria-hidden="true">
			<label for="cf-website">Website</label>
			<input type="text" id="cf-website" name="website" tabindex="-1" autocomplete="off">
		</div>

		<div class="form-row">
			<div class="field">
				<label for="cf-name"><?php esc_html_e( 'Full name *', 'mursi-digital' ); ?></label>
				<input type="text" id="cf-name" name="name" required autocomplete="name">
			</div>
			<div class="field">
				<label for="cf-email"><?php esc_html_e( 'Email *', 'mursi-digital' ); ?></label>
				<input type="email" id="cf-email" name="email" required autocomplete="email">
			</div>
		</div>
		<div class="form-row">
			<div class="field">
				<label for="cf-phone"><?php esc_html_e( 'Phone / WhatsApp', 'mursi-digital' ); ?></label>
				<input type="tel" id="cf-phone" name="phone" autocomplete="tel">
			</div>
			<div class="field">
				<label for="cf-service"><?php esc_html_e( 'Service', 'mursi-digital' ); ?></label>
				<select id="cf-service" name="service">
					<?php foreach ( mursi_services() as $slug => $service ) : ?>
						<option value="<?php echo esc_attr( $service['title'] ); ?>" <?php selected( $mursi_service, $slug ); ?>><?php echo esc_html( $service['title'] ); ?></option>
					<?php endforeach; ?>
					<option value="<?php esc_attr_e( 'Not sure yet', 'mursi-digital' ); ?>"><?php esc_html_e( 'Not sure yet', 'mursi-digital' ); ?></option>
				</select>
			</div>
		</div>
		<div class="field">
			<label for="cf-budget"><?php esc_html_e( 'Budget', 'mursi-digital' ); ?></label>
			<select id="cf-budget" name="budget">
				<option><?php esc_html_e( 'Under $300', 'mursi-digital' ); ?></option>
				<option><?php esc_html_e( '$300 – $700', 'mursi-digital' ); ?></option>
				<option><?php esc_html_e( '$700 – $1,500', 'mursi-digital' ); ?></option>
				<option><?php esc_html_e( '$1,500+', 'mursi-digital' ); ?></option>
				<option><?php esc_html_e( 'Monthly retainer', 'mursi-digital' ); ?></option>
			</select>
		</div>
		<div class="field">
			<label for="cf-message"><?php esc_html_e( 'Project details *', 'mursi-digital' ); ?></label>
			<textarea id="cf-message" name="message" required placeholder="<?php esc_attr_e( 'Tell us about your business and what you want to achieve…', 'mursi-digital' ); ?>"></textarea>
		</div>
		<button class="btn btn--primary btn--block" type="submit"><?php esc_html_e( 'Send Message', 'mursi-digital' ); ?></button>
	</form>
</div>
