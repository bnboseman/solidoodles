<div class="doodle-carousel-container">
	<div id="doodle-carousel" class="carousel slide doodleModel">
		<div class="carousel-inner">
					<?php
					foreach ( $files as $index => $stlFile ) :
						$activeString = "";
						if ($index == 0) {
							$activeString = "active";
						}
						echo "<div class='item carouselItem " . $activeString . "' doodleId='" . $stlFile ['id'] . "' doodleModel='" . $stlFile ['file'] . "' index='" . $index . "'>";
						echo "<div id='model" . $stlFile ['id'] . "'>";
						echo "<div id='loading" . $stlFile ['id'] . "'></div>";
						echo "</div>";
						echo '<div class="carousel-caption blackCaption">';
						echo $stlFile ['name'];
						echo "</div>";
						echo "</div>";
					endforeach
					;
					?>
				</div>
	</div>
	<div class="carousel-controls">	
				<?php
				
if (count ( $files ) > 1) {
					echo '<ol class="carousel-indicators">';
					foreach ( $files as $index => $stlFile ) {
						$activeString = "";
						if ($index == 0) {
							$activeString = "active";
						}
						echo "<li data-target='#doodle-carousel' data-slide-to='" . ( string ) ($index) . "' class='blackBorder " . $activeString . "'></li>";
					}
					echo '</ol>';
				}
				?>
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