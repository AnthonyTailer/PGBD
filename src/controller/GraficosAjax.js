$(document).ready(function(){
    var map;
    var dot;
    var dot_rs;
    var markers = [];
    var markers_rs = [];
    var infoWindow;
    var queryReturn1;
    var queryReturn2;
    var flag1 = true;
    var flag2 = true;
    var flag3 = true;
    var flag4 = true;
    var cont = 0;
    var cont2 = 0;
    var totalReclamacoesRS = 0;
    var porcentagemRS = 0;
    // var markerCluster;

    //exibi os itens do menu lateral
    // $('#li2').css("display", "block");
    // $('#li3').css("display", "block");
    // $('#li4').css("display", "block");

    $.ajax({
      url: "../controller/Graficos.php?query=init",
      data: "text",
      success: function(data) {
         if(eval(data) == 0){
            $("#accordion").css("display", "none");
            $("#mensagem").css("display", "block");
         }
      }
   });

    /* ----------------- GRAFICO 1 ----------------- */
    // GEOMAPA - RELAÇÃO DA QUANTIDADE DE RECLAMAÇÕES POR ESTADO     
	$('#collapseOne').on('shown.bs.collapse', function () { 
		$('#headingOne > h4 > i').addClass("glyphicon-minus");
        if (flag1) {
            flag1 = false;
            requestData1();
		}
	})
    
    $('#collapseOne').on('hidden.bs.collapse', function () {
        $('#headingOne > h4 > i').removeClass("glyphicon-minus");
    })

    function requestData1(){ // Executa consulta SQL para o mapa
        $.ajax({ 
            url: "../controller/Graficos.php?query=geomap1",
            dataType: "json",
            type: 'GET',
            success: function(msg){
                queryReturn1 = msg;
                GeoMap1(queryReturn1);
            }
        });
    }

    function GeoMap1(queryReturn1){
        var iconBase = "../utilities/img/maps/";
        var icons = {
            group0: {
            icon: iconBase + 'group-0.png',
            desc: "< 1.000"
            },
            group1: {
            icon: iconBase + 'group-1.png',
            desc: "1.000 a 2.000"
            },
            group2: {
            icon: iconBase + 'group-2.png',
            desc: "2.000 a 3.000"
            },
            group3: {
            icon: iconBase + 'group-3.png',
            desc: "3.000 a 4.000"
            },
            group4: {
            icon: iconBase + 'group-4.png',
            desc: "> 4.000"
            }
        };

        function initMap() {

            geocoder = new google.maps.Geocoder();
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 4,
                scrollwheel: false,
                center: {lat: -14.235004, lng: -58.92528},
                mapTypeId: google.maps.MapTypeId.VIEWPORT
            });
            var i = 0;

            var interval = setInterval(function(){
            if (i < queryReturn1.length){
                converteEndereco(queryReturn1[i][0], queryReturn1[i][1]);
                i++;
            }else
                clearInterval(interval);
            // markerCluster = new MarkerClusterer(map, markers,
            // {imagePath: iconBase+'/m'});
            }, 650);

            var legend = document.getElementById('legend');
            for (var key in icons) {
                 var type = icons[key];
                 var name = type.desc;
                 var icon = type.icon;
                 var div = document.createElement('div');
                 div.innerHTML = '<img src="' + icon + '" width="53px"> ' + name;
                  legend.appendChild(div);
            }

            var div = document.createElement('div');
            div.innerHTML = '<h4><b>Total: '+queryReturn1[0][2]+'</b></h4>';
            legend.appendChild(div);

            map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(legend);

            // map.addListener('zoom_changed', function() {
            //   markerCluster = new MarkerClusterer(map, markers,
            //   {imagePath: iconBase+'/m'});
            // });
        }

        function converteEndereco(endereco, reclamacoes) {
            geocoder.geocode( { 'address': endereco+', Brazil'} , function(resultado, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    cont += 1;
                    if (reclamacoes < 1000) {
                        dot = new google.maps.Marker({
                            map: map,
                            position: resultado[0].geometry.location,
                            title: endereco+", "+reclamacoes+" Reclamações",
                            icon: icons['group0'].icon
                        });
                    }else if (reclamacoes >= 1000 & reclamacoes < 2000) {
                        dot = new google.maps.Marker({
                            map: map,
                            position: resultado[0].geometry.location,
                            title: endereco+", "+reclamacoes+" Reclamações",
                            icon: icons['group1'].icon
                        });
                    }else if (reclamacoes >= 2000 & reclamacoes < 3000) {
                        dot = new google.maps.Marker({
                            map: map,
                            position: resultado[0].geometry.location,
                            title: endereco+", "+reclamacoes+" Reclamações",
                            icon: icons['group2'].icon
                        });
                    }else if (reclamacoes >= 3000 & reclamacoes < 4000) {
                        dot = new google.maps.Marker({
                            map: map,
                            position: resultado[0].geometry.location,
                            title: endereco+", "+reclamacoes+" Reclamações",
                            icon: icons['group3'].icon
                        });
                    }else {
                        dot = new google.maps.Marker({
                            map: map,
                            position: resultado[0].geometry.location,
                            title: endereco+", "+reclamacoes+" Reclamações",
                            icon: icons['group4'].icon
                        });
                    }
                    markers.push(dot);
                    janelaInformacoes(dot, endereco, reclamacoes, queryReturn1[0][2]);
                }else {
                    console.log('Erro ao converter endereço: ' + status);
                }
            });
        }

        function janelaInformacoes(dot, endereco, reclamacoes, totalReclamacoes){
            var porcento = ((reclamacoes/eval(totalReclamacoes))*100).toPrecision(2);
            var contentString = '<div class="container">'+
              '<h4 id="reclamacoesTitle">N° de Reclamações</h4>'+
              '<div id="reclamacoesInfo">'+
              '<h5>'+reclamacoes+'</h5>'+
              '</div>'+
              '<h4 id="porcentoTitle">Porcentagem do Total</h4>'+
              '<div id="porcentoInfo">'+
              '<h5>'+porcento+'%'+'</h5>'+
              '</div>'+
              '<h4 id="estadoTitle">Estado</h4>'+
              '<div id="estadoInfo">'+
              '<h5>'+endereco+'</h5>'+
              '</div>'+
              '</div>';

            var infowindow = new google.maps.InfoWindow({
                content: contentString,
                maxWidth: 200
            });

            google.maps.event.addListener(dot, 'click', function(event) {
                infowindow.open(map,dot);
              });
              // google.maps.event.addListener(dot, 'mouseout', function(event) {
              //   infowindow.close(map,dot);
              // });
            }   

        initMap();  //inicializa o mapa//processa o mapa
    }

    /* ----------------- GRAFICO 2 ----------------- */
    // GEOMAPA - RELAÇÃO DA QUANTIDADE DE RECLAMAÇÕES NO RS
    $('#collapseTwo').on('shown.bs.collapse', function(){ 
    	$('#headingTwo > h4 > i').addClass("glyphicon-minus");
        if (flag2) {
            flag2 = false;
            requestData2();
        }
    })

    $('#collapseTwo').on('hidden.bs.collapse', function () {
        $('#headingTwo > h4 > i').removeClass("glyphicon-minus");
    })

    function requestData2(){ // Executa consulta SQL para o mapa
        $.ajax({ 
            url: "../controller/Graficos.php?query=geomap2",
            dataType: "json",
            type: 'GET',
            success: function(msg){
                queryReturn2 = msg;
                for (var i = 0; i < queryReturn2.length; i++) {
                    totalReclamacoesRS += eval(queryReturn2[i][2]);
                }
                porcentagemRS = (totalReclamacoesRS/eval(queryReturn2[0][3]))*100;
                GeoMap2(queryReturn2);
            }
        });
    }

    function GeoMap2(queryReturn2){
        var iconBase = "../utilities/img/maps/";
        var iconsRS = {
            group0: {
                icon: iconBase + 'group-0.png',
                desc: "< 100"
            },
            group1: {
                icon: iconBase + 'group-1.png',
                desc: "100 a 200"
            },
            group2: {
                icon: iconBase + 'group-2.png',
                desc: "200 a 300"
            },
            group3: {
                icon: iconBase + 'group-3.png',
                desc: "300 a 400"
            },
            group4: {
                icon: iconBase + 'group-4.png',
                desc: "> 400"
            }
        };

        function initMap2() {
            var i = 0;
            geocoder = new google.maps.Geocoder();
            map = new google.maps.Map(document.getElementById('map2'), {
                zoom: 7,
                scrollwheel: false,
                center: {lat: -30.034632, lng: -51.217699},
                mapTypeId: google.maps.MapTypeId.HYBRID
            });
            
            var interval = setInterval(function(){
                if (i < queryReturn2.length){
                    converteEndereco2(queryReturn2[i][0], queryReturn2[i][1], queryReturn2[i][2]);
                    i++;
                }else
                    clearInterval(interval);
                // markerCluster = new MarkerClusterer(map, markers_rs,
                // {imagePath: iconBase+'/m'});
            }, 800);

            var legend2 = document.getElementById('legend2');
            for (var key in iconsRS) {
                var type = iconsRS[key];
                var name = type.desc;
                var icon = type.icon;
                var div = document.createElement('div');
                div.innerHTML = '<img src="' + icon + '" width="40px"> ' + name;
                legend2.appendChild(div);
            }

            var infoDiv = document.createElement('div');
            infoDiv.innerHTML = '<h5><b> Total no Brasil: '+ queryReturn2[0][3] + '</b></h5>';
            legend2.appendChild(infoDiv);

            var infoDiv2 = document.createElement('div');
            infoDiv2.innerHTML = '<h5><b> Total no RS: '+ totalReclamacoesRS + '</b></h5>';
            legend2.appendChild(infoDiv2);

            var infoDiv3 = document.createElement('div');
            infoDiv3.innerHTML = '<h5><b>Porcentagem: '+ porcentagemRS.toPrecision(2) +'%'+'</b></h5>';
            legend2.appendChild(infoDiv3);

            map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(legend2);

            // map.addListener('zoom_changed', function() {
            //   markerCluster = new MarkerClusterer(map, markers_rs,
            //   {imagePath: iconBase+'/m'});
            // });
        }

        function converteEndereco2(cidade, uf, reclamacoes) {
            geocoder.geocode( { 'address': cidade+', '+uf+', Brazil'} , function(resultado, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    cont2 += 1;
                    if (reclamacoes < 100) {
                        dot_rs = new google.maps.Marker({
                            map: map,
                            position: resultado[0].geometry.location,
                            title: cidade+", "+reclamacoes+" Reclamações",
                            icon: iconsRS['group0'].icon
                        });
                    }else if (reclamacoes >= 100 & reclamacoes < 200) {
                        dot_rs = new google.maps.Marker({
                            map: map,
                            position: resultado[0].geometry.location,
                            title: cidade+", "+reclamacoes+" Reclamações",
                            icon: iconsRS['group1'].icon
                        });
                    }else if (reclamacoes >= 200 & reclamacoes < 300) {
                        dot_rs = new google.maps.Marker({
                            map: map,
                            position: resultado[0].geometry.location,
                            title: cidade+", "+reclamacoes+" Reclamações",
                            icon: iconsRS['group2'].icon
                        });
                    }else if (reclamacoes >= 300 & reclamacoes < 400) {
                        dot_rs = new google.maps.Marker({
                            map: map,
                            position: resultado[0].geometry.location,
                            title: cidade+", "+reclamacoes+" Reclamações",
                            icon: iconsRS['group3'].icon
                        });
                    }else {
                        dot_rs = new google.maps.Marker({
                            map: map,
                            position: resultado[0].geometry.location,
                            title: cidade+", "+reclamacoes+" Reclamações",
                            icon: iconsRS['group4'].icon
                        });
                    }
                    markers_rs.push(dot_rs);
                    janelaInformacoes2(dot_rs, cidade, reclamacoes, totalReclamacoesRS);
                }else {
                  console.log('Erro ao converter endereço: ' + status);
                }
            });
        }

        function janelaInformacoes2(dot_rs, cidade, reclamacoes, totalReclamacoesRS){
            var contentString = 
            '<div class="container">'+
              '<h4 id="reclamacoesTitle">N° de Reclamações</h4>'+
              '<div id="reclamacoesInfo">'+
              '<h5>'+reclamacoes+'</h5>'+
              '</div>'+
              '<h4 id="cidadeTitle">Cidade</h4>'+
              '<div id="cidadeInfo">'+
              '<h5>'+cidade+'</h5>'+
              '</div>'+
              '<h4 id="totalTitle">Total de Reclamações RS</h4>'+
              '<div id="totalInfo">'+
              '<h5>'+totalReclamacoesRS+'</h5>'+
              '</div>'+
              '<h4 id="porcentagemTitle">Porcentagem do Total</h4>'+
              '<div id="porcentagemInfo">'+
              '<h5>'+((reclamacoes/totalReclamacoesRS)*100).toPrecision(2)+'%'+'</h5>'+
              '</div>'+
            '</div>';

            var infowindow = new google.maps.InfoWindow({
                content: contentString,
                maxWidth: 250
            });

            google.maps.event.addListener(dot_rs, 'click', function(event) {
                infowindow.open(map,dot_rs);
            });
            // google.maps.event.addListener(dot_rs, 'mouseout', function(event) {
            //   infowindow.close(map,dot_rs);
            // });
        }

        initMap2();// Processa o mapa
    }

    /* ----------------- GRAFICO 3 ----------------- */
    // GRAFICO - QUANTIDADE DE RECLAMAÇÕES POR EMPRESA
    $('#collapseThree').on('shown.bs.collapse', function(emp){ // Processa o grafico
        $('#headingThree > h4 > i').addClass("glyphicon-minus");
        if(flag3){
            flag3 = false;
            requestData3(7);
        }
    })

    $('#executaLimite').click(function(emp){
        requestData3($('#qtdeLimite').val());
    })

    $('#collapseThree').on('hidden.bs.collapse', function () {
        $('#headingThree > h4 > i').removeClass("glyphicon-minus");
    })

    function requestData3(qtdeLimite){ // Executa consulta SQL para o gráfico
        $.ajax({
            url: "../controller/Graficos.php?query=grafico3&qtdeLimite="+qtdeLimite,
            dataType: "json",
            type: 'GET',
            success: function(msg){
                var empresas = [];
                var qtde0 = [];
                var qtdeTotal = [];

                for(i=0; i<msg.length; i++){
                    empresas.push(msg[i][0]); // console.log(empresas[i]);
                    qtde0.push(eval(msg[i][1])); // console.log(qtde0[i]);
                    qtdeTotal.push(eval(msg[i][2])); // console.log(qtdeTotal[i]);
                }
                Grafico3(empresas, qtde0, qtdeTotal);
            }
        });
    }

    function Grafico3(empresas, qtde0, qtdeTotal) { // Processa o gráfico
        Highcharts.chart('map3', {
            chart: {
              type: 'bar'
            },
            title: {
              text: 'Quantidade de reclamações por empresa'
            },
            subtitle: {
              text: 'Empresas selecionadas e ordenadas pelo maior número de reclamações com Nota = 0'
            },
            xAxis: {
              categories: empresas,
              title: {
                  text: null
              }
            },
            yAxis: {
              min: 0,
              title: {
                  text: 'Quantidade de Reclamações',
                  align: 'high'
              },
              labels: {
                  overflow: 'justify'
              }
            },
            tooltip: {
              valueSuffix: null
            },
            plotOptions: {
              bar: {
                  dataLabels: {
                      enabled: true
                  }
              }
            },
            legend: {
              layout: 'vertical',
              align: 'right',
              verticalAlign: 'bottom',
              x: -40,
              y: -90,
              floating: true,
              borderWidth: 1,
              backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
              shadow: true
            },
            credits: {
              enabled: false
            },
            series: [{
              name: 'Total de Reclamações',
              data: qtdeTotal
            }, {
              name: 'Reclamações com Nota 0',
              data: qtde0
          
            }]
        });
    }

    /* ----------------- GRAFICO 4 ----------------- */
    // GRAFICO - PERCENTUAL DE RECLAMAÇÕES POR PERFIL DE CONSUMIDOR
    $('#collapseFour').on('shown.bs.collapse', function(emp){ // Processa o grafico
         $('#headingFour > h4 > i').addClass("glyphicon-minus");
        if(flag4){
            flag4 = false;
            requestData4();
        }
    })

    $('#collapseFour').on('hidden.bs.collapse', function () {
        $('#headingFour > h4 > i').removeClass("glyphicon-minus");
    })

    function requestData4(){ // Executa consulta SQL para o gráfico
        $.ajax({
            url: "../controller/Graficos.php?query=grafico4",
            dataType: "json",
            type: 'GET',
            success: function(msg){

                var perfil = [];
                var porcento = [];
                var total = eval(msg[0]["TOTAL"]);
                var soma = 0;

                for(i=0; i<msg.length; i++){
                  perfil.push(msg[i]["SEXO"]+" - "+msg[i]["FAIXAETARIA"]);  console.log(perfil[i]);
                  
                  porcento.push(((eval(msg[i]["QTDE"])/total)*100).toPrecision(2));  console.log(porcento[i]);
                  
                  soma += eval(msg[i]["QTDE"]);
                }
                perfil.push("Outros");
                porcento.push((((total-soma)/total)*100).toPrecision(2));

                Grafico4(perfil, porcento);
            }
        });
    }

    function Grafico4(perfil, porcento) { // Processa o gráfico
        // Radialize the colors
        Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function (color) {
        return {
            radialGradient: {
                cx: 0.5,
                cy: 0.3,
                r: 0.7
            },
            stops: [
                [0, color],
                [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
            ]
        };
        });

        // Build the chart
        Highcharts.chart('map4', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Percentual de reclamações por Perfil de Consumidor'
        },
        subtitle: {
            text: 'Perfis selecionados e ordenados pelo número de reclamações'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    },
                    connectorColor: 'silver'
                }
            }
        },
        series: [{
            name: 'Brands',
            data: [
                { name: perfil[0], y: eval(porcento[0]), sliced: true, selected: true},
                { name: perfil[1], y: eval(porcento[1]) },
                { name: perfil[2], y: eval(porcento[2]) },
                { name: perfil[3], y: eval(porcento[3]) },
                { name: perfil[4], y: eval(porcento[4]) },
                { name: perfil[5], y: eval(porcento[5]) },
                { name: perfil[6], y: eval(porcento[6]) },
                { name: perfil[7], y: eval(porcento[7]) },
                { name: perfil[8], y: eval(porcento[8]) },
                { name: perfil[9], y: eval(porcento[9]) }
            ]
            }]
        });
    }

});
