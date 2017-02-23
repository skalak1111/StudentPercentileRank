<?php
/**
 * StudentPercentileTest class
 *
 * The StudentPercentileTest class is implemented for unit testing using PhpUnit Framework. class StudentPercentile is being tested.
 *
 * @package StudentPercentileTest
 *
 * @author Sai Krishna
 */

class StudentPercentileTest extends PHPUnit_Framework_TestCase {

	protected $_object;
	protected $testfieldname;
	private $gpaList;
	private $sampleArray;

// -------------------------------------------------------------------------------------------------------------
	/**
	 *
	 * Creating the object to instantiate the StudentPercentile Class for usage with PHPUnit Methods
	 * Declared the sample or dummy array lists for passing them as an input to PHPUnit Methods.
	 */
	
	
	public function __construct(){
		$this->_object = new StudentPercentile();
		$this->gpaList = Array(1.60,3.50,3.90,3.50,2.20,3.60,2.70,2.30,3.70,3.50,2.70,2.70,1.80,2.90,3.80,2.40,3.60,3.50,2.20,3.60,3.50,2.20,3.60,2.20,3.70);
		$this->sampleArray = Array(
				Array 
				(
						"471908US",
						"Randy Perez",
						1.60
						),
				Array
				(
						"957625US",
						"Alice Brown",
						3.50
						),
				Array
				(
						"909401US",
						"Maria Russell",
						3.90
						),
				);
		
		
	}
	
// -------------------------------------------------------------------------------------------------------------
	/**
	 *
	 * Testing the "calculatePercentileRankFoundation" method which should return the arraylist type on various cases
	 */
	
	public function testcalculatePercentileRankFoundation() {
	
	
		$collection_interface_obj = $this->_object->studentObjectHandler($this->sampleArray);
		$this->assertEquals(3,count($this->_object->calculatePercentileRankFoundation($collection_interface_obj)));
		$this->assertInternalType('array',$this->_object->calculatePercentileRankFoundation($collection_interface_obj));
	
	}

// -------------------------------------------------------------------------------------------------------------
	/**
	 *
	 * Testing the "calculatePercentileRank" method for getting the percentile rank 
	 * by passing dummy parameters and should match the given percentile rank
	 * Rank calculated based on the "Wiki - Percentile Rank" Formula
	 */
	
	public function testcalculatePercentileRank(){

		$this->assertEquals(16,$this->_object->calculatePercentileRank("2","4","25"));
	}
	
// -------------------------------------------------------------------------------------------------------------
	/**
	 *
	 * Testing the "getAllGpa" method for pulling the count of the supplied gpa's, 
	 * by passing dummy array and should return the count and match the given sample valid value
	 * 
	 */
	
	public function testgetAllGpa(){

		$this->assertSame(3,count($this->_object->getAllGpa($this->sampleArray)));
	}

// -------------------------------------------------------------------------------------------------------------
	/**
	 *
	 * Testing the "getCountOfBelowGpa" method for pulling the count of the supplied below gpa's, 
	 * by passing dummy array and should return the count and match the given sample valid value
	 *
	 */
	public function testgetCountOfBelowGpa(){
		
		$this->assertEquals(2,$this->_object->getCountOfBelowGpa("2.2", $this->gpaList));
		
	}

// -------------------------------------------------------------------------------------------------------------
	/**
	 *
	 * Testing the "getFrequencyOfGpa" method for pulling the count of the supplied similar frequency gpa's,
	 * by passing dummy array and should return the count and match the given sample valid value
	 *
	 */
	
	public function testgetFrequencyOfGpa(){
		
		$this->assertEquals(4,$this->_object->getFrequencyOfGpa("2.2", $this->gpaList));
	}

// -------------------------------------------------------------------------------------------------------------
	/**
	 *
	 * Testing the "studentObjectHandler" method for pulling the array collection
	 * by passing dummy array and should return the results from "ArrayCollection" instance
	 *
	 */
	
	public function teststudentObjectHandler(){
	
		$this->assertInstanceOf("ArrayCollection",$this->_object->studentObjectHandler($this->sampleArray));
	}

// -------------------------------------------------------------------------------------------------------------
	/**
	 *
	 * Testing the "getRawDataFromCsv" method for pulling array object, 
	 * by calling the orginal method should match the count of student objects and type of return on various cases.
	 *
	 */
	
	public function testgetRawDataFromCsv(){
	
		$this->assertEquals(25,count($this->_object->getRawDataFromCsv()));
		$this->assertArrayHasKey(24,$this->_object->getRawDataFromCsv());
		$this->assertInternalType('array',$this->_object->getRawDataFromCsv());
	
	}
	
	
		
}