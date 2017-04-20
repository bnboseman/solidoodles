<?php
App::uses('AppController', 'Controller');
App::uses('CakeS3', 'CakeS3.Lib');

/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class DoodlesController extends AppController
{
	public $pageTitle = 'Solidoodles: 3D Printing Community';

	public $helpers = array(
		'Form',
		'Html',
		'Js',
		'Time',
		'Doodle',
		'Link',
		'FileUpload.UploadForm'
	);

	public $components = array('Paginator',
		'CakeS3.CakeS3' => array(
			's3Key' => 'AKIAJAAERBSOU3EJ5TJA',
			's3Secret' => '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',
			'bucket' => 'solidoodles')
	);

	public $paginate = array(
		'order' => array(
			'Doodle.created' => 'desc'
		),
		'limit' => 10,
		'maxLimit' => 30,

	);

	// Specify which pages users can see without logging in
	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow('index', 'search', 'featured', 'newest', 'tag', 'download', 'viewer');
	}

	public function download($id = null) {
		$this->layout = 'ajax';
		if ( $this->request->is('post') ) {
			$this->Doodle->id = $this->request->data('id');
			$downloads = $this->Doodle->field('downloads');
			$downloads += 1;
			$this->Doodle->saveField('downloads', $downloads);
			$this->set('downloads', $downloads);
		}
	}
	
	public function viewer($id = null ) {
		$this->layout = 'ajax';
		//$this->autoRender = false;
		
		if ( $id == null ) {
			return;
		}
		
		$this->set('model', $this->Doodle->findById($id));
	}
	// Handle user upload page
	public function upload()
	{
		$this->Doodle->id = null;
		// Set up variables
		$categories = $this->Doodle->Category->find('list');
		$licenses = $this->Doodle->License->find('list');
		$user_id = $this->Auth->user('id');
		define('UPLOAD_DIR', '/tmp/');

		// Process incoming data
		if ($this->request->is('post')):
			// Set up things we need to zip files and push files to cloud... 
			$this->Zip = $this->Components->load('Stl');
			$this->CakeS3->permission('public_read');

			// Set up data to create new database row
			$data = $this->request->data;

			$files = $data ['Doodle'] ['StlFiles'];
			$name = $data ['Doodle'] ['name'];
			
			if ( $this->Zip->checkForStl( $files ) ): 
				unset($data['Doodle']['StlFiles']);
				// Set up user id
				$data ['Doodle']['user_id'] = $user_id;
				$this->Doodle->create();
				$newDoodle = $this->Doodle->Save($data);
	
				if (!empty($newDoodle)):
	
					// get lastInsertId to create paths for files
					$newId = $this->Doodle->id;
					$data['Doodle']['id'] = $newId;
	
					// set the path of the new directory to a variable then make the directory
					$filePath = WWW_ROOT . 'files' . DS . $newId;
					mkdir($filePath, 0777);
	
					$filePath .= DS;    // add last directory seperator since mkdir barfs at having the trailing /
					$fileNames = array();    // empty array to handle the names of the STL files. used to help determine if we need a zip file
					$data  ['StlFile'] = array();    // empty array to save StlFiles to database
	
					// Generate array for STLFiles and pictures
					foreach ($files as $file):
						$file['name'] = strtolower($file['name']);
						if ($this->Zip->stlCheck($file)):
	
							if (move_uploaded_file($file['tmp_name'], $filePath . $file['name'])):
								$data ['StlFile'] [] = array(
									'name' => $name,
									'file' => $file ['name']
								);
								$response = $this->CakeS3->putObject($filePath . $file['name'], $newId . DS . basename($file['name']), $this->CakeS3->permission('public_read'));
								if ($response == false):
									$this->Session->setFlash(__('Could not upload ' . $file['name']));
								endif;
								$fileNames[] = $filePath . $file['name'];
							else:
								$this->Session->setFlash(__('Could not upload ' . $file['name']));
							endif;
						elseif ($this->Zip->imageCheck($file)):
							if (move_uploaded_file($file['tmp_name'], $filePath . $file['name'])):
								$data['Picture'][] = array(
									'file_name' => $file ['name'],
									'user_id' => $user_id);
							else:
								$this->Session->setFlash(__('Could not upload ' . $file['name']));
							endif;
						endif;
					endforeach;
	
					// If more than one stl file was uploaded we need to zip the files and push them to the cloud
					if (count($fileNames) > 1):
						$zipName = $filePath . Inflector::slug(strtolower($name)) . '.zip';
						$this->Zip->createZip($fileNames, $zipName);
						$data['ZipFile'][] = array('name' => $name,
							'file' => basename($zipName));
						$response = $this->CakeS3->putObject($zipName, $newId . DS . basename($zipName), $this->CakeS3->permission('public_read'));
	
						if ($response == false):
							$this->Session->setFlash(__('Could not upload ' . basename($zipName)));
						endif;
					endif;
	
					if ($this->Doodle->saveAssociated($data)):
						$this->Session->setFlash(__('Model has been uploaded'), 'default', array('class' => 'success'));
						$this->redirect(array('action' => 'view', $newId));
					endif;
	
				endif; // empty( newDoodle) 
				
			else:
				$this->Session->setFlash(__('Please upload at least one STL file to continue.'));
			endif;

		endif;

		// Set categories, licenses and public arrays for view
		$this->set(compact('categories'));
		$this->set(compact('licenses'));
		$this->set('public', array(
			'Private',
			'Public'
		));
	}

	public function picture($id = null)
	{
		if ($id == null):
			throw new BadRequestException('No Model');
		endif;


		if (!$this->Doodle->exists($id)):
			throw new BadRequestException('Model does not exist');
		endif;

		$this->Doodle->read(null, $id);

		$model = $this->Doodle->findById($id);
		$pictures = $this->Doodle->Picture->findByDoodleId($id);
		$user = $this->Auth->user('id');

		$this->set('model', $model);
		$this->set('pictures', $pictures);

		// Check to see if we have an admin or the owner uploading
		if ($this->Doodle->field('user_id') != $user && $this->Auth->user('role') != 'GAdmin') {
			throw new BadRequestException('You are not authorized to update this model');
		}

		if ($this->request->is('post')):
			$data = $this->request->data;
			define('UPLOAD_DIR', WWW_ROOT . DS . 'img' . DS . 'models' . DS . $id . DS); // increase validation - actually validation isn't easy because we are base64 at this point.
			if ( !( file_exists(UPLOAD_DIR) ) ):
				mkdir( UPLOAD_DIR );
			endif;
			$img = $data['dataUrl'];
			$img = str_replace('data:image/png;base64,', '', $img);
			$img = str_replace(' ', '+', $img);
			$image = base64_decode($img);
			$file = UPLOAD_DIR . $data['file'] . '.png'; // UPLOAD_DIR . uniqid() . '.png';
			$success = file_put_contents($file, $image);
			if ($success):
				$this->Doodle->Picture->create();
				$picture = array('Picture' => array(
					'file_name' => $data['file'] . '.png',
					'doodle_id' => $model['Doodle']['id'],
					'stl_file_id' => $data['file'],
					'user_id' => $user)
				);
				$databaseEntry = $this->Doodle->Picture->findByStlFileId( $data['file'] );
				if ( empty( $databaseEntry) ):
					$this->Doodle->Picture->save($picture);
					$this->redirect($this->referer());
				endif;
				
			endif;
		endif;
	}

	// View each individual model
	public function view($id = null)
	{
		// Make sure an id is set
		if ($id == null) {
			throw new NotFoundException('Invalid model, try again');
		}

		// Need to grab everything by model
		$this->Doodle->recursive = 2;

		// Find model by Id number
		$model = $this->Doodle->findById($id);

		// If not found, throw exception
		if (!($model)) {
			throw new NotFoundException('Invalid model, try again');
		}

		$this->Doodle->id = $model['Doodle']['id'];
		$this->Doodle->saveField('views', ++$model['Doodle']['views']);

		// Set page title to doodle name ( for SEO of course )
		$this->pageTitle = $model['Doodle']['name'] . " by " . $model['User']['username'] . " - Solidoodles";
		$this->set('meta_description', $model['Doodle']['name'] . " by " . $model['User']['username']);
		$this->set('model', $model);
	}

	public function delete($id = null)
	{
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}

		$this->Doodle->id = $id;

		// Do we have a valid model to delete?
		if (!$this->Doodle->exists()):
			$this->Session->setFlash(__('Could Not Delete'));
			$this->redirect(array('controller' => 'users', 'action' => 'uploads'));
		endif;

		// Do we own this model? 
		$owner = $this->Doodle->field('user_id');
		$role = $this->Auth->user('role');
		if ($owner == $this->Auth->user('id') || $role == 'GAdmin' || $role == 'Admin' ):
			$delete = $this->Doodle->delete();
			// Problem Deleting.
			if (empty($delete)):
				$this->Session->setFlash(__('Could Not Delete'));
				$this->redirect(array('controller' => 'users', 'action' => 'uploads'));
			endif;

			// Tell user everything is AOK and redirect to user uploads page
			$this->Session->setFlash(__("$delete has been deleted."));
			$this->redirect(array('controller' => 'users', 'action' => 'uploads'));
			exit();
		endif;
		$this->Session->setFlash(__('You do not have authorization to delete model'));
		$this->redirect(array('controller' => 'users', 'action' => 'uploads'));
	}

	public function index()
	{
		// Set featured model
		$featured = $this->Doodle->getFeatured();
		$this->set('featured', $featured);

		// only used to link to random model in the banner.
		$random = $this->Doodle->randomDoodle();
		$this->set('random', $random);

		$recent = $this->Doodle->find('all', array('order' => array('Doodle.created DESC'),
			'limit' => 5));
		$this->set('recent', $recent);
	}

	public function search($search = null)
	{
		// Allow searchs from GET parameters
		if ($search != null) {
			$results = $this->Doodle->search($search);

			if ($results == null) {
				$this->Session->setFlash(__('No Models found for ' . $search));
			}
		}

		if ($this->request->is('post')) {
			$results = $this->Doodle->search($this->request->data ['Doodle'] ['Search']);
			if ($results == null) {
				$this->Session->setFlash(__('No Models found for ' . $this->request->data ['Doodle'] ['Search']));
			}
		}

		$this->set('results', isset($results) ? $results : null);
	}

	public function newest()
	{
		$this->Paginator->settings = $this->paginate;
		$this->set('models', $this->Paginator->paginate('Doodle'));
	}

	public function featured()
	{
		$featured = $this->Doodle->getFeatured();
		$this->set('models', $featured);
	}

	public function feature( ) {
		$this->layout = 'ajax';

		if ( $this->request->is('post')  ) {
			$this->Session->setFlash(__('Invalid Model'));
			exit();
		}


	}
	public function beforeRender()
	{
		$this->set('title_for_layout', $this->pageTitle);
	}


}
