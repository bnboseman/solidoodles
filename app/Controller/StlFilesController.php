<?php 
App::uses ( 'AppController', 'Controller' );

class StlFilesController extends AppController {
	public function picture( $id = null ) {
		//$this->layout = 'ajax';
		
		$this->StlFile->id = $id;
		$this->set('file_id', $id);
		$this->set('doodle_id', $this->StlFile->field('doodle_id') );
		$this->set('file', $this->StlFile->field('file'));
	}
}
?>