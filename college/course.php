  
<?php

// Check existence of id parameter before processing further
if(isset($_GET["course_id"]) && !empty(trim($_GET["course_id"]))){
    // Include config file
    require_once "config.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM coursedetails WHERE course_id = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["course_id"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Retrieve individual field value
                $course_id = $row["course_id"];
                $course_name = $row["course_name"];
                $subject = $row["subject"];
                $instructor = $row["instructor"];
                $weeks = $row["weeks"];
                $description = $row["description"];

            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>View Record</title>
	<link rel="stylesheet" href="course.css">
</head>

<body>
  <?php include "navigation.inc"?>
  <?php include "header.inc"?>
	<div class="row">

		<h3>View Record</h3>
		<div class="form-group">
			<p><b><?php echo $row["course_code"]; ?></b> - <b><?php echo $row["course_name"]; ?></b></p>
		</div>
		<div class="form-group">
			<p> <b><label>Subject : </label><?php echo $row["subject"]; ?></b></p>
		</div>
		<div class="form-group">
			<p><b><label>Instructor : </label> <?php echo $row["instructor"]; ?></b></p>
		</div>
		<div class="form-group">
			<p><b><label>Duration : </label><?php echo $row["weeks"]; ?></b></p>
		</div>
		<div class="form-group">
			<p><?php echo $row["description"]; ?></p>
		</div>

		<p>
			<button onclick="goBack()">Go Back</button>
		</p>
		<script>
			function goBack() {
				window.history.back();
			}
		</script>
	</div>
  <?php include "footer.inc"?>