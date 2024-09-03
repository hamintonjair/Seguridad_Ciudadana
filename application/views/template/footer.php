<br>

<!-- <div class="video-carousel" style="margin-left: auto;">
<button class="btn-prev btn btn-primary"><i class="fas fa-chevron-left"></i></button>

    <?php
	// Limitar el número de videos a mostrar
	$contador = 0;
	foreach ($link as $linke) {
		// if ($contador < 4) {
	?>
            <iframe class="video-frame" src="https://www.youtube.com/embed/<?php echo $linke->url ?>" frameborder="0" allowfullscreen style="width: 800px; height: 420px;"></iframe>
    <?php
		//     $contador++;
		// }
	} ?>
    <button class="btn-next btn btn-primary"><i class="fas fa-chevron-right"></i></button>

</div> -->

<?php
$this->load->model('ModelReporte');
$validado = $this->ModelReporte->get_Session();

if (empty($validado) == true) { ?>
		<div class="video-carousel-container" style="position: relative; margin-left: auto; overflow: hidden;">
			<button class="btn-prev btn btn-primary" style="position: absolute; top: 50%; left: 0; transform: translateY(-50%); z-index: 1;"><i class="fas fa-chevron-left"></i></button>

			<div class="video-carousel" style="display: flex; overflow-x: auto; white-space: nowrap;">
				<?php foreach ($link as $linke) { ?>
					<iframe class="video-frame" src="https://www.youtube.com/embed/<?php echo $linke->url ?>" frameborder="0" allowfullscreen style="width: 800px; height: 420px;"></iframe>
				<?php } ?>
			</div>

			<button class="btn-next btn btn-primary" style="position: absolute; top: 50%; right: 0; transform: translateY(-50%); z-index: 1;"><i class="fas fa-chevron-right"></i></button>
		</div>

<?php }else{
	if ($validado[0]->rol == 'usuario') { ?>
		<div class="video-carousel-container" style="position: relative; margin-left: auto; overflow: hidden;">
			<button class="btn-prev btn btn-primary" style="position: absolute; top: 50%; left: 0; transform: translateY(-50%); z-index: 1;"><i class="fas fa-chevron-left"></i></button>

			<div class="video-carousel" style="display: flex; overflow-x: auto; white-space: nowrap;">
				<?php foreach ($link as $linke) { ?>
					<iframe class="video-frame" src="https://www.youtube.com/embed/<?php echo $linke->url ?>" frameborder="0" allowfullscreen style="width: 800px; height: 420px;"></iframe>
				<?php } ?>
			</div>

			<button class="btn-next btn btn-primary" style="position: absolute; top: 50%; right: 0; transform: translateY(-50%); z-index: 1;"><i class="fas fa-chevron-right"></i></button>
		</div>
<?php }
}; ?>
<script>
	document.addEventListener("DOMContentLoaded", function(event) {
		const carousel = document.querySelector('.video-carousel');
		const prevButton = document.querySelector('.btn-prev');
		const nextButton = document.querySelector('.btn-next');

		prevButton.addEventListener('click', function() {
			carousel.scrollBy({
				left: -400, // Ajusta este valor según el ancho de tus videos
				behavior: 'smooth'
			});
		});

		nextButton.addEventListener('click', function() {
			carousel.scrollBy({
				left: 400, // Ajusta este valor según el ancho de tus videos
				behavior: 'smooth'
			});
		});
	});
</script>



<br>
<br>
<div class="personaje policia"></div>
<div class="personaje ladron"></div>
<footer class="bg-dark text-center text-white">
	<!-- Grid container -->
	<div class="container p-4 pb-0">
		<!-- Section: Social media -->
		<section class="mb-4">
			<!-- Facebook -->
			<a class="btn btn-outline-light btn-floating m-1" href="https://www.facebook.com/DeveloperJojama?mibextid=ZbWKwL" role="button"><i class="fab fa-facebook-f"></i></a>


			<!-- Google -->
			<a class="btn btn-outline-light btn-floating m-1" href="https://youtube.com/@DeveloperJojama?si=8wAxBa3_dBBgwj4E" role="button"><i class="fab fa-youtube"></i></a>

			<!-- Instagram -->
			<a class="btn btn-outline-light btn-floating m-1" href="https://www.instagram.com/the_beautifull_pretty?igsh=M3BpcDRkbWN3d3I4" role="button"><i class="fab fa-instagram"></i></a>

			<!-- Linkedin -->
			<a class="btn btn-outline-light btn-floating m-1" href="https://www.linkedin.com/in/haminton-mena-mena-haminton" role="button"><i class="fab fa-linkedin-in"></i></a>

		</section>
		<!-- Section: Social media -->
	</div>
	<!-- Grid container -->

	<!-- Copyright -->
	<div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
		© 2023 Copyright:
		<a class="text-white" href="https://hammenamena.mercadoshops.com.co/" target="_blank">Todos los derechos reservados por Jojama</a>
	</div>
	<!-- Copyright -->
</footer>
<!-- Incluye las bibliotecas de Bootstrap y archivos JavaScript necesarios aquí -->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script> -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/dataTables.responsive.min.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/libreria/sweetalert2/dist/sweetalert2.min.js">
</script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/function.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/functions_admin.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/registrar_usuario.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/chart.js"></script>


</body>

</html>
