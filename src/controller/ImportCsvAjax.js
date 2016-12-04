$(document).ready(function(){

	var flag			= 0; 				// flag de parada
	var progressbar   	= $('#progressBar');// Barra de progresso
	var statustxt     	= $('#statusTxt'); 	// Barra de Status
	var submitbutton  	= $("#uploadBtn"); 	// Botao de Enviar
	var myform        	= $("#upload_csv");	// Formulario
	var completed     	= '0%';
	var qtdLinhasCsv  	= 0; 				//qtdLinhas total do arquivo
	var linhas        	= 0;
	var limitDataTable	= 1000;
	var qtdLinhasDes  	= 0;

	//  function showMenuItem(haveItems, li2, li3, li4){
	// 	if(haveItems != 0){
	// 		if (li2) $('#li2').css("display", "block");
	// 		if (li3) $('#li3').css("display", "block");
	// 		if (li4) $('#li4').css("display", "block");
	// 	}
	// }

	// function liberaMenu(li2, li3, li4){
	// 	$.ajax({ //Ajax para saber a qtd de linhas atuais do BD Desnormalizado
	// 		url:"../controller/QtdLinesDes.php",
	// 		dataType : "text",
	// 		//async: false,
	// 		success: function(data) {
	// 			qtdLinhasDes = eval(data);
	// 			// console.log("Qtdlinhas BD Desnormalizado: "+qtdLinhasDes);
	// 			// showMenuItem(qtdLinhasDes, li2, li3, li4);
	// 		}
	// 	});
	// } 

	$.ajax({
      	url: "../controller/QtdLinesDes.php",
	    data: "text",
	    method: "POST",
	    success: function(data) {
	        if(eval(data) == 0){
            	hideTable();
         	}else{
         		addProgress(100);
         	}
      	}
   	});

	function addProgress(percentual){
		progressbar.width(percentual+'%');
		statustxt.html(percentual+'%');
	}

	function upProgress(){
		$.ajax({
			url:"../controller/QtdLinesDes.php",
			method:"POST",
			success: function(data){
				linhas = data;
				var res = eval(data)/qtdLinhasCsv*100;
				// console.log("Width: "+res+" CSV Lines: "+qtdLinhasCsv+" Data: "+data);
				addProgress(res.toPrecision(2));
				if(flag == 0){
					setTimeout(function(){
						//console.log("Calling function");
						upProgress();
					}, 500);
				}else if(flag == 1){
					addProgress(100);
				}else{
					addProgress(0);
				}
			}
		});
	}

	// liberaMenu(true, true, true); //Pesquisa qtd de linhas na desnormalizada e libera o menu

	$('#consumidor_table').DataTable({
		// "processing": true,
	    "ajax": {
	        "url": "../controller/AdminDataTable.php?tabela=desnormalizada",
	        "type": "GET"
	    },
	});

	myform.on("submit", function(e){
		$("#uploadBtn").prop("disabled", true);
		e.preventDefault();
		addProgress(0);
		$.ajax({
			url: "../controller/QtdLinesCsv.php",
			method:"POST",
			data: new FormData(myform[0]),
			contentType:false,
			cache:false,
			processData:false,
			success: function(data) {
				qtdLinhasCsv = data;
				// console.log("Qtd Linhas do CSV: "+qtdLinhasCsv);
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
							//console.log("Chamando a func");
						}, false);
						xhr.addEventListener("progress", function(evt) {
							flag = 1;
							// console.log("Parando a func");
							upProgress();
							$("#uploadBtn").prop("disabled", false);
						}, false);
						return xhr;
					},success: function(dataSet){

						if(dataSet == 'Error1'){
							alert("O arquivo selecionado deve ser um .csv");
							flag = 2;
							addProgress(0);

						}else if(dataSet == "Error2"){
							alert("Por Favor selecione um arquivo!");
							flag = 2;
							addProgress(0);

						}else{
							$("#consumidor_div").css("display", "block");
							$("#mensagem").css("display", "none");

							var table = $('#consumidor_table').DataTable();
							table.clear().draw();
							table.rows.add(JSON.parse(dataSet)).draw();
							// liberaMenu(true, false, false);
						}
					}
				})
			}
		})
	});

	$("#clearBtn").click(function(){
	  	clearDataBase();
	});

	function clearDataBase(){
	  	$.ajax({
            url: "../controller/ClearDataBase.php?action=clear",
            data: "text",
            success: function(data){
                // document.getElementById("#uploadBtn").disabled = "enabled";
                alert(data);
				hideTable();
				addProgress(0);

                var table = $('#consumidor_table').DataTable();
				table.clear().draw();
				table.rows.add(JSON.parse(dataSet)).draw();


            }
        });
	}

	function hideTable(){
		$("#consumidor_div").css("display", "none");
		$("#mensagem").css("display", "block");
	}
});
