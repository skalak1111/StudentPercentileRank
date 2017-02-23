<?php
/**
 * StudentTest class
 *
 * The Student test class implements the unit tests for the Student Class functionality or methods using phpunit Framework
 *
 * @package Student
 *
 * @author Sai Krishna
 */


class StudentTest extends PHPUnit_Framework_TestCase {
	
	private $studentObj; 

// -------------------------------------------------------------------------------------------------------------
	/**
	 *
	 * Creating the object to instantiate the Student Class for usage with PHPUnit Methods
	 */
	
	public function __construct(){
		$this->studentObj = new Student();
	}
	
// -------------------------------------------------------------------------------------------------------------
	/**
	 *
	 * Testing the method which is used to pull the assigned value and assign the value for Student Id on various cases
	 */
	
	public function testGetId() {
		
		$this -> assertTrue($this->studentObj -> setId(8));
		$this -> assertEquals("8",$this->studentObj -> getId());
		
		$this -> assertNull($this->studentObj -> setId(""));
		$this -> assertNull(Null,$this->studentObj -> getId());
		
	}
	
// -------------------------------------------------------------------------------------------------------------
	/**
	 *
	 * Testing the method which is used to pull the assigned value and assign the value for Student Name on various cases
	 */
	
	public function testsetName(){
		
		$this -> assertTrue($this->studentObj -> setName("Sai Krishna"));
		$this -> assertEquals("Sai Krishna", $this->studentObj -> getName());
		
	}
	
// -------------------------------------------------------------------------------------------------------------
	/**
	 *
	 * Testing the method which is used to pull the assigned value and assign the value for Student Gpa on various cases
	 */
	
	public function testsetGpa(){
		
		$this -> assertTrue($this->studentObj -> setGpa("2.8"));
		$this -> assertSame("2.8",$this->studentObj->getGpa());
		
		
	}

// -------------------------------------------------------------------------------------------------------------
	/**
	 *
	 * Testing the method which is used to pull the assigned value and assign the value for Student Percentile Rank on various cases
	 */
	
	public function testsetPercntileRank(){
		$this -> assertTrue($this->studentObj->setPercentileRank("50"));
		$this -> assertSame("50",$this->studentObj->getPercentileRank());
	}
}