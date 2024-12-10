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

            <div class="bg-white rounded-2 shadow-sm mb-4 pt-3 px-3">
               <div class="row">
                  <div class="d-grid d-lg-block col-lg-5 col-xl-6">
                     <!-- button modal Add Transaction -->
                     <button type="button" class="btn btn-success px-3" data-bs-toggle="modal" data-bs-target="#addTransaction">
                        <i class="ti ti-plus me-2"></i> Add Transaction
                     </button>
                     <!-- form modal Add Transaction -->
                     <div class="modal fade" id="addTransaction" tabindex="-1" aria-labelledby="addTransactionLabel" aria-hidden="true">
                        <div class="modal-dialog">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="addTransactionLabel">Add Transaction</h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <form action="act_transaction_add.php" method="post">
                                 <div class="modal-body">
                                    <div class="mb-3">
                                       <label for="tanggal" class="form-label">Name</label>
                                       <input type="date" class="form-control" name="tanggal" id="tanggal" required>
                                    </div>
                                    <div class="mb-3">
                                       <label for="sales">Sales Name</label>
                                       <select name="sales" id="sales" class="form-select">
                                          <option value="" disabled selected>Select Sales</option>
                                          <?php
                                          $sales = $conn->query("SELECT * FROM sales");
                                          foreach ($sales as $s) :
                                          ?>
                                             <option value="<?= $s['id']; ?>"><?= $s['name']; ?></option>
                                          <?php endforeach; ?>
                                       </select>
                                    </div>
                                    <div class="mb-3">
                                       <label for="car">Car Model</label>
                                       <select name="car" id="car" class="form-select">
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
                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-7 col-xl-6">
                     <!-- form pencarian -->
                     <form action="" method="GET">
                        <div class="input-group">
                           <input type="text" name="search" class="form-control form-search" placeholder="Search sales ..." autocomplete="off">
                           <button class="btn btn-success" type="submit">Search</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>

            <div class="bg-white rounded-2 shadow-sm pt-4 px-4 pb-1 mb-5">
               <div class="table-responsive mb-3">
                  <table class="table table-bordered table-striped table-hover" style="width:100%">
                     <tr>
                        <th>No</th>
                        <th>Date</th>
                        <th>Nama Sales</th>
                        <th>Phone Number</th>
                        <th>Merk</th>
                        <th>Year</th>
                        <th>Price</th>
                     </tr>
                     <?php
                     $transaksi = $conn->query("SELECT transactions.*, sales.name, sales.phone, cars.merk, cars.tahun, cars.harga FROM transactions INNER JOIN sales ON transactions.sales_id = sales.id INNER JOIN cars ON transactions.car_id = cars.id");
                     $no = 1;
                     foreach ($transaksi as $data) :
                     ?>
                        <tr>
                           <td><?= $no++ ?></td>
                           <td><?= $data['sale_date'] ?></td>
                           <td><?= $data['name'] ?></td>
                           <td><?= $data['phone'] ?></td>
                           <td><?= $data['merk'] ?></td>
                           <td><?= $data['tahun'] ?></td>
                           <td><?= $data['harga'] ?></td>
                        </tr>
                     <?php endforeach ?>
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

   <!-- Notifications -->
   <?php if (isset($_SESSION['success'])) { ?>
      <script>
         Swal.fire({
            position: "top-end",
            icon: "success",
            title: "<?= $_SESSION['success'] ?>",
            showConfirmButton: false,
            timer: 1500
         });
      </script>
   <?php }
   unset($_SESSION['success']); ?>
</body>

</html>