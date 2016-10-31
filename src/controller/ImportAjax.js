$(document).ready(function(){
		var progressbar     = $('#progressBar');
		var statustxt       = $('#statusTxt');
		var submitbutton    = $("#uploadBtn");
		var myform          = $("#upload_csv");
		var inputStop				= document.getElementById("inputStop");
		//var output          = $("#output");
		var completed       = '0%';
		var quantidadeLinhas = 299;
		var linhas = 0;

		function upProgress(){
			$.ajax({
					 url:"../controller/numlines.php",
					 method:"POST",
					 success: function(data){
						 linhas = data;
						 var res = eval(data)/quantidadeLinhas*100;
						 console.log("Width: "+res+" Linhas: "+linhas+" Data: "+data);
						 addProgress(res);
				 }
		  }).done(function (){
				if(inputStop.value == '0' && linhas < quantidadeLinhas){
					setTimeout(function(){
							console.log("Calling function");
							upProgress();
					 }, 50);
				}else{
					addProgress(100);
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
								 //console.log(xhr);
								 //Upload progress
								 xhr.upload.addEventListener("progress", function(evt){
									 upProgress();
									 console.log("Chamando a func");
								 }, false);
								 xhr.addEventListener("progress", function(evt) {
							      inputStop.value = "1";
										console.log("Parando a func");
							    }, false);
								 return xhr;
						 	},success: function(data){
                  //console.log(data);
									 if(data == 'Error1')
									 {
												alert("O arquivo selecionado deve ser um .csv");
									 }
									 else if(data == "Error2")
									 {
												alert("Por Favor selecione um arquivo!");
									 }
									 else
									 {
												$('#consumidor_table').html(data);
												$('#consumidor_table').DataTable();

												alert("Importação Finalizada!");
									 }
							}
				 })
		});
});
