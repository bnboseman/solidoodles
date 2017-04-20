<?php
App::uses('AppModel', 'Model');
/**
 * Comment Model
 *
 * @property Comment $ParentComment
 * @property User $User
 * @property Doodle $Doodle
 * @property Comment $ChildComment
 */
class Comment extends AppModel {
	public $displayField = 'comment';
	
	public $validate = array(
		'user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	
	public $recursive = 1;
	
	public $belongsTo = array(
		'ParentComment' => array(
			'className' => 'Comment',
			'foreignKey' => 'parent_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
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

	public $hasMany = array(
		'ChildComment' => array(
			'className' => 'Comment',
			'foreignKey' => 'parent_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
	
	public function beforeFind($query) {
		$query ['conditions'] ['Comment.soft_delete'] = false;
		return $query;
	}
	
	public function delete( $id = null, $cascade = true ) {
		if( $id == null ):
			$id = $this->id;
		endif;
	
		if ( $id != null ):
		return $this->updateAll(array('Comment.soft_delete' => true),
				array('Comment.id' => $id) );
		
		endif;
	}

}
