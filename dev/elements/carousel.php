<!-- start carousel -->
<div id="carousel" class="carousel slide carousel-fade" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carousel" data-slide-to="0" class="active"></li>
        <li data-target="#carousel" data-slide-to="1"></li>
        <li data-target="#carousel" data-slide-to="2"></li>
        <li data-target="#carousel" data-slide-to="3"></li>
    </ol>
    <div class="carousel-inner">
        <?php
            // process all active imgs
            $img_handler = new Image();
            define('IMG_MAX', 4);
            $carousel_img_arr = $img_handler->get_active_imgs(IMG_MAX);
            $counter = 0;
            foreach ($carousel_img_arr as $carousel_img) {
                $img_location = 'img_repo/' . $carousel_img['img_category'] . '/' . $carousel_img['img_file_name'];
                $counter++;
                // end PHP code block
        ?>
        <div class="carousel-item item <?php if ($counter==1) echo 'active'; ?>" style="background-image: url('<?php echo $img_location; ?>')"></div>
        <?php
            // continue PHP code block
            }
        ?>
    </div>
    <!-- <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
        <span class="carousel-control-prev" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel" role="button" data-slide="Next">
        <span class="carousel-control-prev" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a> -->
</div>
<!-- end carousel -->
