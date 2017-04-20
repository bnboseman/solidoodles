<?php
App::uses ( 'AppController', 'Controller' );
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class CommentsController extends AppController {
	public $helpers = array(
			'Form',
			'Html',
			'Js',
			'Time'
	);
	
	
	public function add() {
		$this->layout = 'ajax';
		$this->autoRender = false;
		
		if ($this->request->is( 'post') ) {
			$data = $this->request->data;
			$user = $this->Auth->user('id');
			// Check to see if user left a comment previously
			$this->Comment->recursive = 0;
			$previousComment = $this->Comment->find('first', array(
					'conditions' => array(
							'Comment.user_id' => $user,
							'Comment.created > NOW() - INTERVAL 5 MINUTE' )) );
			
			if ( !empty($previousComment) ) {
				App::uses('CakeTime', 'Utility');
				$timeToWait = CakeTime::timeAgoInWords( $previousComment['Comment']['created'] );
				$this->set('error', "You posted a comment at $timeToWait. <br />You must wait 5 minutes before you can submit again.");
			} else {
				$data['Comment']['user_id'] = $user;
				$this->Comment->create();
				$this->Comment->save( $data );
			}
			
			$this->set('comments', $this->Comment->find('threaded', array(
					'conditions' => array('Comment.doodle_id' =>$this->request->data ['Comment']['doodle_id']),
					 'order' => 'Comment.created DESC') ) );
			$this->set('success', 'Comment was successfully posted');
			$this->render('view');
		}
		
		$this->view();
	}
	
	public function view() {
		$this->layout = 'ajax';
		$doodle_id = $this->request->data ['Comment']['doodle_id'];

		if  ($doodle_id == null ) {
			return;
		}
		
		$this->set('comments', $this->Comment->find('threaded', array(
				'conditions' => array('Comment.doodle_id' => $doodle_id),
					 'order' => 'Comment.created DESC' ) ) );		
	}
	
	public function delete() {
		$this->layout = 'ajax';
		$user = $this->Auth->user('id');
		
		if ( $this->request->is('post') ) {
			$this->Comment->clear();
			$this->Comment->id = $this->request->data('id');
			if ($this->Comment->field('user_id') == $user || $this->Auth->user('role') == 'Admin' || $this->Auth->user('role') == 'GAdmin') { 
				if ( $this->Comment->delete() ) {
					$this->set('success',  'The comment has been sucessfully deleted.');
				} else {
					$this->set('error', 'Could not delete comment.');
				}
			} else {
				$this->set('error', 'You do not have the permissions to delete this comment.');
			}
		}
	}
	
	
}