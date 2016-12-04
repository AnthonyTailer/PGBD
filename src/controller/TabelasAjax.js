$(document).ready(function(){
  var regiao     = $("#regiao_table");
  var estado     = $("#estado_table");
  var cidade     = $("#cidade_table");
  var consumidor = $("#consumidor_table");
  var segmento   = $("#segmento_table");
  var area       = $("#area_table");
  var empresa    = $("#empresa_table");
  var grupo      = $("#grupo_table");
  var problema   = $("#problema_table");
  var reclamacao = $("#reclamacao_table");
  var formnormaliza   = $("#normaliza_table");
  var flag = new Array(0,0,0,0,0,0,0,0,0,0);

  // function showMenuItem(haveItems){
  //     if(haveItems > 0){
  //        $('#li2').css("display", "block");
  //        $('#li3').css("display", "block");
  //        $('#li4').css("display", "block");
  //     }
  // }

  $.ajax({
      url: "../controller/Tabelas.php?query=init",
      data: "text",
      success: function(data) {
         if(eval(data) == 0){
            $("#accordion").css("display", "none");
            $("#mensagem").css("display", "block");
         }
      }
   });

  function chamaTable(i, table, request){
    //hiddenTables();
    $("#"+request).css("display", "block");
    if (flag[i] == 0) {
      var oTable = table.DataTable({
        "ajax": {
            "url": "../controller/AdminDataTable.php?tabela="+request,
            "type": "GET"
        },
      });
      flag[i] = 1;
    }
  }

  // showMenuItem(true);

  $('#collapseOne').on('shown.bs.collapse', function(e){ chamaTable(0, regiao, "regiao"); $('#headingOne > h4 > i').addClass("glyphicon-minus")});
  $('#collapseOne').on('hidden.bs.collapse', function(e){ $('#headingOne > h4 > i').removeClass("glyphicon-minus") });

  $('#collapseTwo').on('shown.bs.collapse', function(e){ chamaTable(1, estado, "estado") ; $('#headingTwo > h4 > i').addClass("glyphicon-minus")});
  $('#collapseTwo').on('hidden.bs.collapse', function(e){ $('#headingTwo > h4 > i').removeClass("glyphicon-minus") });

  $('#collapseThree').on('shown.bs.collapse',function(e){ chamaTable(2, cidade, "cidade") ; $('#headingThree > h4 > i').addClass("glyphicon-minus")});
  $('#collapseThree').on('hidden.bs.collapse', function(e){ $('#headingThree > h4 > i').removeClass("glyphicon-minus") });

  $('#collapseFour').on('shown.bs.collapse', function(e){ chamaTable(3, consumidor, "consumidor") ; $('#headingFour > h4 > i').addClass("glyphicon-minus")});
  $('#collapseFour').on('hidden.bs.collapse', function(e){ $('#headingFour > h4 > i').removeClass("glyphicon-minus") });

  $('#collapseFive').on('shown.bs.collapse', function(e){ chamaTable(4, segmento, "segmento") ; $('#headingFive > h4 > i').addClass("glyphicon-minus")});
  $('#collapseFive').on('hidden.bs.collapse', function(e){ $('#headingFive > h4 > i').removeClass("glyphicon-minus") });

  $('#collapseSix').on('shown.bs.collapse',  function(e){ chamaTable(5, empresa, "empresa") ; $('#headingSix > h4 > i').addClass("glyphicon-minus")});
  $('#collapseSix').on('hidden.bs.collapse', function(e){ $('#headingSix > h4 > i').removeClass("glyphicon-minus") });

  $('#collapseSeven').on('shown.bs.collapse', function(e){ chamaTable(6, area, "area") ; $('#headingSeven > h4 > i').addClass("glyphicon-minus")});
  $('#collapseSeven').on('hidden.bs.collapse', function(e){ $('#headingSeven > h4 > i').removeClass("glyphicon-minus") });

  $('#collapseEight').on('shown.bs.collapse', function(e){ chamaTable(7, grupo, "grupo") ; $('#headingEight > h4 > i').addClass("glyphicon-minus")});
  $('#collapseEight').on('hidden.bs.collapse', function(e){ $('#headingEight > h4 > i').removeClass("glyphicon-minus") });

  $('#collapseNine').on('shown.bs.collapse', function(e){ chamaTable(8, problema, "problema") ; $('#headingNine > h4 > i').addClass("glyphicon-minus")});
  $('#collapseNine').on('hidden.bs.collapse', function(e){ $('#headingNine > h4 > i').removeClass("glyphicon-minus") });

  $('#collapseTen').on('shown.bs.collapse', function(e){
    //chamaTable(9, reclamacao, "reclamacao")
    $("#reclamacao").css("display", "block");
    $('#headingTen > h4 > i').addClass("glyphicon-minus");
    if (flag[9] == 0) {
      var reclamacao_DT = reclamacao.DataTable({
          "ajax": {
            "url" : "../controller/AdminDataTable.php?tabela=reclamacao",
            "type": "GET"
          },
          "columns": [
              {
                  "className": "details-control",
                  "orderable": false,
                  "data": null,
                  "defaultContent": ""
              }, // 0
              {"data": "IDRECLAMACAO"}, // 1
              {"data": "CIDADE"}, // 2
              {"data": "UF"}, // 3
              {"data": "REGIAO"}, // 4
              {"data": "SEXO"}, // 5
              {"data": "FAIXAETARIA"}, // 6
              {"data": "ANO"}, // 7
              {"data": "MES"}, // 8
              {"data": "DATAABERTURA"}, // 9
              {"data": "DATARESPOSTA"}, // 10
              {"data": "DATAFINALIZACAO"}, // 11
              {"data": "TEMPORESPOSTA"}, // 12
              {"data": "NOMEFANTASIA"}, // 13
              {"data": "SEGMENTO"}, // 14
              {"data": "AREA"}, // 15
              {"data": "ASSUNTO"}, // 16
              {"data": "PROBLEMA"}, // 17
              {"data": "COMOCOMPROU"}, // 18
              {"data": "PROCUROUEMPRESA"}, // 19
              {"data": "RESPONDIDA"}, // 20
              {"data": "SITUACAO"}, // 21
              {"data": "AVALIACAO"}, // 22
              {"data": "NOTACONSUMIDOR"} // 23
          ],
          "columnDefs": [{
                        "targets": [2, 3, 4, 5, 6,7, 8, 13, 14, 15, 16,17,18,19,20],
                        "visible": false
                    }],
          "order": [[1, 'asc']]
      });

          var detailRows = [];

          $('#reclamacao_table tbody').on('click', 'tr td.details-control', function(){
          var tr = $(this).closest('tr');
          var row = reclamacao_DT.row(tr);
          var idx = $.inArray(tr.attr('id'), detailRows);

          if (row.child.isShown()){
              tr.removeClass('details');
              row.child.hide();

              detailRows.splice(idx, 1);
          }else{
              tr.addClass('details');
              var d = row.data();
              row.child( function(){
                  var data;

                  data  = "<div class='content'>";
                  data += "<div class='row'><div class='col-lg-12'><table class='table table-striped table-bordered' width='100%'>";

                  data += "<td colspan='4' style='background-color: #B3B3B3; color: white; padding: 0px 0px 0px 10px'><h4><i class='glyphicon glyphicon-comment'></i> Reclamação</h4></td>";
                  data += "<tr><td><b>Assunto: </b>"+d.PROBLEMA+"</td><td colspan='2'><b>Problema: </b> "+d.AREA+"</td><td><b>Área: </b>"+d.ASSUNTO+"</td></tr>";

                  data += "<td colspan='4' style='background-color: #B3B3B3; color: white; padding: 0px 0px 0px 10px'><h4><i class='glyphicon glyphicon-user'></i> Consumidor</h4></td>";
                  data += "<tr><td colspan='2'><b>Cidade: </b>"+d.CIDADE+"</td><td><b>UF: </b>"+d.UF+"</td><td><b>Região: </b>"+d.REGIAO+"</td></tr>";
                  data += "<tr><td colspan='3'><b>Faixa Etária: </b>"+d.FAIXAETARIA+"</td><td colspan='2'><b>Sexo: </b> "+d.SEXO+"</td></tr>";

                  data += "<td colspan='4' style='background-color: #B3B3B3; color: white; padding: 0px 0px 0px 10px'><h4><i class='glyphicon glyphicon-briefcase'></i> Empresa</h4></td>";
                  data += "<tr><td colspan='2'><b>Nome da Empresa: </b> "+d.NOMEFANTASIA+"</td><td colspan='2'><b>Como Comprou: </b> "+d.COMOCOMPROU+"</td></tr>";
                  data += "<tr><td colspan='2'><b>Segmento: </b> "+d.SEGMENTO+"</td><td><b>Procurou Empresa: </b>"+d.PROCUROUEMPRESA+"</td><td><b>Respondida: </b>"+d.RESPONDIDA+"</td></tr>";

                  data += "</table></div></div></div>";

                  return data;
              }).show();

              if(idx===-1) detailRows.push(tr.attr('id'));
          }
        });

        reclamacao_DT.on('draw', function () {
            $.each(detailRows, function(i, id){
                $('#'+id+' td.details-control').trigger('click');
            } );
        });
      }
      flag[9] = 1;
  });
  $('#collapseTen').on('hidden.bs.collapse', function(e){ $('#headingTen > h4 > i').removeClass("glyphicon-minus") });
});
