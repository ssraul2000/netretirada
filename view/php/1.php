    
    <div class="container top">
        
      <!-- Logo da net -->

      
        <div class="body">
          <!-- Textos da Página -->
          
            <p class="texto-pagina">Olá <?php echo $_SESSION['retirada']['nome_cli']; ?>, sou o Assistente Virtual da NET.</p>
            <p class="texto-pagina">Gostaríamos de agendar a retirada do seu equipamento referente ao contrato<strong> <?php echo $_SESSION['retirada']['contrato_cli']; ?> </strong></p>
            <p class="texto-pagina"><strong>Selecione uma das opções abaixo:</strong></p>        
        </div>
      <div class="container" >
            <div class="row">
              <div class="col-lg-6  col-xs-12 ">
                  <form method="post">
                      <input type="submit"  placeholder="Estado" id="enviar" class="btn btn-default btn-style col-lg-12 btn-md" value="Tenho Interesse">
                        <input type="hidden" name="b1" id="confir" value="b1"> 
                  </form>
              </div>
                <div class="col-lg-6  col-xs-12">
                    <form method="post">
                        <input type="submit"  placeholder="Estado" id="enviar" class="btn btn-default btn-style col-lg-12 btn-md" value="Não Tenho Interesse">
                        <input type="hidden" name="b2" id="confir" value="b2"> 
                    </form>
                </div>
            </div>
        </div>
    
    
    </div>

