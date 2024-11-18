<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'db_mik2_sales_car');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
   $name = $_POST['name'];
   $email = $_POST['email'];
   $phone = $_POST['phone'];

   $sql = $conn->query("INSERT INTO sales (name, email, phone) VALUES ('$name', '$email', '$phone')");

   if ($sql) {
      $_SESSION['success'] = 'Successfully added new data!';
   } else {
      $_SESSION['error'] = 'Failed to add new data, please try again!';
   }
   header('location:sales.php');
}
