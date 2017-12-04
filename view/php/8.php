
    <div class="container">
        
      <!-- Logo da net -->

      <div class="container">
        <div class="body">
          <!-- Textos da Página -->
          <?php  $retirada= RetiradaControll::getRetirada($_SESSION['retirada']['id_ret']);?>
          <div class="container">
              <p class="texto-pagina">Retirada agendada para: <strong><?php echo RetiradaControll::genareteDate(1,$retirada['data_ret']);?></strong></p>
            <p class="texto-pagina">Período: <strong><?php echo $retirada['text_horario']; ?></strong></p>
            <p class="texto-pagina">Endereço para Retirada: <strong><?php echo $retirada['endereco'];?></strong></p>
            <p class="texto-pagina">Complemento: <strong><?php echo $retirada['complemento']; ?></strong></p>
            <p class="texto-pagina">Telefone: <strong><?php echo $retirada['telefone']; ?></strong></p>
            <p class="texto-pagina"><a href="2" class="alterar">Alterar os dados</a></p>
            <p class="texto-pagina">Caso tenha alguma dúvida ou queira alterar o agendamento realizado, favor entra em contato com a NET no telefone (85) 33046301 </p>
          </div>
          <!-- Buttons -->
          <div class="container" >
            <div class="row"> 
              <div class="col-lg-12  col-xs-12">
                <form method="post">
                    <center>
                        <input type="submit"   id="enviar" class="btn btn-default btn-style col-lg-6 btn-md" value="Confirmar"></center>
                        <input type="hidden" name="b13" id="confir" value="b13"> 
                </form>

            </div>
             
            </div>  
          </div>
        </div>

      </div>
    
    </div>


