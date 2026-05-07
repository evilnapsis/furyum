<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
        <div class="card-body p-5">
          <div class="text-center mb-4">
            <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 64px; height: 64px;">
              <i class="bi bi-lock-fill fs-2"></i>
            </div>
            <h2 class="fw-bold">Bienvenido</h2>
            <p class="text-muted">Inicia sesión para continuar</p>
          </div>

          <form method="post" action="./?action=access&o=login">
            <div class="form-floating mb-3">
              <input type="text" required name="username" class="form-control" id="userInput" placeholder="Usuario">
              <label for="userInput">Nombre de usuario</label>
            </div>
            
            <div class="form-floating mb-4">
              <input type="password" required name="password" class="form-control" id="passwordInput" placeholder="Password">
              <label for="passwordInput">Contraseña</label>
            </div>

            <div class="d-grid gap-2">
              <button type="submit" class="btn btn-primary btn-lg shadow-sm">
                Acceder <i class="bi bi-arrow-right ms-2"></i>
              </button>
            </div>
          </form>

          <div class="mt-4 text-center">
            <p class="mb-0 text-muted small">¿No tienes cuenta? <a href="./?view=register" class="text-primary fw-bold text-decoration-none">Regístrate aquí</a></p>
          </div>
        </div>
      </div>
      
      <div class="text-center mt-4">
        <a href="./" class="text-muted text-decoration-none small"><i class="bi bi-arrow-left me-1"></i> Volver al inicio</a>
      </div>
    </div>
  </div>
</div>
<?php
//$user = UserData::getBy("id",2);
//$user->del();
//print_r($user);
?>