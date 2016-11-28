$(document).ready(function(){
  var map;
  var dot;
  var dot_rs;
  var markers = [];
  var markers_rs = [];
  var markerCluster;
	var infoWindow;
	var queryReturn1;
	var queryReturn2;
	var i = true;
  var j = true;
  var cont = 0;
  var cont2 = 0;
  var totalReclamacoesRS = 0;
  var porcentagemRS = 0;

  var queryReturn3;
  var empresas = [];
  var qtde0 = [];
  var qtdeTotal = [];

  // Executa consulta SQL para o mapa 1
	$.ajax({
	  url: "../controller/Graficos.php?query=geomap1",
	  dataType: "json",
	  type: 'GET',
	  success: function(msg){
	    queryReturn1 = msg;
	    // console.log(queryReturn);
	  }
	});

  // Executa consulta SQL para o mapa 2
  $.ajax({
	  url: "../controller/Graficos.php?query=geomap2",
	  dataType: "json",
	  type: 'GET',
	  success: function(msg){
	    queryReturn2 = msg;
      for (var i = 0; i < queryReturn2.length; i++) {
        totalReclamacoesRS += eval(queryReturn2[i][2]);
        //console.log("totalReclamacoesRS = "+totalReclamacoesRS);
      }

      porcentagemRS = (totalReclamacoesRS/eval(queryReturn2[0][3]))*100;
      //console.log("porcentagemRS = "+porcentagemRS);
	  }
	});

  // Processa o mapa 1
	$('#collapseOne').on('shown.bs.collapse', function () {
			// GEOMAPA - RELAÇÃO DA QUANTIDADE DE RECLAMAÇÕES POR ESTADO

			if (i == true) {
					i = false;
					var iconBase = "../utilities/img/maps/";
					var icons = {
					          group0: {
					            icon: iconBase + 'group-0.png',
											desc: "< 700"
					          },
										group1: {
					            icon: iconBase + 'group-1.png',
											desc: "700 a 1399"
					          },
										group2: {
					            icon: iconBase + 'group-2.png',
											desc: "1400 a 2099"
					          },
										group3: {
					            icon: iconBase + 'group-3.png',
											desc: "2100 a 2799"
					          },
										group4: {
					            icon: iconBase + 'group-4.png',
											desc: "2800 a 3599"
					          },
										group5: {
					            icon: iconBase + 'group-5.png',
											desc: "3600 a 4299"
					          },
										group6: {
					            icon: iconBase + 'group-6.png',
											desc: ">= 4300 "
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
                //console.log("Qtd de Markers: "+markers);
                markerCluster = new MarkerClusterer(map, markers,
                {imagePath: iconBase+'/m'});
						}, 1000);

					var legend = document.getElementById('legend');
					for (var key in icons) {
						 var type = icons[key];
						 var name = type.desc;
						 var icon = type.icon;
						 var div = document.createElement('div');
						 div.innerHTML = '<img src="' + icon + '"> ' + name;
						  legend.appendChild(div);
					}
					map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(legend);

          map.addListener('zoom_changed', function() {
            markerCluster = new MarkerClusterer(map, markers,
            {imagePath: iconBase+'/m'});
          });


				}

				function converteEndereco(endereco, reclamacoes) {
					geocoder.geocode( { 'address': endereco+', Brazil'} , function(resultado, status) {
						if (status == google.maps.GeocoderStatus.OK) {
              cont += 1;
							if (reclamacoes < 700) {
								dot = new google.maps.Marker({
									map: map,
									position: resultado[0].geometry.location,
									title: endereco+", "+reclamacoes+" Reclamações",
									icon: icons['group0'].icon
								});
							}else if (reclamacoes >= 700 & reclamacoes < 1400) {
								dot = new google.maps.Marker({
									map: map,
									position: resultado[0].geometry.location,
									title: endereco+", "+reclamacoes+" Reclamações",
									icon: icons['group1'].icon
								});
							}else if (reclamacoes >= 1400 & reclamacoes < 2100) {
								dot = new google.maps.Marker({
									map: map,
									position: resultado[0].geometry.location,
									title: endereco+", "+reclamacoes+" Reclamações",
									icon: icons['group2'].icon
								});
							}else if (reclamacoes >= 2100 & reclamacoes < 2800) {
								dot = new google.maps.Marker({
									map: map,
									position: resultado[0].geometry.location,
									title: endereco+", "+reclamacoes+" Reclamações",
									icon: icons['group3'].icon
								});
							}else if (reclamacoes >= 2800 & reclamacoes < 3600) {
								dot = new google.maps.Marker({
									map: map,
									position: resultado[0].geometry.location,
									title: endereco+", "+reclamacoes+" Reclamações",
									icon: icons['group4'].icon
								});
							}else if (reclamacoes >= 3600 & reclamacoes < 4300) {
								dot = new google.maps.Marker({
									map: map,
									position: resultado[0].geometry.location,
									title: endereco+", "+reclamacoes+" Reclamações",
									icon: icons['group5'].icon
								});
							}else {
								dot = new google.maps.Marker({
									map: map,
									position: resultado[0].geometry.location,
									title: endereco+", "+reclamacoes+" Reclamações",
									icon: icons['group6'].icon
								});
							}
              markers.push(dot);
              janelaInformacoes(dot, endereco, reclamacoes);
						}else {
							console.log('Erro ao converter endereço: ' + status);
						}
					});
				}

        function janelaInformacoes(dot, endereco, reclamacoes){
          var contentString = '<div class="container">'+
          '<h1 id="reclamacoesTitle">N° de Reclamações</h1>'+
          '<div id="reclamacoesInfo">'+
          '<h3>'+reclamacoes+'</h3>'+
          '</div>'+
          '<h1 id="estadoTitle">Estado</h1>'+
          '<div id="estadoInfo">'+
          '<h3>'+endereco+'</h3>'+
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
  
  // Processa o mapa 2
  $('#collapseTwo').on('shown.bs.collapse', function(){
    	if (j == true) {
        j = false;
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

  // Processa o grafico 3
  $('#collapseThree').on('shown.bs.collapse', function(emp){
      requestData();
  })

  // Executa consulta SQL para o gráfico 3
  function requestData(){
    $.ajax({
      url: "../controller/Graficos.php?query=grafico3",
      dataType: "json",
      type: 'GET',
      success: function(msg){
        queryReturn3 = msg;

        for(a=0; a<queryReturn3.length; a++){
          empresas.push(queryReturn3[a][0]);
          // console.log(empresas[a]);
          qtde0.push(eval(queryReturn3[a][1]));
          // console.log(qtde0[a]);
          qtdeTotal.push(eval(queryReturn3[a][2]));
          // console.log(qtdeTotal[a]);
        }
        Grafico3();
      }
    });
  }

  // Processa o gráfico 3
  function Grafico3() {
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
              verticalAlign: 'top',
              x: -40,
              y: 200,
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

});
