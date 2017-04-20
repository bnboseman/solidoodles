<div class="row" ><h1>Category : <?php echo $name; ?></h1> </div>
<div class="displayed-row row">
	<?php foreach( $models as $model ):
		$doodle = $model['Doodle'];
		$doodle['Likes'] = $model['Likes'];
		$doodle['Comments'] = $model['Comments'];
		$doodle['DefaultPicture'] = $model['DefaultPicture'];
		echo $this->element('doodle', array('model' => $doodle)); ?>
	<?php endforeach;  ?>
</div>
<?php echo $this->element('pages')?>