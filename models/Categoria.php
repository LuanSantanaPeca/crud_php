<?php

/*********************************************************************************************************************
 Curso: Engenharia de Software
 Disciplina: Linguagem e Técnicas de Programacão
 Professor: Flores
 Turma: ESOFT-2A
 Componentes: 
            25169060-2 - Alex Rafael Ferreira
            25001459-2 - Eduardo Gritten dos Santos Spohr
            25177941-2 - Juan Pyerre de Sousa Carvalho 
            25044068-2 - Legiane Cristina de Souza Oliveira Chagas
            25164713-2 - Luan Enrico Santana Peça
            25182011-2 - Miguel Felipe Gazola
            25181985-2 - Nathaly Yukie Otofuji Honda
            25181898-2 - Pedro Paulo Rodrigues Mardegam
 Data: 11 de Novembro de 2025
 Descritivo: Desenvolvimento de um Sistema CRUD em PHP com MySQL
 **********************************************************************************************************************/

class Categoria {
    private $conn;
    private $table_name = "categorias";

    public $id;
    public $nome;

    public function __construct($db){
        $this->conn = $db;
    }

    // Usado para ler categorias
    function read(){
        $query = "SELECT id, nome FROM " . $this->table_name . " ORDER BY nome";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Usado para criar categoria
    function create(){
        $query = "INSERT INTO " . $this->table_name . " SET nome=:nome";
        $stmt = $this->conn->prepare($query);

        $this->nome=htmlspecialchars(strip_tags($this->nome));

        $stmt->bindParam(":nome", $this->nome);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // Usado para ler uma única categoria
    function readOne(){
        $query = "SELECT id, nome FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->nome = $row['nome'];
    }

    // Usado para atualizar a categoria
    function update(){
        $query = "UPDATE " . $this->table_name . " SET nome = :nome WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $this->nome=htmlspecialchars(strip_tags($this->nome));
        $this->id=htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // Usado para deletar a categoria
    function delete(){
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        $this->id=htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(1, $this->id);

        if($stmt->execute()){
            return true;
        }
        return false;
    }
}
?>
