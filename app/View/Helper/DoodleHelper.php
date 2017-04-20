<?php 
App::uses('AppHelper', 'View/Helper');

class DoodleHelper extends AppHelper {
  public $helpers = array('Html');
  
  public function prepareDoodle( $model ) {
  	$doodle = $model['Doodle'];
  	$doodle['Likes'] = $model['Likes'];
  	$doodle['Comments'] = $model['Comments'];
  	$doodle['DefaultPicture'] = $model['DefaultPicture'];
  	
  	return $doodle;
  }
  
  public function picture( $picture, $options = null ) {
  	if( !isset( $picture['file_name'] ) ):
  			  $picture['file_name'] = "solidoodledefault.jpg";
  	endif;
  	
  	if ( $picture['file_name'] == "solidoodledefault.jpg" ):
  		$pictureFile = "solidoodledefault.jpg";
  	else:
  		$pictureFile = 'models/' .  $picture['doodle_id'] . '/' . $picture['file_name'];
  	endif;
  	
  	if ( $options ):
  		$image = $this->Html->image( $pictureFile, $options );
  	else: 
  		$image = $this->Html->image( $pictureFile );
  	endif;
  	
  	return $image;
  }
  
  
  public function file( $id, $file, $title="Download", array $options = array() ) {
  	
 		$link = "https://s3.amazonaws.com/solidoodles/$id/$file";
 		
 		return $this->Html->link( $title, $link, $options);
  }
  
  public function link( $id, $file ) {
  	return "https://s3.amazonaws.com/solidoodles/$id/$file";
  }
  
  public function download( $link ) {
  	$image = $this->Html->image('icons/download.png');
  	$download  = <<<EOT
  <div class="download">
			<a
				href="$link">
				<div class="icon">
					$image
				</div>
				<div class="text">download</div>
			</a>
		</div>
EOT;
	return $download;
  }
  
  public function likes( $likes ) {
  	$image  = $this->Html->image('icons/likes.png');
  	$likes = <<<EOT
	  	<div class="likes">
		  	<div class="icon">
		  		$image
		  	</div>
	  	<div class="count">
	  		$likes
	  	</div>
  	</div>
EOT;
  	return $likes;
  }
  
  public function comments( $comments ) {
  	$image = $this->Html->image( 'icons/comments.png');
  	$comments = <<<EOT
  	<div class="comments">
	  	<div class="icon">
	  		$image
	  	</div>
	  	<div class="count">
	  		$comments
	  	</div>
  	</div>
EOT;
  	return $comments;
  }
  
  public function downloads( $downloads ) {
  	$image = $this->Html->image('icons/downloads.png');
  	$downloads = <<<EOT
  	<div class="downloads">
	  	<div class="icon">
	  	 $image
	  	 </div>
	  	 <div class="count">
	  	 	$downloads
	  	 </div>
  	 </div>
EOT;
  	
  	return $downloads;
  }
}
?>