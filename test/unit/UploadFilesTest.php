<?php
/**
 * UploadFilesTest class
 *
 * The UploadFilesTest class is implemented for unit testing using PhpUnit. class UploadFiles is being tested.
 *
 * @package UploadFilesTest
 *
 * @author Sai Krishna
 */

class UploadFilesTest extends PHPUnit_Framework_TestCase {
	
	protected $_object;
	protected $testfieldname;
	private $doc_root;

// -------------------------------------------------------------------------------------------------------------
	/**
	 *
	 * Testing the "checkDirectory" method for creating the supplied directory for storing the file uploads,
	 * by passing desired directory paths and should check for the directory and then create if not exists.
	 *
	 */
	
	public function testcheckDirectory(){
		
		$testDirectoryObj = new UploadFiles('uploads/tests');
		$this->assertTrue($testDirectoryObj->checkDirectory('uploads/tests'));
	}


// -------------------------------------------------------------------------------------------------------------
	/**
	 *
	 ** Testing the "uploaded" method for creating the supplied data file,
	 * by passing sample data in an array format, the method should be able to create the sample file in the given directory under tests folder.
	 *
	 */
	
	public function testuploaded()
	{	
		$this->doc_root =  __DIR__;
		$this->_object = new UploadFiles('uploads/tests/');
		
				$uploadcsv = array(
						'test' =>
							array(
								'name' => 'data.csv', 
								'tmp_name' => $this->doc_root . '\uploads\test\data.csv',
								'error' => 0,
						),
				); 
		$this->assertTrue($this->_object->uploaded($uploadcsv['test']['name'], $uploadcsv['test']['tmp_name'], $uploadcsv['test']['error']));
	} 
}