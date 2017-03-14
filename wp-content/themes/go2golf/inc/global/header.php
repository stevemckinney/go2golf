<body <?php body_class(); ?>>

	<header role="banner" class="c-masthead">
		<div class="o-wrapper">
			<h1>
				<?php if (is_front_page()) { ?>
					<img src="<?php echo bloginfo('template_directory'); ?>/_source/images/icons/logo-white.svg" alt="Go 2 Golf">
				<?php } else { ?>
					<a href="<?php bloginfo('url'); ?>">
						<img src="<?php echo bloginfo('template_directory'); ?>/_source/images/icons/logo-white.svg" alt="Go 2 Golf">
					</a>
				<?php } ?>
			</h1>
		</div><!--/.o-wrapper -->
	</header>