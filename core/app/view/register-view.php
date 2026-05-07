<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
        <div class="row g-0">
          <div class="col-md-5 bg-primary d-none d-md-flex flex-column align-items-center justify-content-center p-5 text-white text-center">
            <i class="bi bi-person-plus-fill display-1 mb-4"></i>
            <h2 class="fw-bold">Únete a nosotros</h2>
            <p class="opacity-75">Crea una cuenta y empieza a interactuar con nuestra comunidad.</p>
          </div>
          <div class="col-md-7 p-5">
            <h3 class="fw-bold mb-4">Registro</h3>
            <form method="post" action="./?action=processregister">
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label small fw-bold">Nombre</label>
                  <input type="text" name="name" class="form-control rounded-3" placeholder="Tu nombre" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label small fw-bold">Apellidos</label>
                  <input type="text" name="lastname" class="form-control rounded-3" placeholder="Tus apellidos" required>
                </div>
                <div class="col-12">
                  <label class="form-label small fw-bold">Correo electrónico</label>
                  <input type="email" name="email" class="form-control rounded-3" placeholder="nombre@ejemplo.com" required>
                </div>
                <div class="col-12">
                  <label class="form-label small fw-bold">Contraseña</label>
                  <input type="password" name="password" class="form-control rounded-3" placeholder="••••••••" required>
                </div>
                <div class="col-12 mt-4">
                  <div class="form-check small">
                    <input class="form-check-input" type="checkbox" name="accept" id="termsCheck" required>
                    <label class="form-check-label text-muted" for="termsCheck">
                      Acepto los <a href="#" class="text-primary text-decoration-none">términos y condiciones</a>
                    </label>
                  </div>
                </div>
                <div class="col-12 mt-4 d-grid">
                  <button type="submit" class="btn btn-primary btn-lg rounded-3">
                    Registrarme <i class="bi bi-check-circle ms-2"></i>
                  </button>
                </div>
              </div>
            </form>
            <div class="mt-4 text-center">
              <p class="mb-0 text-muted small">¿Ya tienes cuenta? <a href="./?view=login" class="text-primary fw-bold text-decoration-none">Inicia sesión</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>