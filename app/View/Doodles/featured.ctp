<h1>Featured Models</h1>
<div class="displayed-row">
	<?php foreach( $models as $model ): 
		echo $this->element('doodle',$this->Doodle->prepareDoodle( $model) ); 
	endforeach;?>
</div>