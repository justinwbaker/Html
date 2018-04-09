<?php
// Include config file
require_once 'json_manager.php';
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = $name = $lastname = $gender = "";
$age = 1;
$username_err = $password_err = $confirm_password_err = $name_err = $lastname_err = $age_err = $gender_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Validate name
    if(empty(trim($_POST['name']))){
        $name_err = "Please enter a name.";     
    } else{
        $name = trim($_POST['name']);
    }

    // Validate lastname
    if(empty(trim($_POST['lastname']))){
        $lastname_err = "Please enter a lastname.";     
    } else{
        $lastname = trim($_POST['lastname']);
    }

    // Validate lastname
    if(empty(trim($_POST['gender']))){
        $gender_err = "Please enter a gender.";
    } else{
        $gender = trim($_POST['gender']);
    }

    // Validate age
    if(empty(trim($_POST['age']))){
        $age_err = "Please enter a name.";     
    } else if($_POST['age'] < 13) {
        $age_err = "Must be at least 13 years old.";
    } else{
        $age = trim($_POST['age']);
    }
    
    // Validate password
    if(empty(trim($_POST['password']))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST['password'])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST['password']);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = 'Please confirm password.';     
    } else{
        $confirm_password = trim($_POST['confirm_password']);
        if($password != $confirm_password){
            $confirm_password_err = 'Password did not match.';
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password, UUID) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            $UUID = sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x', mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0x0fff ) | 0x4000, mt_rand(0, 0x3fff) | 0x8000, mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff) );

            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_username, $param_password, $UUID);
            
            // Set parameters
            $param_name = $name;
            $param_lastname = $lastname;
            $param_age = $age;
            $param_gender = $gender;
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                echo "success:" . $param_username . ":" . $UUID;
                createUser($param_username, $UUID, $param_name, $param_lastname, $param_age, $param_gender);
                header("location: ../default.php");
            } else{
                //echo $stmt->error . ":";
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }else {
        echo $username_err . ":" . $password_err . ":" . $confirm_password_err;
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Ouroboros</title>
  <!-- Bootstrap core CSS-->
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">
</head>

<body>
    <div class="bg-dark">
        <div class="container">
            <div class="card card-login mx-auto mt-5">
                <div class="card-header">Sign Up</div>
                    <div class="card-body">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                                <span class="help-block"><?php echo $name_err; ?></span>
                            </div>
                            <div class="form-group <?php echo (!empty($lastname_err)) ? 'has-error' : ''; ?>">
                                <label>Last Name</label>
                                <input type="text" name="lastname" class="form-control" value="<?php echo $lastname; ?>">
                                <span class="help-block"><?php echo $lastname_err; ?></span>
                            </div>
                            <div class="form-group <?php echo (!empty($age_err)) ? 'has-error' : ''; ?>">
                                <label>Age</label>
                                <input type="number" name="age" class="form-control" value="<?php echo $age; ?>" min="1">
                                <span class="help-block"><?php echo $age_err; ?></span>
                            </div> 
                            <div class="form-group <?php echo (!empty($gender_err)) ? 'has-error' : ''; ?>">
                                <label>Gender</label>
                                <input type="text" name="gender" class="form-control" value="<?php echo $gender; ?>">
                                <span class="help-block"><?php echo $gender_err; ?></span>
                            </div>
                            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                                <label>Gamer Tag</label>
                                <input type="text" name="username"class="form-control" value="<?php echo $username; ?>">
                                <span class="help-block"><?php echo $username_err; ?></span>
                            </div>
                            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                                <span class="help-block"><?php echo $password_err; ?></span>
                            </div>
                            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                                <label>Confirm Password</label>
                                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                                <span class="help-block"><?php echo $confirm_password_err; ?></span>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Submit">
                                <input type="reset" class="btn btn-default" value="Reset">
                            </div>
                            <p>Already have an account? <a href="../default.php">Login here</a>.</p>
                        </form>
                    </div>
                </div>
            </div>
        </div>  

    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
</body>
</html>