<?php

/*
 *  Student Class File
 * 
 */

/**
 * Student class
 *
 * The Student class that sets and gets the property values i.e. ID, Name, Gpa, PercentileRank
 *
 * @package Student
 *
 * @author Sai Krishna
 */
class Student {
	
	/**
	 * The Student properties
	 *
	 * @access private
	 * @var mixed
	 */
	
	private $id;
	private $name;
	private $gpa;
	private $percentileRank;


	/**
	 * Student class
	 *
	 * The Student class constructor that can store the values on class initialization.
	 *
	 * @param string
	 */
	
	function __construct($n_id='', $n_name='', $n_gpa='', $n_percentileRank='') {
		$this->id = $n_id;
		$this->name = $n_name;
		$this->gpa = $n_gpa;
		$this->percentileRank = $n_percentileRank;
	}

// -------------------------------------------------------------------------------------------------------------
	/**
	 *
	 * this method is used to pull the assigned value for Student Id
	 * @param null
	 * @return the mixed getter values like Student Id
	 */
	
	function getId() {
		return $this->id;
	}

	/**
	 * this method is used to pull the assigned value for Student Name
	 * @param null
	 * @return the mixed value for  Student Name
	 */
	
	function getName() {
		return $this->name;
	}
	
	/**
	 * this method is used to pull the assigned value for Student Gpa
	 * @param null
	 * @return the mixed value for Student Gpa
	 */

	function getGpa() {
		return $this->gpa;
	}
	
	/**
	 * this method is used to pull the assigned value for Student Percentle Rank
	 * @param null
	 * @return the mixed value for Student Percentile Rank
	 */
	
	function getPercentileRank() {
		return $this->percentileRank;
	}

// -------------------------------------------------------------------------------------------------------------

	/**
	 *
	 * this method is used to assign the student Id
	 * @param mixed input value
	 *  @return bool|NULL True if the value is set or Null
	 */
	
	function setId($n_id) {
		
		if(!empty($n_id)){		
			$this->id = $n_id;
			return true;
		}
	}
	
   /**
	* this method is used to assign the student Name
	* @param mixed input value
	* @return bool|NULL True if the value is set or Null
	*/

	function setName($n_name) {
		
		if(!empty($n_name)){
			$this->name = $n_name;
			return true;
		}
		return false;
	}

	/**
	 * this method is used to assign the student Gpa
	 * @param mixed input value
	 * @return bool|NULL True if the value is set or Null
	 */
	
	function setGpa($n_gpa) {
		
		if(!empty($n_gpa)){
			$this->gpa = $n_gpa;
			return true;
		}
		return false;
	}

	/**
	 * this method is used to assign the student Calculated Percentile Rank
	 * @param mixed - input value
	 * @return bool|NULL True if the value is set or Null
	 */

	function setPercentileRank($n_percentileRank) {
		
		if(!empty($n_percentileRank)){
			$this->percentileRank = $n_percentileRank;
			return true;
		}
		return false;
	}



}
