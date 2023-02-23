<?php

include("./components/header.php");
include "./src/User.php";
$message = null;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = $_POST['username'];
  $pwd = sha1($_POST['pwd']);
  // echo $username . " " . $pwd;
  $userObj = new User($connection);
  $res = $userObj->login($username, $pwd);
  if ($res['success']===true) {
    $_SESSION['curr_user_id'] = $res['userid'];
    $_SESSION['curr_user'] = $username;
    // echo "<script>console.log".$_SESSION['curr_user']."</script>";
    header("location: index.php");
  } else{
    $message = "Wrong Credentials";
    $mType = "danger";

  }
  // echo $message;
}
?>



<div class="container mt-3">
  <h1>Login Form</h1>
  <form action="./login.php" method="post">
    <div class="form-group">
      <label for="username">Username</label>
      <input name="username" type="text" class="form-control" id="username">
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input name="pwd" type="password" class="form-control" id="password">
    </div>
    <button class="my-2" type="submit" class="btn btn-outline-primary">Submit</button>
    <p>Don't have an account? <a href="register.php">Create one</a> </p>
    <?php 
    if($message){
      ?>
      <p class="alert alert-danger"><?=$message?></p>
      <?php
    }
    ?>
  </form>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

<?php
include("./components/footer.php")
?>