<main>

    <div class="container mt-5">
        <div class="row">
            <div style="background-color:#f0f0f0; border-radius:30px; " id="vista-alertas" class="col-md-9">
            <br>
                <h4 style="color:black; text-align: center;">Recursos de Emergencia</h4>
				<br>
                <ul class="list-unstyled">
                    <!-- Policía -->

                    <?php foreach ($lineas as $linea){ ?>
                    <li class="emergency-contact">
                        <h3><?php  echo $linea->entidad; ?></h3>
                        <a class="emergency-phone" href="tel:123"><?php echo $linea->linea; ?></a>
                        <p class="emergency-description"><?php echo $linea->nota; ?></p>
                    </li>
                    <?php   }; ?>
                </ul>
            </div>
