<nav class="navbar navbar-expand navbar-dark text-white bg-primary topbar static-top shadow">
<div class="mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
  <a class="navbar-brand font-weight-bold " href="index.php">
<?php require_once('koneksi.php'); $query = "SELECT title FROM configs";
    $result = mysqli_query($koneksi, $query);
    $row = mysqli_fetch_assoc($result);
    $title =  $row['title']; echo $title  ?>
    </a>
</div>
<ul class="navbar-nav ml-auto">
    <div class="topbar-divider d-none d-sm-block"></div>
    <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline  text-white small "><?php
    require('koneksi.php');
    $username = $_SESSION['login_user'];
    $query = "SELECT nama FROM user WHERE username = '$username'";
    $result = mysqli_query($koneksi, $query);
    $row = mysqli_fetch_assoc($result);
    echo $row['nama'];
    mysqli_close($koneksi);
    ?></span>
            <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
        </a>
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="profil.php">
              <i class="fas fa-fw fa-user mr-2 text-gray-400"></i>
            Profil</a>
            <a class="dropdown-item" href="riwayat-presensi.php">
              <i class="fas fa-fw fa-calendar mr-2 text-gray-400"></i>
            Riwayat Presensi</a>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Logout
            </a>
    </li>
</ul>
</nav>