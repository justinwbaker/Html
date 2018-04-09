
<?php $title = 'Ouroboros'; ?>
<?php $metaTags = 'tag1 tag2'; ?>
<?php $currentPage = 'Profile'; ?>
<!DOCTYPE html>
<html>
<head>
  <?php include('includes/head.php'); ?>
  <?php
    // Initialize the session
    // If session variable is not set it will redirect to login page
    if(!isset($_SESSION['username']) || empty($_SESSION['username']) || !isset($_SESSION['UUID']) || empty($_SESSION['UUID'])){
      header("location: ../../index.php");
      exit;
    }
  ?>
</head>
<body>
  <?php include('includes/nav-bar.php'); ?>
  <div class="content">
    <h1><?php 
    echo $_SESSION['username']; 
    ?></h1>
    
    <?php
      require_once '../json_manager.php';
    /*
    $user->gamerTag = $username;
      $user->name = $name;
      $user->lastname = $lastname;
      $user->age = (int)$age;
      $user->gender = $gender;*/

      echo "<h2>Games:</h2><ol>";
      if(isset($_SESSION['game_name'])) {
        echo "<li>" . $_SESSION['game_name'] . "</li>";
        
      echo "</ol>";
      }else {

    $user = getUser($_SESSION['username'], $_SESSION['UUID']);
      echo "<h2>Name: " . $user->name . "</h2>";
      echo "<h2>Last Name: " . $user->lastname . "</h2>";
      echo "<h7>UUID: " . $user->UUID . "</h7>";
        foreach ($user->games as $key) {
          echo "<li>" . $key . "</li>";
        }
      }
    ?>

  </div>
    <?php include('includes/footer.php'); ?>
</body>
</html>