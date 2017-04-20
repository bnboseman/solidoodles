<div class="displayed-model col-sm-5ths">
	<div class="displayed-container">
		<div class="displayed-image">
			<?php
			echo $this->Doodle->picture( $model['DefaultPicture'], array(
					'url' => array('controller'=>'models', 'action'=>'view', $model['id']),
						'alt' => $model['name'],
					'title' => Inflector::humanize($model['name'])  ) );?>
		</div>
		<?php echo $this->Doodle->download( $model['link']); ?>
		<div class="counters">
			<?php echo $this->Doodle->likes( count( $model['Likes'] ) ); ?>
			
			<?php echo $this->Doodle->comments( count($model['Comments']) ); ?>
			
			<?php echo $this->Doodle->downloads($model['downloads'] ); ?>
			
		</div>
	</div>
</div>
