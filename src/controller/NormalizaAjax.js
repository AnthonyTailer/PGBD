$(document).ready(function(){

   var alertRegiao     = $("#alertRegiao");
   var alertConsumidor = $("#alertConsumidor");
   var alertSegmento   = $("#alertSegmento");
   var alertArea       = $("#alertArea");
   var alertEmpresa    = $("#alertEmpresa");
   var alertGrupo      = $("#alertGrupo");
   var alertProblema   = $("#alertProblema");
   var alertReclamacao = $("#alertReclamacao");

   var formNormaliza   = $("#normaliza");
   var progressbar     = $("#progressBar");  // Barra de progresso
   var statustxt       = $("#statusTxt");    // Barra de Status
   var submitbutton    = $("#normalizaBtn"); // Botao de Enviar

   var progresso       = 0;
   var tabelas         = ["regiao", "estado", "cidade", "consumidor", "area", "grupo", "problema", "segmento", "empresa", "reclamacao" ];

   function showMenuItem(haveItems){
      if(haveItems != 0){
         $('#li2').css("display", "block");
         $('#li3').css("display", "block");
         $('#li4').css("display", "block");
      }
   }

   function addProgress(percentual){
      progresso += percentual;
      progressbar.width(progresso+'%');
      statustxt.html(progresso+'%');
   }

   function requestData(nomeTabela){
      var proxTable = tabelas.indexOf(nomeTabela) + 1;
      $.ajax({
         url: "../controller/Normaliza.php?tabela="+nomeTabela,
         data: "text",
         xhr: function(){
            var xhr = new window.XMLHttpRequest;
            //Upload progress
            xhr.upload.addEventListener("progress", function(evt){
              //console.log("Chamando a func");
            }, false);
            xhr.addEventListener("progress", function(evt) {
                if(proxTable < 10){
                  setTimeout(function(){
                    requestData(tabelas[proxTable]);
                  }, 1500);
                }
            }, false);
            return xhr;
          },
         success: function(data) {
            addProgress(eval(data));
            console.log(nomeTabela+" foi!"+"proxTable = "+tabelas[proxTable]);
         }});
      
        return proxTable;
   }

   $.ajax({
      url: "../controller/Normaliza.php?tabela=ini",
      data: "text",
      success: function(data) {
         console.log(data);
         if(eval(data) > 0){
            alertRegiao.css("display", "block");
            alertConsumidor.css("display", "block");
            alertArea.css("display", "block");
            alertGrupo.css("display", "block");
            alertProblema.css("display", "block");
            alertSegmento.css("display", "block");
            alertEmpresa.css("display", "block");
            alertReclamacao.css("display", "block");
            showMenuItem(eval(data));
         }
      }
   });

   var flag2 = 0;
   submitbutton.click(function(e){  
     flag2 = requestData(tabelas[0]); //regiao
     showMenuItem(flag2);
   });     
});