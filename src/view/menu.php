<link rel="shortcut icon" href="../utilities/img/icon.svg" type="image/png"/>

<link rel="stylesheet" href="../utilities/css/style.css" media="all" type="text/css">
<link rel="stylesheet" href="../utilities/css/bootstrap.min.css">
<link rel="stylesheet" href="../utilities/css/jquery.dataTables.min.css">

<div class="nav-side-menu lado-direito">
  <div class="brand"> consumidor.gov.br </div>
  <i class="glyphicon glyphicon-menu-hamburger btn-lg toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>

  <div class="menu-list">
    <ul id="menu-content" class="menu-content collapse out ">
      <li>
          <a href="importacao.php"><i class="glyphicon glyphicon-import"></i> Importação </a>
      </li>
      <li>
          <a href="normalizacao.php"><i class="glyphicon glyphicon-thumbs-up"></i> Normalização </span></a>
      </li>
      <li data-toggle="collapse" data-target="#tabelas" class="collapsed">
          <a href="#"><i class="glyphicon glyphicon-th-list"></i> Tabelas <span class="glyphicon glyphicon-menu-down"></span></a>
      </li>
          <ul class="collapse subMenu" id="tabelas">
              <li id="li0"><a href="tabelas.php#regiao"> <i class="glyphicon glyphicon-chevron-right"></i> Região</a></li>
              <li id="li1"><a href="tabelas.php#estado"> <i class="glyphicon glyphicon-chevron-right"></i> Estado</a></li>
              <li id="li2"><a href="tabelas.php#cidade"> <i class="glyphicon glyphicon-chevron-right"></i> Cidade</a></li>
              <li id="li3"><a href="tabelas.php#consumidor"> <i class="glyphicon glyphicon-chevron-right"></i> Consumidor</a></li>
              <li id="li4"><a href="tabelas.php#segmento"> <i class="glyphicon glyphicon-chevron-right"></i> Segmento</a></li>
              <li id="li5"><a href="tabelas.php#area"> <i class="glyphicon glyphicon-chevron-right"></i> Area</a></li>
              <li id="li6"><a href="tabelas.php#empresa"> <i class="glyphicon glyphicon-chevron-right"></i> Empresa</a></li>
              <li id="li7"><a href="tabelas.php#grupo"> <i class="glyphicon glyphicon-chevron-right"></i> Grupo</a></li>
              <li id="li8"><a href="tabelas.php#problema"> <i class="glyphicon glyphicon-chevron-right"></i> Problema</a></li>
              <li id="li9"><a href="tabelas.php#reclamacao"> <i class="glyphicon glyphicon-chevron-right"></i> Reclamação</a></li>
          </ul>
      <li>
          <a href="#"><i class="glyphicon glyphicon-stats"></i> Gráficos </span></a>
      </li>
    </ul>
  </div>
</div>
<!-- <script type="text/javascript">
  $("#li0").click(function(e)
  {
   $("#li0").load("tabelas.php #regiao", function() {
     alert( "Load was performed." );
  });
    // css("display", "inline-block");
  });

</script> -->
