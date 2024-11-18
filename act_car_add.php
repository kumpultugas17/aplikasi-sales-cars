<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'db_mik2_sales_car');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
   $merk = $_POST['merk'];
   $model = $_POST['model'];
   $year = $_POST['year'];
   $price = $_POST['price'];

   $sql = $conn->query("INSERT INTO cars (merk, model, tahun, harga) VALUES ('$merk', '$model', '$year', '$price')");

   if ($sql) {
      $_SESSION['success'] = 'Successfully added new data!';
   } else {
      $_SESSION['error'] = 'Failed to add new data, please try again!';
   }
   header('location:cars.php');
}
