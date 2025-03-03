<?php
$titulo = "Cadastrar Paciente";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'conexao.php';
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $endereco = $_POST['endereco'];
    $cep = $_POST['cep'];
    $horario = $_POST['horario'];
    
    $sql = "INSERT INTO pacientes (nome, cpf, endereco, cep, horario) VALUES ('$nome', '$cpf', '$endereco', '$cep', '$horario')";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: listar_consultas.php");
        exit();
    } else {
        $erro = "Erro ao cadastrar: " . $conn->error;
    }
}

ob_start();
?>
<h2>Cadastrar Paciente</h2>
<form method="POST">
    <div class="mb-3">
        <label class="form-label">Nome</label>
        <input type="text" class="form-control" name="nome" required>
    </div>
    <div class="mb-3">
        <label class="form-label">CPF</label>
        <input type="text" class="form-control" name="cpf" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Endereço</label>
        <input type="text" class="form-control" name="endereco" required>
    </div>
    <div class="mb-3">
        <label class="form-label">CEP</label>
        <input type="text" class="form-control" name="cep" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Horário da Consulta</label>
        <input type="datetime-local" class="form-control" name="horario" required>
    </div>
    <button type="submit" class="btn btn-primary">Cadastrar</button>
</form>
<?php if (isset($erro)) echo "<p class='text-danger'>$erro</p>"; ?>

<?php
$conteudo = ob_get_clean();
include 'base.php';
?>
