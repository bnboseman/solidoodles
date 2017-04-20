<div class="row header-row">
	<div class="col-md-12">
	    <h1>Profile</h1>
	</div>
</div>

<div class="profile">
	<div class="row">
		<div class="col-md-2">
			<?php echo $this->Html->image('default-user-image.png', array('alt' => $user['User']['username'] . ' Profile image',
					'height' => '150px',
					'width' => '150px'
			)); ?>
		</div>
		<div class="col-md-4">
			<h2><?php echo $user['User']['username']; ?></h2>
			<?php echo $this->Html->image('icons/my-profile_location-icon.png'); ?> <?php echo $user['User']['location']; ?><br />
			<?php echo $this->Html->image('icons/my-profile_email-icon.png'); ?> <?php echo $user['User']['email']; ?><br />
		</div>
		<div class="col-md-4">
			<div class="my-profile-uploads">
				<?php echo count($user['Doodle'] ); ?>
			</div>
			
			<div class="my-profile-likes">
				<?php echo count($user['Like'] ); ?>
			</div>
		</div>
		
	</div>
	
	<div class="row">
	<div class="col-md-12">
	    <h2>My Uploads</h2>
	    <?php 
	    	foreach( $user['Doodle'] as $doodle ) {
	    			echo $this->element('doodle', array('model' => $doodle ) );
	    	}
	    	?>
	</div>
	</div>
</div>
