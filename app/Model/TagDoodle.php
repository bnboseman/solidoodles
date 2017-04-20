<?php
App::uses('AppModel', 'Model');
/**
 * TagDoodle Model
 *
 * @property Tag $Tag
 * @property Doodle $Doodle
 */
class TagsDoodle extends AppModel {
	
	public $name = 'DoodleTags';

	public $belongsTo = array(
		'Tag' => array(
			'className' => 'Tags',
			'foreignKey' => 'tag_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Doodle' => array(
			'className' => 'Doodle',
			'foreignKey' => 'doodle_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
