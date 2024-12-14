<?php
session_start();
if (!isset($_SESSION['login'])) {
   header('location:login.php');
   exit;
}
$conn = mysqli_connect('localhost', 'root', '', 'db_mik2_sales_car');
?>

<!DOCTYPE html class="h-100">
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="description" content="Aplikasi Management Sales Car">
   <meta name="author" content="M. Iqbal Adenan">
   <title>Dashboard</title>
   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="assets/css/bootstrap.min.css">
   <!-- Tabler Icons CSS -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
   <!-- Font -->
   <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
   <!-- Flatpickr CSS -->
   <link href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.css" rel="stylesheet">
   <!-- Select2 CSS -->
   <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
   <!-- Template CSS -->
   <link rel="stylesheet" href="assets/css/app.css">
   <!-- jQuery Core -->
   <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

   <style>
      body {
         display: flex;
         flex-direction: column;
         min-height: 100vh;
         margin: 0;
      }

      main {
         flex: 1;
      }
   </style>
</head>

<body>
   <header>
      <!-- Navbar Top -->
      <nav class="navbar navbar-top fixed-top bg-success text-white">
         <div class="container">
            <!-- Navbar Brand -->
            <a class="d-inline navbar-brand text-white" href="#">
               <!-- logo -->
               <img src="assets/images/logo-dashboard.png" alt="Logo" width="32" class="align-text-bottom me-2">
               <!-- title -->
               <span class="fs-4 text-uppercase">Management Sales System</span>
            </a>
         </div>
      </nav>
      <!-- Navbar Menu -->
      <nav class="navbar navbar-menu fixed-top navbar-expand-lg shadow-lg-sm">
         <div class="container">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
               <ul class="navbar-nav me-auto">
                  <li class="nav-item">
                     <a class="nav-link text-nowrap me-3 active" aria-current="page" href="dashboard.php">
                        <i class="ti ti-home align-text-top me-1"></i> Home
                     </a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link text-nowrap me-3" href="sales.php">
                        <i class="ti ti-users align-text-top me-1"></i> Sales
                     </a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link text-nowrap me-3" href="cars.php">
                        <i class="ti ti-car align-text-top me-1"></i> Cars
                     </a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link text-nowrap me-3" href="transactions.php">
                        <i class="ti ti-folders align-text-top me-1"></i> Transactions
                     </a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link text-nowrap" href="report.php">
                        <i class="ti ti-file-text align-text-top me-1"></i> Report
                     </a>
                  </li>
               </ul>
               <ul class="navbar-nav">
                  <li class="nav-item">
                     <a href="logout.php" class="nav-link text-nowrap">
                        <i class="ti ti-logout align-text-top me-1"></i> Logout
                     </a>
                  </li>
               </ul>
            </div>
         </div>
      </nav>
   </header>

   <main class="flex-shrink-0">
      <div class="container">
         <div class="page-content">

            <div class="bg-white rounded-2 shadow-sm p-4 mb-5">
               <div class="row align-items-center g-5">
                  <div class="col-lg-3">
                     <img src="assets/images/img-dashboard.svg" class="img-fluid opacity-85" alt="images" loading="lazy">
                  </div>
                  <div class="col-lg-9">
                     <h4 class="text-success mb-2">
                        Selamat datang di <span class="fw-semibold">Aplikasi Management Sales</span>!
                     </h4>
                     <p class="lead-dashboard mb-4">Aplikasi ini adalah aplikasi untuk memudahkan dalam mengelola data sales. Transaksi dengan mudah dan cepat.</p>
                     <div class="d-grid gap-3 d-md-flex justify-content-md-start">
                        <a href="https://pustakakoding.com/" target="_blank" class="btn btn-success py-2 px-4">
                           Show Projects <i class="ti ti-chevron-right align-middle ms-2"></i>
                        </a>
                     </div>
                  </div>
               </div>
            </div>

            <div class="row mb-3">
               <!-- menampilkan informasi jumlah data Category -->
               <div class="col-lg-6 col-xl-4">
                  <div class="bg-white rounded-2 shadow-sm p-4 mb-4">
                     <div class="d-flex align-items-center justify-content-start">
                        <div class="me-4">
                           <i class="ti ti-users fs-1 bg-primary-2 text-white rounded-2 p-2"></i>
                        </div>
                        <div>
                           <p class="text-muted mb-1">Sales</p>
                           <!-- tampilkan data -->
                           <h5 class="fw-bold mb-0"><?= getData("sales") ?></h5>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- menampilkan informasi jumlah data Product -->
               <div class="col-lg-6 col-xl-4">
                  <div class="bg-white rounded-2 shadow-sm p-4 p-lg-4-2 mb-4">
                     <div class="d-flex align-items-center justify-content-start">
                        <div class="me-4">
                           <i class="ti ti-copy fs-1 bg-success text-white rounded-2 p-2"></i>
                        </div>
                        <div>
                           <p class="text-muted mb-1">Cars</p>
                           <!-- tampilkan data -->
                           <h5 class="fw-bold mb-0"><?= getData("cars") ?></h5>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- menampilkan informasi jumlah data Customer -->
               <div class="col-lg-6 col-xl-4">
                  <div class="bg-white rounded-2 shadow-sm p-4 p-lg-4-2 mb-4">
                     <div class="d-flex align-items-center justify-content-start">
                        <div class="text-muted me-4">
                           <i class="ti ti-users fs-1 bg-warning text-white rounded-2 p-2"></i>
                        </div>
                        <div>
                           <p class="text-muted mb-1">Transactions</p>
                           <!-- tampilkan data -->
                           <h5 class="fw-bold mb-0"><?= getData("transactions") ?></h5>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

            <!-- menampilkan informasi product terlaris -->
            <div class="bg-white rounded-2 shadow-sm pt-4 px-4 pb-3 mb-5">
               <!-- judul -->
               <h6 class="mb-0">
                  <i class="ti ti-folder-star fs-5 align-text-top me-1"></i>
                  5 Best selling products.
               </h6>

               <hr class="mb-4">

               <!-- tabel tampil data -->
               <div class="table-responsive">
                  <table class="table table-bordered table-striped table-hover" style="width:100%">
                     <thead>
                        <th class="text-center">Image</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Sold</th>
                     </thead>
                     <tbody>
                        <?php
                        // query penjualan mobil 5 terbanyak
                        $query = $conn->query("SELECT transactions.*, cars.merk, cars.model, cars.tahun, cars.harga, count(transactions.car_id) as qty FROM transactions INNER JOIN cars ON transactions.car_id = cars.id GROUP BY transactions.car_id DESC LIMIT 5");

                        // jika data tidak ada, tampilkan pesan data tidak tersedia
                        if ($query->num_rows > 0) {

                           // tampilkan data
                           foreach ($query as $transaction) :
                        ?>
                              <tr>
                                 <td width="50" class="text-center">
                                    <img src="asset('/storage/products/'.$transaction->product->image)" class="img-thumbnail rounded-4" width="80" alt="Images">
                                 </td>
                                 <td width="200"><?= $transaction['merk'] . ' - ' . $transaction['model'] . ' ' . $transaction['tahun'] ?></td>
                                 <td width="100" class="text-end">Rp <?= number_format($transaction['harga'], 2, ',', '.') ?> </td>
                                 <td width="80" class="text-center"><?= $transaction['qty'] ?></td>
                              </tr>
                           <?php endforeach ?>
                        <?php } else { ?>
                           <tr>
                              <td colspan="6">
                                 <div class="d-flex justify-content-center align-items-center">
                                    <i class="ti ti-info-circle fs-5 me-2"></i>
                                    <div>No data available.</div>
                                 </div>
                              </td>
                           </tr>
                        <?php } ?>
                     </tbody>
                  </table>
               </div>
            </div>

         </div>
      </div>
   </main>

   <!-- Footer -->
   <footer class="footer bg-white shadow mt-auto py-3">
      <div class="container">
         <div class="d-flex flex-column flex-md-row align-items-center align-items-md-left">
            <!-- copyright -->
            <div class="copyright text-center mb-2 mb-md-0">
               &copy; 2024 - <a href="#" target="_blank" class="fw-semibold">ELTIBIZ Koding</a>. All rights reserved.
            </div>
            <!-- link -->
            <div class="link ms-md-auto">
               <a href="#" target="_blank">Terms & Conditions</a>
            </div>
         </div>
      </div>
   </footer>

   <!-- Bootstrap JS -->
   <script src="assets/js/bootstrap.bundle.min.js"></script>
   <!-- Flatpickr JS -->
   <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.js"></script>
   <!-- Select2 JS -->
   <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
   <!-- jQuery Mask Plugin -->
   <script src="https://cdn.jsdelivr.net/npm/jquery-mask-plugin@1.14.16/dist/jquery.mask.min.js" integrity="sha256-Kg2zTcFO9LXOc7IwcBx1YeUBJmekycsnTsq2RuFHSZU=" crossorigin="anonymous"></script>
   <!-- Sweetalert2 JS -->
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <!-- Bootstrap Notify -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap-notify@3.1.3/bootstrap-notify.min.js"></script>

   <!-- Custom Scripts -->
   <script src="assets/js/plugins.js"></script>
   <script src="assets/js/image-preview.js"></script>
</body>

</html>

<?php
function getData($table)
{
   global $conn;
   $sql = $conn->query("SELECT * FROM $table");
   return mysqli_num_rows($sql);
}
?>