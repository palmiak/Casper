<?php
$fb = get_field( 'fb', 'options' );
$gplus = get_field( 'g+', 'options' );
$instagram = get_field( 'instagram', 'options' );
$pinterest = get_field( 'pinterest', 'options' );
?>

<footer id="footer" class="section">
	<div class="photobg" style="background-image: url(<?php bloginfo( 'template_url' ); ?>/dist/images/photo1.jpg);">
		<div class="photobg-inner">
			<div class="row">
				<div class="large-12 medium-12 small-12 columns text-center">
					<p>
						<a href="<?php bloginfo( 'url' ); ?>"><img src="<?php bloginfo( 'template_url' ); ?>/dist/images/logo2.png" alt="" /></a>
					</p>
					<?php
					$args = [
						'theme_location' => 'main_menu_4',
						'container_class' => '',
						'menu_class' => '',
						'container' => '',
					];
					wp_nav_menu( $args );
					?>

				</div>
				<div class="large-6 medium-12 small-12 columns text-center large-text-left">
					<p>
						<a data-open="newsletter-popup" class="newsletter-link"><img src="<?php bloginfo( 'template_url' ); ?>/dist/images/nsl.png" alt="" /> Bądź na bieżąco! Zapisz się na Newsletter<i class="fa fa-angle-right" aria-hidden="true"></i></a>
					</p>
				</div>

				<div class="large-6 medium-12 small-12 columns text-center large-text-right">
					<p>
					<?php if ( '' != $fb ) : ?>
						<a href="<?php echo $fb; ?>" class="socials"><i class="fa fa-facebook" aria-hidden="true"></i></a>
					<?php endif; ?>
					<?php if ( '' != $gplus ) : ?>
						<a href="<?php echo $gplus;?>" class="socials"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
					<?php endif; ?>
					<?php if ( '' != $instagram ) : ?>
						<a href="<?php echo $instagram; ?>" class="socials"><i class="fa fa-instagram" aria-hidden="true"></i></a>
					<?php endif; ?>
					<?php if ( '' != $pinterest ) : ?>
						<a href="<?php echo $pinterest; ?>" class="socials"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a>
					<?php endif; ?>
					</p>
				</div>
			</div>
		</div>
	</div>
</footer>
<section id="footer-bottom">
	<a href="#mainnav" class="gotop"><i class="fa fa-angle-up" aria-hidden="true"></i></a>
	<div class="row">
		<div class="large-6 medium-6 small-12 columns text-center medium-text-left">
			<p>
				&copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?>. All rights reserved
			</p>
		</div>
		<div class="large-6 medium-6 small-12 columns text-center medium-text-right">
			<p>
				Projekt i wykonanie: <a href="http://insanelab.pl/" target="_blank"><img src="<?php bloginfo( 'template_url' ); ?>/dist/images/insanelab.png" alt="In’saneLab – agencja interaktywna" /></a>
			</p>
		</div>
	</div>
</section>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDLYEv-wYd_FYo5KaehPLhyC4DeJcpKi58"></script>
