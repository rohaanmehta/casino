<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Admin </title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <link rel="stylesheet" href="public/plugins/fontawesome-free/css/all.min.css">

  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

  <link rel="stylesheet" href="public/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

  <link rel="stylesheet" href="public/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

  <link rel="stylesheet" href="public/plugins/jqvmap/jqvmap.min.css">

  <link rel="stylesheet" href="public/dist/css/adminlte.min.css?v=3.2.0">

  <link rel="stylesheet" href="public/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

  <link rel="stylesheet" href="public/plugins/daterangepicker/daterangepicker.css">

  <link rel="stylesheet" href="public/plugins/summernote/summernote-bs4.min.css">
  <style>
    .pagination li{
      width: 100%;
      padding: 10px 15px 10px 15px;
      background-color:#c5c5c5;
      color:#000;
    }
    .pagination li a{
      color:#000 !important;
    }

    .pagination .active{
      background-color:#7a7a7a !important;
    }
  </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <nav class="main-header navbar navbar-expand navbar-white navbar-light">

      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
    </nav>


    <aside class="main-sidebar sidebar-dark-primary elevation-4">

      <a href="index3.html" class="brand-link">
        <span class="brand-text font-weight-light">Casino Corners </span>
      </a>

      <div class="sidebar">
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="<?= base_url('dashboard'); ?>" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('admin_users'); ?>" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  Users
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('admin_deposits'); ?>" class="nav-link">
                <i class="nav-icon fas fa-credit-card"></i>
                <p>
                  Deposits
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('admin_withdraw'); ?>" class="nav-link">
                <i class="nav-icon fas fa-university"></i>
                <p>
                  Withdraws
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('admin_msgs')?>" class="nav-link">
                <i class="nav-icon fas fa-comments"></i>
                <p>
                  Messages
                  <span class="right badge badge-danger">New</span>
                </p>
              </a>
            </li>
          </ul>
        </nav>

      </div>

    </aside>

    <?= $this->renderSection('content') ?>
    
    <footer class="main-footer">
      <strong>Copyright &copy; 2023 <a href="<?= base_url() ?>">Casino Corners </a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <!-- <b>Version</b> 3.2.0 -->
      </div>
    </footer>

    <aside class="control-sidebar control-sidebar-dark">

    </aside>

  </div>


  <script src="public/plugins/jquery/jquery.min.js"></script>

  <script src="public/plugins/jquery-ui/jquery-ui.min.js"></script>

  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>

  <script src="public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

  <script src="public/plugins/chart.js/Chart.min.js"></script>

  <script src="public/plugins/sparklines/sparkline.js"></script>

  <script src="public/plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="public/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>

  <script src="public/plugins/jquery-knob/jquery.knob.min.js"></script>

  <script src="public/plugins/moment/moment.min.js"></script>
  <script src="public/plugins/daterangepicker/daterangepicker.js"></script>

  <script src="public/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

  <script src="public/plugins/summernote/summernote-bs4.min.js"></script>

  <script src="public/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

  <script src="public/dist/js/adminlte.js?v=3.2.0"></script>

  <script src="public/dist/js/demo.js"></script>

  <script src="public/dist/js/pages/dashboard.js"></script>
</body>

</html>