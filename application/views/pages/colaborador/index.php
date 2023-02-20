<div class="container-fluid">
  <div class="card">
    <div class="card-header">
      Colaboradores
      <a type="button" class="btn btn-success btn-sm float-end" href="<?php echo base_url("colaborador/create") ?>"><i class="fa-solid fa-plus"></i> Adicionar</a>
    </div>
    <div class="card-body">
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">Código</th>
            <th scope="col">Nome</th>
            <th scope="col">CPF</th>
            <th scope="col">Email</th>
            <th scope="col">Celular</th>
            <th scope="col">Função</th>
            <th scope="col">Status</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($colaboradores as $key => $colaborador) :?>
            <tr>
              <td><?php echo $colaborador["id"] ?></td>
              <td><?php echo $colaborador["nome"] ?></td>
              <td><?php echo $colaborador["cpf"] ?></td>
              <td><?php echo $colaborador["email"] ?></td>
              <td><?php echo $colaborador["celular"] ?></td>
              <td><?php echo ($colaborador["funcao"] == "COLABORADOR") ? '<span class="badge text-bg-primary">COLABORADOR</span>' : '<span class="badge text-bg-warning">FORNECEDOR</span>' ?></td>
              <td><?php echo ($colaborador["status"] == "ATIVO") ? '<span class="badge text-bg-success">ATIVO</span>' : '<span class="badge text-bg-danger">INATIVO</span>' ?></td>
              <td>
                <a class="btn btn-primary btn-sm" href="<?= base_url() ?>colaborador/edit/<?= $colaborador["id"] ?>"><i class="fa-solid fa-pen"></i></a>
                <?php echo ($colaborador["status"] == "ATIVO") ? '<a type="button" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-title="Desativar Colaborador" href="'.base_url('colaborador/desativar_colaborador/'.$colaborador["id"]).'"><i class="fa-solid fa-circle-xmark"></i></a>' : '<a type="button" class="btn btn-success btn-sm" data-bs-toggle="tooltip" data-bs-title="Ativar Colaborador" href="'.base_url('colaborador/ativar_colaborador/'.$colaborador["id"]).'"><i class="fa-solid fa-circle-check"></i></a>' ?></td>
              </td>
            </tr>
          <?php endforeach; ?>
          <?php if (sizeof($colaboradores) == 0):?>
            <tr><td colspan="8" align="center">Não há colaboradores cadastrados
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