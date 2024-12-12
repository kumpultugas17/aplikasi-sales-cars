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
   <!-- Select2 CSS -->
   <link rel="stylesheet" href="assets/select2/css/select2.min.css">
   <!-- Sweetalert CSS -->
   <link rel="stylesheet" href="assets/sweetalert2/sweetalert2.min.css">
   <!-- Template CSS -->
   <link rel="stylesheet" href="assets/css/app.css">
   <!-- jQuery Core -->
   <script src="assets/js/jquery-3.7.1.min.js"></script>
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
                     <a class="nav-link text-nowrap me-3 active" href="transactions.php">
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
            <div class="d-flex flex-column flex-lg-row mb-2">
               <!-- Page Title -->
               <div class="flex-grow-1">
                  <h5 class="page-title">Create Transaction</h5>
               </div>
               <div class="pt-lg-1">
                  <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                           <a href="cars.php" class="text-breadcrumb text-decoration-none">
                              <i class="ti ti-home fs-6"></i>
                           </a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                           Transaction
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                           Create
                        </li>
                     </ol>
                  </nav>
               </div>
            </div>

            <div class="bg-white rounded-2 shadow-sm p-4 mb-5">
               <!-- form add data -->
               <form action="act_car_add.php" method="POST">
                  <div class="mb-3 row align-items-center">
                     <label class="form-label col-sm-2">Date Transaction <span class="text-danger">*</span></label>
                     <div class="col-sm-10">
                        <input type="date" name="tanggal" class="form-control" autocomplete="off">
                     </div>
                  </div>
                  <div class="mb-3 row align-items-center">
                     <label class="form-label col-sm-2">Sales Name <span class="text-danger">*</span></label>
                     <div class="col-sm-10">
                        <select name="sales" id="sales" class="select2-single">
                           <option value="" disabled selected>Choose Sales</option>
                           <?php
                           $sales = $conn->query("SELECT * FROM sales");
                           foreach ($sales as $s) :
                           ?>
                              <option value="<?= $s['id']; ?>"><?= $s['name']; ?></option>
                           <?php endforeach; ?>
                        </select>
                     </div>
                  </div>
                  <div class="mb-3 row align-items-center">
                     <label class="form-label col-sm-2">Car Name <span class="text-danger">*</span></label>
                     <div class="col-sm-10">
                        <select name="car" id="car" class="select2-single">
                           <option value="" disabled selected>Select Car Model</option>
                           <?php
                           $cars = $conn->query("SELECT * FROM cars");
                           foreach ($cars as $c) :
                           ?>
                              <option value="<?= $c['id']; ?>"><?= $c['merk'] . ' ' . $c['model'] . ' [' . $c['tahun'] . ']'; ?></option>
                           <?php endforeach; ?>
                        </select>
                     </div>
                  </div>
                  <div class="d-grid gap-3 d-sm-flex justify-content-md-start pt-1 offset-lg-2 offset-md-2">
                     <!-- button simpan data -->
                     <button type="submit" class="btn btn-success py-2 px-4">Save</button>
                     <!-- button kembali ke halaman index -->
                     <a href="cars.php" class="btn btn-secondary py-2 px-3">Cancel</a>
                  </div>
               </form>
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
   <!-- Select2 JS -->
   <script src="assets/select2/js/select2.min.js"></script>
   <!-- Sweetalert2 JS -->
   <script src="assets/sweetalert2/sweetalert2.all.min.js"></script>

   <!-- Custom Scripts -->
   <script>
      // select2
      $('.select2-single').each(function() {
         $(this).select2({
            // fix select2 search input focus bug
            dropdownParent: $(this).parent(),
         })
      })
   </script>

</body>

</html>