<?php $count = 0; ?>
<?php echo $this->Html->script('three.min.js'); ?>
<?php  echo $this->Html->script('Detector.js'); ?>
<?php  echo $this->Html->script('Mirror.js'); ?>
<?php  echo $this->Html->script('controls/TrackballControls.js'); ?>
<?php  echo $this->Html->script('libs/stats.min.js'); ?>
<?php  echo $this->Html->script('jquery-ui-1.10.3.custom.min.js'); ?>
<?php  echo $this->Html->script('bootstrap.js'); ?>
<?php  echo $this->Html->script('stl.js'); ?>
<?php  echo $this->Html->script('soliview.js'); ?>
<div class="container-fluid">
<div>
<h2>Pick your default picture for your Solidoodle </h2>

<p>Use this page to pick a default page for your Solidoodle.</p>

<p>Click and drag to position your model for screenshot. Use the mousewheel to zoom in out from your model. When you are done 
hit the screenshot button to take a picture of your model for searches.</p>

<div id='pictureStatus'></div>
<script type="text/javascript" src="/js/soliview.js"></script>
<script>
	var user; 
	user = '<?php echo $model['Doodle']['user_id'] ?>';
</script>
<h2><?php echo $model['Doodle']['name']?></h2> 
<div class="row">
<?php 

foreach($model['Picture'] as $picture ):
$primary_picture = "";
if ($picture['id'] == $model['DefaultPicture']['id']) {
	$primary_picture = "primary-picture";
}?>

<div class="col-md-2">
<div class="picture-highlight-wrap <?php echo $primary_picture;?>">
<div class="picture-wrap"  picture="<?php echo $picture['file_name'];?>" filename="<?php echo $picture['file_name'];?>" picture-id="<?php echo $picture['id'];?>">
<?php
	echo $this->Js->link( $this->Html->image('/img/models/' . $model['Doodle']['id'] . '/' . $picture['file_name'], array('width' => '130px', 'height' => '138px')), array('controller' => 'pictures', 'action' => 'select', $picture['id']), array('onclick' => 'p', 'update' => '#pictureStatus',	'escape' => false, 'confirm' => 'Set this image as default?'));
?> </div>
</div>
</div>
<?php endforeach;?>
</div>

<?php foreach( $model['StlFile'] as $file ):
if (  strcasecmp(substr($file['file'], -3 ), 'stl') == 0 ):
$count++;?>
<div class="row">
<div id='model<?php echo $file['id']; ?>' class='model' style="height: 500px; width: 600px;"><div id='loading<?php echo $file['id']; ?>'> loading ... </div>

<script>
$( document ).ready(function () {
	var soliviewer = soliview(<?php echo $file['id']; ?>, "https://s3.amazonaws.com/solidoodles/<?php echo $model['Doodle']['id']?>/<?php echo $file['file']; ?>");
	$("#screenshot<?php echo $file['id']; ?>").click( function (e) {
		var screenshot = soliviewer.domElement.toDataURL("image/png");
		console.log( soliviewer.domElement );
		console.log( 'hi')
		console.log(screenshot);
		$("#dataUrl<?php echo $file['id']; ?>").val(screenshot);
		$("#file<?php echo $file['id']; ?>").val(<?php echo $file['id']; ?>);
		$("#model<?php echo $model['Doodle']['id']; ?>").val(<?php echo $model['Doodle']['id']; ?>);
		$("#hiddenForm<?php echo $file['id']; ?>").submit();	
	});
});
</script>
</div>
<div>No picture yet.</div> 



 
<p class="btn btn-default" id="screenshot<?php echo $file['id']; ?>">Screenshot </p> 

<?php echo $this->Form->create(null, array( 'style' => 'display:none;',
											'id' => 'hiddenForm' . $file['id']
		))?>
	<input type="hidden" name="dataUrl" value="" id="dataUrl<?php echo $file['id']; ?>"></input>
	<input type="hidden" name="file" value="" id="file<?php echo $file['id']; ?>"></input>
	<input type="hidden" name="model" value="" id="model<?php echo $model['Doodle']['id']; ?>"></input>
<?php echo $this->Form->end();?>

<?php endif; ?>
</div>
<?php endforeach;?>
<div>
<span>When you are ready
<script>
$( document ).ready(function() {
var imageComplete = true;
for (var i = 0; i < <?php echo $count; ?>; i++) {
if ($('#image' + i).val() === "") {
imageComplete = false;
}
}
if (imageComplete === true) {
} else {
}
});
</script>
<?php
if(!empty( $model['DefaultPicture']) ):
	echo $this->Html->link( "Click Here to finish Finish", array('action' => 'view', $model['Doodle']['id']));
endif;
?>
</span>
</div>
</div>
<script>
</script>
<div class="dialog" style="display:none">
<span class="modalClose">x</span>
Please take a screenshot to continue.
</div>
<?php echo $this->Js->writeBuffer(); ?>
