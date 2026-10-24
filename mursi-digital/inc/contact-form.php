<?php
/**
 * Contact form handler (admin-post.php).
 *
 * @package Mursi_Digital
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Handle contact form submission and redirect back with a status flag.
 */
function mursi_handle_contact_form() {
	$redirect = wp_get_referer() ? wp_get_referer() : home_url( '/' );
	$redirect = remove_query_arg( 'contact', $redirect );

	if ( ! isset( $_POST['mursi_contact_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['mursi_contact_nonce'] ), 'mursi_contact' ) ) {
		wp_safe_redirect( add_query_arg( 'contact', 'error', $redirect ) . '#contact-form' );
		exit;
	}

	// Honeypot: real users never fill this hidden field.
	if ( ! empty( $_POST['website'] ) ) {
		wp_safe_redirect( add_query_arg( 'contact', 'sent', $redirect ) . '#contact-form' );
		exit;
	}

	$name    = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
	$email   = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	$phone   = isset( $_POST['phone'] ) ? sanitize_text_field( wp_unslash( $_POST['phone'] ) ) : '';
	$service = isset( $_POST['service'] ) ? sanitize_text_field( wp_unslash( $_POST['service'] ) ) : '';
	$budget  = isset( $_POST['budget'] ) ? sanitize_text_field( wp_unslash( $_POST['budget'] ) ) : '';
	$message = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';

	if ( '' === $name || ! is_email( $email ) || '' === $message ) {
		wp_safe_redirect( add_query_arg( 'contact', 'invalid', $redirect ) . '#contact-form' );
		exit;
	}

	$to      = mursi_option( 'email' ) ? mursi_option( 'email' ) : get_option( 'admin_email' );
	/* translators: %s: sender name */
	$subject = sprintf( __( 'New enquiry from %s', 'mursi-digital' ), $name );
	$body    = implode(
		"\n",
		array(
			'Name: ' . $name,
			'Email: ' . $email,
			'Phone: ' . $phone,
			'Service: ' . $service,
			'Budget: ' . $budget,
			'',
			'Message:',
			$message,
			'',
			'— Sent from ' . home_url( '/' ),
		)
	);
	$headers = array( 'Reply-To: ' . $name . ' <' . $email . '>' );

	$sent = wp_mail( $to, $subject, $body, $headers );

	wp_safe_redirect( add_query_arg( 'contact', $sent ? 'sent' : 'error', $redirect ) . '#contact-form' );
	exit;
}
add_action( 'admin_post_mursi_contact', 'mursi_handle_contact_form' );
add_action( 'admin_post_nopriv_mursi_contact', 'mursi_handle_contact_form' );
