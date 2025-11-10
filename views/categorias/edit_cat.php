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

$id = isset($_GET['id']) ? $_GET['id'] : die('ID da categoria não fornecido.');

$categoria = $controller->readOne($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    if ($controller->update($id, $nome)) {
        header('Location: /crud_php/public/index.php?page=categorias');
        exit();
    } else {
        echo "<p class='error'>Não foi possível atualizar a categoria.</p>";
    }
}

include __DIR__ . '/../../views/includes/header.php';
?>

<h2>Editar Categoria</h2>

<form action="/crud_php/public/index.php?page=categorias&action=edit&id=<?php echo $id; ?>" method="POST">
    <label for="nome">Nome da Categoria:</label>
    <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($categoria->nome, ENT_QUOTES); ?>" required>
    <button type="submit" class="button">Salvar</button>
    <a href="/crud_php/public/index.php?page=categorias" class="button">Cancelar</a>
</form>

<?php include __DIR__ . '/../../views/includes/footer.php'; ?>
