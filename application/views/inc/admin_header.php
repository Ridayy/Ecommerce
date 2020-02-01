<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Admin - Dashboard</title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url(); ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="<?php echo base_url(); ?>assets/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->

  <link href="<?php echo base_url(); ?>assets/css/sb-admin.css" rel="stylesheet">

  <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>

 
</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="index.html">Admin</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
     
     
    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
            <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle fa-fw"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <button type="button" class="dropdown-item" data-toggle="modal" data-target="#settingsModal">
           Settings
          </button>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
        </div>
      </li>
    </ul>

  </nav>

  <div id="wrapper">
 
    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="<?= base_url(). 'admins/dashboard'; ?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url().'admins/products'; ?>">
          <i class="fas fa-tshirt"></i>
          <span>Manage Products</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url().'admins/categories'; ?>">
          <i class="fas fa-list"></i>
          <span>Categories</span></a>
      </li>

  
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="ordersdropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-shopping-cart"></i>
          <span>Orders</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="ordersdropdown">
          <a class="dropdown-item font-weight-bold" href="<?php echo base_url(). 'orders/get_pending'; ?>">Pending</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item font-weight-bold" href="<?php echo base_url(). 'orders/get_confirmed'; ?>">Confirmed</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item font-weight-bold" href="<?php echo base_url(). 'orders/get_completed'; ?>">Completed</a>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url(). 'admins/users'; ?>">
          <i class="fas fa-users"></i>
          <span>Users</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url(). 'admins/faqs'; ?>">
          <i class="fas fa-question"></i>
          <span>Faqs</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url(). 'admins/reviews'; ?>">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Reviews</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url(). 'admins/slides'; ?>">
          <i class="fas fa-square"></i>
          <span>Slides</span></a>
      </li>

    </ul>

    <div id="content-wrapper">

      <div class="container-fluid">