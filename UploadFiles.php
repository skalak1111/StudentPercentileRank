<?php

/*
 *  UploadFiles Class File
 *
 */

/**
 * UploadFiles class
 *
 * The UploadFiles class that serves as a utility class in handling all the file related actions
 *
 * @package UploadFiles
 *
 * @author Sai Krishna
 */
class UploadFiles {

	/**
	 * The UploadFiles properties
	 *
	 * @access private
	 * @var mixed
	 */
	
	private $fileName;
	private $tmpName;
	private $error;
	private $uploadDir;
	private $ext;
	private $doc_root;
	
   /**
	* @var constant
	*/
	const UPLOADED_FILENAME = "data.csv";
	const ACEEPTED_EXT_TYPE = array('csv');
	const DESTINATION_FOLDER = "uploads/";
	
	
	/**
	 * UploadFiles class
	 *
	 * The UploadFiles class constructor that can store the upload directory value on class initialization and can be available throughout the class methods.
	 *
	 * @param string $n_uploadDir
	 */
	
	public function __construct($n_uploadDir) {
		$this->doc_root = __DIR__;
		$this->uploadDir = $n_uploadDir;
		return true;
		
	}

// -------------------------------------------------------------------------------------------------------------
	/**
	 *
	 * In the context of the UploadFiles class, returns the assigned value for File Name
	 * @param null
	 * @return the mixed value for File name
	 */
	
	public function getFileName(){
		return $this->fileName;
	}
	
	/**
	 *
	 * In the context of the UploadFiles class, returns the assigned value for File temporary location name
	 * @param null
	 * @return the mixed value for File temporary location name
	 */
	
	public function getTmpName(){
		return $this->tmpName;
	}
	
	/**
	 *
	 * In the context of the UploadFiles class, returns the assigned value for File extension
	 * @param null
	 * @return the mixed value for File extension
	 */
	
	public function getExt(){
		return $this->ext;
	}
	
	/**
	 *
	 * In the context of the UploadFiles class, returns the assigned value for File error number
	 * @param null
	 * @return the mixed value for File error number
	 */
	
	public function getError(){
		return $this->error;
	}
	
	/**
	 *
	 * In the context of the UploadFiles class, returns the assigned value for File upload directory
	 * @param null
	 * @return the mixed value for File upload directory
	 */
	
	public function getUploadDir(){
		return $this->uploadDir;
	}
	
// -------------------------------------------------------------------------------------------------------------

	/**
	 * In the context of the UploadFiles class, sets the File Name
	 * @param string input value - $n_fileName
	 * @return bool|NULL True if the value is set or Null
	 */
	
	public function setFileName($n_fileName){

		if(!empty($n_fileName)){
			$this->fileName = $n_fileName;
			return true;
		}
	}
	
	/**
	 * In the context of the UploadFiles class, sets the File temporary location Name
	 * @param string input value - n_tmpName
	 * @return bool|NULL True if the value is set or Null
	 */
	
	
	public function setTmpName($n_tmpName){
		
		if(!empty($n_tmpName)){
		 	$this->tmpName = $n_tmpName;
		 	return true;
		 }
	}

	/**
	 * In the context of the UploadFiles class, sets the File extension 
	 * @param string input value
	 * @return bool|NULL True if the value is set or Null
	 */
	
	
	public function setExt($n_ext){
		
		if(!empty($n_ext)){
			$this->ext = $n_ext;
		 	return true;
		}
	}

	/**
	 * In the context of the UploadFiles class, sets the File error number related to file size. To check whether the uploaded file is a valid one.
	 * @param string input value
	 * @return bool|NULL True if the value is set or Null
	 */
	
	
	public function setError($n_error){
		
		if(!empty($n_error)){
			$this->error = $n_error;
		 	return true;
		}
	}
	
// -------------------------------------------------------------------------------------------------------------

	/**
	 *
	 * This method will checks whether the project folder has the directory created for holding uploaded csv files
	 * return the bool on it. Otherwise it will throw an error.
	 * If the folder or directory is not created, it will throw error.
	 *
	 * @param string $n_uploadDir
	 * @return bool|Error
	 */
	
	public function checkDirectory($n_uploadDir){
		
		if (!file_exists($this->doc_root."/".$n_uploadDir) || !is_dir($this->doc_root."/".$n_uploadDir)) {
			try {
				
			return mkdir($this->doc_root."/".$n_uploadDir, 0755, true);
			
			 } catch (Exception $e) {
				
            throw new Exception("Could not create the directory. Please check permissions of the folder", 0, $e);
           
        	} 
		}
		return true;
	}
	
// -------------------------------------------------------------------------------------------------------------
	/**
	 *
	 * This method will checks whether the uploaded file is of csv format, destination folder is already created or not for holding uploaded csv files
	 * return the bool on it. Otherwise it will throw an error.
	 * If the folder or directory is not created, it will throw error.
	 * If the fild is not of csv format, it will throw error.
	 *
	 * @param string $n_fileName - provide file name
	 * @param string $n_tmpName - provide the temporary location of the uploaded file
	 * @param string $n_error - provide the error number of the uploaded file
	 * @return bool
	 */
	
	public function uploaded($n_fileName, $n_tmpName, $n_error) { 
		
		$this->setFileName($n_fileName);
		$this->setTmpName($n_tmpName);
		$this->setError($n_error);
		
		//get the extension, out from the file name uploaded.
		$this->setExt(pathinfo($this->getFileName(), PATHINFO_EXTENSION));
 
		//checking the type of the uploaded file from the array list of allowed extensions.
		if (in_array($this->getExt(), self::ACEEPTED_EXT_TYPE)) {
			
			if ($this->getError() == 0) { //making sure that the uploaded file is error free.
				
				$this->checkDirectory($this->getUploadDir());
				
				try { //throw exception if can't move the file
						
						$this->handleUpload($this->getTmpName(), $this->doc_root."/".$this->getUploadDir() . self::UPLOADED_FILENAME);
						return true;
							
					} catch (Exception $e) {
						throw new Exception('File did not upload: ' . $e->getMessage());
						
					}
			} else
				return false;
		} else 
			return false;
	}

// -------------------------------------------------------------------------------------------------------------
	/**
	 *
	 * This method will move the file to the destination folder.  Otherwise it will throw an error.
	 *
	 * @param string $n_tmpName - provide the temporary location of the uploaded file
	 * @param string $n_destinationPath - provide the destination folder of the uploading file
	 * @return bool
	 */
	//file upload process, copying the file from temporary location to actual "uploads" directory in project root folder.
	
	public function handleUpload($n_tmpName, $n_destinationPath) {
	//echo $n_tmpName. $n_destinationPath; 
		//$move = move_uploaded_file($n_tmpName, $n_destinationPath);
		$move = copy($n_tmpName, $n_destinationPath);
		if (!$move) {
			throw new Exception('Could not able to upload the file. Try again.');
		}
		return true;
	
	}
	 

}
