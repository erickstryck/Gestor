

//Essa função tem dependência do método sendAjax() e Alertify; 
// function deletar(useCase, id){
// 	var url = 'index.php?uc='+useCase+'&a=deletar'; 

// 	sendAjax(url,'POST',{'id' : id},function(data){
// 		data = JSON.parse(data);

// 		if(data['status'])
// 			alertify.success("Registro deletado com sucesso."); 
// 		else
// 			alertify.error(data['msg']); 
// 	}); 
// }

(function($){
	var interval; 

	$.fn.deletar = function(useCase, delay){

		if( typeof delay == 'undefined')
			delay = 1500; 

		this.click(function(){
			var id  = this.value; 
			var url = 'index.php?uc='+useCase+'&a=deletar'; 

			sendAjax(url,'POST',{'id' : id},function(data){
				data = JSON.parse(data);

				if(data['status']){
					alertify.success("Registro deletado com sucesso."); 
					interval = setInterval(function(){window.location.reload(); clearInterval(interval); },delay); 
				}
				else
					alertify.error(data['msg']); 
			});
		}); 
	}
}(jQuery))