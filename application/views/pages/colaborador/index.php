<div class="container-fluid">
  <div class="card">
    <div class="card-header">
      Colaboradores
      <a type="button" class="btn btn-success btn-sm float-end" href="<?php echo base_url() ?>colaborador/create"><i class="fa-solid fa-plus"></i> Adicionar</a>
    </div>
    <div class="card-body">
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">Código</th>
            <th scope="col">Nome</th>
            <th scope="col">CPF</th>
            <th scope="col">Data de Nascimento</th>
            <th scope="col">Salário</th>
            <th scope="col">Celular</th>
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
              <td><?php echo date("d/m/Y", strtotime($colaborador["data_nascimento"])) ?></td>
              <td><?php echo number_format($colaborador["salario"], 2, ",", ".") ?></td>
              <td><?php echo $colaborador["celular"] ?></td>
              <td><?php echo $colaborador["status"] ?></td>
              <td>
                <a class="btn btn-primary btn-sm" href=""><i class="fa-solid fa-pen"></i></a>
                <a class="btn btn-danger btn-sm" href=""><i class="fa-solid fa-trash-can"></i></a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>