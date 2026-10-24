<?php
/**
 * Template Name: Pricing Page
 *
 * @package Mursi_Digital
 */

get_header();

mursi_part(
	'page-hero',
	array(
		'eyebrow' => __( 'Pricing', 'mursi-digital' ),
		'title'   => __( 'Simple, transparent pricing', 'mursi-digital' ),
		'text'    => __( 'Choose a package that fits your stage. No hidden fees — and every plan starts with a free strategy call.', 'mursi-digital' ),
		'buttons' => false,
	)
);
?>

<section class="section">
	<div class="container">
		<?php mursi_part( 'pricing-table' ); ?>

		<?php
		while ( have_posts() ) {
			the_post();
			if ( get_the_content() ) {
				echo '<div class="entry-content mt-lg">';
				the_content();
				echo '</div>';
			}
		}
		?>
	</div>
</section>

<?php
mursi_part(
	'faq',
	array(
		'faqs' => array(
			array( 'q' => __( 'Do you require an upfront payment?', 'mursi-digital' ), 'a' => __( 'For one-time projects we take 50% upfront and 50% on completion. Monthly plans are billed at the start of each month.', 'mursi-digital' ) ),
			array( 'q' => __( 'Can I cancel a monthly plan?', 'mursi-digital' ), 'a' => __( 'Yes, monthly plans have no long-term contract. Just give us 30 days notice.', 'mursi-digital' ) ),
			array( 'q' => __( 'Which payment methods do you accept?', 'mursi-digital' ), 'a' => __( 'Bank transfer, JazzCash / Easypaisa (Pakistan), Payoneer, Wise and PayPal for international clients.', 'mursi-digital' ) ),
			array( 'q' => __( 'Do you offer discounts for combining services?', 'mursi-digital' ), 'a' => __( 'Yes — bundle a website with Local SEO or automation and get a special package price. Ask us on the free call.', 'mursi-digital' ) ),
		),
	)
);
mursi_part( 'cta' );

get_footer();
