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

  $("#li0").click(function(e){ chamaTable(0, regiao, "regiao"); });

  $("#li1").click(function(e){ chamaTable(1, estado, "estado"); });

  $("#li2").click(function(e){ chamaTable(2, cidade, "cidade"); });

  $("#li3").click(function(e){ chamaTable(3, consumidor, "consumidor"); });

  $("#li4").click(function(e){ chamaTable(4, segmento, "segmento"); });

  $("#li5").click(function(e){ chamaTable(5, area, "area"); });

  $("#li6").click(function(e){ chamaTable(6, empresa, "empresa"); });

  $("#li7").click(function(e){ chamaTable(7, grupo, "grupo"); });

  $("#li8").click(function(e){ chamaTable(8, problema, "problema"); });

  $("#li9").click(function(e){ chamaTable(9, reclamacao, "reclamacao"); });
});
