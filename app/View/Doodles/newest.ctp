<h1>Newest Models</h1>
<div class="displayed-row row">
	<?php foreach( $models as $model ): 
	echo $this->element('doodle', array('model' => $this->Doodle->prepareDoodle( $model ) ) ); ?>
	<?php endforeach;  ?>
</div>
<?php echo $this->element('pages')?>