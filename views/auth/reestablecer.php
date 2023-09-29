<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__texto">Reestablece tu password</p>

    <?php require_once __DIR__.'/../templates/alertas.php' ?>

    <form method="POST" class="formulario">
        <div class="formulario__campo">
            <label for="password" class="formulario__label">Password</label>
            <input type="password" class="formulario__input" id="password" name="password" placeholder="Tu Password">
        </div>

        <input type="submit" class="formulario__submit" value="Guardar password">
    </form>

    <div class="acciones">
        <a href="/registro" class="acciones__enlace">¿Aun no tienes una cuenta?Obten una</a>
        <a href="/login" class="acciones__enlace">¿Ya tienes una cuenta?Inicia sesion</a>
    </div>
</main>