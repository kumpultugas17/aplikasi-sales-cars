<?php
session_start();
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
                     <a class="nav-link text-nowrap me-3" aria-current="page" href="dashboard.php">
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
                     <a class="nav-link text-nowrap active" href="report.php">
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
            <div class="d-flex flex-column flex-lg-row mb-2">
               <!-- Page Title -->
               <div class="flex-grow-1">
                  <h5 class="page-title">Sales</h5>
               </div>
               <div class="pt-lg-1">
                  <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                           <a href="dashboard.php" class="text-breadcrumb text-decoration-none">
                              <i class="ti ti-home fs-6"></i>
                           </a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                           Sales
                        </li>
                     </ol>
                  </nav>
               </div>
            </div>

            <!-- Pesan -->
            <?php if (isset($_GET['msg']) and $_GET['msg'] == 'success') { ?>
               <div class="alert alert-success d-flex align-items-center">
                  <i class="ti ti-circle-check fs-5 me-2"></i> Sukses! Data baru berhasil ditambahkan.
               </div>
            <?php } ?>

            <div class="bg-white rounded-2 shadow-sm mb-4 pt-3 px-3">
               <div class="row">
                  <div class="d-grid d-lg-block col-lg-5 col-xl-6">
                     <form action="" method="GET">
                        <div class="input-group mb-3">
                           <input type="date" class="form-control" name="start_date">
                           <span class="input-group-text">to</span>
                           <input type="date" class="form-control" name="end_date">
                           <button class="btn btn-success" type="submit">Search</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>

            <!-- Sembunyikan jika tidak dicari -->
            <?php if (isset($_GET['start_date']) and isset($_GET['end_date']) and !empty($_GET['start_date']) and !empty($_GET['end_date'])) { ?>

               <div class="bg-white rounded-2 shadow-sm pt-4 px-4 pb-3 mb-5">
                  <!-- tabel tampil data -->
                  <div class="table-responsive mb-3">
                     <table class="table table-bordered table-striped table-hover" style="width:100%">
                        <thead>
                           <th class="text-center">No.</th>
                           <th class="text-center">Sales Name</th>
                           <th class="text-center">Car Name</th>
                           <th class="text-center">Price</th>
                        </thead>
                        <tbody>
                           <?php
                           // Ambil nilai pencarian
                           $search_start = isset($_GET['start_date']) ? trim($_GET['start_date']) : '';
                           $search_end = isset($_GET['end_date']) ? trim($_GET['end_date']) : '';
                           // Bersihkan input untuk menghindari SQL injection
                           $search_clean_start = htmlspecialchars($search_start, ENT_QUOTES, 'UTF-8');
                           $search_clean_end = htmlspecialchars($search_end, ENT_QUOTES, 'UTF-8');
                           // Tambahkan kondisi pencarian jika ada
                           $search_condition = $search_start && $search_end ? "WHERE sale_date BETWEEN '$search_clean_start' AND '$search_clean_end'" : "";
                           $query = "SELECT transactions.*, sales.name, cars.merk, cars.model, cars.tahun, cars.harga FROM transactions INNER JOIN sales ON transactions.sales_id = sales.id INNER JOIN cars ON transactions.car_id = cars.id $search_condition";
                           $result = $conn->query($query);
                           if ($result->num_rows > 0) {
                              $no = 1;
                              foreach ($result as $data) {
                           ?>
                                 <tr>
                                    <td width="30" class="text-center"><?= $no++ ?></td>
                                    <td width="200"><?= $data['name'] ?></td>
                                    <td width="200"><?= $data['merk'] . ' ' . $data['model'] . ' ' . $data['tahun'] ?></td>
                                    <td width="200"><?= $data['harga'] ?></td>
                                 </tr>

                              <?php } ?>
                           <?php } else { ?>
                              <tr>
                                 <td colspan="5">
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

            <?php } ?>
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