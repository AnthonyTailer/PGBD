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
    hiddenTables();
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

  $('#collapseTen').on('shown.bs.collapse', function(e){ chamaTable(9, reclamacao, "reclamacao")});
});
