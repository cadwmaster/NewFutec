<img src="http://www.futbolecuador.com/<?php echo $story->thumb300 ?>" class="img-responsive">

<div class="row clearfix">
    <div class="col-md-12 column text-news-date">
        <?php echo $story->created ?>
    </div>
    <div class="col-md-12 column ">
        <h2><?php echo $story->title ?></h2>
    </div>
    <div class="col-md-12 column text-news-sub">
        <?php echo $story->subtitle ?>
    </div>
    <div class="col-md-12 column ">
        <?php echo $story->lead ?>
    </div>
    <div class="col-md-12 column content-gris">
        <div class="col-md-4 column margen0">
           Lecturas <?php echo $story->reads ?>
        </div>
        <div class="col-md-8 column margen0 text-right text-news-zone">
            <?php echo $story->category ?>
        </div>
    </div>
</div>