<div class="col-md-3">
	<!-- Barra de navegación con iconos y etiquetas -->
	<ul class="list-group">
		<?php
		$this->load->model('ModelReporte');
		$validado = $this->ModelReporte->get_Session();; ?>
		<?php
		if (!empty($validado)) {
			if ($validado[0]->rol == 'usuario') { ?>
				<li class="list-group-item custom-list-item">
					<a href="<?php echo base_url(); ?>" class="custom-link">
						<i class="fas fa-home"></i> Home
					</a>
				</li>
			<?php } else ?>

		<?php } else { ?>
			<li class="list-group-item custom-list-item">
				<a href="<?php echo base_url(); ?>" class="custom-link">
					<i class="fas fa-home"></i> Home
				</a>
			</li>
		<?php }; ?>
		<?php
		if (!empty($validado)) {  ?>
			<?php
			if ($validado[0]->rol == 'usuario') { ?>
				<li class="list-group-item custom-list-item">
					<a href="<?php echo base_url(); ?>reportar/incidencia" class="custom-link">
						<i class="fas fa-pencil-alt"></i> Reportar Incidente
					</a>
				</li>
			<?php }
		} else {; ?>
			<li class="list-group-item custom-list-item">
				<a href="<?php echo base_url(); ?>reportar/incidencia" class="custom-link">
					<i class="fas fa-pencil-alt"></i> Reportar Incidente
				</a>
			</li>
		<?php }; ?>
		<?php
		if (!empty($validado)) {  ?>
			<?php
			if ($validado[0]->rol == 'admin' || $validado[0]->rol == 'operador') { ?>
				<li class="list-group-item custom-list-item">
					<a href="<?php echo base_url('ver/alert'); ?>" class="custom-link">
						<i class="fas fa-bell"></i> Alertas
						<span id="numero-alertas" class="badge badge-danger"></span> <!-- Ejemplo de número de alertas -->
					</a>
				</li>
		<?php }
		}; ?>
		<?php
		if (!empty($validado)) {  ?>
			<?php
			if ($validado[0]->rol == 'usuario') { ?>
				<li class="list-group-item custom-list-item">
					<a href="<?php echo base_url('mis/incidencias'); ?>" class="custom-link">
						<i class="fas fa-list"></i> Mis Incidentes
					</a>
				</li>
		<?php }
		}; ?>
		<?php
		if (!empty($validado)) {  ?>
			<?php
			if ($validado[0]->rol == 'admin' || $validado[0]->rol == 'operador') { ?>

				<li class="list-group-item custom-list-item">
					<a href="<?php echo base_url('incidencias/estadisticas'); ?>" class="custom-link">
						<i class="fas fa-chart-bar"></i> Gráfica - Predicción - Patrones
					</a>
				</li>
		<?php }
		}; ?>
		<?php
		if (!empty($validado)) {  ?>
			<?php
			if ($validado[0]->rol == 'admin' || $validado[0]->rol == 'operador') { ?>
				<li class="list-group-item custom-list-item">
					<a href="<?php echo base_url('incidencias/cerradas'); ?>" class="custom-link">
						<i class="fas fa-lock"></i> Incidencias cerradas
					</a>
				</li>
		<?php }
		}; ?>
		<?php
		if (!empty($validado)) {
			if ($validado[0]->rol == 'usuario') { ?>
				<li class="list-group-item custom-list-item">
					<a href="<?php echo base_url('recursos/emergencias'); ?>" class="custom-link">
						<i class="fas fa-phone"></i> Recursos de Emergencia
					</a>
				</li>
				<li class="list-group-item custom-list-item">
					<a href="<?php echo base_url('recursos/videos'); ?>" class="custom-link">
						<i class="fas fa-video"></i> Noticias
					</a>
				</li>
			<?php }
		} else { ?>
			<li class="list-group-item custom-list-item">
				<a href="<?php echo base_url('recursos/emergencias'); ?>" class="custom-link">
					<i class="fas fa-phone"></i> Recursos de Emergencia
				</a>
			</li>
			<li class="list-group-item custom-list-item">
				<a href="<?php echo base_url('recursos/videos'); ?>" class="custom-link">
					<i class="fas fa-video"></i> Videos
				</a>
			</li>
		<?php }; ?>
		<?php
		if (!empty($validado)) { ?>
			<?php
			if ($validado[0]->rol == 'admin' || $validado[0]->rol == 'operador') { ?>
				<li class="list-group-item custom-list-item">
					<a href="<?php echo base_url('configuracion'); ?>" class="custom-link" id="link">
						<i class="fas fa-cog"></i> Configuración
					</a>
					<ul style="display: none;">
						<!-- Submenú oculto por defecto -->
						<?php
						if ($validado[0]->rol == 'admin') { ?>
							<li><a href="<?php echo base_url('configuracion/usuario'); ?>"><i class="fas fa-users"></i> Usuarios</a>
							</li>
						<?php } ?>
						<li><a href="<?php echo base_url('configuracion/listar-usuario'); ?>"><i class="fas fa-list-alt"></i>
								Ver Usuarios</a>
						</li>
						<?php
						if ($validado[0]->rol == 'admin') { ?>
							<li><a href="<?php echo base_url('configuracion/registrar_lineas'); ?>"><i class="fas fa-phone-alt"></i>
									Registrar líneas</a></li>
						<?php } ?>
						<li><a href="<?php echo base_url('configuracion/listar_lineas'); ?>"><i class="fas fa-list-alt"></i>
								Ver líneas de emergencias</a></li>
						<?php
						if ($validado[0]->rol == 'admin') { ?>
							<li><a href="<?php echo base_url('configuracion/vista'); ?>"><i class="fas fa-link"></i> Guardar enlace
									de YouTube</a></li>
						<?php } ?>
						<li><a href="<?php echo base_url('configuracion/link'); ?>"><i class="fas fa-link"></i> Ver enlaces
								de YouTube</a></li>
						<!-- <li><a href="#"><i class="fas fa-user-cog"></i> Perfil</a></li> -->
					</ul>

				</li>
		<?php }
		}; ?>
		<?php
		if (!empty($validado)) {
			if ($validado[0]->rol == 'usuario' || $validado[0]->rol == "admin" || $validado[0]->rol == "operador") { ?>
				<li class="list-group-item custom-list-item">
					<a href="<?php echo base_url('panel/logout'); ?>" class="custom-link">
						<i class="fas fa-sign-out-alt"></i> Cerrar sesión
					</a>
				</li>
		<?php }
		}; ?>
	</ul>

	<!-- <div class="form-group">
        <button id="obtener-ubicacion" type="button" class="btn btn-primary" id="obtener-ubicacion">Obtener Ubicación
            Actual</button>
    </div> -->

</div>
</main>
