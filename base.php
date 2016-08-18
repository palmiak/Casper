<?php
	use Roots\Sage\Wrapper;
?>

<!doctype html>
<html <?php language_attributes(); ?>>
  <?php get_template_part('templates/head'); ?>
  <body <?php body_class(); ?>>

	<div id="fb-root"></div>
	<script>
		(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/pl_PL/sdk.js#xfbml=1&version=v2.7&appId=354696121251703";
		fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	</script>

    <section id="preloader">
      <div id="inner"></div>
  	</section>

	<?php get_template_part('templates/newsletter', 'popup'); ?>

	<?php
		do_action('get_header');
		get_template_part('templates/header');
	?>

    <?php include Wrapper\template_path(); ?>

	<script>
		var site_address = "<?php bloginfo( 'url' );?>";
		var template_url = "<?php bloginfo( 'template_url' );?>";
	</script>

    <?php
		do_action('get_footer');
		get_template_part('templates/footer');
		wp_footer();
    ?>

  </body>
</html>
