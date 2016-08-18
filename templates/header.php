<header id="mobilenav" class="hide-for-large">
	<div class="row expanded">
		<div class="medium-12 small-12 columns text-center">
			<a href="<?php bloginfo( 'url' ); ?>"><img src="<?php bloginfo( 'template_url' ); ?>/dist/images/logo.png" alt="" /></a>

			<div class="mobilemenu-btn-content hide-for-large"><div class="mobilemenu-btn">
				<span></span>
				<span></span>
				<span></span>
				<span></span>
			</div></div>
		</div>
	</div>
</header>

<nav id="mobilemenu">
	<div class="inner">
		<ul>
			<?php
				$args = [
					'theme_location' => 'main_menu_3',
					'container_class' => '',
					'menu_class' => '',
					'container' => '',
				];
				wp_nav_menu( $args );
				?>
		</ul>
		<ul>
			<li>
				<a href="" class="yellow"><strong>Polski</strong></a>
			</li>
			<li>
				<a href="" class="yellow"><strong>English</strong></a>
			</li>
		</ul>
	</div>
</nav>

<header id="mainnav" class="show-for-large">
	<div class="langs">
		<a href="" class="active">PL</a>
		<a href="">EN</a>
	</div>
	<div class="logo">
		<a href="<?php bloginfo( 'url' ); ?>"><img src="<?php bloginfo("template_url"); ?>/dist/images/logo_desktop.png" alt="" /></a>
	</div>
	<div class="row collapse">
		<div class="large-6 columns text-right">
			<div class="inner">
				<?php
				$args = [
					'theme_location' => 'main_menu_1',
					'container_class' => '',
					'menu_class' => '',
					'container' => '',
				];
				wp_nav_menu( $args );
				?>
			</div>
		</div>
		<div class="large-6 columns">
			<div class="inner">
				<?php
				$args = [
					'theme_location' => 'main_menu_2',
					'container_class' => '',
					'menu_class' => '',
					'container' => '',
				];
				wp_nav_menu( $args );
				?>
			</div>
		</div>
	</div>
</header>
