<?php
App::uses ( 'AppModel', 'Model' );
/**
 * Doodle Model
 *
 * @property User $User
 * @property License $License
 * @property Category $Category
 * @property Favorite $Favorite
 * @property Feature $Feature
 * @property Like $Like
 * @property Picture $Picture
 * @property StlFile $StlFile
 * @property Tag $Tag
 */
class Doodle extends AppModel {
	public $displayField = 'name';
	
	// Use Tag behavior to automatically save tags from a space seperated string
	public $actsAs = array (
			'Tag' => array (
					'table_label' => 'tags',
					'tags_label' => 'tag',
					'separator' => ',' 
			) 
	);
	
	public $validate = array (
			'name' => array (
					'notEmpty' => array (
							'rule' => array (
									'notEmpty' 
							),
							'messgage' => 'A name for your Solidoodle is required!'
					) 
			),
			'user_id' => array (
					'notEmpty' => array (
							'rule' => array (
									'notEmpty' 
							) 
					) 
			),
			'description' =>  array (
					'notEmpty' => array (
							'rule' => array (
									'notEmpty' 
							),
							'message' => 'A description for your Solidoodle is required!'
					) 
			),
			'license_id' => array (
					'notEmpty' => array (
							'rule' => array (
									'notEmpty' 
							),
							'message' => 'Please select a license for your Solidoodle' 
					) 
			),
			'category_id' => array (
					'notEmpty' => array (
							'rule' => array (
									'notEmpty'
							),
							'message' => 'You must select a category'
					)
			),
			'disabled' => array (
					'boolean' => array (
							'rule' => array (
									'boolean' 
							) 
					) 
			),
			'public' => array (
					'boolean' => array (
							'rule' => array (
									'boolean' 
							) 
					) 
			) 
	);
	
	public $belongsTo = array (
			'User' => array (
					'className' => 'User',
					'foreignKey' => 'user_id' 
			),
			'License' => array (
					'className' => 'License',
					'foreignKey' => 'license_id' 
			),
			'Category' => array (
					'className' => 'Category',
					'foreignKey' => 'category_id' 
			),
			'DefaultPicture' => array (
					'className' => 'Picture',
					'foreignKey' => 'picture_id'
			)
	);
	
