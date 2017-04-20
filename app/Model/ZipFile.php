<?php
App::uses('AppModel', 'Model');
/**
 * StlFile Model
 *
 * @property Doodle $Doodle
 */
class ZipFile extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'file';


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
}
