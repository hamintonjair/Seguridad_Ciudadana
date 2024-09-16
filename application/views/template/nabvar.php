
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #226f7e;">
            <a class="navbar-brand" href="<?php echo base_url(); ?>">Sistema de Seguridad Ciudadana</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <?php 
             $this->load->model( 'ModelReporte' );
              $validado = $this->ModelReporte->get_Session(); 
            if(empty($validado[0]->rol)){ ?>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('login'); ?>">Iniciar Sesión / Registrarse</a>
                    </li>
                </ul>
            </div>
            <?php }else{; ?>
                <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link"><strong><?php echo $validado[0]->nombre; ?></strong></a>
                    </li>
                </ul>
            </div>
                <?php }; ?>
        </nav>
    </header>

