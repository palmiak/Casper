<article class="post">
    <header class="post-header">
        <h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h2>
    </header>
    <section class="post-excerpt">
        <p><?php the_excerpt(); ?></p>
    </section>
    <footer class="post-meta">
		<?php if ( '' != get_avatar_url( get_the_author_meta( 'ID' ), 24 ) ) : ?>
        	<img class="author-thumb" src="<?php echo get_avatar_url( get_the_author_meta( 'ID' ), 24 ); ?>" alt="<?php echo get_the_author_meta( 'display_name' ); ?>" nopin="nopin" />
		<?php endif ;?>
        <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php echo get_the_author_meta( 'display_name' ); ?></a>
		<?php the_tags( __( 'on: ', 'sage' ) ); ?>
        <time class="post-date" datetime="<?php the_time( 'd.m.Y' );?>"><?php the_time( 'd.m.Y' );?></time>
    </footer>
</article>
