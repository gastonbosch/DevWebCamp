<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__texto">Registrate en DeWebCamp</p>

    <?php require_once __DIR__.'/../templates/alertas.php' ?>

    <form method="POST" action="/registro" class="formulario">
        <div class="formulario__campo">
            <label for="nombre" class="formulario__label">Nombre</label>
            <input type="text" class="formulario__input" id="nombre" name="nombre" value="<?php echo $usuario->nombre; ?>" placeholder="Tu Nombre">
        </div>
        <div class="formulario__campo">
            <label for="apellido" class="formulario__label">Apellido</label>
            <input type="text" class="formulario__input" id="apellido" name="apellido" value="<?php echo $usuario->apellido; ?>" placeholder="Tu Apellido">
        </div>
        <div class="formulario__campo">
            <label for="email" class="formulario__label">Email</label>
            <input type="email" class="formulario__input" id="email" name="email" value="<?php echo $usuario->email; ?>" placeholder="Tu Email">
        </div>
        <div class="formulario__campo">
            <label for="password" class="formulario__label">Password</label>
            <input type="password" class="formulario__input" id="password" name="password" placeholder="Tu Password">
        </div>
        <div class="formulario__campo">
            <label for="password2" class="formulario__label">Repite tu password</label>
            <input type="password" class="formulario__input" id="password2" name="password2" placeholder="Repite tu password">
        </div>

        <input type="submit" class="formulario__submit" value="Crear Cuenta">
    </form>

    <div class="acciones">
        <a href="/login" class="acciones__enlace">¿Ya tienes una cuenta?Inicia sesion</a>
        <a href="/olvide" class="acciones__enlace">¿Olvidaste tu password?</a>
    </div>
</main>