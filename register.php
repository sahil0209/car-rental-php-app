<?php

include("./components/header.php");
include "./src/User.php";
$message = null;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = $_POST['name'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $pwd = sha1($_POST['pwd']);
  $contact = $_POST['contact'];
  $userObj = new User($connection);
  $res = $userObj->create($name, $username, $pwd, $email, $contact);
  if ($res) {
    $message = "Successful";
  }
  // echo $message;
}
?>



<div class="container mt-3">
  <h1>Hello User</h1>
  <form action="./register.php" method="post">
    <div class="form-group">
      <label for="name">Name</label>
      <input name="name" type="text" class="form-control" id="name">
    </div>
    <div class="form-group">
      <label for="username">Username</label>
      <input name="username" type="text" class="form-control" id="username">
    </div>
    <div class="form-group">
      <label for="email">Email address</label>
      <input name="email" type="email" class="form-control" id="email">
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input name="pwd" type="password" class="form-control" id="password">
    </div>
    <div class="form-group">
      <label for="contact">Contact</label>
      <input type="tel" name="contact" class="form-control" id="number">
    </div>
    <button class="my-2" type="submit" class="btn btn-outline-primary">Submit</button>
  </form>
  <?php
  if ($message != null) {
  ?>
    <div class="alert alert-success">
      <?= $message; ?>
    </div> <?php
          } 
            ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

<?php
include("./components/footer.php")
?>