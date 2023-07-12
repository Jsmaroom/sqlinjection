<?php 
$host = "localhost";
$username = "username";
$password = "";
$dbname = "web2";

try {
	$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	echo "Connected successfully";
  } catch(PDOException $e) {
	echo "Connection failed: " . $e->getMessage();
  }


  $stmt = $conn->prepare("INSERT INTO form ( usernamr , email , passwo ,gender ,rember)
VALUES (:username, :email , :passwo, :gender, :rember,)");
$stmt->bindParam(':usernamr', $usernamr);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':passwo', $passwo);
$stmt->bindParam(':gender', $gender);
$stmt->bindParam(':rember', $rember);

if (isset($_POST['submit'])) {
	$usernamr = htmlspecialchars($_POST['usernamr']);
	$email = htmlspecialchars($_POST['email']);
	$passwo = htmlspecialchars($_POST['password']);
	$gender = htmlspecialchars($_POST['gender']);
	$rember = htmlspecialchars($_POST['rember']);
	$stmt->execute();
	echo "تم إدخال البيانات بنجاح!";
  }
  

  
  
?>




<!DOCTYPE html>
<html>
<head>
	<title>Sign Up Form</title>
</head>
<body>
	<h2>Sign Up Form</h2>
	<form action="signup.php" method="post" enctype="multipart/form-data">
		<label>Name:</label><br>
		<input type="text" name="name" required><br>

		<label>Email:</label><br>
		<input type="email" name="email" required><br>

		<label>Password:</label><br>
		<input type="password" name="password" required><br>

		<label>Gender:</label><br>
		<input type="radio" name="gender" value="male" checked> Male<br>
		<input type="radio" name="gender" value="female"> Female<br>
		<input type="radio" name="gender" value="other"> Other<br><br>

		<label>Profile Image:</label><br>
		<input type="file" name="image" accept="image/*" required><br>

		<input type="checkbox" name="rememberme"> Remember Me<br><br>

		<input type="submit" name="submit" value="Submit">
	</form>
</body>
</html>

<?php
if(isset($_POST['submit'])){
	$name = trim($_POST['name']);
	$email = trim($_POST['email']);
	$password = trim($_POST['password']);
	$gender = $_POST['gender'];
	$rememberme = isset($_POST['rememberme']);

	// Validate name
	if(empty($name)){
		$error = "Please enter your name.";
	}

	// Validate email
	if(empty($email)){
		$error = "Please enter your email.";
	}elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		$error = "Please enter a valid email address.";
	}

	// Validate password
	if(empty($password)){
		$error = "Please enter your password.";
	}elseif(strlen($password) < 6){
		$error = "Your password must be at least 6 characters long.";
	}

	// Validate gender
	if(empty($gender)){
		$error = "Please select your gender.";
	}

	// Validate image
	if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
		$image = $_FILES['image'];
		$size = $image['size'];
		if($size > 1048576){ // 1 MB in bytes
			$error = "Your profile image must be less than 1 MB.";
		}
	}else{
		$error = "Please upload your profile image.";
	}

	if(!isset($error)){
		// Process the form data
		// ...
		echo "Thank you for signing up!";
	}else{
		echo $error;
	}
}
?>
<?php 
$host="localhost";
$username ="root" ;
$password ="";
$dbname ="web2";

$conn2 = mysqli_connect($host,$username,$password,$dbname);



if(isset($_POST['submit'])){
	
    $fileName=$_FILES['image']['name'];
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $sql = "insert into form set id=?, name=?, email=?, password=?, gender=?, rembere=?";
    $sql = mysqli_prepare($conn2,$sql);
    mysqli_stmt_bind_param($sql ,"sssss",$id ,$name,$email,$password,$gender,$rember);
    mysqli_stmt_execute($sql );
    

}
?>