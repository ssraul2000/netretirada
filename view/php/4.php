
    <div class="container">
        
      <!-- Logo da net -->

      <div class="container">
        <div class="body">
          <!-- Textos da Página -->
          <div class="container">
            <p class="texto-pagina">O equipamento será retirado em:<strong> <?php echo $_SESSION['retirada']['endereco']; ?> </strong></p>
            <p class="texto-pagina">Este endereço está correto?</p>
          </div>
          <!-- Buttons -->
          <div class="container" >
            <div class="row">
              <div class="col-lg-6  col-xs-12">
                    <form method="post">
                        <input type="submit"  placeholder="Estado" id="enviar" class="btn btn-default btn-style col-lg-12 btn-md" value="Sim">
                        <input type="hidden" name="b8" id="confir" value="b8"> 
                  </form>
              </div>
              <div class="col-lg-6  col-xs-12">
                   <form method="post">
                        <input type="submit"  placeholder="Estado" id="enviar" class="btn btn-default btn-style col-lg-12 btn-md" value="Não">
                        <input type="hidden" name="b9" id="confir" value="b9"> 
                  </form>
              </div>
            </div>  
          </div>
        </div>

      </div>
    
    </div>

