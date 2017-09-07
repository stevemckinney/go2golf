<body <?php body_class(); ?>>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PD92CDK"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

	<?php
		$nav_menu_args = array(
			'taxonomy' => 'product_cat',
			'title_li' => '',
			'depth' => 2
		);
	?>

	<?php if (is_front_page()) { ?>
		<header role="banner" class="c-masthead c-masthead--overlaid">
			<div class="o-wrapper">
				<div class="c-masthead__wrapper">
					<h1>
						<img src="<?php echo bloginfo('template_directory'); ?>/_source/images/icons/logo.svg" alt="Go 2 Golf">
					</h1>
					<nav class="c-primary-nav">
						<ul class="c-primary-nav__list">
							<?php wp_list_categories($nav_menu_args); ?>
						</ul>
					</nav>
				</div><!--/.c-masthead__wrapper -->
			</div><!--/.o-wrapper -->
		</header>
	<?php } else { ?>
		<header role="banner" class="c-masthead">
			<div class="o-wrapper">
				<div class="c-masthead__wrapper">
					<h1>
						<a href="<?php bloginfo('url'); ?>">
							<img src="<?php echo bloginfo('template_directory'); ?>/_source/images/icons/logo-white.svg" alt="Go 2 Golf">
						</a>
					</h1>
					<nav class="c-primary-nav">
						<ul class="c-primary-nav__list">
							<?php wp_list_categories($nav_menu_args); ?>
						</ul>
					</nav>
				</div><!--/.c-masthead__wrapper -->
			</div><!--/.o-wrapper -->
		</header>
	<?php } ?>