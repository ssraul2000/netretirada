

    <div class="container">
      <img src="view/imgs/loader.gif" hidden="hidden" id="carregando" name="carregando" />
      <!-- Logo da net -->

      <div class="container">
        <div class="body">
          <!-- Textos da Página -->
          <div class="container">
            <p class="texto-pagina">Por favor, nos informe o endereço correto abaixo.</p>
            
          </div>
      
          <!-- Formulário do enderesso -->
          <form class="col-xs-12" id="form-ende" method="post">
                    <div class="col-xs-12 div-input">
                        <input type="text" name="cep" required="required" id="cep" maxlength="9" placeholder="CEP" class="btn btn-default input-style col-lg-12">                
                    </div>
                     <div class="col-xs-12 div-input">
                        <input type="text" name="ende" required="required" placeholder="Endereço" class="btn btn-default input-style col-lg-12">                
                    </div>
                    <div class="col-xs-12 div-input">
                        <input type="number" name="num" required="required"   placeholder="Número" class="btn btn-default input-style col-lg-12">                
                    </div> 
                    <div class="col-xs-12 div-input">
                        <input type="text" name="bairro" required="required" placeholder="Bairro" class="btn btn-default input-style col-lg-12">                
                    </div>
                     <div class="col-xs-12 div-input">
                        <select class="btn btn-default input-style" id="estado" name="estado"  required="required">
                            <option value="" selected disabled hidden>Estado</option>
                            <?php 
                                $linha = RetiradaControll::selectEstado();
                                foreach ($linha as $row){
                                    echo "<option value=\"$row->id\">$row->nome</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-xs-12 div-input">
                        <select class="btn btn-default input-style" id="cidade" name="cidade" required="required ">
                            <option value="" selected disabled hidden>Cidade</option>
                        </select>
                    </div>
                   
                    <div class="col-xs-12 div-input">
                        <input type="submit"  placeholder="Estado" id="enviar" class="btn btn-default input-style col-lg-12 btn-md" value="Próximo">
                        <input type="hidden" name="b10" id="confir" value="b10">
                         
                    </div>
              
                
            </form>
          
        </div>

      </div>
    
    </div>