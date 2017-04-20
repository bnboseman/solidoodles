<?php echo $this->Html->script('carousel'); ?>
<div id="welcome">
	<div class="carousel-container">
			<div id="home-carousel" class="carousel slide" data-ride="carousel">
				<div class="carousel-inner">
					<div class="item active" index="0">
						<?php echo $this->Html->image('action-philosophers.jpg',  array('url' =>'http://www.solidoodle.com/index.php?route=information/action_philosophers'))?>
					</div>
					
					<div class="item"  index="1">
						<?php echo $this->Html->image('lotus.jpg', array('url' =>array('action' => 'view', 509)))?>
					</div>
					
					<div class="item"  index="2">
						<?php echo $this->Html->image('tie-clip.jpg', array('url' =>array('action' => 'view', 508)))?>
					</div>
				</div>
			</div>
	</div>
	<div class="carousel-controls">
		<a class="left carousel-control black noBackgroundImage" href="#home-carousel" data-slide="prev">
			<?php echo $this->Html->image('icons/carousel-left.png')?>
		</a>
		
		<ol class="carousel-indicators">
			<li data-target="#home-carousel" data-slide-to=0 class="active"></li>
			<li data-target="#home-carousel" data-slide-to=1 ></li>
			<li data-target="#home-carousel" data-slide-to=2 ></li>
		</ol>
		<a class="right carousel-control black noBackgroundImage" href="#home-carousel" data-slide="next">
			<?php echo $this->Html->image('icons/carousel-right.png')?>
		</a>
	</div>
</div>
