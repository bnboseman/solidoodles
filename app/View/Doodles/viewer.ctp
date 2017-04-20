<?php  echo $this->Html->script('three.min.js'); ?>
<?php  echo $this->Html->script('Detector.js'); ?>
<?php  echo $this->Html->script('controls/TrackballControls.js'); ?>
<?php  echo $this->Html->script('jquery-ui-1.10.3.custom.min.js'); ?>
<?php  echo $this->Html->script('loaders/STLLoader.js'); ?>
<?php  echo $this->Html->script('stl.js'); ?>
<?php  echo $this->Html->script('soliview.js'); ?>

<script type="text/javascript">
	soliview($(".carouselItem.active").attr("fileId"), "https://s3.amazonaws.com/solidoodles/<?php echo $model['Doodle']['id']; ?>/" + $(".carouselItem.active").attr("doodlemodel"));
	$("#doodle-carousel").on('slid.bs.carousel', function (e) {
		soliview($(".carouselItem.active").attr("fileId"), "https://s3.amazonaws.com/solidoodles/<?php echo $model['Doodle']['id']; ?>/" + $(".carouselItem.active").attr("doodlemodel"));
	});
</script>
<div class="doodle-carousel-container">
			<div id="doodle-carousel" class="carousel slide doodleModel"
				data-ride="carousel" data-interval="false">
				<div class="carousel-inner">
					<?php 
					// Clean up the way the name looks a bit. 
					$model['Doodle']['name'] = Inflector::humanize($model['Doodle']['name'] );
					
					// Loop through each and add to carousel
					foreach($model['StlFile'] as $index=>$doodle):
					$activeString = "";
					if ($index == 0) {
						$activeString = "active";
					} 
					
					if (count($model['StlFile']) > 1 ) {
						$doodle['name'] = "{$model['Doodle']['name']}: {$doodle['file']}"; 
					}	
						?>
					
					<div class='item carouselItem <?php echo $activeString?>'
						fileid="<?php echo  $doodle['id']?>"
						doodlemodel="<?php echo $doodle['file'] ?>"
						index='<?php echo $index?>'>

						<div id="model<?php echo $doodle['id']?>">
							<div id="loading<?php echo $doodle['id']?>"></div>
						</div>
						<div class="carousel-caption blackCaption">
							<?php echo $doodle['name'];
							?>
						</div>
					</div>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="carousel-controls">
				<?php if (count($model['StlFile']) > 1) { ?>
				<ol class="carousel-indicators">
					<?php foreach ($model['StlFile'] as $index=>$doodle) {
						$activeString = "";
						if ($index == 0) {
							$activeString = "active";
						} ?>
					<li data-target='#doodle-carousel'
						data-slide-to='<?php echo $index; ?>'
						class='blackBorder <?php echo $activeString?>'></li>
					<?php } ?>
				</ol>
				<?php } ?>
				<?php if(count($model['StlFile']) > 1) { ?>
				<a href="#doodle-carousel"
					class="left carousel-control black noBackgroundImage"
					data-slide="prev"> <span
					class="glyphicon glyphicon-chevron-left black"></span>
				</a> <a href="#doodle-carousel"
					class="right carousel-control black noBackgroundImage"
					data-slide="next"> <span
					class="glyphicon glyphicon-chevron-right black"></span>
				</a>
				<?php } ?>
			</div>
		</div>