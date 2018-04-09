<?php
// Include config file
require_once '../json_manager.php';
 
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
            if(createUser($param_username, $UUID, $param_name, $param_lastname, $param_age, $param_gender)){
                if(mysqli_stmt_execute($stmt)){
                    // Redirect to login page
                    $_SESSION['username'] = $param_username;
                        $_SESSION['UUID'] = $UUID;
                        echo "success:" . $param_username . ":" . $UUID;
                        header("location: ../../profile.php");
                } else{
                    //echo $stmt->error . ":";
                    echo "Something went wrong. Please try again later.";
                }
            }else {
                echo "Failed to create user file:" . $param_username . ":" . $UUID;
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