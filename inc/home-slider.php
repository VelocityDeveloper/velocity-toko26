<?php
$slider_home = velocitytheme_option('slider_home');
$ns = 1;
?>

<?php if($slider_home): ?>
    <div id="carouselHome" class="carousel slide mb-3">
        <div class="carousel-inner">
            <?php foreach( $slider_home as $key => $data): ?>
                <div class="<?php echo $ns==1?'carousel-item active':'carousel-item'; ?>" data-bs-interval="3000">
                    <div>
                        <img class="lazyload w-100" data-src="<?php echo $data['imgslider']; ?>" alt="Slider <?php echo $ns; ?>" loading="lazy">
                    </div>
                </div>
            <?php 
            $ns++;
            endforeach;
            ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselHome" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselHome" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
<?php endif; ?>