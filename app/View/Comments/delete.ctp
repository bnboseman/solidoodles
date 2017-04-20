<?php 
debug_backtrace(); 
if ( !empty( $error ) ) { ?>
	<p class="error">
		<strong>Error: </strong><?php echo $error; ?>
	</p>
	
	<?php } elseif (!empty( $success ) ) { ?>
	<p class="success">
		<?php echo $success; ?>
	</p>
<?php } ?>