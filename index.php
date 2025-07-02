<!DOCTYPE html>

<?php
// Inclui o arquivo de conexão com o banco de dados
include 'conexao.php';
// Consulta para buscar todos os computadores cadastrados
$sql_selecionar = "SELECT * FROM computadores ORDER BY id ASC";
$resultado = mysqli_query($conexao, $sql_selecionar);

// Atualizar (EDITAR)
if (isset($_POST['atualiazar'])) {
    $id = intval($_POST['id']);
    $patrimonio = $_POST['patrimonio'];
    $usuario = $_POST['usuario'];
    $setor = $_POST['setor'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];

    $sql_update = "UPDATE computadores SET patrimonio='?', usuario='?', setor='?', marca='?', modelo='?' WHERE id=?";
    $stmt = mysqli_prepare($conexao, $sql_update);
    mysqli_stmt_bind_param($stmt, 'ssssi', $patrimonio, $usuario, $setor, $marca, $modelo, $id);

    if (mysqli_stmt_execute($stmt)) {
        header('Location: index.php');
        exit();
    } else {
        echo "Erro ao atualizar o computador: " . mysqli_error($conexao);
    }
}

$editar = false;
$dados_editar = null;

if (isset($_GET['editar'])) {
    $editar = true;
    $id_editar = intval($_GET['editar']);
    $sql_busca = "SELECT * FROM computadores WHERE id = ?";
    $stmt = mysqli_prepare($conexao, $sql_busca);
    mysqli_stmt_bind_param($stmt, 'i', $id_editar);
    mysqli_stmt_execute($stmt);
    $resultado_editar = mysqli_stmt_get_result($stmt);
    $dados_editar = mysqli_fetch_assoc($resultado_editar);
}
?>

<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="color-scheme" content="light">
    <title>Inventário de Computadores</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
</head>

<body class="body">
    <a id="abrirModalCadastro" class="btn">+</a>
    <p></p>
    <!-- Modal (pop-up escondido por padrão) -->
    <div id="modalForm" class="modal">

        <div class="modal-content">
            <button id="fecharModalCadastro" class="fecharModal">X</button>
            <h2 class="form-title">Novo Computador</h2>
            <!-- Formulário para cadastro de computadores -->
            <form action="processa_computador.php" method="POST">
                <table>
                    <tbody>
                        <tr class="itens_tabela">
                            <td><a>Patrimônio:</a></td>
                            <td><input type="text" name="patrimonio" placeholder="Patrimônio" required></td>
                        </tr>
                        <tr class="itens_tabela">
                            <td><a>Usuário:</a>
                            <td><input type="text" name="usuario" placeholder="Usuário" required></td>
                        </tr>
                        <tr class="itens_tabela">
                            <td><a>Setor:</a></td>
                            <td><input type="text" name="setor" placeholder="Setor" required></td>
                        </tr>
                        <tr class="itens_tabela">
                            <td><a>Marca:</a></td>
                            <td><input type="text" name="marca" placeholder="Marca" required></td>
                        </tr>
                        <tr class="itens_tabela">
                            <td><a>Modelo:</a></td>
                            <td><input type="text" name="modelo" placeholder="Modelo" required></td>
                        </tr>
                        <tr class="itens_tabela">
                            <td colspan="2">
                                <input type="submit" name="cadastrar" value="Cadastrar" class="btn">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>

        </div>
    </div>

    <!-- Modal de edição (sempre presente, campos preenchidos via JS) -->
    <div id="modalEdit" class="modal">
        <div class="modal-content">
            <button id="fecharModalEdicao" class="fecharModal">X</button>
            <h2 class="form-title">Editar Computador</h2>
            <form action="processa_computador.php" method="POST" id="formEdit">
                <input type="hidden" name="id" id="edit_id">
                <table>
                    <tbody>
                        <tr class="itens_tabela">
                            <td><a>Patrimônio:</a></td>
                            <td><input type="text" name="patrimonio" id="edit_patrimonio" required></td>
                        </tr>
                        <tr class="itens_tabela">
                            <td><a>Usuário:</a></td>
                            <td><input type="text" name="usuario" id="edit_usuario" required></td>
                        </tr>
                        <tr class="itens_tabela">
                            <td><a>Setor:</a></td>
                            <td><input type="text" name="setor" id="edit_setor" required></td>
                        </tr>
                        <tr class="itens_tabela">
                            <td><a>Marca:</a></td>
                            <td><input type="text" name="marca" id="edit_marca" required></td>
                        </tr>
                        <tr class="itens_tabela">
                            <td><a>Modelo:</a></td>
                            <td><input type="text" name="modelo" id="edit_modelo" required></td>
                        </tr>
                        <tr class="itens_tabela">
                            <td colspan="2">
                                <button type="submit" name="atualizar" class="btn">Atualizar</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>

    <hr>
    <!-- Título da página -->
    <h1 class="form-title"> Estoque de Computadores </h1>
    <table>
        <thead>
            <tr class="itens_tabela">
                <th class="id">ID</th>
                <th class="patrimonio">Patrimonio</th>
                <th class="usuario">Usuário</th>
                <th class="setor">Setor</th>
                <th class="data_cadastro">Data de Cadastro</th>
                <th class="marca">Marca</th>
                <th class="modelo">Modelo</th>
                <th class="acoes">Ações</th>
            </tr>
        </thead>
        <tbody>

            <?php
            // Loop para percorrer cada linha do resoltado do banco de dados
            if (mysqli_num_rows($resultado) > 0) {
                while ($computador = mysqli_fetch_assoc($resultado)) {
                    echo "<tr class='itens_tabela'>";
                    // htmlspecialchars() é outra medida de SEGURANÇA para evitar ataques XSS
                    echo "<td>" . htmlspecialchars($computador['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($computador['patrimonio']) . "</td>";
                    echo "<td>" . htmlspecialchars($computador['usuario']) . "</td>";
                    echo "<td>" . htmlspecialchars($computador['setor']) . "</td>";
                    echo "<td>" . date('d/m/Y', strtotime($computador['data_cadastro'])) . "</td>";
                    echo "<td>" . htmlspecialchars($computador['marca']) . "</td>";
                    echo "<td>" . htmlspecialchars($computador['modelo']) . "</td>";
                    echo "<td><button class='btn abrirModalEdicao'
                        data-id='" . htmlspecialchars($computador['id']) . "'
                        data-patrimonio='" . htmlspecialchars($computador['patrimonio']) . "'
                        data-usuario='" . htmlspecialchars($computador['usuario']) . "'
                        data-setor='" . htmlspecialchars($computador['setor']) . "'
                        data-marca='" . htmlspecialchars($computador['marca']) . "'
                        data-modelo='" . htmlspecialchars($computador['modelo']) . "'
                        >Editar</button>
                        <a>&nbsp;</a>
                        <a href='processa_computador.php?apagar=" . $computador['id'] . "' class='btn' onclick=\"return confirm('Tem certeza que deseja apagar?');\">Apagar</a>
                        </td>";
                }
            } else {
                echo "<tr><td colspan='7'>Nenhum computador cadastrado.</td></tr>";
            }
            ?>

        </tbody>
    </table>
    <script src="javascript.js"></script>
</body>

</html>
<?php
// Fecha a conexão com o banco de dados no final da pagina
mysqli_close($conexao);
?>
