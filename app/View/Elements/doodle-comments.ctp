<div class="comment-row">
	<div id="commentsection">
		<div id="comment" class="comment">
			<?php foreach ( $comments as $comment ) : ?>
				<div class="commentpic"><?php echo $this->Html->image( $comment['User']['picture'], array('height'=>'65px', 'width'=>'65px')); ?>
				</div>

			<div class="commentbody">
					<?php $this->Html->image('icons/left-comment-arrow.png'); ?>
						<div class="commentheader">
					<div class="commentusername">
								<?php $this->Html->image('icons/duder.png'); ?>
								<?php echo $this->Html->link( $comment['User']['username'], array('controller' => 'users', 'action' => 'profile', $comment['User']['username'] ));?><a></a>
					</div>
					<div class="commentdate">
								<?php $this->Html->image('icons/calendar-comments.png'); ?>
									<?php echo $comment['created']; ?>
							</div>
					<div class="commenttime">
								<?php $this->Html->image('icons/clock.png');?> <?php echo $this->Time->format($comment['created'], '%H:%M %p'); ?>
							</div>
				</div>
				<div class="commenttext">
							<?php echo $comment['comment']; ?>
						t</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>