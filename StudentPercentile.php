<?php

/*
 *  StudentPercentile Class File
 *
 */

/**
 * StudentPercentile class
 *
 * The StudentPercentile class which is implementing the PercentileRank interface,  plays major role in calculating the percentile rank of individual students.
 *
 * @package StudentPercentile
 *
 * @author Sai Krishna
 */


// inluding the required classes. Array Collection is a general class collection imported from external php class resources.
require_once 'interfaces/percentileRank.php';
require_once 'ArrayCollection.php';
require_once 'Student.php';

class StudentPercentile implements PercentileRank{
	
	/**
	 * The StudentPercentile properties
	 *
	 * @access private
	 * @var string
	 */
	
	private $record;
	private $gpa;
	private $gpaCollection;
	private $percentileRank;
	private $belowGpa;
	private $sameGpa;
	private $totalStudents;
	private $collectData;
	
	/**
	 * StudentPercentile class
	 *
	 * The StudentPercentile class constructor that can store the gpa collection values on class initialization and can be available throughout the class methods.
	 *
	 * @param string $n_gpaCollection
	 * @param string $n_gpa
	 */
	
	 public function __construct($n_gpaCollection="", $n_gpa=""){
		
		$this->gpaCollection = $n_gpaCollection;
		$this->gpa = $n_gpa;
		
	}
	
// -------------------------------------------------------------------------------------------------------------
	
	/**
	 *@method objectHandler
	 * This method will gets the data in an array format from the recent uploaded csv file. Then creates the student objects using Student Class.
	 * returns the student objects from StudentObjectHandler method.
	 *
	 * @access public
	 * @return object - Student class 
	 */
	
	public function objectHandler(){
		
		//gets the data from the csv Data file.
		$dataInArray = $this->getRawDataFromCsv();
		return $getStudentObject = $this->studentObjectHandler($dataInArray);
	}

// -------------------------------------------------------------------------------------------------------------
	
	/**
	 *@method calculatePercentileRankFoundation
	 * This method is the foundation or build for the complete calculation of the percentile rank for individual student
	 * Scope of this build starts from supplying the csv data, gpa sorting, percentilerank calculation, creating student objects, creating the collection.
	 *
	 * @access public
	 * @param CollectionInterface $collection
	 * @return ArrayCollection data for student objects
	 */
	
	public function calculatePercentileRankFoundation(CollectionInterface $collection) {
		
		//calling getAllGpa method to get an arraylist with only gpa of students.
		$this->gpaCollection = $this->getAllGpa($collection->getCollection());
		
		//calling method to get the count of total students or records available in the csv file.
		$this->totalStudents = $collection->count();
		
		//Build for percentile ranking, Student Object Collection
		foreach($collection->getCollection() as $keys => $values){
			 
				 // Get the count of student gpa's, which are below the current student gpa selected.
				 $this->belowGpa = $this->getCountOfBelowGpa($values[2], $this->gpaCollection);
				 
				 // Get the count of students who has same or similar gpa of current student gpa selected.
				 $this->same_gpa = $this->getFrequencyOfGpa( $values[2], $this->gpaCollection);
				 
				 //Calculating the percentile rank for individual student
				 $this->percentileRank = $this->calculatePercentileRank($this->belowGpa, $this->same_gpa, $this->totalStudents);
				 
				 //Creating the student objects
				 $student_obj = new Student($values[0], $values[1], $values[2], $this->percentileRank);
				 
				 //Creating the collection for student objects
				 $buidStudentArray[] = array($student_obj->getId(), $student_obj->getName(), $student_obj->getGpa(), $student_obj->getPercentileRank());
				 $collection_obj = new ArrayCollection($buidStudentArray);

		}
		return $this->collectData = $collection_obj->getCollection();
	}

// -------------------------------------------------------------------------------------------------------------
	
	/**
	 *@method calculatePercentileRank
	 * This method is the one which calculates the percentile rank based upon the formula. 
	 * Formula Source: https://en.wikipedia.org/wiki/Percentile_rank where "0.5" is the constant
	 * 
	 * @access public
	 * @param string $n_belowGpa - input count of students with below gpa wrt current student gpa
	 * @param string $n_sameGpa - input count of students with similar or same gpa wrt current student gpa
	 * @param string $n_totalStudents - input total number of students list
	 * @return percentile rank for individual student
	 */
	
