<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Informacion Personal</legend>
    <div class="formulario__campo">
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" placeholder="Tu nombre" class="formulario__input" value="<?php echo $ponente->nombre ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label for="apellido">Apellido</label>
        <input type="text" id="apellido" name="apellido" placeholder="Tu apellido" class="formulario__input" value="<?php echo $ponente->apellido ?? '' ?>">
    <div>

    <div class="formulario__campo">
        <label for="ciudad">Ciudad</label>
        <input type="text" id="ciudad" name="ciudad" placeholder="Tu ciudad" class="formulario__input" value="<?php echo $ponente->ciudad ?? '' ?>">
    <div>

    <div class="formulario__campo">
        <label for="pais">Pais</label>
        <input type="text" id="pais" name="pais" placeholder="Tu pais" class="formulario__input" value="<?php echo $ponente->pais ?? '' ?>">
    <div>

    <div class="formulario__campo">
        <label for="imegan">Imagen</label>
        <input type="file" id="imegan" name="imagen" class="formulario__input formulario__input--file">
    <div>
    
    <?php if(isset($ponente->imagen_actual)){ ?>
        <p class="formulario__texto">Imagen actual:</p>
        <div class="formulario__imagen">
            <picture>
                <source srcset="<?php echo $_ENV['HOST'].'/img/speakers/'.$ponente->imagen;?>.webp" type="image/webp">
                <source srcset="<?php echo $_ENV['HOST'].'/img/speakers/'.$ponente->imagen;?>.png" type="image/png">
                <img src="<?php echo $_ENV['HOST'].'/img/speakers/'.$ponente->imagen;?>.png" alt="Imagen ponente">
            </picture>
        </div>
    <?php } ?>
</fieldset>

<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Informacion Personal Extra</legend>

    <div class="formulario__campo">
        <label for="tags_input">Areas de Experiencia(Separadas por coma)</label>
        <input type="text" id="tags_input" placeholder="Ejm: Node, JS, CSS, PHP, Laravel" class="formulario__input">
    <div>
    <div id="tags" class="formulario__listado"></div>
    <input type="hidden" name="tags" value="<?php echo $ponente->tags ?? '';?>">
</fieldset>

<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Redes Sciales</legend>

    <div class="formulario__campo formulario__campo--social">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-facebook"></i>
            </div>
            <input type="text" name="redes[facebook]" placeholder="Facebook" class="formulario__input--sociales" value="<?php echo $redes->facebook ?? '' ?>">
        </div>
    <div>

    <div class="formulario__campo formulario__campo--social">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-twitter"></i>
            </div>
            <input type="text" name="redes[twitter]" placeholder="Twitter" class="formulario__input--sociales" value="<?php echo $redes->twitter ?? '' ?>">
        </div>
    <div>

    <div class="formulario__campo formulario__campo--social">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-youtube"></i>
            </div>
            <input type="text" name="redes[youtube]" placeholder="YouTube" class="formulario__input--sociales" value="<?php echo $redes->youtube ?? '' ?>">
        </div>
    <div>

    <div class="formulario__campo formulario__campo--social">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-instagram"></i>
            </div>
            <input type="text" name="redes[instragram]" placeholder="Instagram" class="formulario__input--sociales" value="<?php echo $redes->instragram ?? '' ?>">
        </div>
    <div>

    <div class="formulario__campo formulario__campo--social">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-tiktok"></i>
            </div>
            <input type="text" name="redes[tiktok]" placeholder="TikTok" class="formulario__input--sociales" value="<?php echo $redes->tiktok ?? '' ?>">
        </div>
    <div>

    <div class="formulario__campo formulario__campo--social">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-github"></i>
            </div>
            <input type="text" name="redes[github]" placeholder="GitHub" class="formulario__input--sociales" value="<?php echo $redes->github ?? '' ?>">
        </div>
    <div>
</fieldset>