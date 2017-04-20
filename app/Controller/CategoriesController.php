<?php
App::uses('AppController', 'Controller');

class CategoriesController extends AppController {
	public $paginate = array(
			'limit' => 10,
			'maxLimit' => 10,
			'order' => 'Doodle.created'
	);
	
	public function index($id = null) {
		if ( $id == null ) {
			$this->Category->recursive = 0;
			$this->set( 'categories', $this->Category->find('all', null));
		} else {
			$this->Category->recursive = 2;
			$this->paginate['conditions'] = array('Category.slug' => $id );
			$this->set( 'models', $this->paginate('Doodle'));
			$this->set('name', $this->Category->field('name', array('Category.slug' => $id ) ) );
			$this->render('view');
		}
	}
	
}