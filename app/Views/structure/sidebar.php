<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<a href="<?= base_url() ?>" class="brand-link">
		<img src="<?= base_url() ?>/public/img/corporative/logo.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
		<span class="brand-text font-weight-light">PeRa DK</span>
	</a>
	<div class="sidebar">
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

		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column nav-compact nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
				<li class="nav-item menu-open">
					<a href="<?= base_url() ?>" class="nav-link active">
						<i class="nav-icon fas fa-home"></i>
						<p>
							Inicio
						</p>
					</a>
				</li>

				<li class="nav-header">PEDIDOS</li>

				<li class="nav-item">
					<a href="<?= base_url() . route_to('view_order') ?>" class="nav-link">
						<i class="nav-icon fas fa-plus-square"></i>
						<p>
							Crear
						</p>
					</a>
				</li>

				<li class="nav-header">PERMISOS SISTEMA</li>

				<li class="nav-item">
					<a href="<?= base_url() . route_to('view_jobtitles') ?>" class="nav-link">
						<i class="nav-icon far fa-image"></i>
						<p>
							Cargos
						</p>
					</a>
				</li>

				<li class="nav-item">
					<a href="<?= base_url() . route_to('view_employee') ?>" class="nav-link">
						<i class="nav-icon far fa-image"></i>
						<p>
							Empleados
						</p>
					</a>
				</li>
				<li class="nav-header" style="margin-top: 40px;">ADMIN OLD</li>
				<li class="nav-header">Reportes</li>
				<li class="nav-item">
					<a href="<?= base_url() . route_to('admin_old_report_between_dates', date("Y-m-d"), date("Y-m-d")) ?>" class="nav-link">
						<i class="nav-icon fas fa-users"></i>
						<p>
							Clientes
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url() . route_to('admin_old_report_by_references') ?>" class="nav-link">
						<i class="nav-icon fab fa-firefox"></i>
						<p>
							Referencias
						</p>
					</a>
				</li>
			</ul>
		</nav>

	</div>

</aside>