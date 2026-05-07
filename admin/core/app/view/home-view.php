    <section class="content-header">
      <h1>
        Sistema Furyum
        <small>Version 1.1</small>
      </h1>
    </section>

<section class="content">
<div class="row">
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo PostData::countAll(); ?></h3>
              <p>Posts</p>
            </div>
            <div class="icon">
              <i class="fa fa-file-text"></i>
            </div>
            <a href="./?view=posts" class="small-box-footer">Ver mas <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo CategoryData::countAll(); ?></h3>

              <p>Categorias</p>
            </div>
            <div class="icon">
              <i class="fa fa-th-list"></i>
            </div>
            <a href="./?view=categories" class="small-box-footer">Ver mas <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo UserData::countAll(); ?></h3>

              <p>Usuarios</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="./?view=users" class="small-box-footer">Ver mas <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Publicaciones Recientes</h3>
			</div>
			<div class="box-body">
				<?php 
				$recent = PostData::getRecent(10);
				if(count($recent)>0):
				?>
				<table class="table table-bordered table-hover">
					<thead>
						<th>Titulo</th>
						<th>Categoria</th>
						<th>Fecha</th>
					</thead>
					<?php foreach($recent as $r):?>
					<tr>
						<td><?php echo $r->title; ?></td>
						<td><?php echo CategoryData::getById($r->category_id)->name; ?></td>
						<td><?php echo $r->created_at; ?></td>
					</tr>
					<?php endforeach; ?>
				</table>
				<?php else: ?>
					<p class="alert alert-info">No hay publicaciones recientes.</p>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
</section>