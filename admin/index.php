<!DOCTYPE html>
<html lang="en">
	<?php
date_default_timezone_set('Asia/Jakarta');
		session_start();
		if (!isset($_SESSION['isLogin']) || $_SESSION['isLogin'] === false) {
		    header("Location: login.php");
		    exit(); 
		}
		require('../koneksi.php');
		$query = "SELECT title FROM configs";
		$result = mysqli_query($koneksi, $query);
		$row = mysqli_fetch_assoc($result);
		$title =  $row['title'];
		mysqli_close($koneksi);
		?>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="shortcut icon" href="" type="image/x-icon">
		<title>Dashboard -
			<?php echo $title ?>
		</title>
		<link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
		<script src="../vendor/chart.js/Chart.min.js"></script>
		<link href="../css/sb-admin-2.min.css" rel="stylesheet">
	</head>
	<body id="page-top">
		<div id="wrapper">
		<?php include('sidebar.php')?>
		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content">
				<?php include('navbar.php')?>
				<div class="container-fluid">
				<div class="my-auto bg-white rounded  border p-4">
					<div class="d-sm-flex align-items-center justify-content-between mb-4">
						<h1 class="h3 mb-0 text-gray-800 font-weight-bold">Dashboard</h1>
						<div class="clsBtn">
							<div class="btn-group  mr-2 mt-2 mt-sm-0">
								<a class="btn btn-sm btn-primary  active" href="#" onclick="showTab('presensi')" id="presensiBtn">Presensi</a>
								<a class="btn btn-sm btn-primary  " href="#" onclick="showTab('pemagang')" id="pemagangBtn">Pemagang</a>
							</div>
						</div>
						<a href="javascript:void(0)" id="generateReport" class="d-none d-sm-inline-block btn btn-sm btn-primary "><i
							class="fas fa-download fa-sm text-white-50"></i> Generate Screenshot</a>
						<script>
							var scriptElement=document.createElement("script");scriptElement.src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js",document.head.appendChild(scriptElement),document.getElementById("generateReport").addEventListener("click",(function(){html2canvas(document.body,{onrendered:function(e){var t=e.toDataURL("image/png"),n=new Date,a=String(n.getDate()).padStart(2,"0"),c=String(n.getMonth()+1).padStart(2,"0"),r="report_"+n.getFullYear()+"-"+c+"-"+a+".png",d=document.createElement("a");d.download=r,d.href=t,d.click()}})}));
						</script>
					</div>
					<div class="collapse show" id="presensiTab">
						<?php require('dashboard-presensi.php') ?>
					</div>
					<div class="collapse" id="pemagangTab" style="display: none;">
							<?php require('dashboard-pemagang.php') ?>
					</div>
				<script>
					function showTab(tabName) {
					    var pemagangTab = document.getElementById('pemagangTab');
					    var presensiTab = document.getElementById('presensiTab');
					    var pemagangBtn = document.getElementById('pemagangBtn');
					    var presensiBtn = document.getElementById('presensiBtn');
					
					    if (tabName === 'pemagang') {
					        pemagangTab.style.display = 'block';
					        presensiTab.style.display = 'none';
					    } else if (tabName === 'presensi') {
					        pemagangTab.style.display = 'none';
					        presensiTab.style.display = 'block';
					    }
					    if (tabName === 'pemagang') {
					        pemagangBtn.classList.add('active');
					        presensiBtn.classList.remove('active');
					    } else if (tabName === 'presensi') {
					        pemagangBtn.classList.remove('active');
					        presensiBtn.classList.add('active');
					    }
					}
				</script>
				</div>
			</div>
			<footer class="sticky-footer bg-white border-top mt-5">
				<div class="container my-auto">
					<div class="copyright text-center my-auto">
						<span>Copyright &copy; <?php echo $title ?> 2024</span>
					</div>
				</div>
			</footer>
		</div>
		<a class="scroll-to-top rounded" href="#page-top">
		<i class="fas fa-angle-up"></i>
		</a>
		<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
						<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
					<div class="modal-footer">
						<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
						<a class="btn btn-primary" href="logout.php">Logout</a>
					</div>
				</div>
			</div>
		</div>
		<script src="../vendor/jquery/jquery.min.js"></script>
		<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
		<script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
		<script src="../js/sb-admin-2.min.js"></script>
		<script>
			$(document).ready(function(){
			$('.clsBtn a').click(function () {
			$('.collapse').collapse('hide');
			});
			});
		</script>
	</body>
</html>