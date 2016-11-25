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
   var progressbar     = $('#progressBar');  // Barra de progresso
   var statustxt       = $('#statusTxt');    // Barra de Status
   var submitbutton    = $("#normalizaBtn"); // Botao de Enviar

   var progresso       = 0;

   function addProgress(percentual){
      progresso += percentual;
      progressbar.width(progresso+'%');
      statustxt.html(progresso+'%');
   }        

   submitbutton.click(function(e){
      $.ajax({
         url: "../controller/Normaliza.php?tabela=regiao",
         data: "text",
         success: function(data) {
            addProgress(eval(data));
            $.ajax({
               url: "../controller/Normaliza.php?tabela=estado",
               data: "text",
               success: function(data) {
                  addProgress(eval(data));
                  $.ajax({
                     url: "../controller/Normaliza.php?tabela=cidade",
                     data: "text",
                     success: function(data) {
                        addProgress(eval(data));
                        alertRegiao.css("display", "block");
                        $.ajax({
                           url: "../controller/Normaliza.php?tabela=consumidor",
                           data: "text",
                           success: function(data) {
                              addProgress(eval(data));
                              alertConsumidor.css("display", "block");
                              $.ajax({
                                 url: "../controller/Normaliza.php?tabela=area",
                                 data: "text",
                                 success: function(data) {
                                    addProgress(eval(data));
                                    alertArea.css("display", "block");
                                    $.ajax({
                                       url: "../controller/Normaliza.php?tabela=grupo",
                                       data: "text",
                                       success: function(data) {
                                          addProgress(eval(data));
                                          alertGrupo.css("display", "block");
                                          $.ajax({
                                             url: "../controller/Normaliza.php?tabela=problema",
                                             data: "text",
                                             success: function(data) {
                                                addProgress(eval(data));
                                                alertProblema.css("display", "block");
                                                $.ajax({
                                                   url: "../controller/Normaliza.php?tabela=segmento",
                                                   data: "text",
                                                   success: function(data) {
                                                      addProgress(eval(data));
                                                      alertSegmento.css("display", "block");
                                                      $.ajax({
                                                         url: "../controller/Normaliza.php?tabela=empresa",
                                                         data: "text",
                                                         success: function(data) {
                                                            addProgress(eval(data));
                                                            alertEmpresa.css("display", "block");
                                                            $.ajax({
                                                               url: "../controller/Normaliza.php?tabela=reclamacao",
                                                               data: "text",
                                                               success: function(data) {
                                                                  addProgress(eval(data));
                                                                  alertReclamacao.css("display", "block");
                                                               }
                                                            });
                                                         }
                                                      });
                                                   }
                                                });
                                             }
                                          });
                                       }
                                    });
                                 }
                              });
                           }
                        });  
                     }
                  });
               }
            });
         }
      });
   });
});