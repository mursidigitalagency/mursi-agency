<?php
/**
 * Portfolio custom post type and taxonomy.
 *
 * @package Mursi_Digital
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register "project" post type and "project_type" taxonomy.
 */
function mursi_register_post_types() {
	register_post_type(
		'project',
		array(
			'labels'       => array(
				'name'          => __( 'Portfolio', 'mursi-digital' ),
				'singular_name' => __( 'Project', 'mursi-digital' ),
				'add_new_item'  => __( 'Add New Project', 'mursi-digital' ),
				'edit_item'     => __( 'Edit Project', 'mursi-digital' ),
				'all_items'     => __( 'All Projects', 'mursi-digital' ),
			),
			'public'       => true,
			'has_archive'  => false,
			'menu_icon'    => 'dashicons-portfolio',
			'rewrite'      => array( 'slug' => 'work' ),
			'supports'     => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
			'show_in_rest' => true,
		)
	);

	register_taxonomy(
		'project_type',
		'project',
		array(
			'labels'            => array(
				'name'          => __( 'Project Types', 'mursi-digital' ),
				'singular_name' => __( 'Project Type', 'mursi-digital' ),
			),
			'hierarchical'      => true,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'rewrite'           => array( 'slug' => 'work-type' ),
		)
	);
}
add_action( 'init', 'mursi_register_post_types' );

/**
 * Create default project types and flush rewrite rules on theme activation.
 */
function mursi_after_switch_theme() {
	mursi_register_post_types();
	foreach ( mursi_services() as $slug => $service ) {
		if ( ! term_exists( $slug, 'project_type' ) ) {
			wp_insert_term( $service['title'], 'project_type', array( 'slug' => $slug ) );
		}
	}
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'mursi_after_switch_theme' );

/**
 * "Project URL" and "Client" meta box.
 */
function mursi_project_meta_box() {
	add_meta_box( 'mursi_project_details', __( 'Project Details', 'mursi-digital' ), 'mursi_project_meta_box_html', 'project', 'side' );
}
add_action( 'add_meta_boxes', 'mursi_project_meta_box' );

/**
 * Render project meta box.
 *
 * @param WP_Post $post Current post.
 */
function mursi_project_meta_box_html( $post ) {
	wp_nonce_field( 'mursi_project_meta', 'mursi_project_nonce' );
	$client = get_post_meta( $post->ID, '_mursi_client', true );
	$url    = get_post_meta( $post->ID, '_mursi_url', true );
	?>
	<p>
		<label for="mursi_client"><strong><?php esc_html_e( 'Client', 'mursi-digital' ); ?></strong></label><br>
		<input type="text" id="mursi_client" name="mursi_client" value="<?php echo esc_attr( $client ); ?>" class="widefat">
	</p>
	<p>
		<label for="mursi_url"><strong><?php esc_html_e( 'Live URL', 'mursi-digital' ); ?></strong></label><br>
		<input type="url" id="mursi_url" name="mursi_url" value="<?php echo esc_attr( $url ); ?>" class="widefat">
	</p>
	<?php
}

/**
 * Save project meta.
 *
 * @param int $post_id Post ID.
 */
function mursi_save_project_meta( $post_id ) {
	if ( ! isset( $_POST['mursi_project_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['mursi_project_nonce'] ), 'mursi_project_meta' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	if ( isset( $_POST['mursi_client'] ) ) {
		update_post_meta( $post_id, '_mursi_client', sanitize_text_field( wp_unslash( $_POST['mursi_client'] ) ) );
	}
	if ( isset( $_POST['mursi_url'] ) ) {
		update_post_meta( $post_id, '_mursi_url', esc_url_raw( wp_unslash( $_POST['mursi_url'] ) ) );
	}
}
add_action( 'save_post_project', 'mursi_save_project_meta' );
