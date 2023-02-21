<div class="container-fluid">
  <div class="card">
    <?php if (!isset($produto)) echo '<h5 class="card-header">Adicionar Produto</h5>';
          else echo '<h5 class="card-header">Editar Produto</h5>';
    ?>
    <div class="card-body">
      <div class="col error-alert" style="display: none;">
        <div class="alert alert-danger d-flex align-items-center" role="alert">
          <i class="fa-solid fa-triangle-exclamation"></i>&nbsp;&nbsp;
          <div class="error-msg"></div>
        </div>
      </div>
        <?php if (isset($produto)) echo form_open(base_url("produtos/alterar/".$produto["id"]), 'id="form-edit-produto"');
              else echo form_open(base_url("produtos/store"), 'id="form-produto"');
        ?>
        <div class="col">
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="form-nome">Nome *</label>
                <input type="text" class="form-control" id="form-nome" name="form-nome" required value="<?php echo (isset($produto["nome"])) ? $produto["nome"] : '' ?>">
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="form-codigo-barras">Código de Barras</label>
                <input type="text" class="form-control" id="form-codigo-barras" name="form-codigo-barras" value="<?php echo (isset($produto["codigo_barras"])) ? $produto["codigo_barras"] : '' ?>">
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="form-status">Status</label>
                <select class="form-select" id="form-status" name="form-status" <?php echo (isset($produto["status"])) ? 'recordset="'.$produto["status"].'"' : '' ?> required>
                  <option value="ATIVO">ATIVO</option>
                  <option value="INATIVO">INATIVO</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row mt-2">
            <div class="col">
              <div class="form-group">
                <label for="form-descricao">Descrição</label>
                <input type="text" class="form-control" id="form-descricao" name="form-descricao" value="<?php echo (isset($produto["descricao"])) ? $produto["descricao"] : '' ?>">
              </div>
            </div>
          </div>
          <?php if (isset($produto)) echo '<a class="btn btn-primary mt-3" id="send-edt-form"><i class="fa-solid fa-floppy-disk"></i> Editar</a>';
                else echo '<a class="btn btn-primary mt-3" id="send-form"><i class="fa-solid fa-floppy-disk"></i> Salvar</a>';
          ?>
          <a class="btn btn-danger mt-3" href="<?php echo base_url("produtos/index") ?>"><i class="fa-solid fa-ban"></i> Cancelar</a>
        </div>
      <?php echo form_close(); ?>
    </div>
    
  </div>
</div>

<script>
  // Ao carregar a página
  window.onload = function(e){ 

    // Send form and front-end validation
    $("#send-form").click(function(){
      let erro = 0;
      $(".error-alert").css("display", "none");
      
      // Validation nome
      if ($("#form-nome").val().length <= 5) {
        erro++;
        $(".error-msg").html(" Preencha o nome corretamente");
      }

      // Validation Status
      if ($("#form-status").val().trim() == "") {
        erro++;
        $(".error-msg").html(" Preencha o status corretamente");
      }

      if (erro == 0) {
        $("#form-produto").submit();
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

      // Validation Status
      if ($("#form-status").val().trim() == "") {
        erro++;
        $(".error-msg").html(" Preencha o status corretamente");
      }

      if (erro == 0) {
        $("#form-edit-produto").submit();
      } else {
        $(".error-alert").css("display", "");
      }
    });

    // Edit
    <?php
      if (isset($produto)) {
        echo '
          $("#form-status").val($("#form-status").attr("recordset"));
        ';

        // Se inativo, desabilito edição
        if ($produto["status"] == "INATIVO") {
          echo '
            $("input").attr("disabled","disabled");
            $("select").attr("disabled","disabled");
            $("#send-edt-form").remove();
          ';
        }
      }    
    ?>
  }
</script>