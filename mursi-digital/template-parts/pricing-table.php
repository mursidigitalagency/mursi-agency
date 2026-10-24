<?php
/**
 * Pricing tables with tabs per service.
 *
 * Args: only (service slug to show a single table without tabs).
 *
 * @package Mursi_Digital
 */

$args = wp_parse_args( $args, array( 'only' => '' ) );

$mursi_pricing  = mursi_pricing();
$mursi_services = mursi_services();
if ( $args['only'] ) {
	$mursi_pricing = isset( $mursi_pricing[ $args['only'] ] ) ? array( $args['only'] => $mursi_pricing[ $args['only'] ] ) : array();
}
if ( ! $mursi_pricing ) {
	return;
}
$mursi_first = true;
?>
<div class="pricing" data-pricing>
	<?php if ( count( $mursi_pricing ) > 1 ) : ?>
		<div class="pricing-tabs" role="tablist">
			<?php foreach ( $mursi_pricing as $slug => $plans ) : ?>
				<button class="pricing-tab<?php echo $mursi_first ? ' is-active' : ''; ?>" type="button" role="tab" id="tab-<?php echo esc_attr( $slug ); ?>" aria-controls="panel-<?php echo esc_attr( $slug ); ?>" aria-selected="<?php echo $mursi_first ? 'true' : 'false'; ?>">
					<?php echo esc_html( $mursi_services[ $slug ]['title'] ); ?>
				</button>
				<?php $mursi_first = false; ?>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>

	<?php
	$mursi_first = true;
	foreach ( $mursi_pricing as $slug => $plans ) :
		?>
		<div class="pricing-panel grid grid-3" role="tabpanel" id="panel-<?php echo esc_attr( $slug ); ?>" aria-labelledby="tab-<?php echo esc_attr( $slug ); ?>"<?php echo $mursi_first ? '' : ' hidden'; ?>>
			<?php foreach ( $plans as $plan ) : ?>
				<div class="price-card<?php echo ! empty( $plan['featured'] ) ? ' is-featured' : ''; ?>">
					<?php if ( ! empty( $plan['featured'] ) ) : ?>
						<span class="price-badge"><?php esc_html_e( 'Most Popular', 'mursi-digital' ); ?></span>
					<?php endif; ?>
					<h3><?php echo esc_html( $plan['name'] ); ?></h3>
					<p class="price-desc"><?php echo esc_html( $plan['desc'] ); ?></p>
					<div class="price"><?php echo esc_html( $plan['price'] ); ?> <small><?php echo esc_html( $plan['period'] ); ?></small></div>
					<ul class="check-list">
						<?php foreach ( $plan['features'] as $feature ) : ?>
							<li><?php echo esc_html( $feature ); ?></li>
						<?php endforeach; ?>
					</ul>
					<a class="btn <?php echo ! empty( $plan['featured'] ) ? 'btn--primary' : 'btn--ghost'; ?> btn--block" href="<?php echo esc_url( add_query_arg( 'service', $slug, mursi_page_url( 'contact' ) ) ); ?>"><?php esc_html_e( 'Get Started', 'mursi-digital' ); ?></a>
				</div>
			<?php endforeach; ?>
		</div>
		<?php
		$mursi_first = false;
	endforeach;
	?>
	<p class="pricing-note"><?php esc_html_e( 'Need something custom? Every business is different — book a free call for a tailored quote.', 'mursi-digital' ); ?></p>
</div>
