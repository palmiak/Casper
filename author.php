<?php if ( '' == get_header_image() ) : ?>
<header class="main-header author-head no-cover">
<?php else : ?>
<header class="main-header author-head" style="background-image: url(<?php header_image(); ?>)">
<?php endif ;?>
    <nav class="main-nav overlay clearfix">
		<?php if ( '' != get_logo_url() ) : ?>
		<a class="blog-logo" href="<?php bloginfo( 'url' );?>"><img src="<?php echo get_logo_url(); ?>" alt="<?php bloginfo( 'title' );?>" /></a>
		<?php endif; ?>
        <a class="menu-button icon-menu" href="#"><span class="word">Menu</span></a>
    </nav>
</header>
<section class="author-profile inner">
	<figure class="author-image">
		<div class="img" style="background-image: url(<?php echo get_avatar_url( get_the_author_meta( 'ID' ), 68 ); ?>)"><span class="hidden"><?php echo get_the_author_meta( 'display_name' );?></span></div>
	</figure>
	<h1 class="author-title"><?php echo get_the_author_meta( 'display_name' );?></h1>
	<?php if ( '' != get_the_author_meta( 'description' ) ) : ?>
		<?php echo wpautop( get_the_author_meta( 'description' ) ); ?>
	<?php endif; ?>
	<div class="author-meta">
		<?php if ( '' != get_the_author_meta( 'location' ) ) : ?>
			<span class="author-location icon-location"><?php echo get_the_author_meta( 'location' ); ?></span>
		<?php endif; ?>
		<?php if ( '' != get_the_author_meta( 'user_url' ) ) : ?>
			<span class="author-link icon-link"><a href="<?php echo get_the_author_meta( 'user_url' ); ?>"><?php echo get_the_author_meta( 'user_url' ); ?></a></span>
		<?php endif; ?>
		<span class="author-stats"><i class="icon-stats"></i> <?php _e( 'Posts:', 'sage' ); ?> <?php echo count_user_posts( get_query_var( 'author' ) ); ?></span>
	</div>
</section>

<main id="content" class="content" role="main">
<?php
while ( have_posts() ) {
	the_post();
	get_template_part( 'templates/post', 'entry' );
}
?>
<?php the_posts_pagination(); ?>
</main>