	public function calculatePercentileRank($n_belowGpa, $n_sameGpa, $n_totalStudents){
		
		return ( ( ( $n_belowGpa + 0.5 * $n_sameGpa ) * 100) / $n_totalStudents );
		
	}

// -------------------------------------------------------------------------------------------------------------
	
	/**
	 *@method getAllGpa
	 * This method builds the array list with only gpa of the students from the full student object collection.
	 * Used for building - belowgpa and similarGpa for the students.
	 *
	 * @access public
	 * @param array $n_collectionArray - input collection array of students
	 * @return array gpa list for all the students
	 */
	
	public function getAllGpa(array $n_collectionArray){
		
		unset($this->gpa); //unseting the value in the variable
		if(is_array($n_collectionArray)){
			
			foreach($n_collectionArray as $recordValue){ //Gpa value is filtered out from the other data
				
				$this->gpa[]=$recordValue[2];
			}
		}
		return $this->gpa;
	}

// -------------------------------------------------------------------------------------------------------------
	
	/**
	 *@method getCountOfBelowGpa
	 * This method is used in calculating the count of the students who are of below gpa with respect to current student
	 * The count would be used as one of the important parameter for calculating the percentile rank.
	 *
	 * @access public
	 * @param string $n_gpa - input current student gpa
	 * @param array $n_allGpa - input array list of all students gpa
	 * @return int - count of the gpa for students below gpa
	 */
	public function getCountOfBelowGpa($n_gpa, array $n_allGpa){
			$p=0;
			if(count($n_allGpa)){
				foreach($n_allGpa as $gpa_val){
					if( $gpa_val < $n_gpa){ $p++;}	
				}
			}
			return $p;
		}
		
// -------------------------------------------------------------------------------------------------------------
		
	/**
	 *@method getFrequencyOfGpa
	 * This method is used in calculating the count of the students who has same or similar with respect to current student
	 * The count would be used as one of the important parameter for calculating the percentile rank.
	 *
	 * @access public
	 * @param string $n_gpa - input current student gpa
	 * @param array $n_allGpa - input array list of all students gpa
	 * @return int - count of the gpa for students who has same or similar gpa of current student gpa
	 */
	
	public function getFrequencyOfGpa($n_gpa, $n_allGpa){
		
		return count(array_intersect( $n_allGpa, array($n_gpa)));
		
		
	}

// -------------------------------------------------------------------------------------------------------------
	
	/**
	 *@method studentObjectHandler
	 * This method is create the student objects and builds the student collection object.
	 * Also checks the htmlentities from the given input values, considering the security injection aspects.
	 *
	 * @access public
	 * @param array $n_array - input array list of all students gpa
	 * @return int - count of the gpa for students below gpa
	 */
	
	public function studentObjectHandler(array $n_array){
		
		if(count($n_array)){
			
			foreach ($n_array as  $valArray) {
				$this->record= array();
				
				// 2nd level loop to process the data from the input array.
				foreach ($valArray as  $key => $val) { 
					
					$this->record[]= htmlentities($val, ENT_QUOTES);	
				}
				
				// to separate the data based on student id, name and gpa from the newly build array
				list($n_id, $n_name, $n_gpa) = $this->record;
				
				// Student objects are created and built.
				$student_obj = new Student($n_id, $n_name, number_format((float) $n_gpa,2));
				$buidStudentArray[] = array($student_obj->getId(), $student_obj->getName(), $student_obj->getGpa());  
				
				// Student collection is getting built.
				$collection_obj = new ArrayCollection($buidStudentArray);
			}
			return $collection_obj;
	 }
	}
	
// -------------------------------------------------------------------------------------------------------------
	
	/**
	 *@method getRawDataFromCsv
	 * This method is used to pull the data from the uploaded csv file. Basepath is given for better compatibility with other machines.
	 *
	 * @access public
	 * @return array - data from the csv file uploaded
	 */
	public function getRawDataFromCsv(){
		try{
			$fp =  @file(__DIR__.'/'.UploadFiles::DESTINATION_FOLDER.UploadFiles::UPLOADED_FILENAME);
			if (!$fp) {
				throw new Exception('Failed to open csv file');
			}
			else 
				return array_map('str_getcsv', $fp);
		} catch (Exception $e){
		    die("Failed to open csv file.");
		}
		
	
	}

	 

}
