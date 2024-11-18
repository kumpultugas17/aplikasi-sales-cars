<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'db_mik2_sales_car');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
   $id_delete = $_POST['id_delete'];

   $sql = $conn->query("DELETE FROM sales WHERE id = '$id_delete'");

   if ($sql) {
      $_SESSION['success'] = 'Data deleted successfully!';
   } else {
      $_SESSION['error'] = 'Data deletion failed, please try again!';
   }
   header('location:sales.php');
}
