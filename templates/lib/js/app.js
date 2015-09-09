
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


	$.fn.reestabelecerForm = function(useCase,callback){
		//pegar o valor do objeto: 
		//distribuir o valor do objeto nos elementos do formulário. 
		//done. 
		var idItem = parseInt( this.find('input#id').val()); 
		var url = 'index.php?uc='+useCase+'&a=getObject'; 

		var form = this; 

		sendAjax(url,'POST',{'id' : idItem},function(data){
			//Chama callback e retorna os dados do objeto
			callback(data); 
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

	$.fn.initCrud = function(useCase,modalId,callback,handleAlterar, handleCadastrar, handleDeletar){
		// <input type="hidden" id="cadastrar" />
	  	// <input type="hidden" id="id" />
	  	// 
	  	var form = $(modalId).find('form'); 
	  	//id=cadastrar sendo true significa que o modal é invocado para um cadastro,
	  	//caso contrário, é para alteração. 
	  	
	  	$(form).append('<input type="hidden" id="cadastrar"  />'); 
	  	$(form).append('<input type="hidden" id="id" name="id" />'); 

		//Tratando manipuladores com parâmetro nulo:
		if( typeof handleAlterar   == 'undefined' )
			handleAlterar = '.alterar'; 
		if( typeof handleCadastrar == 'undefined' )
			handleCadastrar = '.cadastrar'; 
		if( typeof handleDeletar   == 'undefined' )
			handleDeletar = '.del'; 

		//Manipulando eventos de cadastro
		$(handleCadastrar).click(function(){
			$(form).get(0).reset(); 
			$(form).find('#cadastrar').val(1); 

			var b = $(form).find('button[type=submit]'); 
			b.text("Salvar"); 
			b.removeClass('info').addClass('success'); 

			//Mudando label do modal
			var texto = $(modalId).find('h2').first().text();
			$(modalId).find('h2').first().text(texto.replace('Alterar','Cadastro'));

			$(modalId).foundation('reveal', 'open'); 
		}); 

		//Manipulando eventos de alteração
		$(handleAlterar).click(function(){
			$(form).find('#cadastrar').val(0);
			//Pegando valor botão que é o pivô da ação de deletar. 
			$(form).find('#id').val($(this).val());
			
			//Restabelecendo valores no formulário: 
			$(form).reestabelecerForm(useCase,callback); 

			//Alterando o escopo do botão:
			var b = $(form).find('button[type=submit]'); 
			b.text("Alterar"); 
			b.removeClass('success').addClass('info'); 

			//Mudando label do modal
			var texto = $(modalId).find('h2').first().text();
			$(modalId).find('h2').first().text(texto.replace('Cadastro','Alterar'));

			$(modalId).foundation('reveal', 'open'); 
		}); 

		//Manipulando eventos de deleção
		$(handleDeletar).deletar(useCase); 


		$(form).on('valid.fndtn.abide', function() {
			var data = $(this).serializeArray(); 
			if( parseInt($(this).find('#cadastrar').val()))
				onCadastro(data); 
			else
				onAlterar(data); 
		}); 

		function onCadastro(data){
			sendAjax('index.php?uc='+useCase+'&a=cadastro','POST',data,function(data){
				var data = JSON.parse(data); 
				if(data['status']){
					alertify.success("O recibo foi cadastrado com sucesso"); 
					interval = setInterval(function(){window.location.reload(); clearInterval(interval); },1500); 
				}else
				alertify.error("Ocorreu algum error, tente novamente."); 
			}); 
		}

		function onAlterar(data){
			sendAjax('index.php?uc='+useCase+'&a=alterar','POST',data,function(data){
				alertify.log(data); 
				return;
				var data = JSON.parse(data); 
				if(data['status']){
					alertify.success("Registro alterado com sucesso."); 
					interval = setInterval(function(){window.location.reload(); clearInterval(interval); },1500); 
				}else
				alertify.error("Ocorreu algum error, tente novamente."); 
				
			}); 
		}

	}

}(jQuery))