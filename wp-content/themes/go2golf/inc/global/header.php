<body <?php body_class(); ?>>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PD92CDK"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

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