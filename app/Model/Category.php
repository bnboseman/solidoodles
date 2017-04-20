<?php
App::uses('AppModel', 'Model');
/**
 * Category Model
 *
 * @property Doodle $Doodle
 */
class Category extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Doodle' => array(
			'className' => 'Doodle',
			'foreignKey' => 'category_id',
			'dependent' => false
		)
	);

}
