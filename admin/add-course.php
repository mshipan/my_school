<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Add Course</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="index.php?page=dashboard">Home</a></li>
					<li class="breadcrumb-item active">Add Course</li>
				</ol>
			</div>
		</div>
	</div><!-- /.container-fluid -->
</section>

<?php 

	if (isset($_POST['add-course'])) {
		$coursetitle = $_POST['coursetitle'];
		$coursedescription = $_POST['coursedescription'];

		$coursephoto = explode('.', $_FILES['coursephoto']['name']);

		$coursephoto_ext = end($coursephoto);

		$coursephoto_name = $coursetitle.'.'.$coursephoto_ext;

		$query = "INSERT INTO `courses`(`coursetitle`, `coursedescription`, `coursephoto`) VALUES ('$coursetitle','$coursedescription','$coursephoto_name')";

		$result = mysqli_query($link, $query);

		if ($result) {
			$success = "Data Insert Successfully";
			move_uploaded_file($_FILES['coursephoto']['tmp_name'], 'course_photo/'.$coursephoto_name);
		} else {
			$error = "Data Not Inserted";
		}

		

	}

 ?>

<section class="content">
	<?php if (isset($success)) { echo '<p class="alert alert-success animate__animated animate__fadeInLeft">'.$success.'<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button></p>'; } ?>
	<?php if (isset($error)) { echo '<p class="alert alert-danger">'.$error.'<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button></p>'; } ?>
	<div class="card card-primary">
              
              <!-- form start -->
              <form action="" method="POST" enctype="multipart/form-data">
	                <div class="card-body">
	                  <div class="form-group">
	                    <label for="coursetitle">Course Title</label>
	                    <input type="text" class="form-control" id="coursetitle" name="coursetitle" placeholder="Enter Course Title">
	                  </div>
	                  <div class="form-group">
	                    <label for="coursedescription">Course Description</label>
	                    <textarea class="form-control" id="coursedescription" name="coursedescription" rows="3" placeholder="Enter Course Description"></textarea>
	                  </div>
					  <div class="form-group">
					    <label for="exampleFormControlFile1">Course Photo</label> <small class="text-danger">***Picture Size must be 285 x 201 px***</small>
					    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="coursephoto">
					  </div>
	                  
	                </div>
	                <!-- /.card-body -->

	                <div class="card-footer">
	                  <button type="submit" class="btn btn-primary" name="add-course">Add Course</button>
	                </div>
              </form>
            </div>
            <!-- /.card -->
</section>