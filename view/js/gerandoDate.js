
var now = new Date (); //var "now" recebe data e hora atual;
dayName = new Array ("domingo", "Segunda", "Terça", "Quarta", "Quinta", "Sexta", "sábado"); //Matriz com os nomes dos dias da semana;
monName = new Array ("janeiro", "fevereiro", "março", "abril", "maio", "junho", "julho", "agosto","setembro", "outubro", "novembro", "dezembro"); //Matriz com os nomes dos meses;
/*
    amanha      → Recebe o índice numérico do próximo dia útil.
    dps_amanha  → Recebe o índice numérico de um dia útil após o primeiro dia útil.
    dia         → Recebe o dia compatível ao dia útil do “amanha”;
    dps_dia     → Recebe o dia compatível ao dia útil do “amanha_dps”;
 */

//var amanha, dps_amanha, dia, dps_dia;
var i=0;

//var mes = now.getMonth()+1;
//feriad		→ Matriz para armazenar os feriados do ano;
var feriado = [
"01/01/",
"08/01/",

//Fevereiro
"09/02/",
"10/02/",

//Março
"01/03/",
"08/03/",
"23/03/",

//Abril
"19/04/",
"21/04/",
"22/04/",
"23/04/",

//Maio
"01/05/",
"28/05/",

//Junho

//Agosto
"14/08/",

//Setembro
"07/09/",

//Outubro
"12/10/",
"15/10/",
"19/10/",
"20/10/",

//Novembro
"02/11/",
"15/11/",
"19/11/",
"20/11/",

//Dezembro
"25/12/"
];
var contdia=0;
var dia = now.getDate()+1; //now.getDate()+1;
var mes = now.getMonth()+1;


var resp=getQuantdia(dia,mes);
dia=resp[0];
mes=resp[1];
var diasemana=now.getDay()+1;

var dias=['1','2'];


while(contdia<2){
    
    var resposta=diaSemana(diasemana,dia,mes);
        dia=resposta[1];
        diasemana=resposta[0];
        mes=resposta[2];
        
    for(var i=0;i<feriado.length;i++){
        
        var opt=dia+"/"+mes+"/";
        
        if(opt === feriado[i]){
           
           
            dia++;
            
            resp=getQuantdia(dia,mes);
            dia=resp[0];
            mes=resp[1];
            
            diasemana++;
            if(diasemana>=7){
            diasemana-=7;
            }
        }
        var resposta=diaSemana(diasemana,dia,mes);
        dia=resposta[1];
        diasemana=resposta[0];
        mes=resposta[2];
    }
    //document.write(dia+"/"+mes+"/"+now.getFullYear());]
    var ano=now.getFullYear();
    if(mes>=12 ){
         ano++;
         mes= 01;
    }
    
    dias[contdia]=dia+"/"+mes+"/"+ano;
    
    
    contdia++;
    dia++;  
    resp=getQuantdia(dia,mes);
    dia=resp[0];
    mes=resp[1];
    diasemana++;
    if(diasemana>=7){
        diasemana-=7;
    }
}
//document.write(dias[1]);
$("#b3-value").attr('value',dias[0]);
$("#b4-value").attr('value',dias[1]);

//$("#b3-value").attr('value',primeira_opcao);
function getQuantdia(dia,mes){
    var qmes=[31,28,31,30,31,30,31,31,30,31,30,31];
    var dias;
    var date=new Date();
    var ano= date.getFullYear();
    if(mes==2){
        if( AnoBissexto(ano)===true){
            dias=29;
        }
    }
    else{
        dias=qmes[mes-1];
    }
    if(dia > dias){
        dia-=dias;
        mes++;
    }
    var resp=[dia,mes];
    return resp;
}
function AnoBissexto(year){
    return ((year % 4 == 0) && (year % 100 != 0)) || (year % 400 == 0);
}


function diaSemana(diasemana,dia,mes){
    if(diasemana==6){
                dia+=2;
                var resp=getQuantdia(dia,mes);
                dia=resp[0];
                mes=resp[1];
                diasemana+=2;
                if(diasemana>=7){
                    diasemana-=7;
                }
        }
    else if(diasemana==0){
        dia+=1;
        var resp=getQuantdia(dia,mes);
        dia=resp[0];
        mes=resp[1];
        diasemana+=1;
        if(diasemana>=7){
            diasemana-=7;
        }
    }
    var resposta=[diasemana,dia,mes];
    return resposta;
}

$("#calendario").datepicker({
    //beforeShowDay é utilizado para fornecer detalhes personalizados para o seu selecionador de data.
    // Obs: Útil se você oferecer um serviço onde a escolha do cliente depende da data específica.
    beforeShowDay: function(date) {

        var dd = date.getDate();
        var mm = date.getMonth()+1; //January is 0!
        var shortDate = dd+'/'+mm+'/';

            for(var i=0;i<23;i++){
                if(feriado[i]==shortDate){
                    return [false];
                }
            }

           if (date.getDay() == 0 || date.getDay() == 6) {
            return [false];
        } else {
            return [true];
        }

    } ,

    minDate: 1,
    showButtonPanel:true,

    // changeMonth: true,
    // changeYear: true,
    // numberOfMonths: 3,
    dateFormat: 'dd/mm/yy',
    dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
    dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
    dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
    monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
    monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
       onSelect: function(dateText){
        $("#b5-h").attr('value',dateText);
        $("#calendario").val("Outra Data");
        $("#b5").show();
        var msg ="Confirmar: " + dateText;
        $("#b5").attr('value',msg);        
    }
});
