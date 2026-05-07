<?php
// Si se proporciona un ID, mostramos el perfil público
if(isset($_GET["id"])):
  $u = UserData::getById($_GET["id"]);
  if($u==null){ Core::redir("./"); }
  $posts = PostData::getAllByUser($u->id);
  $karma = LikeData::countByUserKarma($u->id);
?>
<div class="container py-5">
  <div class="row g-4">
    <!-- Sidebar Perfil -->
    <div class="col-lg-4">
      <div class="card border-0 shadow-sm rounded-4 text-center p-5">
        <div class="bg-light rounded-circle mx-auto mb-4 overflow-hidden border border-5 border-white shadow-sm" style="width: 150px; height: 150px;">
          <?php if($u->image!=""):?>
            <img src="./uploads/<?php echo $u->image; ?>" class="w-100 h-100 object-fit-cover">
          <?php else: ?>
            <div class="w-100 h-100 d-flex align-items-center justify-content-center text-muted">
              <i class="bi bi-person-fill display-1"></i>
            </div>
          <?php endif; ?>
        </div>
        <h3 class="fw-bold mb-1"><?php echo $u->name." ".$u->lastname; ?></h3>
        <p class="text-muted small mb-4">Miembro desde <?php echo date("M Y", strtotime($u->created_at)); ?></p>
        
        <div class="row g-2 mt-4">
          <div class="col-6">
            <div class="bg-light p-3 rounded-3">
              <h4 class="fw-bold mb-0"><?php echo count($posts); ?></h4>
              <p class="text-muted small mb-0">Posts</p>
            </div>
          </div>
          <div class="col-6">
            <div class="bg-primary text-white p-3 rounded-3">
              <h4 class="fw-bold mb-0"><?php echo $karma; ?></h4>
              <p class="opacity-75 small mb-0">Karma</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Contenido Principal -->
    <div class="col-lg-8">
      <h4 class="fw-bold mb-4">Publicaciones de <?php echo $u->name; ?></h4>
      
      <?php if(count($posts)>0): ?>
        <div class="row g-3">
          <?php foreach($posts as $p): ?>
            <div class="col-12">
              <div class="card border-0 shadow-sm rounded-4 p-4 h-100 transition-hover">
                <div class="d-flex justify-content-between align-items-start mb-2">
                  <h5 class="fw-bold mb-0">
                    <a href="./?view=post&id=<?php echo $p->id; ?>" class="text-decoration-none text-dark hover-primary"><?php echo $p->title; ?></a>
                  </h5>
                  <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill">
                    <?php echo CategoryData::getById($p->category_id)->name; ?>
                  </span>
                </div>
                <p class="text-muted small mb-0">
                  <i class="bi bi-calendar3 me-1"></i> <?php echo date("d M, Y", strtotime($p->created_at)); ?>
                  <span class="mx-2">•</span>
                  <i class="bi bi-hand-thumbs-up-fill me-1 text-primary"></i> <?php echo LikeData::countByPost($p->id); ?> Me gusta
                </p>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php else: ?>
        <div class="text-center py-5 bg-white rounded-4 shadow-sm">
          <i class="bi bi-chat-square-dots display-1 text-muted opacity-25 mb-3 d-block"></i>
          <p class="text-muted">Este usuario aún no ha realizado publicaciones.</p>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>

<?php else: 
// Si no hay ID, mostramos el formulario de edición (requiere login)
if(!isset($_SESSION["user_id"])){ Core::redir("./?view=login"); }
$u = Core::$user;
?>
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
        <div class="card-header bg-white py-4 px-5 border-bottom-0">
          <h2 class="fw-bold mb-0">Actualizar Mi Perfil</h2>
          <p class="text-muted mb-0 small">Modifica tu información personal y foto de perfil.</p>
        </div>
        <div class="card-body p-5">
          <form method="post" action="./?action=updateprofile" enctype="multipart/form-data">
            <div class="row g-4">
              <!-- Profile Picture Section -->
              <div class="col-12 text-center mb-4">
                <div class="position-relative d-inline-block">
                  <div class="bg-light rounded-circle border border-5 border-white shadow-sm overflow-hidden" style="width: 150px; height: 150px;">
                    <?php if($u->image!=""):?>
                      <img src="./uploads/<?php echo $u->image; ?>" class="w-100 h-100 object-fit-cover" id="profile-preview">
                    <?php else: ?>
                      <div class="w-100 h-100 d-flex align-items-center justify-content-center text-muted">
                        <i class="bi bi-person-fill display-1"></i>
                      </div>
                    <?php endif; ?>
                  </div>
                  <label for="imageInput" class="btn btn-primary btn-sm rounded-circle position-absolute bottom-0 end-0 p-2 shadow" title="Cambiar imagen">
                    <i class="bi bi-camera-fill"></i>
                  </label>
                  <input type="file" name="image" id="imageInput" class="d-none">
                </div>
                <div class="form-text mt-2">Formatos permitidos: JPG, PNG. Máx 2MB.</div>
              </div>

              <!-- Form Fields -->
              <div class="col-md-6">
                <label class="form-label small fw-bold text-uppercase text-muted">Nombre</label>
                <div class="input-group">
                  <span class="input-group-text bg-light border-0"><i class="bi bi-person"></i></span>
                  <input type="text" name="name" value="<?php echo $u->name; ?>" class="form-control rounded-3" placeholder="Tu nombre" required>
                </div>
              </div>

              <div class="col-md-6">
                <label class="form-label small fw-bold text-uppercase text-muted">Apellidos</label>
                <div class="input-group">
                  <span class="input-group-text bg-light border-0"><i class="bi bi-person"></i></span>
                  <input type="text" name="lastname" value="<?php echo $u->lastname; ?>" class="form-control rounded-3" placeholder="Tus apellidos" required>
                </div>
              </div>

              <div class="col-12">
                <label class="form-label small fw-bold text-uppercase text-muted">Correo electrónico</label>
                <div class="input-group">
                  <span class="input-group-text bg-light border-0"><i class="bi bi-envelope"></i></span>
                  <input type="email" name="email" value="<?php echo $u->email; ?>" class="form-control rounded-3" placeholder="nombre@ejemplo.com" required>
                </div>
              </div>

              <div class="col-12">
                <label class="form-label small fw-bold text-uppercase text-muted">Nueva Contraseña</label>
                <div class="input-group">
                  <span class="input-group-text bg-light border-0"><i class="bi bi-shield-lock"></i></span>
                  <input type="password" name="password" class="form-control rounded-3" placeholder="Dejar en blanco para no cambiar">
                </div>
                <div class="form-text small">Usa al menos 8 caracteres para mayor seguridad.</div>
              </div>

              <div class="col-12 mt-5 text-end">
                <a href="./?view=home" class="btn btn-light rounded-pill px-4 me-2">Cancelar</a>
                <button type="submit" class="btn btn-primary rounded-pill px-5 shadow-sm">
                  Guardar Cambios <i class="bi bi-check-lg ms-2"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>