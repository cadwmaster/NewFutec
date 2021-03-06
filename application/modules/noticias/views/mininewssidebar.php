<?php $linkShort = base_url() . 'site/' . $nameSectionUrl; ?>
<div class="panel-heading backcuadros">
    <a href="<?php echo $linkShort; ?>"?>
        <h4 class="panel-title">
            <? echo $namesection; ?>
        </h4>
    </a>
</div>

<div class="row">
    <?php foreach ($noticias as $noticia) {
        $linkbody = $noticia->subtitle;
        if ($linkbody == "")
            $linkbody = $noticia->title;

        $link = $linkShort . '/' . $this->contenido->_urlFriendly($linkbody ) . '/' . $noticia->id;

        // caso abre seccion
        if (isset($noticia->openseccion)) {
            if ($noticia->openseccion != '')
            $link = base_url() . $noticia->openseccion;
        }
        ?>
        <div class="col-md-12 lineseparador separador10">
            <div class="row">
                <div class="col-md-2 col-sm-3">
                    <a href="<?php echo $link ?>"><img
                            src="http://www.futbolecuador.com/<?php echo $noticia->thumb3; ?>"
                            alt="<?php echo str_replace('"', '', "$noticia->title"); ?>" title="<?php echo str_replace('"', '', "$noticia->title"); ?>"></a>
                </div>
                <div class="col-md-10  col-sm-9">
                    <h2><a href="<?php echo $link ?>"><?php echo $noticia->title; ?></a></h2>
                    <?php
                    if (strlen(strip_tags($noticia->lead)) == 0) {
                        $num = 100;
                        $str = strip_tags($noticia->body);
                        $str = substr($str, 0, $num);
                        $bodyCortado = substr($str, 0, -(strlen($str) - strrpos($str, ' ')));

                        echo '<a href="' . $link . '" class="sidebarlink">' . $bodyCortado . "..." . '</a>';
                    } else {
                        ?>
                        <?php echo '<a href="' . $link . '" class="sidebarlink">' . strip_tags($noticia->subtitle) . "</a>";
                    }?>
                </div>
            </div>
        </div>

    <?php } ?>
</div>


<div class="col-md-12 col-sm-12 text-right fondoazul separador10 <?php if ($namesection == "Lo más Leído") echo "hidden" ?>">
    <a href="<?php echo $linkShort; ?>"?>Más Noticias</a>
</div>