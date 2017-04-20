<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
/**
 * User Model
 *
 * @property Comment $Comment
 * @property Doodle $Doodle
 * @property Like $Like
 * @property Picture $Picture
 */
class User extends AppModel {

	public $displayField = 'name';

	public $validate = array(
			'username' => array(
			'notEmpty' => array(
				'rule' => '/^[a-z0-9]{4,}$/i',
				'message' => 'Only letters and integers, min 4 characters',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				'on' => 'create'
			),
			'alphaNumeric' => array(
				'rule' => array('alphaNumeric'),
				'message' => 'Use only letters or numbers',
				'on' => 'create'
			),
			'userNameUnique' => array(
					'rule' => array('isUnique'),
					'message' => 'Username is already registered',
				),
		),
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				'message' => 'Enter valid email',
				'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'emailUnique' => array(
				'rule' => array('isUnique'),
				'message' => 'Email is already registered',
			),
		),
		'password' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Enter password',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'minLength' => array(
				'rule' => array('minLength', 6),
				'message' => 'Password must contain at least 6 characters',
			),
		),
		'repass' => array(
			'minLength' => array(
				'rule' => array('minLength', 6),
				'message' => 'Password must contain at least 6 characters'
			),
				'notEmpty' => array(
						'rule' => array('notEmpty'),
						'message' => 'Enter password'),
				'compare'    => array(
						'rule'      => array('validate_passwords'),
						'message' => 'The passwords you entered do not match.',
						'on' => 'update'
				)
		)
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Comment' => array(
			'className' => 'Comment',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Doodle' => array(
			'className' => 'Doodle',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => array('Doodle.disabled' => false, 'Doodle.deleted' => false),
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Like' => array(
			'className' => 'Like',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Favorite' => array(
				'className' => 'Favorite',
				'foreignKey' => 'user_id',
				'dependent' => false,
				'conditions' => '',
				'fields' => '',
				'order' => '',
				'limit' => '',
				'offset' => '',
				'exclusive' => '',
				'finderQuery' => '',
				'counterQuery' => ''
			),
		'Picture' => array(
			'className' => 'Picture',
			'foreignKey' => 'user_id',
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
	public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $passwordHasher = new BlowfishPasswordHasher();
            $this->data[$this->alias]['password'] = $passwordHasher->hash(
                $this->data[$this->alias]['password']
            );
        }
        return true;
    }
    
    public function getUserDoodles( $id = null ) {
    	if ( $id == null ) {
    		return;
    	}
    	return $this->Doodle->findAllByUserId($id);
    }
    
    public function getUserInfo( $id = null, $field = null ) {
    	if ($id == null ) {
    		return;
    	}
    	
    	$this->recursive = 0;
    	
    	if( is_string($id ) ) {
    		$user = $this->find('first', array('conditions'=>array('User.username'=> $id ) ) );
    	} else {
    		$user = $this->find('first', array('conditions'=>array('User.id'=> $id ) ) );
    	}
    	
    	if (empty( $user ) ) {
    		return; 
    	}
    	
    	if ( isset( $field) ) {
    		return $user['User'][ $field ];
    	}
    	
    	return $user;
    }
    
    public function getUserFavorites( $id = null ) {
    	if ($id == null ) {
    		return null;
    	}
    	
    	$params = array();
    	$params['conditions'] = array('Favorite.user_id' => $id);
    	$params['fields'] = array( 'Doodle.id', 'Doodle.name', 'Doodle.description', 'Doodle.created', 'Doodle.views', 'Doodle.downloads');
    	return $this->Favorite->find('all', $params);
    }
    
    public function validate_passwords() {
    	return $this->data[$this->alias]['password'] === $this->data[$this->alias]['repass'];
    }

}
