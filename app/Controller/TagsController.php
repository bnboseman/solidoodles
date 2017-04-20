<?php
App::uses('AppController', 'Controller');

class TagsController extends AppController {
	public $helpers = array (
			'Form',
			'Html',
			'Doodle',
	);
	public function index($id = null) {
		if ( $id == null ) {
			throw new BadRequestException('No tag listed');
		} else {
			$this->set('id', $id);
			$models = $this->Tag->Doodle->getDoodlesByTag( $id );
			if ( empty( $models ) ) {
				throw new NotFoundException('No Models found for the tag ' . $id );
			}
			
			$this->set('models', $models );
		}
	}
}