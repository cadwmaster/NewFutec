<div class="row clearfix separador5 separador10bot footer-fe margen0  hidden-xs">
    <div class="col-md-3 col-sm-3 ">
        <div class="col-md-12  azulfooter">
            <h3>Secciones</h3>
        </div>
        <div class="col-md-12 separa">
            <div class="subtitulo"><strong>Fútbol Nacional</strong></div>
        </div>

        <div class="col-md-12 separa">
            <a href="<?= base_url('serie-a') ?>">
                Serie A
            </a>
        </div>
        <div class="col-md-12 separa">
            <a href="<?= base_url('serie-b') ?>">Serie B</a>
        </div>
        <div class="col-md-12 separa">
            <a href="<?= base_url('seleccion') ?>">Selección</a>
        </div>

        <div class="col-md-12 separa">
            <a href="<?= base_url('lo-mas-leido') ?>">Lo más Leído</a>
        </div>
        <div class="col-md-12 ">
            <a href="<?= base_url('fuera-de-juego') ?>">Fuera de Juego</a>
        </div>
    </div>

    <div class="col-md-3 col-sm-3">
        <div class="col-md-12  ">
            <div class="espaciador" ></div>
        </div>
        <div class="col-md-12 separa">
            <a href="<?= base_url('tabla-de-posiciones') ?>">Resultados</a>
        </div>


        <div class="col-md-12 separa">
            <a href="<?= base_url('calendario') ?>">Calendario</a>
        </div>
        <div class="col-md-12 separa">
            <a href="<?= base_url('en-el-exterior') ?>">En el Exterior</a>
        </div>
        <div class="col-md-12 separa">
            <a href="<?= base_url('futbol-internacional') ?>">Fútbol Internacional</a>
        </div>

        <div class="col-md-12 separa">
            <a href="<?= base_url('zona-fe') ?>">Zona FE</a>
        </div>

    </div>
    <div class="col-md-3 col-sm-3 hide">
        <div class="col-md-12  azulfooter">
            <h3>Newsletter</h3>
        </div>

        <div class="col-md-12 ">
            <div class="row ">
                <div class="col-md-1 ">
                </div>
                <div class="col-md-10 ">
                    Suscríbite a nuestro boletín de noticias
                </div>
            </div>
        </div>
        <div class="col-md-12 ">
        </div>
        <div class="col-md-12 ">
            <input type="text" placeholder="Nombre" name="Nombre" class="search2">
        </div>

        <div class="col-md-12 ">
            <input type="text" placeholder="Correo" name="Correo" class="search2">
        </div>
        <div class="col-md-12  text-right">
            <a href="#" class="newsButton">Enviar</a>
        </div>
    </div>

    <div class="col-md-3 col-sm-3">
        <div class="col-md-12  azulfooter">
            <h3>Contacto</h3>
        </div>

        <div class="col-md-12 separador5 margen0">

            <div class="col-md-12 margen-contacto">
                Tu opinión nos interesa, escríbe tus sugerencias o comentarios
            </div>

        </div>
        <form id="contacto">
            <div class="col-md-12 separador10 ">
                <input type="text" placeholder="Nombre" name="NombreContacto" id="nombrecontacto" class="search2">
            </div>

            <div class="col-md-12 ">
                <input type="text" placeholder="Correo" name="CorreoContacto" id="correocontacto" class="search2">
            </div>
            <div class="col-md-12 ">
                <textarea placeholder="Mensaje" name="MensajeContacto" id="mensajecontacto" class="search3"></textarea>
            </div>
            <div class="col-md-8  text-left" id="errorcontacto">
            </div>
            <div class="col-md-4  text-center">
                <div class="newsButton " id="enviarcontacto">Enviar</div>
            </div>
        </form>

    </div>

    <div class="col-md-3 col-sm-3">
        <div class="col-md-12  azulfooter">
            <h3>Publicidad</h3>
        </div>
        <div class="col-md-12 separador5 margen0">

            <div class="col-md-12 margen-contacto ">
                Forma parte del selecto grupo de anunciantes de futbolecuador.com
            </div>

        </div>
        <form id="publicidad">
            <div class="col-md-12 separador10">
                <input type="text" placeholder="Nombre" name="NombreContacto" id="nombrepublicidad" class="search2">
            </div>

            <div class="col-md-12 ">
                <input type="text" placeholder="Correo" name="CorreoContacto" id="correopublicidad" class="search2">
            </div>
            <div class="col-md-12 ">
                <textarea placeholder="Mensaje" name="MensajeContacto" id="mensajepublicidad"
                          class="search3"></textarea>
            </div>
            <div class="col-md-8  text-left" id="errorpublicidad">

            </div>
            <div class="col-md-4  text-center">
                <div class="newsButton " id="enviarpublicidad">Enviar</div>
            </div>
        </form>
    </div>
</div>