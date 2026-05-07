<?php
$cat = CategoryData::getById($_GET["id"]);
$jobs  = PostData::getAllByCat($cat->id);
?>

<div class="container py-4">
  <nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./" class="text-decoration-none">Inicio</a></li>
      <li class="breadcrumb-item active" aria-current="page"><?php echo $cat->name; ?></li>
    </ol>
  </nav>

  <div class="row align-items-center mb-4">
    <div class="col-md-8">
      <h1 class="fw-bold mb-0"><?php echo $cat->name; ?></h1>
      <p class="text-muted"><?php echo $cat->description; ?></p>
    </div>
    <div class="col-md-4 text-md-end">
      <?php if(Core::$user!=null):?>
      <button type="button" class="btn btn-primary rounded-pill shadow-sm" data-bs-toggle="modal" data-bs-target="#newPostModal">
        <i class="bi bi-plus-lg me-2"></i>Nueva Publicación
      </button>

      <!-- Modal -->
      <div class="modal fade" id="newPostModal" tabindex="-1" aria-labelledby="newPostModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-bottom-0 pt-4 px-4">
              <h5 class="modal-title fw-bold" id="newPostModalLabel">Nuevo Articulo</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
              <form method="post" action="index.php?action=posts&opt=add" enctype="multipart/form-data">
                <div class="mb-3">
                  <label class="form-label fw-semibold small text-uppercase text-muted">Título*</label>
                  <input type="text" name="title" class="form-control rounded-3" placeholder="Ingresa un título llamativo" required>
                </div>

                <div class="mb-3">
                  <label class="form-label fw-semibold small text-uppercase text-muted">Contenido*</label>
                  <textarea name="content" class="form-control rounded-3" rows="5" placeholder="¿Qué quieres compartir?" required></textarea>
                </div>

                <div class="mb-4">
                  <label class="form-label fw-semibold small text-uppercase text-muted">Imagen destacada</label>
                  <input type="file" name="image" class="form-control rounded-3">
                </div>

                <input type="hidden" name="category_id" value="<?php echo $_GET["id"];?>">

                <div class="d-grid mt-4">
                  <button type="submit" class="btn btn-primary btn-lg rounded-3 shadow-sm">Publicar Ahora</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <?php else: ?>
        <a href="./?view=login" class="btn btn-outline-primary rounded-pill">Inicia sesión para publicar</a>
      <?php endif; ?>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <?php if(count($jobs)>0):?>
        <div class="row g-4">
          <?php foreach($jobs as $jb):
          $u = UserData::getById($jb->user_id);
          ?>
          <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 transition-hover">
              <div class="row g-0">
                <?php if($jb->image!=""):?>
                <div class="col-md-3">
                  <img src="./uploads/<?php echo $jb->image; ?>" class="img-fluid h-100 w-100 object-fit-cover" alt="<?php echo $jb->title; ?>" style="min-height: 180px;">
                </div>
                <?php endif; ?>
                <div class="<?php echo ($jb->image!="") ? 'col-md-9' : 'col-md-12'; ?> p-4">
                  <div class="d-flex flex-column h-100">
                    <h4 class="mb-2 fw-bold">
                      <a href="./?view=post&id=<?php echo $jb->id; ?>" class="text-decoration-none text-dark hover-primary"><?php echo $jb->title; ?></a>
                    </h4>
                    <p class="text-muted small mb-3">
                      <i class="bi bi-person me-1"></i> Por <a href="./?view=profile&id=<?php echo $u->id; ?>" class="text-decoration-none fw-semibold text-primary"><?php echo $u->name." ".$u->lastname; ?></a>
                      <span class="mx-2">•</span>
                      <i class="bi bi-calendar3 me-1"></i> <?php echo date("d M, Y", strtotime($jb->created_at)); ?>
                      <span class="mx-2">•</span>
                      <i class="bi bi-hand-thumbs-up-fill me-1 text-primary"></i> <?php echo LikeData::countByPost($jb->id); ?>
                    </p>
                    <div class="mt-auto">
                      <a href="./?view=post&id=<?php echo $jb->id; ?>" class="btn btn-link text-primary p-0 text-decoration-none fw-semibold">
                        Leer más <i class="bi bi-arrow-right ms-1"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      <?php else:?>
        <div class="text-center py-5 bg-white rounded-4 shadow-sm">
          <i class="bi bi-chat-dots display-1 text-muted opacity-25 mb-3 d-block"></i>
          <h4 class="text-muted">No hay artículos en esta categoría</h4>
          <p class="text-muted small">¡Sé el primero en iniciar la conversación!</p>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>

<style>
.transition-hover {
  transition: all 0.3s ease;
}
.transition-hover:hover {
  transform: translateY(-5px);
  box-shadow: 0 1rem 3rem rgba(0,0,0,.175) !important;
}
.hover-primary:hover {
  color: var(--primary-color) !important;
}
</style>