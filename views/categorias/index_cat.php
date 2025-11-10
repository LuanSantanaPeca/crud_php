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

include_once __DIR__ . '/../../controllers/CategoriaController.php';

$controller = new CategoriaController();
$data = $controller->index();
$stmt = $data['stmt'];
$num = $data['num'];

include __DIR__ . '/../../views/includes/header.php';
?>

<h2>Categorias</h2>

<a href="/crud_php/public/index.php?page=categorias&action=create" class="button">Criar Nova Categoria</a>

<?php
if($num > 0){
    echo "<table>";
        echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Nome</th>";
            echo "<th>Ações</th>";
        echo "</tr>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        echo "<tr>";
            echo "<td>{$id}</td>";
            echo "<td>{$nome}</td>";
            echo "<td>";
                echo "<a href=\"/crud_php/public/index.php?page=categorias&action=edit&id={$id}\" class=\"button edit\">Editar</a>";
                
                $href = "#popup{$id}";
                echo "<a href=\"{$href}\" class=\"button delete\">Deletar</a>";
                
                echo "<div class=\"popup\" id=\"popup{$id}\">";
                        echo "<a href=\"#\" class=\"close\">X</a>";
                        echo "<p>Você tem certeza que quer deletar essa categoria?</p>";
                        echo "<a href=\"/crud_php/public/index.php?page=categorias&action=delete&id={$id}\" class=\"button delete\">Sim</a>";
                echo "</div>";
                
            echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>Nenhuma categoria encontrada.</p>";
}
?>

<?php include __DIR__ . '/../../views/includes/footer.php'; ?>
