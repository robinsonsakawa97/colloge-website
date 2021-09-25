
  <?php include "navigation.inc"?>
  <?php include "header.inc"?>

<div style="border-radius: 10px; border-style: solid; padding: 30px; margin: 10px;">

<?php // Include config file
			require_once "config.php";

			// Attempt select query execution
			$sql="SELECT DISTINCT instructor FROM coursedetails";

			if($result=mysqli_query($link, $sql)) {
				if(mysqli_num_rows($result) > 0) {
					echo '<table style="width" >';
					echo "<thead>";
					echo "<tr>";
          
					echo "<th>Name</th>";
					echo "<th>*****</th>";

					echo "</tr>";
					echo "</thead>";
					echo "<tbody>";

					while($row=mysqli_fetch_array($result)) {
						echo "<tr>";
						echo "<td>". $row['instructor'] . "</td>";
						echo "<td> <a href='instructor.php?instructor_id=".$row['instructor']."'>Teaching Courses</a></td>";

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