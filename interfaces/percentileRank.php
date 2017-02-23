<?php
/**
 * The PercentileRank interface
 *
 * The main PercentileRank interface gives the protocol and structure for the StudentPercentile classess
 *
 * @package Collection
 *
 * @author Sai Krishna
 *
 * 
 */


interface PercentileRank {
	
	/**
	 *@method objectHandler
	 * This method will gets the data in an array format from the recent uploaded csv file. Then creates the student objects using Student Class.
	 * returns the student objects from StudentObjectHandler method.
	 *
	 * @access public
	 * @return object - Student class
	 */
	
	public function objectHandler();
	
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
	
	public function calculatePercentileRankFoundation(CollectionInterface $collection);
	
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
	
	public function calculatePercentileRank($n_belowGpa, $n_sameGpa, $n_totalStudents);
	
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
	
	public function getAllGpa(array $n_collectionArray);
	
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
	public function getCountOfBelowGpa($n_gpa, array $n_allGpa);
	
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
	
	public function getFrequencyOfGpa($n_gpa, $n_allGpa);
	
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
	
	public function studentObjectHandler(array $n_array);
	
	// -------------------------------------------------------------------------------------------------------------
	
	/**
	 *@method getRawDataFromCsv
	 * This method is used to pull the data from the uploaded csv file. Basepath is given for better compatibility with other machines.
	 *
	 * @access public
	 * @return array - data from the csv file uploaded
	 */
	public function getRawDataFromCsv();
	
	
}
