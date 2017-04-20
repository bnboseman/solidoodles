<?php  echo $this->Html->script('three.min.js'); ?>
<?php  echo $this->Html->script('Detector.js'); ?>
<?php  echo $this->Html->script('Mirror.js'); ?>
<?php  echo $this->Html->script('controls/TrackballControls.js'); ?>
<?php  echo $this->Html->script('libs/stats.min.js'); ?>
<?php  echo $this->Html->script('jquery-ui-1.10.3.custom.min.js'); ?>
<?php  echo $this->Html->script('bootstrap.js'); ?>
<?php  echo $this->Html->script('stl.js'); ?>
<?php  echo $this->Html->script('soliview.js'); ?>
<?php  $currentPage = urlencode(Router::url($this->here, true)); ?>
<script type="text/javascript"> 
	var solidoodle; 
	solidoodle = <?php echo $model['Doodle']['id'];?>;
	<?php if ( AuthComponent::user()): ?>
	var user; 
	user = <?php echo AuthComponent::user('id');?>;
	<?php endif;?>
</script>

<script type="text/javascript">
	$(".dropdown-toggle").click(function (e) {
		e.preventDefault();
		$(this).dropdown();
		e.stopPropagation();
	});
</script>

<div id="fb-root"></div>
<script type="text/javascript">
window.fbAsyncInit = function() {
        FB.init({
          appId      : '{373391566137473}',
          status     : true,
          xfbml      : true
        });
      };
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<?php echo $this->element('viewScripts', array('model' => $this->Doodle->prepareDoodle( $model ) ) ); ?>

<div class="row doodle-header-row">
	<div class="col-md-12">
		<div class="doodle-header">
			<?php echo $model['Doodle']['name']; ?>
		</div>
	</div>
