<?php
session_start();
if (!isset($_SESSION['login'])) {
   header('location:login.php');
   exit;
}
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
   <!-- Sweetalert -->
   <link rel="stylesheet" href="assets/sweetalert2/sweetalert2.min.css">
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
                     <a class="nav-link text-nowrap me-3 active" href="sales.php">
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

            <div class="bg-white rounded-2 shadow-sm p-4 mb-4">
               <div class="row">
                  <div class="d-grid d-lg-block col-lg-5 col-xl-6">
                     <!-- button form add data -->
                     <a href="sales-create.php" class="btn btn-success py-2 px-3">
                        <i class="ti ti-plus me-2"></i> Add Sales
                     </a>
                  </div>
                  <div class="col-lg-7 col-xl-6">
                     <!-- form pencarian -->
                     <form action="" method="GET">
                        <div class="input-group">
                           <input type="text" name="search" class="form-control form-search py-2" placeholder="Search sales ..." autocomplete="off">
                           <button class="btn btn-success py-2" type="submit">Search</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>

            <div class="bg-white rounded-2 shadow-sm pt-4 px-4 pb-3 mb-5">
               <!-- tabel tampil data -->
               <div class="table-responsive mb-3">
                  <table class="table table-bordered table-striped table-hover" style="width:100%">
                     <thead>
                        <th class="text-center">No.</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">E-mail</th>
                        <th class="text-center">Phone</th>
                        <th class="text-center">Actions</th>
                     </thead>
                     <tbody>
                        <?php
                        $conn = mysqli_connect('localhost', 'root', '', 'db_mik2_sales_car');
                        // Jumlah data per halaman
                        $limit = 5;
                        // Ambil halaman saat ini
                        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                        $page = max($page, 1); // Halaman minimal adalah 1
                        // Hitung offset
                        $offset = ($page - 1) * $limit;
                        // Ambil nilai pencarian
                        $search = isset($_GET['search']) ? trim($_GET['search']) : '';
                        // Bersihkan input untuk menghindari SQL injection
                        $search_clean = htmlspecialchars($search, ENT_QUOTES, 'UTF-8');
                        // Tambahkan kondisi pencarian jika ada
                        $search_condition = $search ? "WHERE name LIKE '%$search_clean%'" : "";
                        // Hitung total hasil
                        $total_results_query = "SELECT COUNT(*) AS total FROM sales $search_condition";
                        $total_results_result = $conn->query($total_results_query);
                        $total_results = $total_results_result->fetch_assoc()['total'];
                        // Hitung total halaman
                        $total_pages = ceil($total_results / $limit);
                        // Query data dengan limit dan offset
                        $query = "SELECT * FROM sales $search_condition LIMIT $limit OFFSET $offset";
                        $result = $conn->query($query);
                        if ($result->num_rows > 0) {
                           $no = 1;
                           foreach ($result as $data) {
                        ?>
                              <tr>
                                 <td width="30" class="text-center"><?= $no++ ?></td>
                                 <td width="200"><?= $data['name'] ?></td>
                                 <td width="200"><?= $data['email'] ?></td>
                                 <td width="200"><?= $data['phone'] ?></td>
                                 <td width="70" class="text-center">
                                    <!-- button form edit data -->
                                    <a href="sales-edit.php?id=<?= $data['id'] ?>" class="btn btn-primary btn-sm m-1" data-bs-tooltip="tooltip" data-bs-title="Edit">
                                       <i class="ti ti-edit"></i>
                                    </a>
                                    <!-- button modal hapus data -->
                                    <button type="button" class="btn btn-danger btn-sm m-1" data-bs-toggle="modal" data-bs-target="#confirmHapus<?= $data['id'] ?>" data-bs-tooltip="tooltip" data-bs-title="Delete">
                                       <i class="ti ti-trash"></i>
                                    </button>
                                 </td>
                              </tr>

                              <!-- Modal hapus data -->
                              <div class="modal fade" id="confirmHapus<?= $data['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
                                 <div class="modal-dialog">
                                    <div class="modal-content">
                                       <div class="modal-header">
                                          <h1 class="modal-title fs-5" id="exampleModalLabel">
                                             <i class="ti ti-trash me-2"></i> Delete Sales
                                          </h1>
                                       </div>
                                       <div class="modal-body">
                                          <!-- informasi data yang akan dihapus -->
                                          <p class="mb-2">
                                             Are you sure to delete <span class="fw-bold mb-2">
                                                <?= $data['name'] ?>
                                             </span>?
                                          </p>
                                       </div>
                                       <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary py-2 px-3" data-bs-dismiss="modal">Cancel</button>
                                          <form action="act_sales_delete.php" method="POST">
                                             <input type="hidden" name="id_delete" value="<?= $data['id'] ?>">
                                             <button type="submit" class="btn btn-danger py-2 px-3"> Yes, delete it! </button>
                                          </form>
                                       </div>
                                    </div>
                                 </div>
                              </div>

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
               <!-- pagination -->
               <nav aria-label="..." class="px-0 mx-0">
                  <?php if ($total_pages > 1) { ?>
                     <ul class="pagination">
                        <?php if ($page > 1) { ?>
                           <li class="page-item">
                              <a href="?search=<?= urlencode($search) ?>&page=<?= ($page - 1) ?>" class="page-link">Previous</a>
                           </li>
                        <?php } else { ?>
                           <li class="page-item">
                              <a href="?search=<?php urlencode($search) ?>&page=<?php ($page - 1) ?>" class="page-link">Previous</a>
                           </li>
                        <?php } ?>

                        <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                           <?php if ($i == $page) { ?>
                              <li class="page-item active border-0">
                                 <a class="page-link" href="?search=<?= urlencode($search) ?>&page=<?= $i ?>"><?= $i ?></a>
                              </li>
                           <?php   } else { ?>
                              <li class="page-item">
                                 <a class="page-link" href="?search=<?= urlencode($search) ?>&page=<?= $i ?>"><?= $i ?></a>
                              </li>
                           <?php } ?>
                        <?php } ?>

                        <?php if ($page < $total_pages) { ?>
                           <li class="page-item">
                              <a class="page-link" href="?search=<?= urlencode($search) ?>&page=<?= ($page + 1) ?>">Next</a>
                           </li>
                        <?php } else { ?>
                           <li class="page-item disabled">
                              <a class="page-link" href="?search=<?= urlencode($search) ?>&page=<?= ($page + 1) ?>">Next</a>
                           </li>
                        <?php } ?>
                     </ul>
                  <?php } ?>
               </nav>
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
   <script src="assets/sweetalert2/sweetalert2.all.min.js"></script>
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