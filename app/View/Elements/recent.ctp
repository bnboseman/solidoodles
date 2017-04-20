<div class="featured-models">
	<div class="recent-header">recently added</div>
	<div class="row">

		<div class="featured-row">
		<?php foreach( $recent as $feature): ?>
			<div class="featured-model col-sm-5ths">
					<div class="featured-container">
						<div class="featured-image">
							<?php echo $this->Doodle->picture( $feature['DefaultPicture'], array(
									'url' => array('controller'=>'models', 'action'=>'view', $feature['Doodle']['id']),
									'alt' => $feature['Doodle']['name'],
									'title' => Inflector::humanize($feature['Doodle']['name']) ) ); ?>
						</div>
						<div class="download">
						<a href="<?php echo $feature['Doodle']['link'];?>">
						<?php echo $this->Html->image('icons/download-btn.png');?>
							</a>
						</div>
						<div class="counters">
							<div class="likes">
								<div class="icon"><?php echo $this->Html->image('icons/likes.png'); ?></div>
								<div class="count"><?php echo count($feature['Likes'])?></div>
							</div>
							<div class="comments">
								<div class="icon"><?php echo $this->Html->image( 'icons/comments.png'); ?></div>
								<div class="count"><?php echo count($feature['Comments'])?></div>						
							</div>
							<div class="downloads">
								<div class="icon"><?php echo $this->Html->image('icons/downloads.png'); ?></div>
								<div class="count"><?php echo $feature['Doodle']['downloads']; ?></div>						
							</div>
						</div>
					</div>
				</div>
		<?php  endforeach; ?>
		</div>
	</div>
	<div class="see-all">
		<a href="models/newest"><?php echo $this->Html->tag('span', 'see all');
			  echo $this->Html->image('/img/icons/green-right-arrow.png'); ?></a>
	</div>
</div>
