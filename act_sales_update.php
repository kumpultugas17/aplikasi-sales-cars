<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'db_mik2_sales_car');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
   $id = $_POST['id'];
   $name = $_POST['name'];
   $email = $_POST['email'];
   $phone = $_POST['phone'];

   $sql = $conn->query("UPDATE sales SET name='$name', email='$email', phone='$phone' WHERE id='$id'");

   if ($sql) {
      $_SESSION['success'] = 'Data Successfully Edited!';
   } else {
      $_SESSION['error'] = 'Failed to Edit Data!';
   }
   header('location:sales.php');
}
