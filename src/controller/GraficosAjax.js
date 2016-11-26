$(document).ready(function(){
  var map;
  var dot;
  var markers = [];
	var infoWindow;
	var queryReturn;
	var i = true;
  var cont = 0;


	$.ajax({
	  url: "../controller/Graficos.php?query=geomap",
	  dataType: "json",
	  type: 'GET',
	  success: function(msg){
	    queryReturn = msg;
	    //console.log(queryReturn);
	  }
	});

		$('#collapseOne').on('shown.bs.collapse', function () {
			// GEOMAPA - RELAÇÃO DA QUANTIDADE DE RECLAMAÇÕES POR ESTADO
			if (i == true) {
					i = false;
					var iconBase = "../utilities/img/maps/";
					var icons = {
					          group0: {
					            icon: iconBase + 'group-0.png',
											desc: "13 a 610"
					          },
										group1: {
					            icon: iconBase + 'group-1.png',
											desc: "610 a 1220"
					          },
										group2: {
					            icon: iconBase + 'group-2.png',
											desc: "1220 a 1830"
					          },
										group3: {
					            icon: iconBase + 'group-3.png',
											desc: "1830 a 2440"
					          },
										group4: {
					            icon: iconBase + 'group-4.png',
											desc: "2440 a 3050"
					          },
										group5: {
					            icon: iconBase + 'group-5.png',
											desc: "3050 a 3660"
					          },
										group6: {
					            icon: iconBase + 'group-6.png',
											desc: "3660 a 4270"
					          },
										group7: {
					            icon: iconBase + 'group-7.png',
											desc: "4270 a 4880"
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
							if (i < queryReturn.length){
								converteEndereco(queryReturn[i][0], queryReturn[i][1]);
								i++;
							}else
								clearInterval(interval);
                //console.log("Qtd de Markers: "+markers);
                var markerCluster = new MarkerClusterer(map, markers,
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

				}

				function converteEndereco(endereco, reclamacoes) {
					geocoder.geocode( { 'address': endereco+', Brazil'} , function(resultado, status) {
						if (status == google.maps.GeocoderStatus.OK) {
              cont += 1;
							if (reclamacoes < 610) {
								dot = new google.maps.Marker({
									map: map,
									position: resultado[0].geometry.location,
									title: endereco+", "+reclamacoes+"Reclamações",
									icon: icons['group0'].icon
								});
							}else if (reclamacoes >= 610 & reclamacoes < 1220) {
								dot = new google.maps.Marker({
									map: map,
									position: resultado[0].geometry.location,
									title: endereco+", "+reclamacoes+"Reclamações",
									icon: icons['group1'].icon
								});
							}else if (reclamacoes >= 1220 & reclamacoes < 1830) {
								dot = new google.maps.Marker({
									map: map,
									position: resultado[0].geometry.location,
									title: endereco+", "+reclamacoes+"Reclamações",
									icon: icons['group2'].icon
								});
							}else if (reclamacoes >= 1830 & reclamacoes < 2440) {
								dot = new google.maps.Marker({
									map: map,
									position: resultado[0].geometry.location,
									title: endereco+", "+reclamacoes+"Reclamações",
									icon: icons['group3'].icon
								});
							}else if (reclamacoes >= 2440 & reclamacoes < 3050) {
								dot = new google.maps.Marker({
									map: map,
									position: resultado[0].geometry.location,
									title: endereco+", "+reclamacoes+"Reclamações",
									icon: icons['group4'].icon
								});
							}else if (reclamacoes >= 3050 & reclamacoes < 3660) {
								dot = new google.maps.Marker({
									map: map,
									position: resultado[0].geometry.location,
									title: endereco+", "+reclamacoes+"Reclamações",
									icon: icons['group5'].icon
								});
							}else if (reclamacoes >= 3660 & reclamacoes < 4270) {
								dot = new google.maps.Marker({
									map: map,
									position: resultado[0].geometry.location,
									title: endereco+", "+reclamacoes+"Reclamações",
									icon: icons['group6'].icon
								});
							}else {
								dot = new google.maps.Marker({
									map: map,
									position: resultado[0].geometry.location,
									title: endereco+", "+reclamacoes+"Reclamações",
									icon: icons['group7'].icon
								});
							}
              markers.push(dot);
						}else {
							console.log('Erro ao converter endereço: ' + status);
						}
					});
				}

				initMap();
			}
	})

});
