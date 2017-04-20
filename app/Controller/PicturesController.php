<?php
App::uses ( 'AppController', 'Controller' );
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class PicturesController extends AppController {
	public function select( $id = null ) {
		$this->layout = 'ajax';
		$this->autoRender = false;

		if ( !$this->Picture->exists( $id) ):
			throw new BadRequestException('Picture Does not exist');
		endif;
		
		$this->Picture->id = $id;
		
		$owner = $this->Picture->Doodle->field('user_id');
		if ( $this->Auth->user('role') == 'Admin' ||   $this->Auth->user('role') == 'GAdmin' ||  $this->Auth->user('id') == $owner ) {
			$this->Picture->setDefault( $id );
		} else {
			throw new BadRequestException('Could not update default picture');
		}
	}
	
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		
		$this->Picture->id = $id;
		
		// Do we have a valid picture to delete?
		if (!$this->Picture->exists()):
		$this->Session->setFlash(__('Could Not Delete'));
		$this->redirect(array('controller' => 'users', 'action' => 'uploads'));
		endif;
		
		// Do we own this model?
		$owner = $this->Picture->field('user_id');
		$picture = $this->Picture->field('file_name');
		if ( $owner != $user && $this->Auth->user('role') != 'GAdmin' ):
			throw new BadRequestException('You are not authorized to update this model');
		endif;
		
		$delete = $this->Picture->delete();
		// Problem Deleting.
		
		if ($delete == false):
			$this->Session->setFlash(__('Could Not Delete'));
			$this->redirect(array('controller' => 'users', 'action' => 'uploads'));
		endif;

		// Tell user everything is AOK and redirect to user uploads page
		$this->Session->setFlash(__("$picture has been deleted."));
		$this->redirect(array('controller' => 'users', 'action' => 'uploads'));
		exit();
		
		$this->Session->setFlash(__('You do not have authorization to delete model'));
		$this->redirect(array('controller' => 'users', 'action' => 'uploads'));
	}
}