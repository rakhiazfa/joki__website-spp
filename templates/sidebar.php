 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
     <!-- Brand Logo -->
     <a href="index3.html" class="brand-link">
         <img src="<?php echo BASE_URL . '/assets/dist/img/logo.png' ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
         <span class="brand-text font-weight-light">PEMBAYARAN SPP</span>
     </a>

     <!-- Sidebar -->
     <div class="sidebar">
         <!-- Sidebar user panel (optional) -->
         <div class="user-panel mt-3 pb-3 mb-3 d-flex">
             <div class="info">
                 <a href="#" class="d-block"><?php echo $_SESSION['user']['nama_petugas'] ?? 'Ragil Anugraha' ?></a>
             </div>
         </div>

         <!-- Sidebar Menu -->
         <nav class="mt-2">
             <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                 <?php if (isset($_SESSION['siswa'])) { ?>
                     <li class="nav-item">
                         <a href="<?php echo BASE_URL . '/siswa' ?>" class="nav-link">
                             <i class='nav-icon fas fa-file-invoice'></i>
                             <p>
                                 Riwayat Transaksi
                             </p>
                         </a>
                     </li>
                 <?php } else { ?>
                     <li class="nav-item">
                         <a href="<?php echo BASE_URL ?>" class="nav-link">
                             <i class="nav-icon fas fa-tachometer-alt"></i>
                             <p>
                                 Dashboard
                             </p>
                         </a>
                     </li>
                 <?php } ?>

                 <?php if (isset($_SESSION['user'])) { ?>
                     <?php if (($_SESSION['user']['level'] ?? null) == 'admin') { ?>

                         <li class="nav-header">MENU / ITEM</li>

                         <li class="nav-item">
                             <a href="#" class="nav-link">
                                 <i class="nav-icon fas fa-user-alt"></i>
                                 <p>
                                     Pengguna
                                     <i class="right fas fa-angle-left"></i>
                                 </p>
                             </a>
                             <ul class="nav nav-treeview">
                                 <li class="nav-item">
                                     <a href="<?php echo BASE_URL . '/admin/petugas' ?>" class="nav-link">
                                         <i class="far fa-circle nav-icon"></i>
                                         <p>Petugas</p>
                                     </a>
                                 </li>
                                 <li class="nav-item">
                                     <a href="<?php echo BASE_URL . '/admin/siswa' ?>" class="nav-link">
                                         <i class="far fa-circle nav-icon"></i>
                                         <p>Siswa</p>
                                     </a>
                                 </li>
                             </ul>
                         </li>

                         <li class="nav-item">
                             <a href="<?php echo BASE_URL . '/admin/kelas' ?>" class="nav-link">
                                 <i class="nav-icon fas fa-table"></i>
                                 <p>
                                     Data Kelas
                                 </p>
                             </a>
                         </li>

                         <li class="nav-item">
                             <a href="<?php echo BASE_URL . '/admin/spp' ?>" class="nav-link">
                                 <i class="nav-icon fas fa-file-alt"></i>
                                 <p>
                                     Data SPP
                                 </p>
                             </a>
                         </li>

                     <?php } ?>

                     <li class="nav-header">TRANSAKSI</li>

                     <li class="nav-item">
                         <a href="<?php echo BASE_URL . '/transaksi' ?>" class="nav-link">
                             <i class='nav-icon fas fa-file-signature'></i>
                             <p>
                                 Entri Transaksi
                             </p>
                         </a>
                     </li>

                     <li class="nav-item">
                         <a href="<?php echo BASE_URL . '/riwayat_transaksi' ?>" class="nav-link">
                             <i class='nav-icon fas fa-file-invoice'></i>
                             <p>
                                 Riwayat Transaksi
                             </p>
                         </a>
                     </li>
                 <?php } ?>

                 <li class="nav-item">
                     <a href="<?php echo BASE_URL . '/proses_logout.php' ?>" class="nav-link">
                         <i class="nav-icon fas fa-sign-out-alt"></i>
                         <p>
                             Keluar
                         </p>
                     </a>
                 </li>

             </ul>
         </nav>
         <!-- /.sidebar-menu -->
     </div>
     <!-- /.sidebar -->
 </aside>