	public $hasMany = array (
			'Favorite' => array (
					'className' => 'Favorite',
					'foreignKey' => 'doodle_id',
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
			'Comments' => array (
					'className' => 'Comment',
					'foreignKey' => 'doodle_id',
					'dependent' => false,
					'conditions' => 'Comments.soft_delete != 1',
					'fields' => '',
					'order' => '',
					'limit' => '',
					'offset' => '',
					'exclusive' => '',
					'finderQuery' => '',
					'counterQuery' => '' 
			),
			'Feature' => array (
					'className' => 'Feature',
					'foreignKey' => 'doodle_id',
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
			'Likes' => array (
					'className' => 'Like',
					'foreignKey' => 'doodle_id',
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
			'Picture' => array (
					'className' => 'Picture',
					'foreignKey' => 'doodle_id',
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
			'StlFile' => array (
					'className' => 'StlFile',
					'foreignKey' => 'doodle_id',
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
        'ZipFile' => array (
            'className' => 'ZipFile',
            'foreignKey' => 'doodle_id',
            'dependent' => false,
            'conditions' => array('ZipFile.deleted' => false),
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );
	
	public $hasAndBelongsToMany = array (
			'Tag' => array (
					'className' => 'Tag',
					'joinTable' => 'tags_doodles',
					'foreignKey' => 'doodle_id',
					'associationForeignKey' => 'tag_id',
					'unique' => true,
					'conditions' => '',
					'fields' => '',
					'order' => '',
					'limit' => '',
					'offset' => '',
					'finderQuery' => '' 
			) 
	);
	
	// By default we only want doodles that aren't disabled or deleted when we find
	public function beforeFind($query) {
		$query ['conditions'] ['Doodle.disabled'] = false;
		$query ['conditions'] ['Doodle.deleted'] = false;
		return $query;
	}
	
	// Set up find to link to download file
	public function afterFind( $results, $primary = false ) {
		if( array_key_exists(0, $results )):
			foreach ($results as $key => $val):
				if( isset($results[$key] ['Doodle']['id']) ) $results[$key] ['Doodle']['link'] = "https://s3.amazonaws.com/solidoodles/{$results[$key] ['Doodle']['id']}/" . $this->getDownloadFile( $results[$key] ['Doodle']['id']);
			endforeach;
		elseif ( $results != null ):
			$results['link'] = "https://s3.amazonaws.com/solidoodles/{$results['id']}/" .  $this->getDownloadFile( $results['id']);
		endif;
		return $results;
	}
	
	// Function to returned all featured doodles.
	public function getFeatured() {
		$options ['joins'] = array (
				array (
						'table' => 'features',
						'alias' => 'Feature',
						'type' => 'INNER',
						'conditions' => array (
								'Feature.doodle_id = Doodle.id',
								'Doodle.deleted' => false,
								'Doodle.disabled' => false 
						) 
				) 
		);
		$featured = $this->find ( 'all', $options );
		
		return $featured;
	}
	
	// Function to return a random doodle
	public function randomDoodle() {
		return $this->find ( 'first', array (
				'order' => 'rand()' 
		) );
	}
	
	public function getDownloadFile( $id = null ) {
		// return null if we don't have an ID
		if ($id == null):
			return null;
		endif;
		
		// Find all stl files by id
		$this->StlFile->recursive = -1;
		$this->ZipFile->recursive = -1;
		
		$zipFile = $this->ZipFile->findAllByDoodleId( $id );
		if ( !(empty ($zipFile) ) ) {
			return $zipFile[0]['ZipFile']['file'];
		}
		
		$files = $this->StlFile->findAllByDoodleId( $id );
		
		// return either null if empty, the file if only one, or the zip file if more than one file
		if (empty( $files) ) {
			return null;
		}
		
		if ( count( $files) == 1 ): 
			return $files[0]['StlFile']['file'];
		endif;
		
		foreach( $files as $file ) {
			if (substr( $file['StlFile']['file'], -4) == '.zip') {
				return $file['StlFile']['file'];
			}
		}
		
		return null;
	}
	
	// processes searching for models by name, description and tags.
	public function search($search = null) {
		$tags = explode ( " ", $search );
		$results = array ();
		$keywords = $this->_filterSearch( $search );
		if ($search == null) {
			return null;
		} 
		
		// First search for exact title or description match, then tags
		$results = array_merge( $results, $this->findAllByName( $search ) );
		
		// Search doodle description
		$results = array_merge( $results, $this->findAllByDescription( $search ) );
		
		foreach ( $tags as $tag ):
			$results = array_merge ( $results, $this->find ( 'all', array (
					'joins' => $this->generateHabtmJoin ( 'Tag', 'INNER' ),
					'conditions' => array (
							'Tag.tag' => $tag
					)
			) ) );
		endforeach;
		
		// Process search for keywords, see if search terms are found in either title or description
		foreach ( $keywords as $keyword ):
			$results = array_merge ( $results, $this->find ( 'all', array (
					'conditions' => array (
							"MATCH (Doodle.name, Doodle.description) AGAINST('{$keyword}' IN BOOLEAN MODE)"
					) ) ) );
			/*$results = array_merge ( $results, $this->find ( 'all', array (
				'conditions' => array (
						'Doodle.description LIKE' => "% $keyword %"
				) ) ) ); */
		endforeach; 
		
		// remove duplicates from the results and return
		return array_map ( "unserialize", array_unique ( array_map ( "serialize", $results ) ) );
	}
	
	public function getDoodlesByTag( $tag ) {
		return $this->find ( 'all', array (
				'joins' => $this->generateHabtmJoin ( 'Tag', 'INNER' ),
				'conditions' => array (
						'Tag.tag' => $tag
		) ) );
	}
	private function _filterSearch($query){
	    $query = trim(preg_replace("/(\s+)+/", " ", $query));
	    $words = array();
	    
	    // expand this list with your words.
	    $list = array("in","it","a","the","of","or","I","you","he","me","us","they","she","to","but","that","this","those","then");
	    $c = 0;	// number of words found
	    
	    foreach(explode(" ", $query) as $key):
	        if (in_array($key, $list) ):
	            continue;
	        endif;
	        $words[] = $key;
	        
	        // stop processing if we have more than 15 words
	        if ($c >= 15):
	            break;
	        endif;
	        
	        $c++;
	    endforeach;
	    
	    return $words;
	}
	
	// function to zip up new files
	private function _zipFiles() {
		
	}
	
	public function delete( $id = null, $cascade = true ) {
		if( $id == null ):
			$id = $this->id;
		endif;
		
		if ( $id != null ):
			$this->StlFile->updateAll(array('StlFile.deleted' => true),
							array('Doodle.id' => $id) );
		$this->Picture->updateAll(array('Picture.deleted' => true),
				array('Doodle.id' => $id) );
		$this->updateAll(array('Doodle.deleted' => true),
				array('Doodle.id' => $id) );
		return true;
		endif;
	}
}
