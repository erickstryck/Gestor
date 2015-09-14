<?php
require_once(PATH . 'Controller' . DS . 'GenericController.php');
require_once(PATH . 'View' . DS . 'CustomViews' . DS . 'CategoriasView.php');

class Categorias extends GenericController
{
    private $categoriasView;

    public function __construct()
    {
        $this->categoriasView = new CategoriasView();
    }

    /**
     * @Permissao({"administrador"})
     */
    public function novaCategoriaView()
    {
        $this->categoriasView->novaCategoriaView();
    }

    /**
     * @Permissao({"administrador"})
     */
    public function cadastro($arg)
    {
        //Roteiro:
        //Validar os dados que estão vindo da visão ( fazer isso depois )
        //Armazenar os dados no banco
        //Enviar confirmação de sucesso ou falha via JSON.

        Lumine::import("Categoria");

        $categoria = new Categoria();

        $categoria->nomeCategoria = $arg['nomeCategoria'];
        $categoria->margemLucro = (float)$arg['margemLucro'];
        $categoria->empresaId = $_SESSION['empresaId'];

        $categoria->insert();

        //Enviar essa linha apenas se tudo acima estiver sido feito corretamente.
        $this->categoriasView->sendAjax(array('status' => true));
    }

    /**
     * @Permissao({"administrador"})
     */
    public function alterar($arg)
    {
        //Roteiro:
        //Validar os dados que estão vindo da visão ( fazer isso depois )
        //Armazenar os dados no banco
        //Enviar confirmação de sucesso ou falha via JSON.

        Lumine::import("Categoria");

        $categoria = new Categoria();

        $categoria->where("empresa_id = " . $_SESSION['empresaId'] . " and id = " . (int)$arg['id'])->find();
        $categoria->fetch(true);

        $categoria->nomeCategoria = $arg['nomeCategoria'];
        $categoria->margemLucro = (float)$arg['margemLucro'];
        $categoria->empresaId = $_SESSION['empresaId'];

        $categoria->update();

        //Enviar essa linha apenas se tudo acima estiver sido feito corretamente.
        $this->categoriasView->sendAjax(array('status' => true));
    }

    /**
     * @Permissao({"administrador"})
     */
    public function getObject($arg)
    {
        $id = (int)$arg['id'];
        Lumine::import("Categoria");
        $categoria = new Categoria();

        $categoria->get($id);

        $this->categoriasView->sendAjax($categoria->toArray());
    }

    /**
     * @Permissao({"administrador"})
     */
    public function delete($arg)
    {
        Lumine::import("Categoria");
        $categoria = new Categoria();
        $categoria->get((int)$arg['id']);

        //Desativando o registro no banco.
        $categoria->ativo = 0;
        $categoria->update();

        $this->categoriasView->sendAjax(array('status' => true, 'msg' => $arg['id']));
    }

}
