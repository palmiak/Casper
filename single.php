<?php
the_post();
if ( has_post_thumbnail() ) :
	$img = wp_get_attachment_image_src( get_post_thumbnail_id() , 'full' )[0];
?>
<header class="main-header" style="background-image: url(<?php echo $img; ?>)">
<?php elseif ( '' != get_header_image() ) : ?>
<header class="main-header" style="background-image: url(<?php header_image(); ?>)">
<?php else : ?>
<header class="main-header no-cover">
<?php endif ;?>

    <nav class="main-nav overlay clearfix">
		<?php if ( '' != get_theme_mod( 'custom_logo' ) ) : ?>
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

<main class="content" role="main" id="content">
    <article class="post post-template">

        <header class="post-header">
            <h1 class="post-title"><?php the_title(); ?></h1>
            <section class="post-meta">
                <time class="post-date" datetime="<?php the_time( 'd.m.Y' ); ?>"><?php the_time( 'd.m.Y' ); ?></time> <?php the_tags( __( 'on: ', 'sage' ) ); ?>
            </section>
        </header>

        <section class="post-content">
            <?php the_content(); ?>
			<?php wp_link_pages(); ?>

			<div id="comments">
				<?php comments_template(); ?>
			</div>
        </section>

        <footer class="post-footer">

            <figure class="author-image">
                <a class="img" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>" style="background-image: url(<?php echo get_avatar_url( get_the_author_meta( 'ID' ), 68 ); ?>)"><span class="hidden"><?php echo get_the_author_meta( 'display_name' );?></span></a>
            </figure>

            <section class="author">
                <h4><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php echo get_the_author_meta( 'display_name' );?></a></h4>

                <?php if ( '' != get_the_author_meta( 'description' ) ) : ?>
                	<?php echo wpautop( get_the_author_meta( 'description' ) ); ?>
                <?php else : ?>
                    <p><?php _e( 'Read more posts from', 'sage' ); ?> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php _e( 'this author' ); ?></a>.</p>
                <?php endif; ?>
                <div class="author-meta">
                    <?php if ( '' != get_the_author_meta( 'location' ) ) : ?>
						<span class="author-location icon-location"><?php echo get_the_author_meta( 'location' ); ?></span>
					<?php endif; ?>
					<?php if ( '' != get_the_author_meta( 'user_url' ) ) : ?>
                    	<span class="author-link icon-link"><a href="<?php echo get_the_author_meta( 'user_url' ); ?>"><?php echo get_the_author_meta( 'user_url' ); ?></a></span>
					<?php endif; ?>
                </div>
            </section>

            <section class="share">
                <h4>Share this post</h4>
                <a class="icon-twitter" href="https://twitter.com/intent/tweet?text=<?php echo urlencode( get_the_title() );?>&amp;url=<?php echo urlencode( get_site_url() ); ?>"
                    onclick="window.open(this.href, 'twitter-share', 'width=550,height=235');return false;">
                    <span class="hidden">Twitter</span>
                </a>
                <a class="icon-facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode( get_site_url() ); ?>"
                    onclick="window.open(this.href, 'facebook-share','width=580,height=296');return false;">
                    <span class="hidden">Facebook</span>
                </a>
                <a class="icon-google-plus" href="https://plus.google.com/share?url=<?php echo urlencode( get_site_url() ); ?>"
                   onclick="window.open(this.href, 'google-plus-share', 'width=490,height=530');return false;">
                    <span class="hidden">Google+</span>
                </a>
            </section>

            <section class="gh-subscribe">
                <h3 class="gh-subscribe-title"><?php _e( 'Subscribe to', 'sage' ); ?> <?php bloginfo( 'title' ); ?></h3>

                <span class="gh-subscribe-rss"><?php _e( 'Subscribe', 'sage' ); ?> <a href="http://cloud.feedly.com/#subscription/feed/<?php bloginfo( 'rss2_url' ) ?>"><?php _e( 'via RSS', 'sage' ); ?></a> <?php _e( 'with Feedly!', 'sage' );?></span>
            </section>

        </footer>

    </article>
</main>

<aside class="read-next">
<?php
	$next_post = get_next_post();
	$prev_post = get_previous_post();
?>
<?php
if ( $next_post ) :
	$img = wp_get_attachment_image_src( get_post_thumbnail_id( $next_post->ID ) , 'full' )[0];
?>
<?php if ( '' != $img ) : ?>
	<a class="read-next-story" style="background-image: url(<?php echo $img; ?>)" href="<?php echo get_the_permalink( $next_post->ID ); ?>">
<?php else : ?>
	<a class="read-next-story no-cover" href="<?php echo get_the_permalink( $next_post->ID ); ?>">
<?php endif ; ?>
		<section class="post">
			<h2><?php echo get_the_title( $next_post->ID ); ?></h2>
			<?php /*<p>{{excerpt words="19"}}&hellip;</p>*/?>
		</section>
	</a>
<?php endif; ?>
<?php
if ( $prev_post ) :
	$img = wp_get_attachment_image_src( get_post_thumbnail_id( $prev_post->ID ) , 'full' )[0];
?>
<?php if ( '' != $img ) : ?>
	<a class="read-next-story prev" style="background-image: url(<?php echo $img; ?>)" href="<?php echo get_the_permalink( $prev_post->ID ); ?>">
<?php else : ?>
	<a class="read-next-story prev no-cover" href="<?php echo get_the_permalink( $prev_post->ID ); ?>">
<?php endif ; ?>
		<section class="post">
			<h2><?php echo get_the_title( $prev_post->ID ); ?></h2>
			<?php /*<p>{{excerpt words="19"}}&hellip;</p>*/?>
		</section>
	</a>
<?php endif; ?>
</aside>
