$(document).ready(function(){

	var inputStop			= $("#inputStop"); // Input hidden
	var progressbar   = $('#progressBar');// Barra de progresso
	var statustxt     = $('#statusTxt'); // Barra de Status
	var submitbutton  = $("#uploadBtn"); // Botao de Enviar
	var myform        = $("#upload_csv");// Formulario
	var completed     = '0%';
	var qtdLinhasCsv  = 45388; //qtdLinhas total do arquivo
	var linhas        = 0;
	var limitDataTable= 1000;
	var qtdLinhasDes  = 0;


	$.ajax({ //Ajax para saber a qtd de linhas atuais do BD Desnormalizado
		url:"../controller/QtdLinesDes.php",
		dataType : "text",
		async: false,
		success: function(data) {
			qtdLinhasDes = data;
		}
	});

	console.log("Qtdlinhas BD Desnormalizado: "+qtdLinhasDes);

	function addProgress(percentual){
		$('#progressBar').width(percentual+'%');
		$('#statusTxt').html(percentual+'%');
	}

	$('#consumidor_table').DataTable({
		"processing": true,
    "ajax": {
        "url": "../controller/InsertDataTable.php?tabela=desnormalizada",
        "type": "GET"
    },
	});

	alert(qtdLinhasDes+" Linhas estão inseridas no BD, "+limitDataTable+" é o máximo de linhas visualizaveis");

	function upProgress(){
		$.ajax({
			url:"../controller/QtdLinesDes.php",
			method:"POST",
			success: function(data){
				linhas = data;
				var res = eval(data)/qtdLinhasCsv*100;
				//console.log("Width: "+res+" Linhas: "+linhas+" Data: "+data);
				addProgress(res.toPrecision(2));
			}
		}).done(function (){
			if(inputStop.val() == '0' && linhas < qtdLinhasCsv){
				setTimeout(function(){
					console.log("Calling function");
					upProgress();
				}, 500);
			}else{
				addProgress(100);
				//$('#normalizarBtn').css("display", "inline-block");
			}
		});
	}

	myform.on("submit", function(e){
		e.preventDefault();
		$.ajax({
			url:"../controller/ImportCsv.php",
			method:"POST",
			data:new FormData(myform[0]),
			contentType:false,
			cache:false,
			processData:false,
			xhr: function(){
				var xhr = new window.XMLHttpRequest;
				//Upload progress
				xhr.upload.addEventListener("progress", function(evt){
					upProgress();
					console.log("Chamando a func");
				}, false);
				xhr.addEventListener("progress", function(evt) {
					inputStop.value = "1";
					console.log("Parando a func");
					//addProgress(100);
				}, false);
				return xhr;
			},success: function(dataSet){
				//console.log(data);
				if(dataSet == 'Error1')
				{
					alert("O arquivo selecionado deve ser um .csv");
					addProgress(completed);
				}
				else if(dataSet == "Error2")
				{
					alert("Por Favor selecione um arquivo!");
					addProgress(completed);
				}
				else
				{
					$('#consumidor_div').html();
					$('#consumidor_table').DataTable({
						data: dataSet
					});
					alert(
						qtdLinhas+" Linhas foram inseridas no banco, somente 1000 linhas foram mostradas"
					);
				}
			}
		})
	});
});
