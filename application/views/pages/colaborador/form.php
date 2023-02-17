<?php echo validation_errors(); ?>

<div class="container-fluid">
  <div class="card">
    <h5 class="card-header">Adicionar Colaborador</h5>
    <div class="card-body">
      <?php echo form_open(base_url() . "colaborador/store"); ?>
        <div class="col">
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="form-nome">Nome *</label>
                <input type="text" class="form-control" id="form-nome" name="form-nome">
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="form-cpf">CPF *</label>
                <input type="text" class="form-control mask-cpf" id="form-cpf" name="form-cpf">
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="form-data-nascimento">Data de Nascimento</label>
                <input type="date" class="form-control mask-data" id="form-data-nascimento" name="form-data-nascimento">
              </div>
            </div>
          </div>
          <div class="row mt-2">
            <div class="col">
              <div class="form-group">
                <label for="form-email">Email</label>
                <input type="email" class="form-control" id="form-email" name="form-email">
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="form-celular">Celular</label>
                <input type="text" class="form-control mask-celular" id="form-celular" name="form-celular">
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="form-funcao">Função</label>
                <select class="form-select" id="form-funcao" name="form-funcao">
                  <option value="COLABORADOR">COLABORADOR</option>
                  <option value="FORNECEDOR">FORNECEDOR</option>
                </select>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="form-status">Status</label>
                <select class="form-select" id="form-status" name="form-status">
                  <option value="ATIVO">ATIVO</option>
                  <option value="INATIVO">INATIVO</option>
                </select>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary mt-3">Enviar</button>
          <a type="submit" class="btn btn-danger mt-3" href="<?php echo base_url() ?>colaborador/index">Cancelar</a>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="<?php echo base_url('assets/js/event.js') ?>"></script>