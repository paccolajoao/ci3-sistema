<div class="container-fluid">
  <div class="card">
    <?php if (!isset($pedido)) echo '<h5 class="card-header">Adicionar Pedido</h5>';
          else echo '<h5 class="card-header">Editar Pedido</h5>';
    ?>
    <div class="card-body">
      <div class="col error-alert" style="display: none;">
        <div class="alert alert-danger d-flex align-items-center" role="alert">
          <i class="fa-solid fa-triangle-exclamation"></i>&nbsp;&nbsp;
          <div class="error-msg"></div>
        </div>
      </div>
        <?php if (isset($pedido)) echo form_open(base_url("pedidos/alterar/".$pedido["id"]), 'id="form-edit-pedido"');
              else echo form_open(base_url("pedidos/store"), 'id="form-pedido"');
        ?>
        <div class="col">
          <div class="row">
            <div class="col">
              <div class="form-group">
              <label for="form-fornecedor">Fornecedor *</label>
                <select class="form-select" id="form-fornecedor" name="form-fornecedor" <?php echo (isset($pedido["id_fornecedor"])) ? 'recordset="'.$pedido["id_fornecedor"].'"' : '' ?> required>
                  <?php foreach ($fornecedores as $key => $fornecedor): ?>
                    <option value="<?= $fornecedor["id"] ?>"><?= $fornecedor["nome"] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="form-status">Status</label>
                <select class="form-select" id="form-status" name="form-status" <?php echo (isset($pedido["status"])) ? 'recordset="'.$pedido["status"].'"' : '' ?> required>
                  <option value="ATIVO">ATIVO</option>
                  <option value="FINALIZADO">FINALIZADO</option>
                </select>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="form-valor-total-pedido">Valor Total</label>
                <input type="text" class="form-control form-valor-total-pedido mask-money" readonly>
              </div>
            </div>
          </div>
          <div class="row mt-2">
            <div class="col">
              <div class="form-group">
                <label for="form-observacao" class="form-label">Observação</label>
                <textarea class="form-control" id="form-observacao" name="form-observacao" rows="3"><?php echo (isset($pedido["observacao"])) ? $pedido["observacao"] : '' ?></textarea>
              </div>
            </div>
          </div>
          <hr>
          <div class="row mt-2">
            <h5>Itens</h5>
            <div class="itens">
              <div class="row">
                <div class="col form-item-select">
                  <div class="form-group">
                    <label for="form-item">Item *</label>
                    <select class="form-select form-item" name="itens[item][]" required <?php echo (isset($pedido["status"])) ? 'recordset="'.$pedido["status"].'"' : '' ?> >
                      <?php foreach ($itens as $key => $item): ?>
                        <option value="<?= $item["id"] ?>"><?= $item["nome"] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="form-quantidade">Quantidade</label>
                    <input type="number" class="form-control form-quantidade" name="itens[qtde][]">
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="form-valor-unitario">Valor Unitário</label>
                    <input type="text" class="form-control form-valor-unitario mask-money" name="itens[valor_un][]">
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="form-valor-total">Valor Total</label>
                    <input type="text" class="form-control form-valor-total mask-money" readonly>
                  </div>
                </div>
              </div>
              <div class="row mt-2">
                <div class="col">
                  <button type="button" class="btn btn-success float-end" id="add-item"><i class="fa-solid fa-plus"></i> Adicionar</button>
                </div>
              </div>
            </div>
          </div>
          <?php if (isset($pedido)) echo '<a class="btn btn-primary mt-3" id="send-edt-form"><i class="fa-solid fa-floppy-disk"></i> Editar</a>';
                else echo '<a class="btn btn-primary mt-3" id="send-form"><i class="fa-solid fa-floppy-disk"></i> Salvar</a>';
          ?>
          <a class="btn btn-danger mt-3" href="<?php echo base_url("pedidos/index") ?>"><i class="fa-solid fa-ban"></i> Cancelar</a>
        </div>
      <?php echo form_close(); ?>
    </div>
    
  </div>
</div>

