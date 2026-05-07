<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-10">
      <div class="text-center mb-5">
        <h1 class="display-4 mb-3">Bienvenido a Furyum</h1>
        <p class="lead text-muted">La comunidad donde las ideas cobran vida. Únete a la conversación y comparte tu conocimiento.</p>
      </div>

      <div class="row g-4 mt-2">
        <div class="col-md-8">
          <h3 class="mb-4 d-flex align-items-center">
            <i class="bi bi-folder2-open me-2 text-primary"></i>Categorías
          </h3>
          
          <?php 
          $cats = CategoryData::getAll();
          if(count($cats)>0):
          ?>
            <div class="list-group shadow-sm rounded-4 overflow-hidden border-0">
              <?php foreach($cats as $cat):?>
                <a href="./?view=posts&id=<?php echo $cat->id; ?>" class="list-group-item list-group-item-action p-4 border-0 border-bottom">
                  <div class="d-flex w-100 justify-content-between align-items-center">
                    <div>
                      <h5 class="mb-1 text-primary"><?php echo $cat->name; ?></h5>
                      <p class="mb-0 text-muted small"><?php echo $cat->description; ?></p>
                    </div>
                    <div class="d-flex align-items-center">
                      <span class="badge bg-primary-subtle text-primary rounded-pill me-3"><?php echo PostData::countByCat($cat->id); ?> posts</span>
                      <i class="bi bi-chevron-right text-muted"></i>
                    </div>
                  </div>
                </a>
              <?php endforeach; ?>
            </div>
          <?php else:?>
            <div class="alert alert-light border-dashed text-center p-5 rounded-4">
              <i class="bi bi-info-circle fs-1 text-muted mb-3 d-block"></i>
              <p class="mb-0">Aún no hay categorías disponibles. ¡Vuelve pronto!</p>
            </div>
          <?php endif; ?>

        </div>

        <div class="col-md-4">
          <?php if(!isset($_SESSION["user_id"])):?>
          <div class="card border-0 shadow-sm rounded-4 bg-primary text-white p-4">
            <h4>¿Nuevo aquí?</h4>
            <p class="small opacity-75">Regístrate hoy para empezar a publicar y comentar en las discusiones.</p>
            <a href="./?view=register" class="btn btn-light btn-sm fw-bold">Crear cuenta</a>
          </div>
          <?php endif; ?>
          
          <div class="card border-0 shadow-sm rounded-4 mt-4 p-4">
            <h5 class="mb-3">Estadísticas</h5>
            <div class="d-flex justify-content-between mb-2">
              <span class="text-muted small">Publicaciones</span>
              <span class="fw-bold small"><?= count(PostData::getAllActive()); ?></span>
            </div>
            <div class="d-flex justify-content-between">
              <span class="text-muted small">Usuarios</span>
              <span class="fw-bold small"><?= count(UserData::getAll()); ?></span>
            </div>
          </div>

          <div class="card border-0 shadow-sm rounded-4 mt-4 overflow-hidden">
            <div class="card-header bg-white py-3 border-bottom-0">
              <h5 class="fw-bold mb-0 small text-uppercase text-primary">Publicaciones Recientes</h5>
            </div>
            <div class="list-group list-group-flush border-top">
              <?php 
              $recent_all = PostData::getRecent(10);
              if(count($recent_all)>0):
                foreach($recent_all as $rp):
              ?>
                <a href="./?view=post&id=<?php echo $rp->id; ?>" class="list-group-item list-group-item-action py-3 border-0 border-bottom">
                  <h6 class="mb-1 fw-bold small"><?php echo $rp->title; ?></h6>
                  <div class="d-flex justify-content-between align-items-center mt-2">
                    <p class="mb-0 text-muted extra-small" style="font-size: 0.75rem;">
                      <i class="bi bi-calendar3 me-1"></i> <?php echo date("d M, Y", strtotime($rp->created_at)); ?>
                    </p>
                    <div class="d-flex gap-2 text-muted extra-small" style="font-size: 0.75rem;">
                      <span><i class="bi bi-hand-thumbs-up me-1"></i> <?php echo LikeData::countByPost($rp->id); ?></span>
                      <span><i class="bi bi-chat-left-text me-1"></i> <?php echo CommentData::countByPost($rp->id); ?></span>
                    </div>
                  </div>
                </a>
              <?php 
                endforeach;
              else:
              ?>
                <div class="p-4 text-center">
                  <p class="text-muted small mb-0">No hay publicaciones recientes.</p>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>