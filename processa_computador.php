<?php
include 'conexao.php';

// Atualizar (EDITAR)
if (isset($_POST['atualizar'])) {
    $id = intval($_POST['id']);
    $patrimonio = $_POST['patrimonio'];
    $usuario = $_POST['usuario'];
    $setor = $_POST['setor'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];

    $sql_update = "UPDATE computadores SET patrimonio=?, usuario=?, setor=?, marca=?, modelo=? WHERE id=?";
    $stmt = mysqli_prepare($conexao, $sql_update);
    mysqli_stmt_bind_param($stmt, 'sssssi', $patrimonio, $usuario, $setor, $marca, $modelo, $id);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Erro ao atualizar: " . mysqli_error($conexao);
    }
}

// Inserir novo
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cadastrar'])) {
    // Captura os dados do formulário
    $patrimonio = $_POST['patrimonio'];
    $usuario = $_POST['usuario'];
    $setor = $_POST['setor'];
    $data_cadastro = date('Y-m-d'); // Define a data de cadastro como a data atual
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];

    // Prepara a consulta SQL para inserir os dados
    $sql_incerir = "INSERT INTO computadores (patrimonio, usuario, setor, data_cadastro, marca, modelo) VALUES (?, ?, ?, ?, ?, ?)";
    
    // Prepara a declaração
    $stmt = mysqli_prepare($conexao, $sql_incerir);
    
    // Vincula os parâmetros
    mysqli_stmt_bind_param($stmt, 'ssssss', $patrimonio, $usuario, $setor, $data_cadastro, $marca, $modelo);
    
    // Executa a declaração
    if (mysqli_stmt_execute($stmt)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Erro ao cadastrar: " . mysqli_error($conexao);
    }
}

// Apagar
if (isset($_GET['apagar'])) {
    $id = intval($_GET['apagar']);
    $sql_deletar = "DELETE FROM computadores WHERE id = ?";
    $stmt = mysqli_prepare($conexao, $sql_deletar);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    header("Location: index.php");
    exit();
}

// Editar
if (isset($_GET['editar'])) {
    $editar = true;
    $id_editar = intval($_GET['editar']);
    $sql_busca = "SELECT * FROM computadores WHERE id = ?"; 
    $stmt = mysqli_prepare($conexao, $sql_busca);
    mysqli_stmt_bind_param($stmt, 'i', $id_editar);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $dados_editar = mysqli_fetch_assoc($resultado);
}

?>
<form method="POST">
    <input type="hidden" name="id" value="<?php echo $dados_editar['id']; ?>">
    <label>Patrimônio:</label>
    <input type="text" name="patrimonio" value="<?php echo $dados_editar['patrimonio']; ?>" required>
    <label>Usuário:</label>
    <input type="text" name="usuario" value="<?php echo $dados_editar['usuario']; ?>" required>
    <label>Setor:</label>
    <input type="text" name="setor" value="<?php echo $dados_editar['setor']; ?>" required>
    <label>Marca:</label>
    <input type="text" name="marca" value="<?php echo $dados_editar['marca']; ?>" required>
    <label>Modelo:</label>
    <input type="text" name="modelo" value="<?php echo $dados_editar['modelo']; ?>" required>
    <button type="submit" name="atualizar" class="btn">Atualizar</button>
</form>