	<!-- Main Sidebar Container -->
	<aside class="main-sidebar sidebar-dark-primary elevation-4">
		<!-- Brand Logo -->
		<a href="<?= base_url() ?>" class="brand-link">
			<img src="<?= base_url() ?>/public/img/corporative/logo.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
			<span class="brand-text font-weight-light">PeRa DK</span>
		</a>

		<!-- Sidebar -->
		<div class="sidebar">
			<!-- Sidebar user panel (optional) -->
			<div class="user-panel mt-3 pb-3 mb-3 d-flex">
				<div class="image">
					<img src="<?= base_url() ?>/public/img/users/<?= session()->image_employee ?>" class="img-circle elevation-2" alt="User">
				</div>
				<div class="info">
					<a href="#" class="d-block">
						<?= session()->name_employee ?><br><?= session()->jobtitle_name ?>
					</a>
				</div>
			</div>

			<!-- SidebarSearch Form -->
			<div class="form-inline">
				<div class="input-group" data-widget="sidebar-search">
					<input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
					<div class="input-group-append">
						<button class="btn btn-sidebar">
							<i class="fas fa-search fa-fw"></i>
						</button>
					</div>
				</div>
			</div>

			<!-- Sidebar Menu -->
			<nav class="mt-2">
				<ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
					<li class="nav-item menu-open">
						<a href="<?= base_url() ?>" class="nav-link active">
							<i class="nav-icon fas fa-home"></i>
							<p>
								Inicio
							</p>
						</a>
					</li>

					<li class="nav-header" style="margin-top: 40px;">ADMIN OLD</li>
					<li class="nav-header">Reportes</li>
					<li class="nav-item">
						<a href="#" class="nav-link">
							<i class="nav-icon fas fa-users"></i>
							<p>
								Clientes
								<i class="right fas fa-angle-left"></i>
							</p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url() . route_to('admin_old_report_between_dates', date("Y-m-d"), date("Y-m-d")) ?>" class="nav-link">
									<i class="fas fa-calendar-week nav-icon"></i>
									<p>Clientes entre fechas</p>
								</a>
							</li>
						</ul>
						<!-- <ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url() . route_to('admin_old_report_between_dates', date("Y-m-d"), date("Y-m-d")) ?>" class="nav-link">
									<i class="fas fa-calendar-week nav-icon"></i>
									<p>Mayor Compra</p>
								</a>
							</li>
						</ul> -->
					</li>
				</ul>
			</nav>
			<!-- /.sidebar-menu -->
		</div>
		<!-- /.sidebar -->
	</aside>