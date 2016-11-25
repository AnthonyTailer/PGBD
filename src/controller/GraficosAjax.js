  var map;
  var geocoder;
  var infoWindow;
  var queryReturn;

  // $.ajax({
  //   url: "../controller/Graficos.php?query=geomap",
  //   dataType: "json",
  //   type: 'GET',
  //   success: function(msg){
  //     queryReturn = msg;
  //     console.log(queryReturn);
  //   }
  // });

  // GEOMAPA - RELAÇÃO DA QUANTIDADE DE RECLAMAÇÕES POR ESTADO

    function initMap() {

      geocoder = new google.maps.Geocoder();
      map = new google.maps.Map(document.getElementById('map'), {
        zoom: 4,
        center: {lat: -14.235004, lng: -51.92527999999999},
        mapTypeId: google.maps.MapTypeId.TERRAIN
      });

      // for (var i = 0; i < 27; i++) {
      //   converteEndereco(queryReturn[i][i], queryReturn[i][i+1]);
      // }

    }

    function converteEndereco(endereco, reclamacoes) {
      geocoder.geocode( { 'address': endereco}, function(resultado, status) {
        if (status == google.maps.GeocoderStatus.OK) {
          var cityCircle = new google.maps.Circle({
            strokeColor: '#FF0000',
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: '#FF0000',
            fillOpacity: 0.35,
            map: map,
            center: resultado[0].geometry.location,
            radius: reclamacoes * 100
          });
        } else {
          //alert('Erro ao converter endereço: ' + status);
        }
      });
    }
