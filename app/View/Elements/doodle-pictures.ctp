<div class="image=row row">
<?php foreach( $pictures as $picture ): ?>
	<?php 
	$file = $picture['file_name'];						//Full fileman
	$filename = substr( $picture['file_name'], 0, -4);		// Filename minus extenstion
	?>
	<div class="col-md-2">
		<div class="picture-highlight-wrap primary-picture image-row">
			<div class="picture-wrap" picture="<?php echo $file; ?>" filename="<?php echo $filename; ?>" picture-id="<?php echo $filename; ?>">
				<?php echo $this->Html->image( "/files/" . $picture['Doodle']['id'] . "/" . $file ); ?>
		</div>
	</div>
	</div>
<?php endforeach; ?>
</div>