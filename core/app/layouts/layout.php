<!--
Este es el layout principal, a partir de este layout o plantilla se muestran el resto de "vistas"
-->
<!DOCTYPE html>
<html lang="en" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?=Html::title('FURYUM - Foro Comunitario');?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <?=Html::link('assets/bootstrap/css/bootstrap.min.css'); ?>
    <?=Html::link('assets/bootstrap-icons/bootstrap-icons.min.css'); ?>
    <style>
      :root {
        --primary-color: #4f46e5;
        --primary-hover: #4338ca;
        --bg-gradient: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
      }
      body {
        font-family: 'Inter', sans-serif;
        background: var(--bg-gradient);
        color: #1e293b;
      }
      h1, h2, h3, h4, h5, h6, .navbar-brand {
        font-family: 'Outfit', sans-serif;
        font-weight: 700;
      }
      .navbar {
        background-color: rgba(15, 23, 42, 0.9) !important;
        backdrop-filter: blur(10px);
        box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
      }
      .navbar-brand {
        font-size: 1.5rem;
        letter-spacing: -0.025em;
        color: #fff !important;
      }
      .nav-link {
        font-weight: 500;
        color: rgba(255, 255, 255, 0.8) !important;
        transition: color 0.2s;
      }
      .nav-link:hover {
        color: #fff !important;
      }
      .btn-primary {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        font-weight: 600;
        padding: 0.5rem 1.25rem;
        border-radius: 0.5rem;
        transition: all 0.2s;
      }
      .btn-primary:hover {
        background-color: var(--primary-hover);
        border-color: var(--primary-hover);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
      }
      .footer {
        background-color: #0f172a;
        color: #94a3b8;
        padding: 3rem 0;
        margin-top: auto;
      }
    </style>
  </head>

  <body class="d-flex flex-column h-100">
<nav class="navbar navbar-expand-lg navbar-dark sticky-top mb-4">
  <div class="container">
    <a class="navbar-brand" href="./">
      <i class="bi bi-chat-right-text-fill me-2 text-primary"></i>FURYUM
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarMain">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="./">INICIO</a></li>
        <?php if(!isset($_SESSION["user_id"])):?>
        <li class="nav-item"><a class="nav-link" href="./?view=login">LOGIN</a></li>
        <li class="nav-item"><a class="nav-link text-primary" href="./?view=register">REGISTRO</a></li>
        <?php endif; ?>
      </ul>

      <form class="d-flex mx-auto col-lg-5" action="./" method="get">
        <input type="hidden" name="view" value="search">
        <div class="input-group">
          <input class="form-control bg-light border-0 rounded-start-pill ps-4" type="search" name="q" placeholder="Buscar publicaciones..." aria-label="Search" required>
          <button class="btn btn-primary rounded-end-pill px-4" type="submit">
            <i class="bi bi-search"></i>
          </button>
        </div>
      </form>
      
      <?php if(isset($_SESSION["user_id"])):?>
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
              <?= strtoupper(substr(Core::$user->name, 0, 1)); ?>
            </div>
            <?php echo Core::$user->name." ".Core::$user->lastname; ?>
          </a>
          <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="userDropdown">
            <li><a class="dropdown-item py-2" href="./?view=home"><i class="bi bi-speedometer2 me-2"></i>Mi inicio</a></li>
            <li><a class="dropdown-item py-2" href="./?view=profile"><i class="bi bi-person me-2"></i>Editar Perfil</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item py-2 text-danger" href="./?action=access&o=logout"><i class="bi bi-box-arrow-right me-2"></i>Salir</a></li>
          </ul>
        </li>
      </ul>
      <?php endif; ?>
    </div>
  </div>
</nav>

<main class="flex-shrink-0">
<?php 
  View::load("index");
?>
</main>

<footer class="footer mt-auto py-3">
  <div class="container text-center">
    <div class="row">
      <div class="col-md-12">
        <p class="mb-1">Desarrollado con pasión por <a href="http://evilnapsis.com/" target="_blank" class="text-white text-decoration-none fw-bold">Evilnapsis</a></p>
        <p class="small text-muted">&copy; 2026 FURYUM. Todos los derechos reservados.</p>
        <div class="mt-3">
          <a href="#" class="text-muted me-3 fs-5"><i class="bi bi-twitter"></i></a>
          <a href="#" class="text-muted me-3 fs-5"><i class="bi bi-facebook"></i></a>
          <a href="#" class="text-muted fs-5"><i class="bi bi-github"></i></a>
        </div>
      </div>
    </div>
  </div>
</footer>

<?= Html::script('assets/bootstrap/js/bootstrap.bundle.min.js'); ?>
  </body>
</html>
