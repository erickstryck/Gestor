

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

	$.fn.reestabelecerForm = function(useCase){
		//pegar o valor do objeto: 
		//distribuir o valor do objeto nos elementos do formulário. 
		//done. 
		//var idItem = this.find('input#id_item').val(); 
		var idItem =1; 
		var url = 'index.php?uc='+useCase+'&a=getObject'; 

		var form = this; 

		sendAjax(url,'POST',{'id' : idItem},function(data){
			//casos triviais: 
			//select, input, checbox; 
			data = JSON.parse(data); 

			console.log("inputs > "); 
			form.find('input').each(function(){
				var element = $(this); 
				//console.log($(this).attr('name'));
				//indice 0 é o nome do campo. índice 1 é o valor. 
				jQuery.each(data,function(key,value){
					if(key == element.attr('name'))
						element.val(value); 
				})
			}); 


			console.log("select > "); 
			form.find('select').each(function(){
				var element = $(this); 

				jQuery.each(data,function(key,value){
					if(key == element.attr('name')){
						element.children('option').each(function(){
							if($(this).val() == value) $(this).attr('selected', 'selected');
						}); 
					}
				}); 
			}); 


			console.log("checbox > "); 
			form.find('checbox').each(function(){
				console.log($(this).attr('name')); 
			}); 

		}); 

	}

}(jQuery))