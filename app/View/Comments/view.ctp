<script>
$( document ).ready(function() {
	$(".delete_comment").click( function(e) {
		e.preventDefault();
		id = $(this).attr("comment_id");

		results = confirm("Are you sure you want to delete this comment?");
		if ( results ) {
			$.ajax({
				async: false,
				dataType: "html",
				data: {id: id},
				success: function (data, textStatus) {
					$("#commentmessage").html(data);
					$("#comment" + id).css('display', 'none');
				},
				type:"POST",
				url:"\/comments\/delete"
			});
		}
		return true;
	}); 
});

</script>
<div id="commentmessage">
<?php 
if ( !empty( $error ) ) { ?>
	<p class="error">
		<strong>Error: </strong><?php echo $error; ?>
	</p>
	
	<?php } elseif (!empty( $success ) ) { ?>
	<p class="success">
		<?php echo $success; ?>
	</p>
<?php } ?>

</div>

<?php
$comment_exists = false;
$too_fast = false;
$too_long = false;

if (isset($ajaxComments["comment_exists"])) {
        $comment_exists = true;
        unset($ajaxComments["comment_exists"]);
}

if (isset($ajaxComments["too_fast"])) {
        $too_fast = true;
        unset($ajaxComments["too_fast"]);
}

if(isset($ajaxComments["too_long"])) {
	$too_long = true;
	unset($ajaxComments["too_long"]);
}

foreach ($comments as $comment): ?>
<div id="comment<?php echo $comment['Comment']['id']; ?>">
	<div class="commentpic">
		<?php echo $this->Html->image( $comment['User']['picture'], array('height'=>'65px', 'width'=>'65px')); ?>
	</div>
	
	<div class="commentbody">
		<?php echo $this->Html->image('icons/left-comment-arrow.png'); ?>
		<div class="commentheader"> 
			<div class="commentusername">
				<?php echo $this->Html->link( $comment['User']['username'], array('controller' => 'users', 'action' => 'profile', $comment['User']['username'] ));?></a>  
			</div>
		
			<div class="commentdate">
				<?php echo $this->Html->image('icons/calendar-comments.png'); ?>
				<?php echo $this->Time->format( 'F j, Y', $comment['Comment']['created']); ?>
			</div>
			
			<div class="commenttime">
				<?php echo $this->Html->image('icons/clock.png');?> <?php echo $this->Time->format( 'g:i a', $comment['Comment']['created']); ?>
			</div>
		</div>
		
		<div class="commenttext">
			<?php echo $comment['Comment']['comment']; ?>
			<?php if(AuthComponent::user('id') == $comment['Comment']['user_id'] || AuthComponent::user('role') == 'Admin' || AuthComponent::user('role') == 'GAdmin'){ ?>
				<div class="right">
					<a class="delete_comment red" href="#" comment_id="<?php echo $comment['Comment']['id']; ?>">Delete</a>
				</div>
			<?php } ?>
		</div>
	</div>
	</div>
<?php endforeach;
			
if($comment_exists) {
	echo "<p id='commentErr'>Comment already exists (comment not saved)</p>";
}
if($too_fast) {
	echo "<p id='commentErr'>You are posting too fast (comment not saved)</p>";
}
if($too_long) {
	echo "<p id='commentErr'>Your comment was too long (comment not saved)</p>";
}
?>
