<div class="container-fluid">
  <div class="card">
    <h5 class="card-header">Adicionar Colaborador</h5>
    <div class="card-body">
      <div class="col error-alert" style="display: none;">
        <div class="alert alert-danger d-flex align-items-center" role="alert">
          <i class="fa-solid fa-triangle-exclamation"></i>&nbsp;&nbsp;
          <div class="error-msg"></div>
        </div>
      </div>
        <?php if (isset($colaborador)) echo form_open(base_url("colaborador/alterar/".$colaborador["id"]), 'id="form-edit-colaborador"');
              else echo form_open(base_url("colaborador/store"), 'id="form-colaborador"');
        ?>
        <div class="col">
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="form-nome">Nome *</label>
                <input type="text" class="form-control" id="form-nome" name="form-nome" required value="<?php echo (isset($colaborador["nome"])) ? $colaborador["nome"] : '' ?>">
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="form-cpf">CPF *</label>
                <input type="text" class="form-control mask-cpf" id="form-cpf" name="form-cpf" required value="<?php echo (isset($colaborador["cpf"])) ? $colaborador["cpf"] : '' ?>">
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="form-data-nascimento">Data de Nascimento</label>
                <input type="date" class="form-control" id="form-data-nascimento" name="form-data-nascimento" value="<?php echo (isset($colaborador["data_nascimento"])) ? $colaborador["data_nascimento"] : '' ?>">
              </div>
            </div>
          </div>
          <div class="row mt-2">
            <div class="col">
              <div class="form-group">
                <label for="form-email">Email</label>
                <input type="email" class="form-control" id="form-email" name="form-email" value="<?php echo (isset($colaborador["email"])) ? $colaborador["email"] : '' ?>">
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="form-celular">Celular</label>
                <input type="text" class="form-control mask-celular" id="form-celular" name="form-celular" value="<?php echo (isset($colaborador["celular"])) ? $colaborador["celular"] : '' ?>">
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="form-funcao">Função</label>
                <select class="form-select" id="form-funcao" name="form-funcao" <?php echo (isset($colaborador["funcao"])) ? 'recordset="'.$colaborador["funcao"].'"' : '' ?> required>
                  <option value="COLABORADOR">COLABORADOR</option>
                  <option value="FORNECEDOR">FORNECEDOR</option>
                </select>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="form-status">Status</label>
                <select class="form-select" id="form-status" name="form-status" <?php echo (isset($colaborador["status"])) ? 'recordset="'.$colaborador["status"].'"' : '' ?> required>
                  <option value="ATIVO">ATIVO</option>
                  <option value="INATIVO">INATIVO</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row mt-2 div-sign-up">
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="form-nome">Usuário *</label>
                  <input type="text" class="form-control sign-up-fields" id="form-usuario" name="form-usuario" required value="<?php echo (isset($colaborador["usuario"])) ? $colaborador["usuario"] : '' ?>">
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="form-nome">
                    <?php if (isset($colaborador)) echo 'Alterar Senha *';
                          else echo 'Senha *';
                    ?>
                  </label>
                  <input type="password" class="form-control sign-up-fields" id="form-senha" name="form-senha" required value="<?php echo (isset($colaborador["senha"])) ? $colaborador["senha"] : '' ?>">
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="form-nome">Confirmação de Senha *</label>
                  <input type="password" class="form-control sign-up-fields" id="form-confirmacao-senha" name="form-confirmacao-senha" required value="<?php echo (isset($colaborador["senha"])) ? $colaborador["senha"]: '' ?>">
                </div>
              </div>
            </div>
            <div class="row mt-2">
              <div class="col">
                <div class="form-group">
                  <label for="form-menu-colaboradores">Menu Colaborador</label>
                  <select class="form-select" id="form-menu-colaboradores" name="form-menu-colaboradores" <?php echo (isset($colaborador["menu_colaboradores"])) ? 'recordset="'.$colaborador["menu_colaboradores"].'"' : '' ?> required>
                    <option value="1">SIM</option>
                    <option value="0">NÃO</option>
                  </select>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="form-menu-produtos">Menu Produtos</label>
                  <select class="form-select" id="form-menu-produtos" name="form-menu-produtos" <?php echo (isset($colaborador["menu_produtos"])) ? 'recordset="'.$colaborador["menu_produtos"].'"' : '' ?> required>
                    <option value="1">SIM</option>
                    <option value="0">NÃO</option>
                  </select>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="form-menu-pedidos">Menu Pedidos</label>
                  <select class="form-select" id="form-menu-pedidos" name="form-menu-pedidos" <?php echo (isset($colaborador["menu_pedidos"])) ? 'recordset="'.$colaborador["menu_pedidos"].'"' : '' ?> required>
                    <option value="1">SIM</option>
                    <option value="0">NÃO</option>
                  </select>
                </div>
              </div>
            </div>
            
          </div>
          <hr>
          <div class="row mt-2">
            <h5>Endereços</h5>
            <div class="enderecos">
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label for="form-cep">CEP *</label>
                    <input type="text" class="form-control mask-cep form-cep" name="endereco[cep][]" required>
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="form-rua">Rua</label>
                    <input type="text" class="form-control form-rua" name="endereco[rua][]">
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="form-numero">Número</label>
                    <input type="text" class="form-control form-numero" name="endereco[numero][]">
                  </div>
                </div>
              </div>
              <div class="row mt-1">
                <div class="col">
                  <div class="form-group">
                    <label for="form-bairro">Bairro</label>
                    <input type="text" class="form-control form-bairro" name="endereco[bairro][]">
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="form-cidade">Cidade</label>
                    <input type="text" class="form-control form-cidade" name="endereco[cidade][]">
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="form-estado">Estado</label>
                    <input type="text" class="form-control form-estado" name="endereco[estado][]">
                  </div>
                </div>
              </div>
              <div class="row mt-2">
                <div class="col">
                  <button type="button" class="btn btn-success float-end" id="add-endereco"><i class="fa-solid fa-plus"></i> Adicionar</button>
                </div>
              </div>
            </div>
          </div>
          <?php if (isset($colaborador)) echo '<a class="btn btn-primary mt-3" id="send-edt-form"><i class="fa-solid fa-floppy-disk"></i> Editar</a>';
                else echo '<a class="btn btn-primary mt-3" id="send-form"><i class="fa-solid fa-floppy-disk"></i> Salvar</a>';
          ?>
          <a class="btn btn-danger mt-3" href="<?php echo base_url("colaborador/index") ?>"><i class="fa-solid fa-ban"></i> Cancelar</a>
        </div>
      <?php if (isset($colaborador)) echo '<input type="hidden" name="form-hidden-funcao" id="form-hidden-funcao" value="'.$colaborador["funcao"].'">'?>
      <?php echo form_close(); ?>
    </div>
    
  </div>
