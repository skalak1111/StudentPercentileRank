<!DOCTYPE html>
<html>
	<head>
		<title>Student Percentile Rank</title>
		<link href="css/styles.css" rel ="stylesheet" type="text/css" media="screen" />
	</head> 
	<body>
	
	<!-- Form Component Starts here -->
	<fieldset>
		<legend> Upload CSV File </legend>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
			<input type="file" name="uploadcsv">
			<input type="submit" name="btn_submit" value="Upload File" />
		</form>
	</fieldset>
	
<!-- ---------------------------------	Form Component Ends here	--------------------------------------->

	<?php
		// Including all the required files
		require_once 'UploadFiles.php';
		require_once 'Student.php';
		require_once 'ArrayCollection.php';
		require_once 'StudentPercentile.php';
		
		/**
		 *  Executes when the form is submitted with the valid csv file.
		 *  - package UploadFiles class
		 *  - method UploadFiles, uploaded
		 *  - return bool - Returns the success or failure of the file upoads
		 */
		if (!empty($_FILES['uploadcsv'])) {
		
			$objFile = new UploadFiles('uploads/' );
			$fieldname = "uploadcsv";
			$upload = $objFile->uploaded($_FILES[$fieldname]['name'], $_FILES[$fieldname]['tmp_name'], $_FILES[$fieldname]['error']);
			
			// upload status
			if($upload){
				print "<div class = 'success'>File Uploaded and the data is processed below</div>";
			}
			else
				print "<div class='error'>Unsupported file format or Invalid file</div>";
					
		}
		
		/**
		 *  Executes when the page loads. Gets the data from the saved or uploaded file. Creates the student objects and collection.
		 *  - package PercentileRank class
		 *  - method StudentPercentile, calculatePercentileRankFoundation
		 *  - return array - Returns the final data collection of the student for final output view.
		 */
		
		// Student Object created
		$data_obj = new StudentPercentile();
		$collection_obj = $data_obj->objectHandler();
		
		// Final Processed collection data with Percentile Rank included
		$data_list =$data_obj->calculatePercentileRankFoundation($collection_obj);
		
		/**
		 * Output View Dyanamic Container build starts here.
		 * 
		 */ 
		
		$i=0;
		$divData ='<div class="data-container">';
		$divData.='<div class="row-2 container-head"><span>Student ID</span><span>Name</span><span>GPA</span><span>Percentile Rank</span></div>';
		foreach ($data_list as  $valArray) {
			
			$columnClass = "row-2";
			if($i%2==0)
				$columnClass = "row-1";
		
			$divData.='<div class ="' . $columnClass . '">';
			foreach ($valArray as  $key => $val) {
				$divData.='<span>';
				$divData.= htmlentities($val, ENT_QUOTES);
				$divData.='</span>';
			}
			$divData.='</div>';
			$i++;
		}
		$divData.="</div>";
		print $divData;
		
		/**
		 * Output View Dyanamic Container ends starts here.
		 *
		 */
		
	
	
	?>
	</body>
</html>