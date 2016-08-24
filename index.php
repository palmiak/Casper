<?php if ( '' == get_header_image() ) : ?>
<header class="main-header no-cover">
<?php else : ?>
<header class="main-header" style="background-image: url(<?php header_image(); ?>)">
<?php endif ;?>
    <nav class="main-nav overlay clearfix">
		<?php if ( '' != get_logo_url() ) : ?>
		<a class="blog-logo" href="<?php bloginfo( 'url' );?>"><img src="<?php echo get_logo_url(); ?>" alt="<?php bloginfo( 'title' );?>" /></a>
		<?php endif; ?>
        <a class="menu-button icon-menu" href="#"><span class="word">Menu</span></a>
    </nav>
    <div class="vertical">
        <div class="main-header-content inner">
            <h1 class="page-title"><a href="<?php bloginfo( 'url' );?>"><?php bloginfo( 'title' );?></a></h1>
            <h2 class="page-description"><?php bloginfo( 'description' );?></h2>
        </div>
    </div>
    <a class="scroll-down icon-arrow-left" href="#content" data-offset="-45"><span class="hidden"><?php _e( 'Scroll Down', 'sage' );?></span></a>
</header>

<main id="content" class="content" role="main">
	<?php
	while ( have_posts() ) {
		the_post();
		get_template_part( 'templates/post', 'entry' );
	}
	?>
	<?php the_posts_pagination(); ?>
</main>
