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

  function hiddenTables(){
    $("#regiao").css("display", "none");
    $("#estado").css("display", "none");
    $("#cidade").css("display", "none");
    $("#consumidor").css("display", "none");
    $("#segmento").css("display", "none");
    $("#area").css("display", "none");
    $("#empresa").css("display", "none");
    $("#grupo").css("display", "none");
    $("#problema").css("display", "none");
    $("#reclamacao").css("display", "none");
  }

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

  $('#collapseOne').on('shown.bs.collapse', function(e){ chamaTable(0, regiao, "regiao")});

  $('#collapseTwo').on('shown.bs.collapse', function(e){ chamaTable(1, estado, "estado")});

  $('#collapseThree').on('shown.bs.collapse',function(e){ chamaTable(2, cidade, "cidade")});

  $('#collapseFour').on('shown.bs.collapse', function(e){ chamaTable(3, consumidor, "consumidor")});

  $('#collapseFive').on('shown.bs.collapse', function(e){ chamaTable(4, segmento, "segmento")});

  $('#collapseSix').on('shown.bs.collapse',  function(e){ chamaTable(5, empresa, "empresa")});

  $('#collapseSeven').on('shown.bs.collapse', function(e){ chamaTable(6, area, "area")});

  $('#collapseEight').on('shown.bs.collapse', function(e){ chamaTable(7, grupo, "grupo")});

  $('#collapseNine').on('shown.bs.collapse', function(e){ chamaTable(8, problema, "problema")});

  $('#collapseTen').on('shown.bs.collapse', function(e){
    //chamaTable(9, reclamacao, "reclamacao")

    $("#reclamacao").css("display", "block");
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
              {"data": "AREA"}, // 14
              {"data": "ASSUNTO"}, // 15
              {"data": "PROBLEMA"}, // 16
              {"data": "COMOCOMPROU"}, // 17
              {"data": "PROCUROUEMPRESA"}, // 18
              {"data": "RESPONDIDA"}, // 19
              {"data": "SITUACAO"}, // 20
              {"data": "AVALIACAO"}, // 21
              {"data": "NOTACONSUMIDOR"} // 22
          ],
          "columnDefs": [{
                        "targets": [1, 2, 3, 4, 5, 6,7, 8, 13, 14, 15, 16,17,18,19],
                        "visible": false
                    }],
          "order": [[9, 'asc']]
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

                  data += "<td colspan='4' style='background-color: #B3B3B3; color: white'><h4><i class='glyphicon glyphicon-comment'></i> Reclamação</h4></td>";
                  data += "<tr><td><b>Código: </b>"+d.IDRECLAMACAO+"</td><td colspan='2'><b>Problema: </b> "+d.PROBLEMA+"</td><td><b>Assunto: </b>"+d.ASSUNTO+"</td></tr>";

                  data += "<td colspan='4' style='background-color: #B3B3B3; color: white'><h4><i class='glyphicon glyphicon-user'></i> Consumidor</h4></td>";
                  data += "<tr><td colspan='2'><b>Cidade: </b>"+d.CIDADE+"</td><td><b>UF: </b>"+d.UF+"</td><td><b>Região: </b>"+d.REGIAO+"</td></tr>";
                  data += "<tr><td colspan='2'><b>Faixa Etária: </b>"+d.FAIXAETARIA+"</td><td colspan='2'><b>Sexo: </b> "+d.SEXO+"</td></tr>";

                  data += "<td colspan='4' style='background-color: #B3B3B3; color: white'><h4><i class='glyphicon glyphicon-briefcase'></i> Empresa</h4></td>";
                  data += "<tr><td colspan='2'><b>Nome da Empresa: </b> "+d.NOMEFANTASIA+"</td><td><b>Área: </b> "+d.AREA+"</td></tr>";
                  data += "<tr><td colspan='2'><b>Como Comprou: </b> "+d.COMOCOMPROU+"</td><td><b>Procurou Empresa: </b>"+d.PROCUROUEMPRESA+"</td><td><b>Respondida: </b>"+d.RESPONDIDA+"</td></tr>";

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
});
