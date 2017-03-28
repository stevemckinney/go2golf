<body <?php body_class(); ?>>

	<?php if (is_front_page()) { ?>
		<header role="banner" class="c-masthead c-masthead--overlaid">
			<div class="o-wrapper">
				<h1>
					<img src="<?php echo bloginfo('template_directory'); ?>/_source/images/icons/logo.svg" alt="Go 2 Golf">
				</h1>
			</div><!--/.o-wrapper -->
		</header>
	<?php } else { ?>
		<header role="banner" class="c-masthead">
			<div class="o-wrapper">
				<h1>
					<a href="<?php bloginfo('url'); ?>">
						<img src="<?php echo bloginfo('template_directory'); ?>/_source/images/icons/logo-white.svg" alt="Go 2 Golf">
					</a>
				</h1>
			</div><!--/.o-wrapper -->
		</header>
	<?php } ?>