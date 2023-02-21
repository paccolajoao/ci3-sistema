<div class="container-fluid">
  <div class="card">
    <div class="card-header">
      Produtos
      <a type="button" class="btn btn-success btn-sm float-end" href="<?php echo base_url("produtos/create") ?>"><i class="fa-solid fa-plus"></i> Adicionar</a>
    </div>
    <div class="card-body">
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">Código</th>
            <th scope="col">Nome</th>
            <th scope="col">Código de Barras</th>
            <th scope="col">Status</th>
            <th scope="col" width="120"></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($produtos as $key => $produto) :?>
            <tr>
              <td><?php echo $produto["id"] ?></td>
              <td><?php echo $produto["nome"] ?></td>
              <td><?php echo $produto["codigo_barras"] ?></td>
              <td><?php echo ($produto["status"] == "ATIVO") ? '<span class="badge text-bg-success">ATIVO</span>' : '<span class="badge text-bg-danger">INATIVO</span>' ?></td>
              <td>
                <a class="btn btn-primary btn-sm" href="<?= base_url() ?>produtos/edit/<?= $produto["id"] ?>"><i class="fa-solid fa-pen"></i></a>
                <?php echo ($produto["status"] == "ATIVO") ? '<a type="button" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-title="Desativar Produto" href="'.base_url('produtos/desativar_produto/'.$produto["id"]).'"><i class="fa-solid fa-circle-xmark"></i></a>' : '<a type="button" class="btn btn-success btn-sm" data-bs-toggle="tooltip" data-bs-title="Ativar Produto" href="'.base_url('produtos/ativar_produto/'.$produto["id"]).'"><i class="fa-solid fa-circle-check"></i></a>' ?></td>
              </td>
            </tr>
          <?php endforeach; ?>
          <?php if (sizeof($produtos) == 0):?>
            <tr><td colspan="5" align="center">Não há produtos cadastrados
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script>
  // Inicializar tooltips
  window.onload = function(e){
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
  } 
</script>