

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
		var idItem = parseInt( this.find('input#id').val()); 
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
							if($(this).val() == value) 
								$(this).attr('selected', 'selected');
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

	$.fn.initCrud = function(useCase,modalId,handleAlterar, handleCadastrar, callback){
		// <input type="hidden" id="cadastrar" />
	  	// <input type="hidden" id="id" />
	  	// 
	  	var form = $(modalId).find('form'); 
	  	//id=cadastrar sendo true significa que o modal é invocado para um cadastro,
	  	//caso contrário, é para alteração. 
	  	
	  	$(form).append('<input type="hidden" id="cadastrar" />'); 
	  	$(form).append('<input type="hidden" id="id" />'); 

		//Tratando manipuladores com parâmetro nulo:
		if( typeof handleAlterar == 'undefined' )
			handleAlterar = '.alterar'; 
		if( typeof handleCadastrar == 'undefined' )
			handleAlterar = '.cadastrar'; 

		$(handleCadastrar).click(function(){
			$(form).find('#cadastrar').val(true); 
			$(form).find('#id_item').val();

			$(form).get(0).reset(); 

			$(modalId).foundation('reveal', 'open'); 
		}); 

		$(handleAlterar).click(function(){
			$(form).find('#cadastrar').val(false);
			//Pegando valor botão que é o pivô da ação de deletar. 
			$(form).find('#id').val($(this).val());
			
			//Restabelecendo valores no formulário: 
			$(form).reestabelecerForm(useCase); 
			$(modalId).foundation('reveal', 'open'); 
		}); 
	}

}(jQuery))