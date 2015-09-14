(function ($) {
    var interval;

    var DELETE, CADASTRO, ALTERAR
    var DELAY = 1500;

    //O array de configuração tem que estar neste formato:
    //data = {delete: 'info', alterar : 'info', cadastro : 'info'};
    //data = {alterar : 'info'};

    $.fn.Conf = function (conf) {
        if (typeof conf == 'undefined') {
            DELETE = 'delete';
            ALTERAR = 'alterar';
            CADASTRO = 'cadastro';
        } else {
            DELETE = (typeof conf['delete'] == 'undefined') ? 'delete' : conf['delete'];
            ALTERAR = (typeof conf['alterar'] == 'undefined') ? 'alterar' : conf['alterar'];
            CADASTRO = (typeof conf['cadastro'] == 'undefined') ? 'cadastro' : conf['cadastro'];
        }
    }

    $.fn.deletar = function (useCase) {
        this.click(function () {
            var id = parseInt(this.value);
            alertify.confirm("Deseja realmente deletar este registro", function (resposta) {
                if (resposta) {
                    onDelete(id);
                    interval = setInterval(function () {
                        window.location.reload()
                    }, DELAY);
                }
                else
                    alertify.error("Operação cancelada.");
            });
        });

        function onDelete(id) {
            sendAjax('index.php?uc=' + useCase + '&a=' + DELETE, 'POST', {'id': id}, function (data) {
                data = JSON.parse(data);

                if (data['status']) {
                    alertify.success("Registro deletado com sucesso.");
                    interval = setInterval(function () {
                        window.location.reload();
                        clearInterval(interval);
                    }, DELAY);
                }
                else
                    alertify.error(data['msg']);
            });
        }
    }


    $.fn.reestabelecerForm = function (useCase, callback) {
        //pegar o valor do objeto:
        //distribuir o valor do objeto nos elementos do formulário.
        //done.
        var idItem = parseInt(this.find('input#id').val());
        var url = 'index.php?uc=' + useCase + '&a=getObject';

        var form = this;

        sendAjax(url, 'POST', {'id': idItem}, function (data) {
            //Chama callback e retorna os dados do objeto
            callback(data);
            //casos triviais:
            //select, input, checbox;
            data = JSON.parse(data);

            console.log("inputs > ");
            form.find('input[type=hidden] ,input[type=text] ,input[type=number] ,input[type=email],input[type=date]').each(function () {
                var element = $(this);
                //console.log($(this).attr('name'));
                //indice 0 é o nome do campo. índice 1 é o valor.
                jQuery.each(data, function (key, value) {
                    if (key == element.attr('name'))
                        element.val(value);
                })
            });

            console.log("textarea > ");
            form.find('textarea').each(function () {
                var element = $(this);
                //console.log($(this).attr('name'));
                //indice 0 é o nome do campo. índice 1 é o valor.
                jQuery.each(data, function (key, value) {
                    if (key == element.attr('name'))
                        element.val(value);
                })
            });

            console.log("checkbox > ");
            form.find('input[type=checkbox]').each(function () {
                var element = $(this);

                jQuery.each(data, function (key, value) {
                    console.log(key);
                    if (key == element.attr('name')) {
                        var a = ((value == 1) ? true : false );
                        element.attr('checked', a);
                    }
                });
            });

            console.log("select > ");
            form.find('select').each(function () {
                var element = $(this);

                jQuery.each(data, function (key, value) {
                    if (key == element.attr('name')) {
                        element.children('option').each(function () {
                            if ($(this).val() == value)
                                $(this).attr('selected', 'selected');
                        });
                    }
                });
            });


        });

    }

    $.fn.Crud = function (useCase, modalId, callback, handleAlterar, handleCadastrar, handleDeletar) {
        // <input type="hidden" id="cadastrar" />
        // <input type="hidden" id="id" />
        //
        var form = $(modalId).find('form');
        //id=cadastrar sendo true significa que o modal é invocado para um cadastro,
        //caso contrário, é para alteração.

        $(form).append('<input type="hidden" id="cadastrar"  />');
        $(form).append('<input type="hidden" id="id" name="id" />');

        //Tratando manipuladores com parâmetro nulo:
        if (typeof handleAlterar == 'undefined')
            handleAlterar = '.alterar';
        if (typeof handleCadastrar == 'undefined')
            handleCadastrar = '.cadastrar';
        if (typeof handleDeletar == 'undefined')
            handleDeletar = '.del';

        //Manipulando eventos de cadastro
        $(handleCadastrar).click(function () {
            $(form).get(0).reset();
            $(form).find('#cadastrar').val(1);

            var b = $(form).find('button[type=submit]');
            b.text("Salvar");
            b.removeClass('info').addClass('success');

            //Mudando label do modal
            var texto = $(modalId).find('h2').first().text();
            $(modalId).find('h2').first().text(texto.replace('Alterar', 'Cadastro'));

            $(modalId).foundation('reveal', 'open');
        });

        //Manipulando eventos de alteração
        $(handleAlterar).click(function () {
            $(form).find('#cadastrar').val(0);
            //Pegando valor botão que é o pivô da ação de deletar.
            $(form).find('#id').val($(this).val());

            //Restabelecendo valores no formulário:
            $(form).reestabelecerForm(useCase, callback);

            //Alterando o escopo do botão:
            var b = $(form).find('button[type=submit]');
            b.text("Alterar");
            b.removeClass('success').addClass('info');

            //Mudando label do modal
            var texto = $(modalId).find('h2').first().text();
            $(modalId).find('h2').first().text(texto.replace('Cadastro', 'Alterar'));

            $(modalId).foundation('reveal', 'open');
        });

        //Manipulando eventos de deleção
        $(handleDeletar).deletar(useCase);


        $(form).on('valid.fndtn.abide', function () {
            var data = $(this).serializeArray();
            if (parseInt($(this).find('#cadastrar').val()))
                onCadastro(data);
            else
                onAlterar(data);
        });

        function onCadastro(data) {
            sendAjax('index.php?uc=' + useCase + '&a=' + CADASTRO, 'POST', data, function (data) {
                var data = JSON.parse(data);
                if (data['status']) {
                    alertify.success("O registro foi cadastrado com sucesso");
                    interval = setInterval(function () {
                        window.location.reload();
                        clearInterval(interval);
                    }, DELAY);
                } else
                    alertify.error("Ocorreu algum error, tente novamente.");
            });
        }

        function onAlterar(data) {
            sendAjax('index.php?uc=' + useCase + '&a=' + ALTERAR, 'POST', data, function (data) {
                var data = JSON.parse(data);
                if (data['status']) {
                    alertify.success("Registro alterado com sucesso.");
                    interval = setInterval(function () {
                        window.location.reload();
                        clearInterval(interval);
                    }, DELAY);
                } else
                    alertify.error("Ocorreu algum error, tente novamente.");

            });
        }

    }

}(jQuery))