<?php
App::uses('AppModel', 'Model');

class Picture extends AppModel {
	public $displayField = 'file_name';

	public $validate = array(
		'file_name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Invalid filename'
			),
		),
		'doodle_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Doodle' => array(
			'className' => 'Doodle',
			'foreignKey' => 'doodle_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'StlFile' => array(
			'className' => 'StlFile',
			'foreignKey' => 'stl_file_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['stl_file_id'])):
			$previous = $this->findByStlFileId( $this->data[$this->alias]['stl_file_id'] );
			if(!empty( $previous ) ):
				$this->delete( $previous['Picture']['id'], false);
			endif;
		endif;
		return true;
	}
	
	public function doodle( $id ) {
		$this->id = $id;
		
		$doodle = $this->read('doodle_id', $id );
		return $doodle['Picture']['doodle_id'];
	}
	
	public function setDefault( $id) {
		$this->id = $id;

		$model = $this->field('doodle_id');
		$this->Doodle->id = $model;
		$this->Doodle->saveField('picture_id', $id);
	}
	
	public function delete( $id = null, $cascade = true ) {
		if( $id == null ):
			$id = $this->id;
		endif;
		
		if ( $id != null ):
		return( $this->updateAll(array('Picture.deleted' => true),
				array('Picture.id' => $id) ) );
		endif;
		
		return false;
	}
}
