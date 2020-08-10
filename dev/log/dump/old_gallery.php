<!--
    Sample Images:
        [-] img/hd/DSC_7644-Edit-Edit_Full_Size.jpg
        [-] img/hd/WFerraz_2018_00008_Full_Size.jpg
        [-] img/hd/WFerraz_2018_00044_Full_Size.jpg
        [-] img/hd/WFerraz_2018_00049_Full_Size.jpg
        img/hd/WFerraz_2018_00258_Full_Size.jpg
        img/hd/WFerraz_2018_00374-Edit_Full_Size.jpg
-->
<!-- start COLUMN 1 -->
<div class="col-md-4">
    <div class="card img-card">
        <img class="card-img-top" src="img/hd/DSC_0824-8_Full_Size.jpg" alt="Card image cap">
        <div class="card-body">
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
    </div>

    <div class="card img-card">
        <img class="card-img-top" src="img/hd/DSC_7644-Edit-Edit_Full_Size.jpg" alt="Card image cap">
        <div class="card-body">
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
    </div>

    <div class="card img-card">
        <img class="card-img-top" src="img/hd/WFerraz_2018_00008_Full_Size.jpg" alt="Card image cap">
        <div class="card-body">
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
    </div>
</div>
<!-- end COLUMN 2 -->

<!-- start COLUMN 2 -->
<div class="col-md-4">
    <div class="card img-card">
        <img class="card-img-top" src="img/hd/DSC_3757-42_Full_Size.jpg" alt="Card image cap">
        <div class="card-body">
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
    </div>

    <div class="card img-card">
        <img class="card-img-top" src="img/hd/WFerraz_2018_00044_Full_Size.jpg" alt="Card image cap">
        <div class="card-body">
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
    </div>

    <div class="card img-card">
        <img class="card-img-top" src="img/hd/WFerraz_2019_00013_Full_Size.jpg" alt="Card image cap">
        <div class="card-body">
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
    </div>

    <div class="card img-card">
        <img class="card-img-top" src="img/hd/DSC_4155-161_Full_Size.jpg" alt="Card image cap">
        <div class="card-body">
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
    </div>

    <div class="card img-card">
        <img class="card-img-top" src="img/hd/WFerraz_2018_00049_Full_Size.jpg" alt="Card image cap">
        <div class="card-body">
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
    </div>

    <div class="card img-card">
        <img class="card-img-top" src="img/hd/WFerraz_2018_00258_Full_Size.jpg" alt="Card image cap">
        <div class="card-body">
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
    </div>

</div>
<!-- end COLUMN 2 -->

<!-- start COLUMN 3 -->
<div class="col-md-4">
    <?php
        $img_handler = new Image_Controller("img_repo/landscape/");
        $img_file = $img_handler->list_all();

        $img_counter = new Image_Controller("img_repo/");
        echo $img_counter->get_img_count();
        // echo $img_handler->format_img($img_file);
    ?>
</div>
<!-- end COLUMN 3 -->
