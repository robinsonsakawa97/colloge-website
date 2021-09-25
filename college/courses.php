
  <?php include "navigation.inc"?>
  <?php include "header.inc"?>

<div style="border-radius: 10px; border-style: solid; padding: 30px; margin: 10px;">
<?php // Include config file
			require_once "config.php";

			// Attempt select query execution
			$sql="SELECT * FROM coursedetails ";

			if($result=mysqli_query($link, $sql)) {
				if(mysqli_num_rows($result) > 0) {
					echo '<table>';
					echo "<thead>";
					echo "<tr>";
					echo "<th>Course Code</th>";
					echo "<th>Name</th>";
					echo "<th>Subject</th>";
					echo "<th>Instructor</th>";
					echo "<th>Weeks</th>";
					echo "<th>Description</th>";

					echo "</tr>";
					echo "</thead>";
					echo "<tbody>";

					while($row=mysqli_fetch_array($result)) {
						echo "<tr>";
						echo "<td> <a href='course.php?course_id=".$row['course_id']."'>".$row['course_code']."</a></td>";
						echo "<td>". $row['course_name'] . "</td>";
						echo "<td>". $row['subject'] . "</td>";
						echo "<td>". $row['instructor'] . "</td>";
						echo "<td>". $row['weeks'] . "</td>";
						echo "<td>". $row['description'] . "</td>";

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
</div>
	
	<?php include "footer.inc"?>