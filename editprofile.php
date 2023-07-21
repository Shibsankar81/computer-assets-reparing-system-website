<?php
include('connection.php');
session_start();
$id = $_GET['MnoQtyPXZORTE'];
$message = $Home = '';
$_SESSION['user'] = $id;
if($_SESSION['user'] == ''){
	header("location:Editpage.php");
}
else{
	if(isset($_POST['submit'])){
		// $password = $_POST['password'];
		$domainname = $_POST['domainname'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

			$id_decode = base64_decode($id);
			$query = "UPDATE registration SET domain ='$domainname', name='$name', email='$email', mobile='$phone' WHERE id= '$id_decode'";
			$result = mysqli_query($conn, $query);
				if($result)
				{
					$message = "<div class='alert alert-success'>Update Your Profile Successfully..</div>";
					$Home = "<a href='loginForm.php' class='btn btn-success btn-sm'>Login</a>";
				}
		}
	}
?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Edit_Profile</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body class="bg-secondary">
		<div class="container w-50 mt-5">
			<form class="bg-light p-5 shadow-lg" method="post">
				<?php echo $message; ?>
				<h1 class="text-success">Edit Your Profile</h1>
                <!-- <label for="password">Select Your Depertment</label> -->
                <select name="domainname" id="" class="form-control form-control-sm" required>
                    <option>Select your Domain</option>
                    <option value="CSE">CSE</option>
                    <option value="IT">IT</option>
                    <option value="ECE">ECE</option>
                    <option value="EE">EE</option>
                    <option value="ME">ME</option>
                    <option value="Vendor">Vendor</option>
                    <option value="Finance">Finance</option>
                </select>
				<label for="name">Name</label>
				<input type="text" name="name" placeholder="Enter your Name" class="form-control form-control-sm" required><br>
				<label for="email">Email</label>
				<input type="Email" name="email" placeholder="Your Email" class="form-control form-control-sm"><br>
                <label for="phone">phone No</label>
				<input type="number" name="phone" placeholder="Your mobile No" class="form-control form-control-sm" required><br>
				<button type="submit" name="submit" class="btn btn-success btn-sm">Edit Confirm</button> <?php echo $Home; ?>
			</form>
		</div>
</body>
</html>