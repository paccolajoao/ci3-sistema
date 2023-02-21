<?php
  // Seleciono no header qual aba do menu está selecionada
  $active_menu = [
    'HOME' => "link-dark",
    'COLABORADORES' => "link-dark",
    'PRODUTOS' => "link-dark",
    'PEDIDOS' => "link-dark"
  ];

  switch ($menu) {
    case 'COLABORADORES':
      $active_menu["COLABORADORES"] = "";
      break;
    case 'PRODUTOS':
      $active_menu["PRODUTOS"] = "";
      break;
    case 'PEDIDOS':
      $active_menu["PEDIDOS"] = "";
      break;
    default:
      $active_menu["HOME"] = "";
      break;
  }
?>
<div class="container-fluid">
  <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
      <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
        <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
      </a>
      <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li><a href="<?php echo base_url() ?>dashboard" class="nav-link px-2 <?= $active_menu["HOME"] ?>">Home</a></li>
        <?php if($_SESSION["logged_user"][0]["menu_colaboradores"] == 1):?>
          <li><a href="<?php echo base_url('colaborador/index') ?>" class="nav-link px-2 <?= $active_menu["COLABORADORES"] ?>">Colaboradores</a></li>
        <?php endif;?>
        <?php if($_SESSION["logged_user"][0]["menu_produtos"] == 1):?>
          <li><a href="<?php echo base_url('produtos/index') ?>" class="nav-link px-2 <?= $active_menu["PRODUTOS"] ?>">Produtos</a></li>
        <?php endif;?>
        <?php if($_SESSION["logged_user"][0]["menu_pedidos"] == 1):?>
          <li><a href="#" class="nav-link px-2 <?= $active_menu["PEDIDOS"] ?>">Pedidos</a></li>
        <?php endif;?>
      </ul>

      <div class="col-md-3 text-end">
        <a type="button" class="btn btn-outline-primary me-2" href="<?= base_url('login/logout'); ?>">Logout</a>
      </div>
  </header>
</div>