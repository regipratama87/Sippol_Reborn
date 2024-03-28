<style>

	.active {
		font-weight: 700;
		margin-left : 8px;
		transition: all 0.5s ease-out allow-discrete;
		text-decoration: underline;
		fill : white;
	}
	.active i {
		color: rgba(255, 255, 255,1)!important;
	}
</style>

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
	<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
		<div class="sidebar-brand-icon rotate-n-15">
			<i class="fas fa-laugh-wink"></i>
		</div>
		<div class="sidebar-brand-text mx-3">
			<?php echo $title  ?>
		</div>
	</a>
	<hr class="sidebar-divider my-0">
	<li class="nav-item">
		<a class="nav-link" href="index.php">
		<i class="fas fa-fw fa-tachometer-alt"></i>
		<span>Dashboard</span></a>
	</li>
	<hr class="sidebar-divider">
	<div class="sidebar-heading">
		Data Presensi
	</div>
	<li class="nav-item">
		<a class="nav-link" href="data-presensi.php">
		<i class="fas fa-fw fa-calendar"></i>
		<span>Presensi</span></a>
	</li>
	<hr class="sidebar-divider">
	<div class="sidebar-heading">
		Master
	</div>
	<li class="nav-item">
		<a class="nav-link" href="data-pemagang.php">
		<i class="fas fa-user-circle"></i>
		<span>Akun Pemagang</span></a>
	</li>
	<li class="nav-item mt-n3">
		<a class="nav-link" href="data-instansi.php">
		<i class="fas fa-fw fa-chart-area"></i>
		<span>Instansi</span></a>
	</li>
	<li class="nav-item mt-n3">
		<a class="nav-link" href="data-pengajuan.php">
		<i class="fas fa-fw fa-file-pdf"></i>
		<span>Pengajuan</span></a>
	</li>
	<hr class="sidebar-divider">
	<div class="sidebar-heading">
		Laporan
	</div>
	<li class="nav-item">
		<a class="nav-link" href="export.php">
		<i class="fas fa-fw fa-download"></i>
		<span>Export</span></a>
	</li>
	<hr class="sidebar-divider d-none d-md-block">
	<div class="text-center d-none d-md-inline">
		<button class="rounded-circle border-0" id="sidebarToggle"></button>
	</div>
</ul>

<script>
	document.querySelectorAll(".nav-link").forEach((link) => {
    if (link.href === window.location.href) {
        link.classList.add("active");
        link.setAttribute("aria-current", "page");
    }
});
</script>