<script>
  // Ao carregar a página
  window.onload = function(e){ 
    // Masks
    $('.mask-money').mask('000.000.000.000.000,00', {reverse: true});

    // Events
    // Calculo valor total
    $(document).on('change focusout','.form-valor-unitario, .form-quantidade',function(){
        let valor_total_pedido = 0;
        $(".form-quantidade").each(function(index, el) {
          let qtde = $(el).val();
          let valor_un = $(".form-valor-unitario").eq(index).val();
          // Se qtde não for preenchida ainda
          if ((qtde == undefined) || (qtde == null) || (qtde == "")) {
            qtde = 1;
          }

          // Se valor não for preenchido ainda
          if ((valor_un == undefined) || (valor_un == null) || (valor_un == "")) {
            valor_un = '0';
          }

          let valor_total = qtde * parseFloat(valor_un.replace(".", "").replace(",", "."));
          if ((valor_total == undefined) || (valor_total == null) || (isNaN(valor_total))) {
            valor_total = '0';
          }

          valor_total_pedido += parseFloat(valor_total);
          $(".form-valor-total").eq(index).val(valor_total.toFixed(2).replace('.', ',')
                                                                     .replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.'));
        });
        $(".form-valor-total-pedido").val(parseFloat(valor_total_pedido).toFixed(2).replace('.', ',')
                                                                        .replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.'));
    });

    $(document).on('click','.remove-item',function(){
      $(this).parent().parent().parent().remove();
    });

    $("#add-item").click(function(){
      $(".itens").last().after(`
        <div class="itens">
          <div class="row">
            <div class="col form-item-select">
              `+$(".form-item-select").first().html()+`
            </div>
            <div class="col">
              <div class="form-group">
                <label for="form-quantidade">Quantidade</label>
                <input type="number" class="form-control form-quantidade" name="itens[qtde][]">
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="form-valor-unitario ">Valor Unitário</label>
                <input type="text" class="form-control form-valor-unitario mask-money" name="itens[valor_un][]">
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="form-valor-total">Valor Total</label>
                <input type="text" class="form-control form-valor-total mask-money"readonly>
              </div>
            </div>
          </div>
          <div class="row mt-2">
            <div class="col">
              <button type="button" class="btn btn-danger float-end remove-item"><i class="fa-solid fa-trash"></i> Remover</button>
            </div>
          </div>
        </div>
      `);
      $('.mask-money').mask('000.000.000.000.000,00', {reverse: true});
    });

    // Send form and front-end validation
    $("#send-form").click(function(){
      let erro = 0;
      $(".error-alert").css("display", "none");
      
      if ($(".form-item").eq(0).val() == "") {
        erro++;
        $(".error-msg").html(" Preencha pelo menos um item");
      }

      if ($(".form-quantidade").eq(0).val() == "") {
        erro++;
        $(".error-msg").html(" Preencha pelo menos uma quantidade");
      }

      if ($(".form-valor-unitario").eq(0).val() == "") {
        erro++;
        $(".error-msg").html(" Preencha pelo menos um valor unitário");
      }

      if (erro == 0) {
        $("#form-pedido").submit();
      } else {
        $(".error-alert").css("display", "");
      }
    });

    // Send edt form and front-end validation
    $("#send-edt-form").click(function(){
      let erro = 0;
      $(".error-alert").css("display", "none");
      
      if ($(".form-item").eq(0).val() == "") {
        erro++;
        $(".error-msg").html(" Preencha pelo menos um item");
      }

      if ($(".form-quantidade").eq(0).val() == "") {
        erro++;
        $(".error-msg").html(" Preencha pelo menos uma quantidade");
      }

      if ($(".form-valor-unitario").eq(0).val() == "") {
        erro++;
        $(".error-msg").html(" Preencha pelo menos um valor unitário");
      }

      if (erro == 0) {
        $("#form-edit-pedido").submit();
      } else {
        $(".error-alert").css("display", "");
      }
    });

    // Edit
    <?php
      if (isset($pedido)) {
        echo '
          $("#form-status").val($("#form-status").attr("recordset"));
          $("#form-fornecedor").val($("#form-fornecedor").attr("recordset"));
        ';

        // Crio os campos
        for ($i=0; $i < count($pedido_itens) - 1; $i++) { 
          echo '$("#add-item").trigger("click");';
        }

        // Preencho os campos
        foreach ($pedido_itens as $key => $item) {
          echo '
            $(".form-item").eq('.$key.').val("'.$item["id_item"].'");
            $(".form-quantidade").eq('.$key.').val("'.$item["quantidade"].'");
            $(".form-valor-unitario").eq('.$key.').val("'.number_format($item["valor_unitario"], 2, ",", ".").'");
          ';
        }

        echo '$(".form-quantidade").trigger("change")';

        // Se inativo, desabilito edição
        if ($pedido["status"] == "FINALIZADO") {
          echo '
            $("input").attr("disabled","disabled");
            $("select").attr("disabled","disabled");
            $("textarea").attr("disabled","disabled");
            $("#add-item").attr("disabled","disabled");
            $(".remove-item").attr("disabled","disabled");
            $("#send-edt-form").remove();
          ';
        }
      }    
    ?>
  }
</script>