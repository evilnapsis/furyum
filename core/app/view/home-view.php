<?php 
if(!isset($_SESSION["user_id"])){ Core::redir("./");}
$user= UserData::getById($_SESSION["user_id"]);
if($user==null){ Core::redir("./");}
?>
<div class="container py-4">
  <div class="row align-items-center mb-4">
    <div class="col-md-8">
      <h2 class="fw-bold mb-0">Hola, <?php echo $user->name; ?></h2>
      <p class="text-muted">Gestiona tus publicaciones y actividad en el foro.</p>
    </div>
    <div class="col-md-4 text-md-end">
      <a href="./?view=posts&id=1" class="btn btn-primary rounded-pill shadow-sm">
        <i class="bi bi-plus-lg me-2"></i>Nueva Publicación
      </a>
    </div>
  </div>

  <!-- Summary Cards -->
  <div class="row g-4 mb-5">
    <div class="col-md-4">
      <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
        <div class="d-flex align-items-center">
          <div class="bg-primary-subtle text-primary rounded-circle p-3 me-3">
            <i class="bi bi-file-post fs-3"></i>
          </div>
          <div>
            <h4 class="fw-bold mb-0"><?php echo count(PostData::getAllByUser($user->id)); ?></h4>
            <p class="text-muted small mb-0">Publicaciones</p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
        <div class="d-flex align-items-center">
          <div class="bg-success-subtle text-success rounded-circle p-3 me-3">
            <i class="bi bi-chat-left-dots fs-3"></i>
          </div>
          <div>
            <h4 class="fw-bold mb-0"><?php echo CommentData::countByUser($user->id); ?></h4>
            <p class="text-muted small mb-0">Comentarios</p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card border-0 shadow-sm rounded-4 p-4 h-100 bg-primary text-white">
        <div class="d-flex align-items-center">
          <div class="bg-white bg-opacity-25 rounded-circle p-3 me-3">
            <i class="bi bi-star fs-3"></i>
          </div>
          <div>
            <h4 class="fw-bold mb-0"><?php echo LikeData::countByUserKarma($user->id); ?></h4>
            <p class="opacity-75 small mb-0">Karma total</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <?php
      $users = PostData::getAllByUser(Core::$user->id);
      if(count($users)>0){
      ?>
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
          <div class="card-header bg-white py-3 border-bottom-0">
            <h5 class="card-title mb-0 fw-bold">Mis publicaciones</h5>
          </div>
          <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
              <thead class="bg-light">
                <tr>
                  <th class="ps-4">Título</th>
                  <th>Sección</th>
                  <th><i class="bi bi-hand-thumbs-up"></i></th>
                  <th><i class="bi bi-chat-left-text"></i></th>
                  <th>Creación</th>
                  <th class="text-end pe-4">Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($users as $user): ?>
                <tr>
                  <td class="ps-4 fw-semibold"><?php echo $user->title; ?></td>
                  <td>
                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-3">
                      <?php echo CategoryData::getById($user->category_id)->name; ?>
                    </span>
                  </td>
                  <td><span class="text-muted small"><?php echo LikeData::countByPost($user->id); ?></span></td>
                  <td><span class="text-muted small"><?php echo CommentData::countByPost($user->id); ?></span></td>
                  <td class="text-muted small"><?php echo date("d M, Y", strtotime($user->created_at)); ?></td>
                  <td class="text-end pe-4">
                    <a href="./?view=post&id=<?php echo $user->id; ?>" class="btn btn-sm btn-outline-primary rounded-pill px-3 me-1">
                      <i class="bi bi-eye me-1"></i> Ver
                    </a>
                    <button type="button" class="btn btn-sm btn-outline-warning rounded-pill px-3 me-1" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $user->id; ?>">
                      <i class="bi bi-pencil me-1"></i>
                    </button>
                    <a href="index.php?action=posts&opt=del&id=<?php echo $user->id;?>" class="btn btn-sm btn-outline-danger rounded-pill px-3" onclick="return confirm('¿Estás seguro?')">
                      <i class="bi bi-trash"></i>
                    </a>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>

        <?php foreach($users as $user):?>
        <!-- Modal -->
        <div class="modal fade" id="editModal<?php echo $user->id; ?>" tabindex="-1" aria-labelledby="editModalLabel<?php echo $user->id; ?>" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4">
              <div class="modal-header border-bottom-0 pt-4 px-4">
                <h5 class="modal-title fw-bold" id="editModalLabel<?php echo $user->id; ?>">Editar Publicación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body p-4">
                <form method="post" action="index.php?action=posts&opt=update" enctype="multipart/form-data">
                  <div class="mb-3">
                    <label class="form-label fw-semibold small text-uppercase text-muted">Título</label>
                    <input type="text" name="title" value="<?php echo $user->title;?>" class="form-control rounded-3" required>
                  </div>

                  <div class="mb-3">
                    <label class="form-label fw-semibold small text-uppercase text-muted">Contenido</label>
                    <textarea name="content" class="form-control rounded-3" rows="5" required><?php echo $user->content;?></textarea>
                  </div>

                  <div class="mb-4">
                    <label class="form-label fw-semibold small text-uppercase text-muted">Imagen destacada (1920x1080)</label>
                    <input type="file" name="image" class="form-control rounded-3">
                    <div class="form-text small">Deja en blanco para mantener la imagen actual.</div>
                  </div>

                  <input type="hidden" name="category_id" value="<?php echo $user->category_id; ?>">
                  <input type="hidden" name="user_id" value="<?php echo $user->id;?>">

                  <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary btn-lg rounded-3 shadow-sm">Actualizar Cambios</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <?php endforeach; ?>

      <?php
      } else {
        ?>
        <div class="text-center py-5 bg-white rounded-4 shadow-sm">
          <i class="bi bi-file-post display-1 text-muted opacity-25 mb-3 d-block"></i>
          <h4 class="text-muted">No tienes publicaciones aún</h4>
          <p class="text-muted small">¡Empieza a compartir tus ideas con la comunidad!</p>
          <a href="./#publish" class="btn btn-primary rounded-pill px-4 mt-2">Crear mi primera publicación</a>
        </div>
        <?php
      }
      ?>
    </div>
  </div>
</div>