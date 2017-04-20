<?php echo $this->Html->script('three.min.js'); ?>
<?php  echo $this->Html->script('Detector.js'); ?>
<?php  echo $this->Html->script('Mirror.js'); ?>
<?php  echo $this->Html->script('controls/TrackballControls.js'); ?>
<?php  echo $this->Html->script('libs/stats.min.js'); ?>
<?php  echo $this->Html->script('jquery-ui-1.10.3.custom.min.js'); ?>
<?php  echo $this->Html->script('bootstrap.js'); ?>
<?php  echo $this->Html->script('stl.js'); ?>
<?php  echo $this->Html->script('soliview.js'); ?>
<div class="row">
<div id='model<?php echo $file_id; ?>' class='model col-md-8' style="height: 500px"><div id='loading<?php echo $file_id; ?>'> loading ... </div>
</div>

<p class="btn btn-default" id="screenshot<?php echo $file_id; ?>">Screenshot</p> 

<?php echo $this->Form->create(null, 
		array( 'style' => 'display:none;',
				'id' => 'hiddenForm' . $file_id))
?>
	<input type="hidden" name="dataUrl" value="" id="dataUrl<?php echo $file_id; ?>"></input>
	<input type="hidden" name="file" value="" id="file<?php echo $file_id; ?>"></input>
	<input type="hidden" name="model" value="" id="model<?php echo $doodle_id; ?>"></input>
<?php echo $this->Form->end();?>
</div>

<script>
$( document ).ready(function () {
	var soliviewer = soliview(<?php echo $file_id; ?>, "https://s3.amazonaws.com/solidoodles/<?php echo $doodle_id?>/<?php echo $file; ?>");
	$("#screenshot<?php echo $file_id; ?>").click( function (e) {
		var screenshot = soliviewer.domElement.toDataURL("image/png");
		$("#dataUrl<?php echo $file_id; ?>").val(screenshot);
		$("#file<?php echo $file_id; ?>").val(<?php echo $file_id; ?>);
		$("#model<?php echo $doodle_id; ?>").val(<?php echo $doodle_id; ?>);
		$("#hiddenForm<?php echo $file_id; ?>").submit();	
	});
});
</script>