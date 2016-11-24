$(document).ready(function(){

  var geoMap = $("#");
  var map;
  var infoWindow;

  // GEOMAPA - RELAÇÃO DA QUANTIDADE DE RECLAMAÇÕES POR ESTADO
  geoMap.click(function(e){

    $.ajax({
      url: "../controller/Graficos.php?query=geomap",
      data: "json",
      sucess: function(data){
        var queryReturn = data;
        console.log(data);
      }
    });

    // function initMap() {
    //   geocoder = new google.maps.Geocoder();
    //   map = new google.maps.Map(document.getElementById('map'), {
    //     zoom: 4,
    //     center: {lat: -14.235004, lng: -51.92527999999999},
    //     mapTypeId: google.maps.MapTypeId.TERRAIN
    //   });
    //  converteEndereco("RS", 2714856);
    //  converteEndereco("RJ", 2714856);
    //  converteEndereco("Curitiba, PR", 2714856);
    //  converteEndereco("Florianópolis, SC", 2714856);
    //  converteEndereco("SP", 3714856);
    // }
    //
    // function converteEndereco(endereco, reclamacoes) {
    //   geocoder.geocode( { 'address': endereco}, function(resultado, status) {
    //     if (status == google.maps.GeocoderStatus.OK) {
    //       var cityCircle = new google.maps.Circle({
    //         strokeColor: '#FF0000',
    //         strokeOpacity: 0.8,
    //         strokeWeight: 2,
    //         fillColor: '#FF0000',
    //         fillOpacity: 0.35,
    //         map: map,
    //         center: resultado[0].geometry.location,
    //         radius: Math.sqrt(reclamacoes) * 100
    //       });
    //     } else {
    //       alert('Erro ao converter endereço: ' + status);
    //     }
    //   });
    // }
  });


});
