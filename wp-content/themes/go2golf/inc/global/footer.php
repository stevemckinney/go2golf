<footer role="contentinfo" class="c-footer">	
	<div class="o-wrapper">
		<p class="c-footer__copy">Copyright &copy; Go&Golf <?php echo date("Y"); ?></p>
		<?php
  		$defaults = array( 'theme_location' => 'footer-menu', 'echo' => false );
      $menu = strip_tags(wp_nav_menu($defaults), '<a>');
      
      echo '<div class="footer-links">' . $menu . '</ul>';
		?>
	</div><!--/.o-wrapper -->
</footer>

<!--[if (gte IE 6)&(lte IE 8)]>
<script src="//cdnjs.cloudflare.com/ajax/libs/selectivizr/1.0.2/selectivizr-min.js"></script>
<![endif]-->

<?php wp_footer(); ?>

</body>
</html>