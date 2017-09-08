<body <?php body_class(); ?>>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PD92CDK"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

	<?php
		$channel_islands_cat_id = get_term_by('slug', 'channel-islands', 'product_cat')->term_id;
		$isle_of_man_cat_id = get_term_by('slug', 'isle-of-man', 'product_cat')->term_id;
		$nav_menu_args = array(
			'taxonomy' => 'product_cat',
			'title_li' => '',
			'depth' => 2,
			'exclude' => array($channel_islands_cat_id, $isle_of_man_cat_id)
		);
	?>

	<?php if (is_front_page()) { ?>
		<header role="banner" class="c-masthead c-masthead--overlaid">
			<div class="o-wrapper">
				<div class="c-masthead__wrapper">
					<h1>
						<img src="<?php echo bloginfo('template_directory'); ?>/_source/images/icons/logo.svg" alt="Go 2 Golf">
					</h1>
					<span class="c-primary-nav__toggle c-primary-nav__toggle--dark" data-nav-toggle="inactive">
						<span></span>
						<span></span>
						<span></span>
					</span>
					<nav class="c-primary-nav c-primary-nav--dark">
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
					<span class="c-primary-nav__toggle" data-nav-toggle="inactive">
						<span></span>
						<span></span>
						<span></span>
					</span>
					<nav class="c-primary-nav">
						<ul class="c-primary-nav__list">
							<?php wp_list_categories($nav_menu_args); ?>
						</ul>
					</nav>
				</div><!--/.c-masthead__wrapper -->
			</div><!--/.o-wrapper -->
		</header>
	<?php } ?>