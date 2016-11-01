$(document).ready(function(){

	function addProgress(percentual){
		$('#progressBar').width(percentual+'%');
		$('#statusTxt').html(percentual+'%');
	}
	$('#consumidor_table').DataTable();
	var inputStop				= $("#inputStop"); // Input hidden
	var progressbar     = $('#progressBar');// Barra de progresso
	var statustxt       = $('#statusTxt'); // Barra de Status
	var submitbutton    = $("#uploadBtn"); // Botao de Enviar
	var myform          = $("#upload_csv");// Formulario
	var completed       = '0%';
	var quantidadeLinhas = 99;
	var linhas = 0;

	function upProgress(){
		$.ajax({
			url:"../controller/numlines.php",
			method:"POST",
			success: function(data){
				linhas = data;
				var res = eval(data)/quantidadeLinhas*100;
				console.log("Width: "+res+" Linhas: "+linhas+" Data: "+data);
				addProgress(res.toPrecision(2));
			}
		}).done(function (){
			if(inputStop.val() == '0' && linhas < quantidadeLinhas){
				setTimeout(function(){
					console.log("Calling function");
					upProgress();
				}, 50);
			}else{
				addProgress(100);
				//$('#normalizarBtn').css("display", "inline-block");
			}
		});
	}

	myform.on("submit", function(e){
		e.preventDefault();
		$.ajax({
			url:"../controller/ImportCsv.class.php",
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
			},success: function(data){
				//console.log(data);
				if(data == 'Error1')
				{
					alert("O arquivo selecionado deve ser um .csv");
					addProgress(completed);
				}
				else if(data == "Error2")
				{
					alert("Por Favor selecione um arquivo!");
					addProgress(completed);
				}
				else
				{
					$('#consumidor_div').html(data);
					$('#consumidor_table').DataTable();
				}
			}
		})
	});
});
