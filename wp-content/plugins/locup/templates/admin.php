<?php
	// Admin Template.
 ?>

 <div class="wrap">
	 <h1>Locup Search</h1>

	 <form method="post" action="options.php">

		 <?php
			 settings_fields( 'locup-search' );
			 do_settings_sections( 'locup-search' );
			 submit_button();
		 ?>

	 </form>

 </div>
