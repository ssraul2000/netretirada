$(document).ready(function(){
    $('#estado').change(function () {
        var estado=$(this).val();
        $.ajax({
            url:"index.php",
            type:'post',
            dataType:'html',
            data:{estado:estado},
            success:function(msg){
                 //Atualizar os dados do select cidade...
                 //alert(msg.length);
                 $("#cidade").children(".cidades").remove();
                 $("#cidade").append(msg);
            }
        });        
    });
});
//Mascara dos campos cep e tel 
$("#cep").mask("99999-999",{placeholder:" "});
$("#tel").mask("(99)9?9999-9999",{placeholder:" "});

