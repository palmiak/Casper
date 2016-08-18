<div class="nav">
    <h3 class="nav-title"><?php _e( 'Menu', 'sage' );?></h3>
    <a href="#" class="nav-close">
        <span class="hidden"><?php _e( 'Close', 'sage' );?></span>
    </a>
	<?php
	$args = [
		'theme_location' => 'primary_navigation',
		'container_class' => '',
		'menu_class' => '',
		'container' => '',
	];
	wp_nav_menu( $args );
	?>

	<a class="subscribe-button icon-feed" href="<?php bloginfo('rss2_url');?>"><?php _e( 'Subscribe', 'sage' );?></a>

</div>
<span class="nav-cover"></span>
