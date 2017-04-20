
<div class="col-md-12">
<?php echo $this->Form->create('Doodle', array('action' => 'search')); ?>
<?php echo $this->Form->input('Search', array('placeholder'=> 'Search', 'type' => 'text') ); ?>
<?php echo $this->Form->end('Search'); ?>

<?php if (isset( $results ) ) { ?>
<div class="search-row row">
	<?php foreach( $results as $model ): 
		echo $this->element('doodle', array('model' => $this->Doodle->prepareDoodle( $model))); ?>
	<?php endforeach;  ?>
</div>
<?php } ?>
</div>