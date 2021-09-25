<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="course.css">

  <?php include "navigation.inc"?>
  <?php include "header.inc"?>
</head>

<body>
  <h2>Course Taught By <?php echo  $_GET['instructor_id']?></h2>

  <?php // Include config file
			require_once "config.php";

      $instructor_id = $_GET['instructor_id'];

			// Attempt select query execution
			$sql="SELECT * FROM coursedetails WHERE instructor = '$instructor_id'";

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
</body>

</html>