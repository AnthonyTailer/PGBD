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
  var reclamacao = $("#reclamacoes_table");
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
    $("#reclamacoes").css("display", "none");
  }

  $("#li0").click(function(e)
  {
    hiddenTables();
    $("#regiao").css("display", "block");

    if (flag[0] == 0) {
      regiao.DataTable({
        "processing": true,
        "ajax": {
            "url": "../controller/AdminDataTable.php?tabela=regiao",
            "type": "GET"
        },
      });
      flag[0] = 1;
    }


  });
  $("#li1").click(function(e)
  {
    hiddenTables();
    $("#estado").css("display", "block");

    if (flag[1] == 0) {
      estado.DataTable({
    		"processing": true,
        "ajax": {
            "url": "../controller/AdminDataTable.php?tabela=estado",
            "type": "GET"
        },
    	});
      flag[1] = 1;
    }
  });
  $("#li2").click(function(e)
  {
    hiddenTables();
    $("#cidade").css("display", "block");

    if (flag[2] == 0) {
      cidade.DataTable({
    		"processing": true,
        "ajax": {
            "url": "../controller/AdminDataTable.php?tabela=cidade",
            "type": "GET"
        },
    	});
      flag[2] = 1;
    }
  });
  $("#li3").click(function(e)
  {
    hiddenTables();
    $("#consumidor").css("display", "block");

    if (flag[3] == 0) {
      consumidor.DataTable({
        "processing": true,
        "ajax": {
            "url": "../controller/AdminDataTable.php?tabela=consumidor",
            "type": "GET"
        },
      });
      flag[3] = 1;
    }

  });
  $("#li4").click(function(e)
  {
    hiddenTables();
    $("#segmento").css("display", "block");

    if (flag[4] == 0) {
      segmento.DataTable({
    		"processing": true,
        "ajax": {
            "url": "../controller/AdminDataTable.php?tabela=segmento",
            "type": "GET"
        },
    	});
      flag[4] = 1;
    }
  });
  $("#li5").click(function(e)
  {
    hiddenTables();
    $("#area").css("display", "block");

    if (flag[5] == 0) {
      area.DataTable({
    		"processing": true,
        "ajax": {
            "url": "../controller/AdminDataTable.php?tabela=area",
            "type": "GET"
        },
    	});
      flag[5] = 1;
    }
  });
  $("#li6").click(function(e)
  {
    hiddenTables();
    $("#empresa").css("display", "block");

    if (flag[6] == 0) {
      empresa.DataTable({
        "processing": true,
        "ajax": {
            "url": "../controller/AdminDataTable.php?tabela=empresa",
            "type": "GET"
        },
      });
      flag[6] = 1;
    }
  });
  $("#li7").click(function(e)
  {
    hiddenTables();
    $("#grupo").css("display", "block");

    if (flag[7] == 0) {
      grupo.DataTable({
        "processing": true,
        "ajax": {
            "url": "../controller/AdminDataTable.php?tabela=grupo",
            "type": "GET"
        },
      });
      flag[7] = 1;
    }
  });
  $("#li8").click(function(e)
  {
    hiddenTables();
    $("#problema").css("display", "block");

    if (flag[8] == 0) {
      problema.DataTable({
        "processing": true,
        "ajax": {
            "url": "../controller/AdminDataTable.php?tabela=problema",
            "type": "GET"
        },
      });
      flag[8] = 1;
    }
  });
  $("#li9").click(function(e)
  {
    hiddenTables();
    $("#reclamacoes").css("display", "block");

    if (flag[9] == 0) {
      reclamacao.DataTable({
        "processing": true,
        "ajax": {
            "url": "../controller/AdminDataTable.php?tabela=reclamacao",
            "type": "GET"
        },
      });
      flag[9] = 1;
    }
  });
});
