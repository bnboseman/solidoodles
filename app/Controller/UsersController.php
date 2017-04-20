<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class UsersController extends AppController {
	var $components = array('RequestHandler', 'Email');
	
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('register', 'logout', 'login', 'profile', 'confirm', 'reset', 'uploads');
    }

	public function edit() {

	}


    public function login() {
    	$referrer = $this->referer();
    	// Change recursive since we don't need all that info
    	$this->User->recursive = 0;
    	
    	// Check to see if form has been submitted
        if ($this->request->is('post')) {
        	$user = $this->User->findByUsername( $this->request->data['User']['username'] );

        	// Check to see if user has confirmed their account. Redirect to confirmation if not confirmed
        	if ($user['User']['role'] == 'Unconfirmed' && $this->Auth->login() ) {
        		$this->Auth->logout();
        		$this->Session->setFlash(__('Please confirm your account to login.'));
        		$this->redirect(array('action' => 'confirm'));
        		exit();
        	}

        	// Check to see if user has password from old account and update password encryption
        	$user = $this->User->find('first', array('conditions' => array(
        			'password' => Security::hash( $this->request->data['User']['password'], 'sha1', true ),
        			'username' => $this->request->data['User']['username'] ) ) );
        	
        	if ( !empty($user ) ):
        		$this->User->id = $user['User']['id'];
        		$this->User->saveField('password', $this->request->data['User']['password'] );
        	endif;

        	// Try to log them in and redirect to where they are trying to get
            if ($this->Auth->login()) {
            	$this->Session->setFlash('You have been successfully logged in.', 'default', array('class' =>'success'));
            	
            	// Redirect to homepage if they are coming from the login page
            	if ($referrer == "http://solidoodles.localhost/Users/login") {
            		$this->redirect(  '/' );
            	} else {
            		$this->redirect($this->referer() );
            	}
            	
                
            }
            
            // Let them know they cannot login
            $this->Session->setFlash(__('Invalid username or password. Try again'));
        } else {
        	// If user is already logged in redirect them to where they came from
        	if ( $this->Auth->user() ) {
        		$this->redirect("/");
        	}
        }
    }
    
    public function uploads( $id = null) {
    	// If the user is not logged in and no ID is set redirect to login page
    	if ($id == null && $this->Auth->user() == null ) {
    		$this->Session->setFlash(__( 'Login to view your models'));
    		$this->redirect( array( 'action' => 'login', 'controller' =>'users'));
    		
    	// If the user is logged in and no id is set, get that users models to display
    	}  else if ( $id == null ) {
    		$id = $this->Auth->user('username');
    		$doodles = $this->User->getUserDoodles( $this->Auth->user('id') );
    		
    	// If an ID is set get the models of the user who's page we are visiting
    	} else {
    		$doodles = $this->User->getUserDoodles( $this->User->getUserInfo( $id, 'id') );
    	}
    	
    	// If nothing is returned the user has not uploaded anything. Redirect to users profile page
    	if ( empty($doodles ) ) {
    		$this->Session->setFlash ($id . ' has not uploaded any models');
    	}
    	$this->set('models', $doodles);
    	$this->set('user', $id);
    }
    
    public function register() {
        if ($this->request->is('post')) {
        	$data = $this->request->data;
        	
        	$data['User']['location'] = $this->__ip_info('184.152.53.88', "Country"); 
            $this->User->set($data );
            $message = '';
            if ( $data['User']['terms-of-use']  != 1 ) {
            	$message = __("Please accept the terms of service.<br />");
            }  else {
            	// Generate a random string for user confirmation
            	$data['User']['reset'] = Security::generateAuthKey();
            	$confirmationLink =  FULL_BASE_URL . '/users/confirm/' . $data['User']['reset'];
            	// Save user, tell them to confirm to login
            	if ($this->User->save($data)) {
            		$email = new CakeEmail();
            		$email->from( array('support@solidoodle.com' => 'Solidoodles Support'));
            		$email->to( $data['User']['email'] );
            		$email->Subject( 'Confirm Solidoodles Account');
            		$email->send("Please confirm your account to login by visiting $confirmationLink");
            		$this->Session->setFlash(__("The user {$data['User']['username']} has been created. An email has been sent to {$data['User']['email']}. Please confirm your account to login"), 'default', array('class' =>'success'));
            		$this->redirect(array('action' => 'confirm'));
            		exit();
            	}
            }
           
            $message .= __('The user could not be saved. Please try again.');
            $this->Session->setFlash($message);
        }
    }
    
    public function confirm($key = null)
    {
	if ( $this->Auth->user() ):
		$this->redirect(array('action' => 'profile') );
	endif;

        $user = null;

        // Do we have a key to confirm?
        if (isset($key)):
            $user = $this->User->findByReset($key);

            if (!empty($user)):
                $this->User->id = $user['User']['id'];
                $this->User->saveField('reset', null);
                $this->User->saveField('role', 'User');
                $this->Session->setFlash(__('User has been confirmed. Please login to continue'), 'default', array('class' =>'success'));
                $this->redirect(array('action' => 'login'));
            else:
                $this->Session->setFlash('Account could not be confirmed.');
            endif;
        endif;

        if ($this->request->is('post')): 
            $user = $this->User->findByEmail( $this->request->data['User']['email'] );
	    $this->User->id = $user['User']['id'];

            if (empty($user)):
                $this->Session->setFlash('Could not process request');
            else:
		if ($user['User']['role'] != 'Unconfirmed' ):
			$this->Session->setFlash('User account has already been confirmed. Please login to continue.');
			$this->redirect(array('action' => 'login' ) );
		endif;
		if (empty( $user['User']['reset'])  ):	
			$user['User']['reset'] = Security::generateAuthKey();
			$this->User->saveField('reset', $user['User']['reset'] );
		endif;
		$confirmationLink = FULL_BASE_URL . '/users/confirm/' . $user['User']['reset']; 
                $email = new CakeEmail();
                $email->from( array('support@solidoodle.com' => 'Solidoodles Support'));
                $email->to( $user['User']['email'] );
                $email->Subject( 'Confirm Solidoodles Account');
                $email->send("Please confirm your account to login by visiting $confirmationLink");
                $this->Session->setFlash(__("An email has been sent to {$user['User']['email']}. Please confirm your account to login"), 'default', array('class' => 'success'));
                $this->redirect(array('action' => 'confirm'));
                exit();
            endif;
        endif;
    }
    
    public function reset( $key = null) {
    	if ( $this->Auth->user() ):
    		$this->Session->setFlash('Can not reset password because you are already logged in');
    		$this->redirect( array( 'action' => 'profile'));
    	endif;
    	
    	if ( $key != null ):
    		$user = $this->User->findByReset( $key );
    		if (empty($user) ):
    			$this->Session->setFlash('Invalid key');
    		else:
    		$this->User->id = $user['User']['id'];
    			$this->render('changePassword');
    		
	    		if ( $this->request->is('post') ):
	    			if( $this->User->validates( ) ):
	    				$this->User->saveField('reset', null);
	    				$this->User->saveField('password', $this->request->data['User']['password'] ); 
	    				$this->Session->setFlash('Your password has been updated', 'default', array('class' =>'success'));
	    				$this->redirect(array('action'=>'login'));
	    			endif;
	    		endif;
    		endif;
    	endif;
    	
    	// If there is no key set and post data, get the user by email
    	if ( $this->request->is('post') ):
    		$user = $this->User->findByEmail($this->request->data['User']['email']);
    		
    		if ( empty($user ) ):
    			$this->Session->setFlash('Could not process request');
    		else:
    			$this->User->id = $user['User']['id'];
    			$resetKey = Security::generateAuthKey();
    			$this->User->saveField('reset', $resetKey);
    			$confirmationLink =  FULL_BASE_URL . '/users/reset/' . $resetKey;
    			// Save user, tell them to confirm to login
    			$email = new CakeEmail();
    			$email->from( array('support@solidoodle.com' => 'Solidoodles Support'));
    			$email->to( $user['User']['email'] );
    			$email->Subject( 'Solidoodles Account Reset');
    			$email->send("This e-mail confirms your request to reset your password. Please click on the link below and enter your new password (you can also paste the link into your browser). 
    					
    					$confirmationLink");
    			$this->Session->setFlash(__("An email has been sent to {$this->request->data['User']['email']} with instructions on how to reset your password."), 'default', array('class' => 'success'));
    			$this->render('resetSent');
    		endif;
    		
    		
    	endif;
    	
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }
    
    public function profile( $id = null ) {
    	// If the id isn't set and the user is not logged in redirect to login page
        if ( $id == null && $this->Auth->user() == null ):
            $this->Session->setFlash(__('Please login to view your profile'));
            $this->redirect(array('controller'=>'users', 'action' =>'login'));
            exit();
        endif; 
        
        $this->User->recursive = 2; 
        
        // if the ID is null, get the page for the current logged in user
        if ( $id == null ):
            $id = $this->Auth->user('username');
        endif;

        $user = $this->User->find('first', array('conditions' => array('User.username'=>$id))); 
        if ( empty( $user ) ):
        	$this->Session->setFlash(__('User does not exist.'));
        	$this->redirect('/');
        endif;
        
        $favorites = $this->User->getUserFavorites( $user['User']['id'] );
        $this->set('user', $user);
        $this->set('favortes', $favorites);
    }
    
    private function __ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE) {
    $output = NULL;
    if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
        $ip = $_SERVER["REMOTE_ADDR"];
        if ($deep_detect) {
            if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
    }
    $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
    $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
    $continents = array(
        "AF" => "Africa",
        "AN" => "Antarctica",
        "AS" => "Asia",
        "EU" => "Europe",
        "OC" => "Australia (Oceania)",
        "NA" => "North America",
        "SA" => "South America"
    );
    if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
        $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
        if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
            switch ($purpose) {
                case "location":
                    $output = array(
                        "city"           => @$ipdat->geoplugin_city,
                        "state"          => @$ipdat->geoplugin_regionName,
                        "country"        => @$ipdat->geoplugin_countryName,
                        "country_code"   => @$ipdat->geoplugin_countryCode,
                        "continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                        "continent_code" => @$ipdat->geoplugin_continentCode
                    );
                    break;
                case "address":
                    $address = array($ipdat->geoplugin_countryName);
                    if (@strlen($ipdat->geoplugin_regionName) >= 1)
                        $address[] = $ipdat->geoplugin_regionName;
                    if (@strlen($ipdat->geoplugin_city) >= 1)
                        $address[] = $ipdat->geoplugin_city;
                    $output = implode(", ", array_reverse($address));
                    break;
                case "city":
                    $output = @$ipdat->geoplugin_city;
                    break;
                case "state":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "region":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "country":
                    $output = @$ipdat->geoplugin_countryName;
                    break;
                case "countrycode":
                    $output = @$ipdat->geoplugin_countryCode;
                    break;
            }
        }
    }
    return $output;
}
    
}