</div>

<script>
  // Ao carregar a página
  window.onload = function(e){ 
    // Masks
    $('.mask-cpf').mask('000.000.000-00', {reverse: true});
    $('.mask-celular').mask('(00) 00000-0000');
    $('.mask-cep').mask('00000-000');

    // Events
    $("#form-funcao").change(function(){
      if ($(this).val() == 'FORNECEDOR') {
        $(".div-sign-up").css("display", "none");
        $(".sign-up-fields").removeAttr("required");
      } else {
        $(".div-sign-up").css("display", "");
        $(".sign-up-fields").attr("required","required");
      }
    });

    $(document).on('click','.remove-endereco',function(){
      $(this).parent().parent().parent().remove();
    });

    $("#add-endereco").click(function(){
      $(".enderecos").last().after(`
        <div class="enderecos">
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="form-cep">CEP *</label>
                <input type="text" class="form-control mask-cep form-cep" name="endereco[cep][]" required>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="form-rua">Rua</label>
                <input type="text" class="form-control form-rua" name="endereco[rua][]">
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="form-numero">Número</label>
                <input type="text" class="form-control form-numero" name="endereco[numero][]">
              </div>
            </div>
          </div>
          <div class="row mt-1">
            <div class="col">
              <div class="form-group">
                <label for="form-bairro">Bairro</label>
                <input type="text" class="form-control form-bairro" name="endereco[bairro][]">
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="form-cidade">Cidade</label>
                <input type="text" class="form-control form-cidade" name="endereco[cidade][]">
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="form-estado">Estado</label>
                <input type="text" class="form-control form-estado" name="endereco[estado][]">
              </div>
            </div>
          </div>
          <div class="row mt-2">
            <div class="col">
              <button type="button" class="btn btn-danger float-end remove-endereco"><i class="fa-solid fa-trash"></i> Remover</button>
            </div>
          </div>
        </div>
      `);
      $('.mask-cep').mask('00000-000');
    });

    // Send form and front-end validation
    $("#send-form").click(function(){
      let erro = 0;
      $(".error-alert").css("display", "none");
      
      // Validation nome
      if ($("#form-nome").val().length <= 5) {
        erro++;
        $(".error-msg").html(" Preencha o nome corretamente");
      }

      // Validation CPF
      if ($("#form-cpf").val().length < 14) {
        erro++;
        $(".error-msg").html(" Preencha o CPF corretamente");
      }

      // Validation Funcao
      if ($("#form-funcao").val().trim() == "") {
        erro++;
        $(".error-msg").html(" Preencha a função corretamente");
      }

      // Validation Status
      if ($("#form-status").val().trim() == "") {
        erro++;
        $(".error-msg").html(" Preencha o status corretamente");
      }

      // Validation pass and pass confirm
      if ($("#form-funcao").val() == 'COLABORADOR') {
        if (($("#form-senha").val().trim() != $("#form-confirmacao-senha").val().trim()) || ($("#form-senha").val().trim() == "") || ($("#form-confirmacao-senha").val() == "")) {
          erro++;
          $(".error-msg").html(" Preencha a senha e confirmação da senha corretamente");
        }
      }

      if (erro == 0) {
        $("#form-colaborador").submit();
      } else {
        $(".error-alert").css("display", "");
      }
    });

    // Send edt form and front-end validation
    $("#send-edt-form").click(function(){
      let erro = 0;
      $(".error-alert").css("display", "none");
      
      // Validation nome
      if ($("#form-nome").val().length <= 5) {
        erro++;
        $(".error-msg").html(" Preencha o nome corretamente");
      }

      // Validation CPF
      if ($("#form-cpf").val().length < 14) {
        erro++;
        $(".error-msg").html(" Preencha o CPF corretamente");
      }

      // Validation Funcao
      if ($("#form-funcao").val().trim() == "") {
        erro++;
        $(".error-msg").html(" Preencha a função corretamente");
      }

      // Validation Status
      if ($("#form-status").val().trim() == "") {
        erro++;
        $(".error-msg").html(" Preencha o status corretamente");
      }

      // Validation pass and pass confirm
      if ($("#form-funcao").val() == 'COLABORADOR') {
        if (($("#form-senha").val().trim() != $("#form-confirmacao-senha").val().trim())) {
          erro++;
          $(".error-msg").html(" Preencha a senha e confirmação da senha corretamente");
        }
      }

      if (erro == 0) {
        $("#form-edit-colaborador").submit();
      } else {
        $(".error-alert").css("display", "");
      }
    });

    // Edit
    <?php
      if (isset($colaborador)) {
        echo '
          $("#form-funcao").val($("#form-funcao").attr("recordset"));
          $("#form-funcao").attr("disabled","disabled");
          $("#form-status").val($("#form-status").attr("recordset"));
          $("#form-menu-colaboradores").val($("#form-menu-colaboradores").attr("recordset"));
          $("#form-menu-produtos").val($("#form-menu-produtos").attr("recordset"));
          $("#form-menu-pedidos").val($("#form-menu-pedidos").attr("recordset"));
        ';

        // Crio os campos
        for ($i=0; $i < count($colaborador["enderecos"]) - 1; $i++) { 
          echo '$("#add-endereco").trigger("click");';
        }

        // Preencho os campos
        foreach ($colaborador["enderecos"] as $key => $endereco) {
          echo '
            $(".form-cep").eq('.$key.').val("'.$endereco["cep"].'");
            $(".form-rua").eq('.$key.').val("'.$endereco["rua"].'");
            $(".form-numero").eq('.$key.').val("'.$endereco["numero"].'");
            $(".form-bairro").eq('.$key.').val("'.$endereco["bairro"].'");
            $(".form-cidade").eq('.$key.').val("'.$endereco["cidade"].'");
            $(".form-estado").eq('.$key.').val("'.$endereco["estado"].'");
          ';
        }

        // Se inativo, desabilito edição
        if ($colaborador["status"] == "INATIVO") {
          echo '
            $("input").attr("disabled","disabled");
            $("select").attr("disabled","disabled");
            $("#add-endereco").attr("disabled","disabled");
            $(".remove-endereco").attr("disabled","disabled");
            $("#send-edt-form").remove();
          ';
        }
      }    
    ?>
  }
</script>