$(document).ready(function() {
	var result;
	$.ajax({
			url:"../controller/Home.php",
			method:"POST",
			success: function(data){
				//console.log(data);
				result = eval(data);
            	
			}
		});

   outputEle = $('#markdown_git');
   outputEle.html(micromarkdown.parse(result));

});