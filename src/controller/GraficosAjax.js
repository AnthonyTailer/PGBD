$(document).ready(function(){
  var map;
  var dot;
  var dot_rs;
  var markers = [];
  var markers_rs = [];
  // var markerCluster;
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

  /* ----------------- GRAFICO 1 ----------------- */
	$.ajax({ // Executa consulta SQL para o mapa
	  url: "../controller/Graficos.php?query=geomap1",
	  dataType: "json",
	  type: 'GET',
	  success: function(msg){
	    queryReturn1 = msg;
	  }
	});

	$('#collapseOne').on('shown.bs.collapse', function () { // Processa o mapa
      // GEOMAPA - RELAÇÃO DA QUANTIDADE DE RECLAMAÇÕES POR ESTADO
			if (flag1) {
					flag1 = false;
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
						}, 1000);

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
         div.innerHTML = 'Total de Reclamações: ' + queryReturn1[0][2];
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
          '<h3 id="reclamacoesTitle">N° de Reclamações</h3>'+
          '<div id="reclamacoesInfo">'+
          '<h4>'+reclamacoes+'</h4>'+
          '</div>'+
          '<h3 id="porcentoTitle">porcentagem do Total</h3>'+
          '<div id="porcentoInfo">'+
          '<h4>'+porcento+'%'+'</h4>'+
          '</div>'+
          '<h3 id="estadoTitle">Estado</h3>'+
          '<div id="estadoInfo">'+
          '<h4>'+endereco+'</h4>'+
          '</div>'+
          '</div>';

          var infowindow = new google.maps.InfoWindow({
            content: contentString
          });

          google.maps.event.addListener(dot, 'click', function(event) {
            infowindow.open(map,dot);
          });
          // google.maps.event.addListener(dot, 'mouseout', function(event) {
          //   infowindow.close(map,dot);
          // });
        }

				initMap();

			}
	})

  /* ----------------- GRAFICO 2 ----------------- */
  $.ajax({ // Executa consulta SQL para o mapa
    url: "../controller/Graficos.php?query=geomap2",
    dataType: "json",
    type: 'GET',
    success: function(msg){
      queryReturn2 = msg;
      for (var i = 0; i < queryReturn2.length; i++) {
        totalReclamacoesRS += eval(queryReturn2[i][2]);
      }
      porcentagemRS = (totalReclamacoesRS/eval(queryReturn2[0][3]))*100;
    }
  });
  
  $('#collapseTwo').on('shown.bs.collapse', function(){ // Processa o mapa
    	if (flag2) {
        flag2 = false;
        var iconBase = "../utilities/img/maps/";
        var iconsRS = {
                  group0: {
                    icon: iconBase + 'group-0.png',
                    desc: "< 102"
                  },
                  group1: {
                    icon: iconBase + 'group-1.png',
                    desc: "102 a 203"
                  },
                  group2: {
                    icon: iconBase + 'group-2.png',
                    desc: "204 a 305"
                  },
                  group3: {
                    icon: iconBase + 'group-3.png',
                    desc: "306 a 407"
                  },
                  group4: {
                    icon: iconBase + 'group-4.png',
                    desc: ">= 408"
                  }
        };

        function initMap2() {

          geocoder = new google.maps.Geocoder();
          map = new google.maps.Map(document.getElementById('map2'), {
            zoom: 7,
            center: {lat: -30.034632, lng: -51.217699},
            mapTypeId: google.maps.MapTypeId.HYBRID
          });
          var i = 0;

            var interval = setInterval(function(){
              if (i < queryReturn2.length){
                converteEndereco2(queryReturn2[i][0], queryReturn2[i][1], queryReturn2[i][2]);
                i++;
              }else
                clearInterval(interval);
                //console.log("Qtd de Markers: "+markers);
                markerCluster = new MarkerClusterer(map, markers_rs,
                {imagePath: iconBase+'/m'});
            }, 1000);

          var legend2 = document.getElementById('legend2');
          for (var key in iconsRS) {
             var type = iconsRS[key];
             var name = type.desc;
             var icon = type.icon;
             var div = document.createElement('div');
             div.innerHTML = '<img src="' + icon + '"> ' + name;
              legend2.appendChild(div);
          }
          var infoDiv = document.createElement('div');
          infoDiv.innerHTML = '</br><h4> Total no Brasil: '+ queryReturn2[0][3] + '</h4>';
          legend2.appendChild(infoDiv);

          var infoDiv2 = document.createElement('div');
          infoDiv2.innerHTML = '<h4> Total no RS: '+ totalReclamacoesRS + '</h4>';
          legend2.appendChild(infoDiv2);

          var infoDiv3 = document.createElement('div');
          infoDiv3.innerHTML = '<h4> Porcentagem: '+ porcentagemRS.toPrecision(2) +'%'+'</h4>';
          legend2.appendChild(infoDiv3);

          map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(legend2);

          map.addListener('zoom_changed', function() {
            markerCluster = new MarkerClusterer(map, markers_rs,
            {imagePath: iconBase+'/m'});
          });
        }

        function converteEndereco2(cidade, uf, reclamacoes) {
          geocoder.geocode( { 'address': cidade+', '+uf+', Brazil'} , function(resultado, status) {
            if (status == google.maps.GeocoderStatus.OK) {
              cont2 += 1;
              if (reclamacoes < 102) {
                dot_rs = new google.maps.Marker({
                  map: map,
                  position: resultado[0].geometry.location,
                  title: cidade+", "+reclamacoes+" Reclamações",
                  icon: iconsRS['group0'].icon
                });
              }else if (reclamacoes >= 102 & reclamacoes < 204) {
                dot_rs = new google.maps.Marker({
                  map: map,
                  position: resultado[0].geometry.location,
                  title: cidade+", "+reclamacoes+" Reclamações",
                  icon: iconsRS['group1'].icon
                });
              }else if (reclamacoes >= 204 & reclamacoes < 306) {
                dot_rs = new google.maps.Marker({
                  map: map,
                  position: resultado[0].geometry.location,
                  title: cidade+", "+reclamacoes+" Reclamações",
                  icon: iconsRS['group2'].icon
                });
              }else if (reclamacoes >= 306 & reclamacoes < 408) {
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
          var contentString = '<div class="container">'+
          '<h3 id="reclamacoesTitle">N° de Reclamações</h3>'+
          '<div id="reclamacoesInfo">'+
          '<h4>'+reclamacoes+'</h4>'+
          '</div>'+
          '<h3 id="cidadeTitle">Cidade</h3>'+
          '<div id="cidadeInfo">'+
          '<h4>'+cidade+'</h4>'+
          '</div>'+
          '<h3 id="totalTitle">Total de Reclamações RS</h3>'+
          '<div id="totalInfo">'+
          '<h4>'+totalReclamacoesRS+'</h4>'+
          '</div>'+
          '<h3 id="porcentagemTitle">Porcentagem do Total</h3>'+
          '<div id="porcentagemInfo">'+
          '<h4>'+((reclamacoes/totalReclamacoesRS)*100).toPrecision(2)+'%'+'</h4>'+
          '</div>'+
          '</div>';

          var infowindow = new google.maps.InfoWindow({
            content: contentString
          });

          google.maps.event.addListener(dot_rs, 'click', function(event) {
            infowindow.open(map,dot_rs);
          });
          // google.maps.event.addListener(dot_rs, 'mouseout', function(event) {
          //   infowindow.close(map,dot_rs);
          // });
        }
        initMap2();
      }
  })

  /* ----------------- GRAFICO 3 ----------------- */
  $('#collapseThree').on('shown.bs.collapse', function(emp){ // Processa o grafico
      if(flag3){
        flag3 = false;
        requestData3();
      }
  })

  function requestData3(){ // Executa consulta SQL para o gráfico
    $.ajax({
      url: "../controller/Graficos.php?query=grafico3",
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
              text: 'Quantidade de reclamacoes por empresa'
          },
          subtitle: {
              text: 'Separadas por total de reclamações e com notas 0'
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
  $('#collapseFour').on('shown.bs.collapse', function(emp){ // Processa o grafico
      if(flag4){
        flag4 = false;
        requestData4();
      }
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
