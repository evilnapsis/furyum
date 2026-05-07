<?php
$jb  = PostData::getById($_GET["id"]);
$cat = CategoryData::getById($jb->category_id);
$author = UserData::getById($jb->user_id);
?>

<div class="container py-5">
  <div class="row">
    <!-- Main Content -->
    <div class="col-lg-8">
      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb small">
          <li class="breadcrumb-item"><a href="./" class="text-decoration-none">Inicio</a></li>
          <li class="breadcrumb-item"><a href="./?view=posts&id=<?php echo $cat->id; ?>" class="text-decoration-none"><?php echo $cat->name; ?></a></li>
          <li class="breadcrumb-item active" aria-current="page"><?php echo substr($jb->title, 0, 30) . (strlen($jb->title) > 30 ? '...' : ''); ?></li>
        </ol>
      </nav>

      <article class="bg-white shadow-sm rounded-4 overflow-hidden mb-5">
        <?php if($jb->image!=""):?>
          <img src="./uploads/<?php echo $jb->image; ?>" class="img-fluid w-100 object-fit-cover" style="max-height: 450px;" alt="<?php echo $jb->title; ?>">
        <?php endif; ?>

        <div class="p-4 p-md-5">
          <header class="mb-4">
            <h1 class="display-5 fw-bold mb-3"><?php echo $jb->title; ?></h1>
            <div class="d-flex align-items-center text-muted small">
              <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px;">
                <?= strtoupper(substr($author->name, 0, 1)); ?>
              </div>
              <div>
                <p class="mb-0 fw-bold text-dark">Por <a href="./?view=profile&id=<?php echo $author->id; ?>" class="text-decoration-none"><?php echo $author->name." ".$author->lastname; ?></a></p>
                <p class="mb-0"><?php echo date("d M, Y", strtotime($jb->created_at)); ?> • <?php echo $cat->name; ?></p>
              </div>
            </div>
            
            <div class="mt-3">
              <?php 
              $likes_count = LikeData::countByPost($jb->id);
              $already_liked = false;
              if(isset($_SESSION["user_id"])){
                $already_liked = LikeData::getByUserAndPost($_SESSION["user_id"], $jb->id) != null;
              }
              ?>
              <a href="./?action=like&post_id=<?php echo $jb->id; ?>" class="btn <?php echo $already_liked ? 'btn-primary' : 'btn-outline-primary'; ?> rounded-pill px-3 shadow-sm">
                <i class="bi <?php echo $already_liked ? 'bi-hand-thumbs-up-fill' : 'bi-hand-thumbs-up'; ?> me-2"></i>
                Me gusta <span class="badge bg-white text-primary ms-1"><?php echo $likes_count; ?></span>
              </a>
            </div>
          </header>

          <div class="content fs-5 text-secondary lh-lg mb-5">
            <?php echo nl2br($jb->content); ?>
          </div>
        </div>
      </article>

      <section id="comments" class="mb-5">
        <h3 class="fw-bold mb-4 d-flex align-items-center">
          <i class="bi bi-chat-left-text me-2 text-primary"></i> Comentarios
        </h3>

        <?php if(Core::$user!=null):?>
        <div class="card border-0 shadow-sm rounded-4 mb-4">
          <div class="card-body p-4">
            <h5 class="fw-bold mb-3 small text-uppercase text-muted">Escribir un comentario</h5>
            <form method="post" action="./?action=send">
              <input type="hidden" name="post_id" value="<?php echo $jb->id; ?>">
              <div class="mb-3">
                <textarea name="comment" class="form-control rounded-3" rows="4" placeholder="Comparte tu opinión con la comunidad..." required></textarea>
              </div>
              <div class="text-end">
                <button type="submit" class="btn btn-primary rounded-pill px-4">
                  Enviar Comentario <i class="bi bi-send ms-2"></i>
                </button>
              </div>
            </form>
          </div>
        </div>
        <?php else: ?>
        <div class="alert alert-info border-0 rounded-4 p-4 d-flex align-items-center mb-4">
          <i class="bi bi-info-circle fs-3 me-3"></i>
          <div>
            Debes <a href="./?view=login" class="fw-bold text-decoration-none">iniciar sesión</a> para poder dejar un comentario.
          </div>
        </div>
        <?php endif;  ?>

        <?php
        $comments  = CommentData::getPublicByPost($jb->id);
        if(count($comments)>0):
        ?>
          <div class="bg-white shadow-sm rounded-4 overflow-hidden">
            <div class="list-group list-group-flush">
              <?php foreach($comments as $com):
              $uc = UserData::getById($com->user_id);
              ?>
                <div class="list-group-item p-4 border-0 border-bottom">
                  <div class="d-flex align-items-start mb-2">
                    <div class="bg-secondary-subtle text-secondary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 32px; height: 32px; flex-shrink: 0;">
                      <i class="bi bi-person-fill"></i>
                    </div>
                    <div>
                      <p class="mb-0 fw-bold small"><?php echo $uc->name." ".$uc->lastname; ?></p>
                      <p class="mb-0 text-muted extra-small" style="font-size: 0.75rem;">
                        <?php echo date("d M, Y - H:i", strtotime($com->created_at)); ?>
                      </p>
                    </div>
                  </div>
                  <div class="ms-5 text-secondary">
                    <?php echo nl2br($com->comment); ?>
                  </div>
                </div>
              <?php endforeach ; ?>
            </div>
          </div>
        <?php else:?>
          <div class="text-center py-5 bg-white rounded-4 shadow-sm">
            <p class="text-muted mb-0 small">Aún no hay comentarios. ¡Sé el primero en comentar!</p>
          </div>
        <?php endif; ?>
      </section>
    </div>

    <!-- Sidebar -->
    <div class="col-lg-4">
      <div class="sticky-top" style="top: 100px;">
        <div class="card border-0 shadow-sm rounded-4 mb-4">
          <div class="card-header bg-white py-3 border-bottom-0">
            <h5 class="fw-bold mb-0 small text-uppercase text-primary">Relacionados en <?php echo $cat->name; ?></h5>
          </div>
          <div class="list-group list-group-flush border-top">
            <?php 
            $recent_posts = PostData::getRecentByCat($cat->id, 10);
            if(count($recent_posts)>0):
              foreach($recent_posts as $rp):
                if($rp->id == $jb->id) continue; // Skip current post
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
                <p class="text-muted small mb-0">No hay otras publicaciones recientes.</p>
              </div>
            <?php endif; ?>
          </div>
          <div class="card-footer bg-light border-0 py-3 text-center">
            <a href="./?view=posts&id=<?php echo $cat->id; ?>" class="small text-primary fw-bold text-decoration-none">
              Ver todo en <?php echo $cat->name; ?> <i class="bi bi-arrow-right ms-1"></i>
            </a>
          </div>
        </div>

        <?php if(!isset($_SESSION["user_id"])):?>
        <div class="card border-0 shadow-sm rounded-4 bg-primary text-white p-4">
          <h5 class="fw-bold mb-2">Comunidad Furyum</h5>
          <p class="small opacity-75 mb-3">Comparte tus dudas, proyectos y conocimientos con otros entusiastas.</p>
          <a href="./?view=register" class="btn btn-light btn-sm w-100 fw-bold rounded-pill">Unirme ahora</a>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>

</div>