

//Essa função tem dependência do método sendAjax() e Alertify; 
function deletar(useCase, id){
	var url = 'index.php?uc='+useCase+'&a=deletar'; 

	sendAjax(url,'POST',{'id' : id},function(data){
		data = JSON.parse(data);

		if(data['status'])
			alertify.success("Registro deletado com sucesso."); 
		else
			alertify.error(data['msg']); 
	}); 
}