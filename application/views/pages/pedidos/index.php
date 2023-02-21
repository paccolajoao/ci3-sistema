<div class="container-fluid">
  <div class="card">
    <div class="card-header">
      Pedidos
      <a type="button" class="btn btn-success btn-sm float-end" href="<?php echo base_url("pedidos/create") ?>"><i class="fa-solid fa-plus"></i> Adicionar</a>
    </div>
    <div class="card-body">
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">Código</th>
            <th scope="col">Data de Criação</th>
            <th scope="col">Fornecedor</th>
            <th scope="col">Status</th>
            <th scope="col" width="120"></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($pedidos as $key => $pedido) :?>
            <tr>
              <td><?php echo $pedido["id"] ?></td>
              <td><?php echo date("d/m/Y H:i:s", strtotime($pedido["data_criacao"])) ?></td>
              <td><?php echo $pedido["nome_colaborador"] ?></td>
              <td><?php echo ($pedido["status"] == "ATIVO") ? '<span class="badge text-bg-success">ATIVO</span>' : '<span class="badge text-bg-primary">FINALIZADO</span>' ?></td>
              <td>
                <a class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-title="Editar Pedido" href="<?= base_url() ?>pedidos/edit/<?= $pedido["id"] ?>"><i class="fa-solid fa-pen"></i></a>
                <?php echo ($pedido["status"] == "ATIVO") ? '<a class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-title="Excluir Pedido" href="'.base_url()."pedidos/delete/".$pedido["id"].'"><i class="fa-solid fa-trash"></i></a>' : "" ?>
                <?php echo ($pedido["status"] == "ATIVO") ? '<a type="button" class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-title="Finalizar Pedido" href="'.base_url('pedidos/finalizar_pedido/'.$pedido["id"]).'"><i class="fa-solid fa-square-check"></i></a>' : '<a type="button" class="btn btn-success btn-sm" data-bs-toggle="tooltip" data-bs-title="Ativar Pedido" href="'.base_url('pedidos/ativar_pedido/'.$pedido["id"]).'"><i class="fa-solid fa-circle-check"></i></a>' ?>
              </td>
            </tr>
          <?php endforeach; ?>
          <?php if (sizeof($pedidos) == 0):?>
            <tr><td colspan="5" align="center">Não há pedidos cadastrados
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