$(document).ready(function(){
          $('#upload_csv').on("submit", function(e){
               e.preventDefault();
               $.ajax({
                    url:"export.php",
                    method:"POST",
                    data:new FormData(this),
                    contentType:false,
                    cache:false,
                    processData:false,
                    success: function(data){
                         if(data=='Error1')
                         {
                              alert("O arquivo selecionado deve ser um .csv");
                         }
                         else if(data == "Error2")
                         {
                              alert("Por Favor selecione um arquivo!");
                         }
                         else
                         {
                              $('#consumidor_table').html(data);
                         }
                    }
               })
          });
     });
