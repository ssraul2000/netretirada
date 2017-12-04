
<div class="container top">
  
    <div class="body">
     <!-- Textos da Página -->
  
      <p class="texto-pagina">Perfeito <?php echo $_SESSION['retirada']['nome_cli']; ?>, vamos continuar.</p>
       <p class="texto-pagina">Por favor informe qual dia gostaria de realizar a retirada.</p>
 
    </div>

<div class="container" >
    <div class="row">
      <div class="col-lg-6  col-xs-12">
          <form method="post">
                <input type="submit"  id="b3-value" name="b3-value" class="btn btn-default btn-style col-lg-12 btn-md" value="">
                <input type="hidden" name="b3" id="confir" value="b3"> 
          </form>

      </div>
      <div class="col-lg-6  col-xs-12">
          <form method="post">
                <input type="submit"   name="b4-value" id="b4-value" class="btn btn-default btn-style col-lg-12 btn-md" value="">
                <input type="hidden" name="b4" id="confir" value="b4"> 
          </form>

     </div> 

    <div class="col-lg-12 col-xs-12">
        <form method="POST" enctype="multipart/form-data">
            <center><input type="button" class="btn btn-default input-style col-lg-6" id="calendario" name="calendario" value="Outra Data"></center>
           <center> <input type="submit" class="btn btn-default input-style col-lg-6" id="b5" name="b5" value="" style="display: none;   "> </center>
            <input type="hidden" id="b5-h" name="b5-h" value="">
        </form> 
    </div>

    </div>
</div>
</div>
