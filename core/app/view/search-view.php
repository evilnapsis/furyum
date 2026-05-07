<?php
$q = isset($_GET["q"]) ? $_GET["q"] : "";
$results = PostData::getSearch($q, 25);
?>

<div class="container py-5">
  <div class="row align-items-center mb-5">
    <div class="col-md-8">
      <h1 class="fw-bold mb-1">Resultados de búsqueda</h1>
      <p class="text-muted lead">Mostrando resultados para: <span class="text-primary fw-bold">"<?php echo $q; ?>"</span></p>
    </div>
    <div class="col-md-4 text-md-end">
      <span class="badge bg-white text-dark shadow-sm p-2 rounded-3 border">
        <i class="bi bi-list-stars me-1 text-primary"></i> <?php echo count($results); ?> coincidencias encontradas
      </span>
    </div>
  </div>

  <div class="row g-4">
    <div class="col-lg-12">
      <?php if(count($results)>0): ?>
        <div class="row g-4">
          <?php foreach($results as $jb):
          $u = UserData::getById($jb->user_id);
          $cat = CategoryData::getById($jb->category_id);
          ?>
          <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden transition-hover">
              <div class="row g-0">
                <?php if($jb->image!=""):?>
                <div class="col-md-3">
                  <img src="./uploads/<?php echo $jb->image; ?>" class="img-fluid h-100 w-100 object-fit-cover" alt="<?php echo $jb->title; ?>" style="min-height: 180px;">
                </div>
                <?php endif; ?>
                <div class="<?php echo ($jb->image!="") ? 'col-md-9' : 'col-md-12'; ?> p-4">
                  <div class="d-flex flex-column h-100">
                    <div class="mb-2">
                      <span class="badge bg-primary-subtle text-primary mb-2"><?php echo $cat->name; ?></span>
                    </div>
                    <h4 class="mb-2 fw-bold">
                      <a href="./?view=post&id=<?php echo $jb->id; ?>" class="text-decoration-none text-dark hover-primary"><?php echo $jb->title; ?></a>
                    </h4>
                    <p class="text-muted small mb-3">
                      <i class="bi bi-person me-1"></i> Por <a href="./?view=profile&id=<?php echo $u->id; ?>" class="text-decoration-none fw-semibold text-primary"><?php echo $u->name." ".$u->lastname; ?></a>
                      <span class="mx-2">•</span>
                      <i class="bi bi-calendar3 me-1"></i> <?php echo date("d M, Y", strtotime($jb->created_at)); ?>
                      <span class="mx-2">•</span>
                      <i class="bi bi-hand-thumbs-up-fill me-1 text-primary"></i> <?php echo LikeData::countByPost($jb->id); ?>
                      <span class="mx-2">•</span>
                      <i class="bi bi-chat-left-text-fill me-1 text-primary"></i> <?php echo CommentData::countByPost($jb->id); ?>
                    </p>
                    <div class="mt-auto text-end">
                      <a href="./?view=post&id=<?php echo $jb->id; ?>" class="btn btn-link text-primary p-0 text-decoration-none fw-semibold">
                        Leer publicación <i class="bi bi-arrow-right ms-1"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      <?php else: ?>
        <div class="text-center py-5 bg-white rounded-4 shadow-sm border border-dashed">
          <i class="bi bi-search display-1 text-muted opacity-25 mb-3 d-block"></i>
          <h4 class="text-muted fw-bold">No se encontraron resultados</h4>
          <p class="text-muted mb-4">Intenta buscar con otros términos o revisa la ortografía.</p>
          <a href="./" class="btn btn-primary rounded-pill px-4">Volver al inicio</a>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>
