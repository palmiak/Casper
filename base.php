<?php
	use Roots\Sage\Wrapper;
?>

<!doctype html>
<html <?php language_attributes(); ?>>
	<?php get_template_part( 'templates/head' ); ?>
	<body <?php body_class( 'nav-closed' ); ?>>
		<?php
		get_template_part( 'templates/includes', 'navigation' );
		?>
		<div class="site-wrapper">
		<?php
		do_action( 'get_header' );

		include Wrapper\template_path();

		do_action( 'get_footer' );
		get_template_part( 'templates/footer' );
		wp_footer();
		?>
		</div>
	</body>
</html>
