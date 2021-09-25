
<?php include "navigation.inc"?>
<?php include "header.inc"?>
<br><br>
<div style="border-radius: 10px; border-style: solid; padding: 30px; margin: 10px;">
<fieldset>
  <legend><b>Add New Course</b> </legend>
  <form action="#" method="post" enctype="multipart/form-data" >
  <label for="Course code">Course Code:</label>
  <input type="text" name="course_code"><br><br>
  <label for="course name">Course Name:</label>
  <input type="text"  name="course_name"><br><br>
    <label for="Subject">Subject:</label>
  <input type="text" name="subject"><br><br>
    <label for="Instructor">Instructor:</label>
  <input type="text" name="instructor"><br><br>
    <label for="Weeks">Weeks:</label>
  <input type="number"  name="weeks"><br><br>
    <label for="lname">Description:</label>
    <textarea name="description" id="" cols="30" rows="5"></textarea>
  <br><br>

   <label for="files">Upload more info. :</label>
  <input type="file" name="myfile"><br><br>
  <input type="submit" name="save" value="add course" style="border-radius: 10px; background-color:blue; color: white; padding: 10px 20px; margin: 5px 2px; cursor: pointer;">

</form>
</fieldset>

</div>
<?php
// connect to the database
  require_once "config.php";

  // Uploads files
  if (isset($_POST['save'])) { 
    // if save button on the form is clicked
    // name of the uploaded file
    $course_code=$_POST['course_code'];
    $course_name=$_POST['course_name'];
    $subject=$_POST['subject'];
    $instructor=$_POST['instructor'];
    $weeks=$_POST['weeks'];
    $description=$_POST['description'];
    $filename = $_FILES['myfile']['name'];

    // destination of the file on the server
    $destination = 'Course_Guide /' . $filename;

    // get the file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['myfile']['tmp_name'];
    $size = $_FILES['myfile']['size'];
    

    if (!in_array($extension, ['zip', 'pdf', 'docx', 'txt'])) {
        echo "You file extension must be .zip, .pdf or .docx";
    } elseif ($_FILES['myfile']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte
        echo "File too large!";
    } else {
        // move the uploaded (temporary) file to the specified destination
        if (move_uploaded_file($file, $destination)) {
            $sql = "INSERT INTO coursedetails  (course_code,course_name, subject, instructor, weeks,description) VALUES ('$course_code', '$course_name','$subject', '$instructor', '$weeks', '$description')";
            if (mysqli_query($link, $sql)) {
                echo "File uploaded successfully";
            }
        } else {
            echo "Failed to upload file.";
        }
    }
}
?>

<?php include "footer.inc"?>
