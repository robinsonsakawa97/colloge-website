<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="course.css">
</head>

<body>
  <?php include "navigation.inc"?>
  <?php include "header.inc"?>
  <h2>Subject Course</h2>

  <?php // Include config file
			require_once "config.php";

      $subject_id = $_GET['subject_id'];

			// Attempt select query execution
			$sql="SELECT * FROM coursedetails WHERE subject = '$subject_id'";

			if($result=mysqli_query($link, $sql)) {
				if(mysqli_num_rows($result) > 0) {
					echo '<br><table class="table table-bordered table-striped">';
					echo "<thead>";
					echo "<tr>";
          
					echo "<th>Name</th>";

					echo "</tr>";
					echo "</thead>";
					echo "<tbody> ";

					while($row=mysqli_fetch_array($result)) {
						echo "<tr>";
						echo "<td>". $row['course_name'] . "</td>";
						echo "<td>";

						echo "</tr>";
					}

					echo "</tbody>";
					echo "</table>";
					// Free result set
					mysqli_free_result($result);
				}

				else {
					echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
				}
			}

			else {
				echo "Oops! Something went wrong. Please try again later.";
			}

			// Close connection
			mysqli_close($link);
			?>

<?php include "footer.inc"?>