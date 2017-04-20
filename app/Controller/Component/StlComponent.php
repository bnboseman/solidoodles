<?php
App::uses('Component', 'Controller');

class StlComponent extends Component
{

	/* creates a compressed zip file */
	function createZip($files = array(), $destination = '/files/', $overwrite = false)
	{
		//if the zip file already exists and overwrite is false, return false
		if (file_exists($destination) && !$overwrite):
			return false;
		endif;

		$valid_files = array();

		//if files were passed in...
		if (is_array($files)):
			//cycle through each file
			foreach ($files as $file):
				//make sure the file exists
				if (file_exists($file)):
					$valid_files[] = $file;
				endif;
			endforeach;
		endif;

		//if we have good files...
		if (count($valid_files)):
			//create the archive
			$zip = new ZipArchive();
			if ($zip->open($destination, $overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true):
				return false;
			endif;
			//add the files
			foreach ($valid_files as $file):
				$zip->addFile($file, basename($file));
			endforeach;
			//debug
			//echo 'The zip archive contains ',$zip->numFiles,' files with a status of ',$zip->status;
			//close the zip -- done!
			$zip->close();
			//check to make sure the file exists
			return file_exists($destination);
		else:
			return false;
		endif;
	}

	function stlCheck($file)
	{
		if (substr(strtolower($file['name']), -4) != '.stl') {
			return false;
		}

		if ($file['type'] == 'application/sla' ||
			$file['type'] == 'application/octet-stream' ||
			$file['type'] == 'text/plain' ||
			$file['type'] == 'application/unknown' ||
			$file['type'] == 'application/netfabb'
		) {
			return true;
		}

		return false;
	}

	function imageCheck($file)
	{
		$image = getimagesize($file['tmp_name']);
		$image_type = $image[2];

		if (in_array($image_type, array(IMAGETYPE_JPEG, IMAGETYPE_PNG))) {
			return true;
		}
		return false;
	}
	
	function checkForStl( $files ) {
		foreach( $files as $file ):
			if ( $this->stlCheck( $file ) ):
				return true;
			endif;
		endforeach;
		
		return false;
	}
}