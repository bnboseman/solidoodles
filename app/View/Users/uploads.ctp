<h1>Models by <?php echo $user; ?></h1>
<div class="displayed-row row">
	<?php foreach( $models as $model ): 
	echo $this->element('doodle', array('model' => $this->Doodle->prepareDoodle( $model ) ) ); ?>
	<?php endforeach;  ?>
</div>
<?php echo $this->element('pages')?>