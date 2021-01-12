<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Dashboard</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Dashboard v1</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<!-- Small boxes (Stat box) -->
			<div class="row">
				<div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-info">
						<div class="inner">
							<h3><?php
								$data = $this->db->get('jurusan')->result();
								echo count($data);
								?></h3>

							<p>Data Jurusan</p>
						</div>
						<div class="icon">
							<!-- <i class="ion ion-bag"></i> -->
							<i class="fas fa-fw fa-graduation-cap"></i>
						</div>
						<a href="<?= base_url('jurusan') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-success">
						<div class="inner">
							<h3>
								<?php
								$data = $this->db->get('mata_kuliah')->result();
								echo count($data);
								?></h3>

							<p>Mata Kuliah</p>
						</div>
						<div class="icon">
							<i class="fas fa-book-open"></i>
						</div>
						<a href="<?= base_url('mata_kuliah') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-danger">
						<div class="inner">
							<h3><?php
								$data = $this->db->get('mahasiswa')->result();
								echo count($data);
								?></h3>

							<p>Mahasiswa</p>
						</div>
						<div class="icon">
							<i class="fas fa-fw fa-users"></i>
						</div>
						<a href="<?= base_url('mahasiswa') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
			</div>
			<!-- /.row -->
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->