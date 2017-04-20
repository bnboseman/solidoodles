<?php
App::uses ( 'AppModel', 'Model' );

class Tag extends AppModel {
	public $displayField = 'name';
	
	public $hasAndBelongsToMany = array (
			'Doodle' => array (
					'className' => 'Doodle',
					'joinTable' => 'tags_doodles',
					'foreignKey' => 'tag_id',
					'associationForeignKey' => 'doodle_id',
					'unique' => true,
					'conditions' => '',
					'fields' => '',
					'order' => '',
					'limit' => '',
					'offset' => '',
					'finderQuery' => '' 
			) 
	);
}
