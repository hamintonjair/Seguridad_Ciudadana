<main>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div style="background-color:#f0f0f0; border-radius:30px;" id="vista-alertas" class="col-md-9">
                <br>
                <h4 style="color:black; text-align: center;">Noticias</h4>

                <!-- Carrusel de Videos -->
                <div class="row">
                    <div class="col col-md-10 offset-md-1 col-lg-8 offset-lg-2">
                        <!-- Carousel -->
                        <div id="carousel-example" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <!-- Los indicadores se generan dinámicamente -->
                                <?php foreach ($link as $index => $linke): ?>
                                    <li data-target="#carousel-example" data-slide-to="<?php echo $index; ?>" class="<?php echo $index === 0 ? 'active' : ''; ?>"></li>
                                <?php endforeach; ?>
                            </ol>
                            <div class="carousel-inner">
                                <!-- Los videos se generan dinámicamente -->
                                <?php foreach ($link as $index => $linke): ?>
                                    <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                                        <div class="embed-responsive embed-responsive-16by9">
                                            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo $linke->url; ?>" allowfullscreen></iframe>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <a class="carousel-control-prev" href="#carousel-example" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carousel-example" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                        <!-- End carousel -->
                    </div>
                </div>
                <!-- End carousel row -->
            </div>
 <style>
	@media (max-width: 767px) {
    .carousel-control-prev,
    .carousel-control-next {
        display: none;
    }

    .carousel-indicators li {
        margin-left: 10px;
        margin-right: 10px;
    }
}
 </style>
