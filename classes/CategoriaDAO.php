<?php
require_once 'Model.php';
class CategoriaDAO extends Model
{   
    public function __construct() 
    {
    	parent::__construct();
    	$this->tabela = 'categorias';
    	$this->class = 'Categoria';
    }

    public function insereCategoria(Categoria $categoria) {
    	$values = "null, '{$categoria->getNome()}'";
    	return $this->inserir($values);
    }

    public function alteraCategoria(Categoria $categoria) {
    	$values = "nome = '{$categoria->getNome()}'";
    	$this->alterar($categoria->getId(), $values);
	}
	public function listar($pesquisa = '')
    {
        if($pesquisa != '') {
            $sql = "SELECT * FROM {$this->tabela} 
                    WHERE nome like '%{$pesquisa}%'";
        } else {
            $sql = "SELECT * FROM {$this->tabela}";
        }
        $stmt = $this->db->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, $this->class);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}