</div>
<div class="row soliviewer-row">
	<div class="col-md-8 col-sm-12 col-xs-12">
		<div id="doodle" doodle-id="<?php echo $model['Doodle']['id']; ?>">
		</div>

		<div class="row image-row">
			<?php foreach ( $model['Picture'] as $picture ): ?>
			<?php
			$primary_picture = "";
			if((AuthComponent::user('id') == $model['Doodle']['user_id'] || AuthComponent::user('role') == 'Admin' || AuthComponent::user('role') == 'GAdmin')){
				if ($picture['id'] == $model['DefaultPicture']['id']) {
					$primary_picture = "primary-picture";
				}
			}
			?>
			<div class="col-md-2">
				<div
					class="picture-highlight-wrap <?php echo $primary_picture;?>">
					<div class="picture-wrap"
						picture="<?php echo $picture['file_name'];?>"
						filename="<?php echo $picture['file_name'];?>"
						picture-id="<?php echo $picture['id'];?>">
						<?php
						if(AuthComponent::user('id') == $model['Doodle']['user_id'] || AuthComponent::user('role') == 'Admin' || AuthComponent::user('role') == 'GAdmin'){
							echo $this->Html->link( $this->Html->image('/img/models/' . $model['Doodle']['id'] . '/' . $picture['file_name'], array('width' => '130px', 'height' => '138px')), array('controller' => 'pictures', 'action' => 'select', $picture['id']), array('escapeTitle' => false, 'confirm' => 'Set this image as default?'));
						} else {
							echo $this->Html->image('/img/models/' . $model['Doodle']['id'] . '/' . $picture['file_name'], array('width' => '130px', 'height' => '138px'));
						}
								//echo $this->Html->image('/img/models/' . $model['Doodle']['id'] . '/' . $picture['file_name']); ?>
						<?php 
							if(AuthComponent::user('id') == $model['Doodle']['user_id'] || AuthComponent::user('role') == 'Admin' || AuthComponent::user('role') == 'GAdmin'){?>
						<div class="delete-img"
							doodle-id='<?php echo $model["Doodle"]["id"];?>'
							picture-id="<?php echo $picture['id'];?>">
							<?php echo $this->Html->image('icons/trashcan.png');?>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
	<div class="col-md-4 col-sm-12 col-xs-12">
		<div class="gravatar-and-info">
			<div class="gravatar">
				<?php echo $this->Html->image($model['User']['picture'], array('height'=>'65', 'width'=>'65'));?>
			</div>
			<div class="info">
				<div class="author">
					<?php echo $this->Html->link(
							$model['User']['username'],
							array(
									'controller' => 'users', 'action' => 'profile', $model["User"]["username"])
					);
					?>
				</div>
				<div class="created">
					Created:
					<?php echo $this->Time->timeAgoInWords( $model['Doodle']['created'], array(
							'accuracy' => array('month' => 'month'),
    'end' => '1 year') ); ?>
				</div>
			</div>
		</div>
		<div class="title-and-description">
			<div class="title">
				<?php echo $model['Doodle']['name']; ?>
			</div>
			<div class="description">
				<?php echo $model['Doodle']['description']; ?>
			</div>
			<div class="license">
				<?php echo $model['License']['name']; ?>
			</div>
		</div>
		<div class="download">
			<?php 
			if ( !empty($model['ZipFile'])  ) { ?>
			<div class="download-btn">
				<a class="countdownload"
					href="<?php echo $this->Doodle->link( $model['Doodle']['id'], $model['ZipFile'][0]['file']);?>">
					download<img src="/img/icons/download.png" alt="" />
				</a>
			</div>
			<div class="indiv-btn" id="individualModels">Download
				individual doodles</div>
			<div class="modal" id="individualModelsModal" title="Download"
				style="display: none">
				<span class="modalHeader">Download individual doodles</span>
				<div class="modalClose" id="closeIndividualModelsModal">x</div>
				<?php foreach($model['StlFile'] as $doodle): ?>
				<div id="downloadbutton" class="countdownload">
					<div class='btn btn-primary downloadButton'>
						<a
							href="<?php echo $this->Doodle->link($model['Doodle']['id'], $doodle['file']);?>">
							<?php echo $doodle['file'];?>
						</a>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
			<?php } else { ?>
			<div class="download-btn">
				<a class="countdownload"
					href="<?php echo $model['Doodle']['link']; ?>"> download
					<?php echo $this->Html->image('icons/download.png');?>
				</a>
			</div>
			<?php } ?>


			<?php if( AuthComponent::user('id') == $model['Doodle']['user_id'] || AuthComponent::user('role') == 'Admin' || AuthComponent::user('role') == 'GAdmin'){/*
			echo "<div id='editMyDoodle'>";
			echo "Edit Information";
			echo "</div>";*/
		} ?>

			<?php if(AuthComponent::user()){/* ?>
			<div id="addpictures"><a>Add Pictures</a></div>
		<?php */
}?>

			<?php 
		if(AuthComponent::user('id') == $model['Doodle']['user_id'] || AuthComponent::user('role') == 'Admin' || AuthComponent::user('role') == 'GAdmin'){ ?>
			<div class="picture-picker">
				<?php echo $this->Html->link(__('Update Model Photos'), array( 'action' => 'picture', $model['Doodle']['id']));
				?>
			</div>
			<?php } ?>
			<?php
			if(AuthComponent::user('role') == 'Admin' || AuthComponent::user('role') == 'GAdmin'){/* ?>
				<div class="make-featured">
				<?php
				if(empty( $model['Feature'] ) ){
				echo $this->Form->postLink(
						' Make Featured',
						array('action' => 'feature', $model['Doodle']['id'], 'feature'),
						array('confirm' => 'are you sure?'));
				}elseif($model['Doodle']['featured'] == 1){
				echo $this->Form->postLink(
						' Remove Featured Status',
						array('action' => 'feature', $model['Doodle']['id'], 'defeature'),
						array('confirm' => 'are you sure?'));
				} ?>
				</div>
				<?php */
}?>

			<?php 
		if(AuthComponent::user('id') == $model['Doodle']['user_id'] || AuthComponent::user('role') == 'Admin' || AuthComponent::user('role') == 'GAdmin'){?>
			<div class="deletesection">
				<?php
				if($model['Doodle']['deleted'] == 0){
					echo " ";
					echo $this->Form->postLink(
							"<img src='/img/icons/trashcan.png'>Delete This Doodle",
							array('action' => 'delete', $model['Doodle']['id']),
							array('escape' => false, 'confirm' => "Are you sure you want to delete {$model['Doodle']['name']}?") );
				}elseif($model['Doodle']['deleted'] == 1){
					echo "deleted";
				}	?>
			</div>
			<?php }	?>
		</div>
		<div class="counters">
			<div class="row">
				<div class="col-md-3 col-sm-3 col-xs-3">
					<div class="counter">
						<img src="/img/icons/count-views.png" alt="">
						<div class="count">
							<?php echo $model['Doodle']['views'];?>
						</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-3">
					<div class="counter">
						<img src="/img/icons/count-downloads.png" alt="">
						<div class="count" id="downloadsCount">
							<?php echo $model['Doodle']['downloads'];?>
						</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-3">
					<div class="counter">
						<img src="/img/icons/count-comments.png" alt="">
						<div class="count">
							<?php echo count($model['Comments']);?>
						</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-3">
					<div class="counter">
						<img src="/img/icons/count-likes.png" alt="">
						<div class="count">
							<?php echo count($model['Likes']); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="social-button addthis_toolbox" id="social-button">
			<div class="text">Share this model</div>
			<div class="custom_images">
				<a class="addthis_button_facebook facebook-ico"
					href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $currentPage; ?>">
					<?php echo $this->Html->image('/img/icons/profile-share-facebook-icon.png'); ?>
				</a> <a class="addthis_button_twitter twitter-ico" href="https://twitter.com/home?status=<?php echo urlencode("#3d " . $model['Doodle']['name'] . " @Solidoodle3D") .  " - " . $this->Link->bitly($this->Html->url( null, true )); ?>"><?php echo $this->Html->image('/img/icons/profile-share-twitter-icon.png');?>
				</a> <a class="addthis_button_google_plusone_share google-plus-ico"
					href="https://plus.google.com/share?url=<?php echo $currentPage; ?>"><?php echo $this->Html->image('icons/profile-share-google-icon.png'); ?></a><a
					class="addthis_button_more more-ico"><?php echo $this->Html->image('/img/icons/profile-share-more-options-plus-icon.png'); ?>
				</a> <a class="addthis_button_email email-ico"><?php echo $this->Html->image('/img/icons/profile-share-email-icon.png');?>
				</a>

			</div>
		</div>
		<div id="sidetags">
			<h2>Tags</h2>
			<?php if(empty($model['Tag'])) { 
				echo "No tags";
			} ?>
			<?php foreach ($model['Tag'] as $tag): ?>
			<p>
				<?php echo $this->Html->link($tag['tag'], array('controller' => 'tags',
				  $tag['tag']));  ?>
			</p>
			<?php endforeach ?>
		</div>
	</div>
</div>


<div class="row comment-row">
	<div class="col-md-8 sm-12 xs-12">
		<div class="row">
			<div class="col-md-8">
				<div class="commentbox">
					<?php
					if(AuthComponent::user()){
						echo $this->Form->create('Comment', array('id' => 'ajaxCommentForm', 'action'=>'add', 'default' => false));
						echo $this->Html->image('icons/up-arrow.png');
						echo $this->Form->input('comment',array('type' => 'text', 'cols' => '5', 'rows' => '3', 'div'=>false, 'label'=>false, "required title" => "Please leave a comment longer than 5 letters."));
						echo $this->Form->input('doodle_id', array('type' => 'hidden', 'value' => $model['Doodle']['id']));
						echo $this->Form->submit("post", array('div'=>false, 'name'=>'add', 'id'=>"ajaxCommentSubmit"));
						echo $this->Form->end();
					}
					?>
				</div>
			</div>
			<div class="col-md-4" style="display: none;">
				<?php if(AuthComponent::user()){ ?>
				<div id="like">
					<div class="text">Like it</div>
					<?php echo $this->Html->image('/img/icons/thumbsup.png'); ?>
				</div>
				<?php }	?>
			</div>
			<div id="commentsection"></div>
		</div>




		<?php
			$pageId = $this->Js->object(array("Comment" => array('doodle_id' => $model['Doodle']['id']), "initialPageLoad" => true));?>
		<script type="text/javascript">
			<?php echo $this->Js->domReady(
				$this->Js->request(
					array('controller' => 'Comments' ,'action' => 'view'),
					array(
						'update' => '#commentsection',
						'data' => $pageId,
						'async' => true,
						'dataExpression' => true,
						'method' => 'POST'
					)
				)
			); ?>
			</script>

		<script type="text/javascript">
			
			</script>
	</div>
	<?php /* <div class="col-md-4 col-sm-12 col-xs-12">
			<div class="featured-header">Featured models:</div>
			<?php for ($i = 0; $i < count($featured); $i = $i + 3) {?>
			<div class="row">
			<?php
			$maxRow = count($featured) < $i + 3 ? count($featured) : $i + 3;
			for ($j = $i; $j < $maxRow; $j++) { ?>
			<div class="col-md-4">
			<div class="featured-image">
			<a href="/uploads/doodle?id=<?php echo $featured[$j]['UploadSet']['id'];?>"><img src="<?php echo $featured[$j]['UploadSet']['default_picture']; ?>" /></a>
			</div>
			<div class="download">
			<?php
			if (!empty($featured[$j]['UploadSet']['zip'])) {
			$download = 'https://s3.amazonaws.com/Solidoodles1/'. $featured[$j]['UploadSet']['zip'];
			} else {
			$download = "https://s3.amazonaws.com/Solidoodles1/" .$download_doodles[$featured[$j]['UploadSet']['id']][0]["Upload"]["model"];
			}
			?>
			<a href="<?php echo $download;?>">
			<div class="icon">
			<?php echo $this->Html->image('icons/download.png'); ?>
			</div>
			<div class="text">download</div>
			</a>
			</div>
			<div class="featured-more-info">
			<a href="/uploads/doodle?id=<?php echo $featured[$j]['UploadSet']['id'];?>">more info</a>
			</div>
			</div>
			<?php } ?>
			</div>
			<?php } ?>
			<div class="row">
			<div class="col-md-4"></div>
			</div>
	</div>*/ ?>
</div>

<div class="modal" id="dialog" title="upload picture"
	style="display: none">
	<span class="modalHeader">Upload Picture</span> <span
		class="modalClose" id="closeModal">x</span>
	<?php echo $this->Form->create('Picture', array('type' => 'File')); ?>
	<fieldset>

		<?php echo $this->Form->input('Picture.picture', array(
				'between' => '<br />',
				'type' => 'file'
			)); ?>
		<?php echo $this->Form->input('Picture.file_name', array('type' => 'hidden')); ?>
	</fieldset>
	<?php echo $this->Form->submit("Submit", array('div'=>false, 'name'=>'addPictures'));  
	echo $this->Form->end();
	?>
</div>

<div class="modal" id="editMyDoodleDialog" title="Update doodle"
	style="display: none">
	<span class="modalHeader"> Edit </span> <span class="modalClose"
		id="closeEditMyDoodle">x</span>
	<?php echo $this->Form->create('Doodle'); ?>
	<div>
		<fieldset>

			<?php echo $this->Form->input("name");?>
			<?php echo $this->Form->input('description',array('type' => 'text', 'rows' => '2'));?>
			<?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
		</fieldset>
		<?php echo $this->Form->submit("Submit", array('div'=>false, 'name'=>'updateText'));
		echo $this->Form->end();
		?>
	</div>
</div>

<?php /* if($like == true){
echo "
<script>
$('#like').addClass('glow-green');
$('#like > .text').text('Liked!');
</script>
";
}*/
?>
