$(document).ready(function(){
		var progressbar     = $('#progressBar');
		var statustxt       = $('#statusTxt');
		var submitbutton    = $("#uploadBtn");
		var myform          = $("#upload_csv");
		//var output          = $("#output");
		var completed       = '0%';
		function addProgress(percentual) {
			//console.log(percentual);
		  progressbar.width(percentual+'%');
			statustxt.html(percentual+'%');
		};
		myform.on("submit", function(e){
				 e.preventDefault();
				 $.ajax({
							url:"../controller/ImportCsv.class.php",
							method:"POST",
							data:new FormData(myform[0]),
							contentType:false,
							cache:false,
							processData:false,
							xhr: function()
						 {
							 var xhr = new window.XMLHttpRequest();
							 //Upload progress
							 xhr.upload.addEventListener("progress", function(evt){
								 if (evt.lengthComputable) {
									 var percentComplete = evt.loaded / evt.total;
									 console.log(evt.loaded);
									 console.log(evt.loaded);

									 console.log(percentComplete);
									 addProgress(percentComplete);
								 }
							 });
							 return xhr;
						 },
							success: function(data){
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
												alert("Importação Finalizada!");
									 }
							}
				 })
		});
});
