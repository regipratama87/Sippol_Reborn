<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top border-bottom">
	<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
	<i class="fa fa-bars"></i>
	</button>
	<div class="mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
<style>
  #clock {
    /* text-align: center; */
    font-size: 16px;
    padding: 10px;
  }

  @media only screen and (max-width: 768px) {
    #clock {
      font-size: 14px;
    }
  }
</style>
		<div id="clock" class="my-auto"></div>
		<script>
			function padZero(num) {
    return (num < 10 ? "0" : "") + num;
}

var months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

setInterval(function() {
    var now = new Date();
    var daysArray = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
var day = new Date().getDay();
var dayName = daysArray[day];
    var hours = padZero(now.getHours());
    var minutes = padZero(now.getMinutes());
    var seconds = padZero(now.getSeconds());
    var tanggal = padZero(now.getDate());
    var month = months[now.getMonth()];
    var year = now.getFullYear();

    var formattedDate = dayName + " " +  tanggal + " " + month + " " + year;
    var time = hours + ":" + minutes + ":" + seconds;

    document.getElementById("clock").innerHTML = formattedDate + " - " + time;
}, 1000);

		</script>
	</div>
	<ul class="navbar-nav ml-auto">
		<div class="topbar-divider d-none d-sm-block"></div>
		<li class="nav-item dropdown no-arrow">
			<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php
				require('../koneksi.php');
				$query = "SELECT * FROM admin";
				$result = mysqli_query($koneksi, $query);
				$row = mysqli_fetch_assoc($result);
				echo $row['nama'];
				mysqli_close($koneksi);
				?></span>
			<img class="img-profile rounded-circle" src="../img/undraw_profile_2.svg">
			</a>
			<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown"> 
			  <a class="dropdown-item" href="profil.php">
				  <i class="fas fa-fw fa-user-circle mr-2 text-gray-400"></i>&nbsp;Profil
        </a>           
				<a class="dropdown-item" href="konfigurasi.php">
				  <i class="fas fa-fw fa-cogs mr-2 text-gray-400"></i>&nbsp;Konfigurasi
        </a>
				<a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
				  <i class="fas fa-fw fa-sign-out-alt mr-2 text-gray-400"></i>&nbsp;Logout
				</a>
			</div>
		</li>
	</ul>
</nav>