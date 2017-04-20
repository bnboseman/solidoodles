<?php
App::uses('AppModel', 'Model');
/**
 * StlFile Model
 *
 * @property Doodle $Doodle
 */
class StlFile extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


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
		)
	);
	
	public $hasMany = array(
			'Picture' => array (
					'className' => 'Picture',
					'foreignKey' => 'stl_file_id',
					'dependent' => true,
					'conditions' => array( 'Picture.deleted' => false ),
					'fields' => '',
					'order' => '',
					'limit' => '',
					'offset' => '',
					'exclusive' => '',
					'finderQuery' => '',
					'counterQuery' => '' 
			)
		);
}
