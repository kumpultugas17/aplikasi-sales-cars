<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'db_mik2_sales_car');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
   $tanggal = $_POST['tanggal'];
   $sales = $_POST['sales'];
   $car = $_POST['car'];

   $sql = $conn->query("INSERT INTO transactions (sale_date, sales_id, car_id) VALUES ('$tanggal', '$sales', '$car')");

   if ($sql) {
      $_SESSION['success'] = 'Successfully added new transaction!';
   } else {
      $_SESSION['error'] = 'Failed to add new data, please try again!';
   }
   header('location:transactions.php');
}
