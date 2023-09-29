<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__texto">Recupera tu password en DeWebCamp</p>

    <?php require_once __DIR__.'/../templates/alertas.php' ?>

    <form method="POST" action="/olvide" class="formulario">
        <div class="formulario__campo">
            <label for="email" class="formulario__label">Email</label>
            <input type="email" class="formulario__input" id="email" name="email" placeholder="Tu Email">
        </div>

        <input type="submit" class="formulario__submit" value="Enviar Instrucciones">
    </form>

    <div class="acciones">
        <a href="/login" class="acciones__enlace">¿Ya tienes una cuenta?Inicia sesion</a>
        <a href="/registro" class="acciones__enlace">¿Aun no tienes una cuenta?Obten una</a>
    </div>
</main>