<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<a href="<?= base_url() ?>" class="brand-link">
		<img src="<?= base_url() ?>/img/corporative/logo.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
		<span class="brand-text font-weight-light">PERACOLOMBIA</span>
	</a>
	<div class="sidebar">
		<div class="user-panel justify-content-center mt-1 pb-1 mb-1 d-flex">
			<div class="image">
				<img src="<?= base_url() ?>/img/users/<?= session()->image_employee ?>" class="img-circle" alt="User">
			</div>
		</div>
		<div class="user-panel justify-content-center mt-3 pb-3 mb-3 d-flex">
			<a href="#" class="d-block text-center">
				<?= session()->name_employee ?><br><?= session()->jobtitle_name ?>
			</a>
		</div>
		<div class="form-inline">
			<div class="input-group" data-widget="sidebar-search">
				<input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
				<div class="input-group-append">
					<button style="font-size:0.8rem" class="btn btn-sidebar">
						<i class="fas fa-search fa-fw"></i>
					</button>
				</div>
			</div>
		</div>

		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column nav-compact nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
				<li class="nav-item">
					<a href="<?= base_url() ?>" class="nav-link <?= $this->renderSection('active-home') ?>">
						<i class="nav-icon fas fa-home"></i>
						<p>
							Inicio
						</p>
					</a>
				</li>

				<li class="nav-item has-treeview <?= $this->renderSection('menu-cotizador') ?>">
					<a href="#" class="nav-link <?= $this->renderSection('active-cotizador') ?>">
						<i class="nav-icon fas fa-chart-pie"></i>
						<p>
							Cotizadores
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?= base_url() . route_to('quoter_normal') ?>" class="nav-link <?= $this->renderSection('active-cotizador-normal') ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Normal</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url() . route_to('quoter_promotion') ?>" class="nav-link <?= $this->renderSection('active-cotizador-promotion') ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Promoci&oacute;n</p>
							</a>
						</li>
					</ul>
				</li>

				<li class="nav-header">PEDIDOS</li>

				<li class="nav-item">
					<a href="<?= base_url() . route_to('view_order') ?>" class="nav-link <?= $this->renderSection('active-ingresar') ?>">
						<i class="nav-icon fas fa-plus-square"></i>
						<p>
							Ingresar
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url() . route_to('view_load_order') ?>" class="nav-link <?= $this->renderSection('active-cargar-pedido') ?>">
						<i class="nav-icon fas fa-search"></i>
						<p>
							Cargar Pedido
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url() . route_to('view_to_pass_producction') ?>" class="nav-link <?= $this->renderSection('active-por-pasar') ?>">
						<i class="nav-icon fas fa-unlock-alt"></i>
						<p>
							Por pasar a producci&oacute;n
						</p>
					</a>
				</li>

				<li class="nav-header">PRODUCCION</li>

				<li class="nav-item">
					<a href="<?= base_url() . route_to('view_production') ?>" class="nav-link <?= $this->renderSection('active-produccion') ?>">
						<i class="nav-icon fas fa-sort-amount-down-alt"></i>
						<p>
							Producci&oacute;n
						</p>
					</a>
				</li>

				<li class="nav-header">PERMISOS SISTEMA</li>

				<li class="nav-item">
					<a href="<?= base_url() . route_to('view_jobtitles') ?>" class="nav-link <?= $this->renderSection('active-cargos') ?>">
						<i class="nav-icon far fa-image"></i>
						<p>
							Cargos
						</p>
					</a>
				</li>

				<li class="nav-item">
					<a href="<?= base_url() . route_to('view_employee') ?>" class="nav-link <?= $this->renderSection('active-empleados') ?>">
						<i class="nav-icon far fa-image"></i>
						<p>
							Empleados
						</p>
					</a>
				</li>
				<li class="nav-header" style="margin-top: 40px;">ADMIN OLD</li>
				<li class="nav-header">Reportes</li>
				<li class="nav-item">
					<a href="<?= base_url() . route_to('admin_old_report_between_dates', date("Y-m-d"), date("Y-m-d")) ?>" class="nav-link <?= $this->renderSection('active-clientes') ?>">
						<i class="nav-icon fas fa-users"></i>
						<p>
							Clientes
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url() . route_to('admin_old_report_by_references') ?>" class="nav-link <?= $this->renderSection('active-referencias') ?>">
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