<?php

include('conexao.php');
$titulo = "Procurar Paciente";

$cpf_filtro = isset($_POST['cpf_filtro']) ? $_POST['cpf_filtro'] : '';

if ($cpf_filtro) {
    $sql = "SELECT * FROM pacientes WHERE cpf LIKE ?"; 
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$cpf_filtro]);
    $consultas = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
   
    $sql = "SELECT * FROM pacientes";
    $stmt = $conexao->query($sql);
    $consultas = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

ob_start();
?>


    <div class="container my-5">
        <h2 class="text-center mb-4">Pesquisar Consultas</h2>

        <form method="POST" action="filtrar_cpf.php" class="mb-4">
            <div class="mb-3">
                <label for="cpf_filtro" class="form-label">Pesquisar por CPF:</label>
                <input type="text" name="cpf_filtro" id="cpf_filtro" class="form-control" value="<?php echo $cpf_filtro; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Pesquisar</button>
        </form>

        <table class="table table-dark table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Endereço</th>
                    <th>CEP</th>
                    <th>Horário</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($consultas as $consulta): ?>
                    <tr>
                        <td><?php echo $consulta['id']; ?></td>
                        <td><?php echo $consulta['nome']; ?></td>
                        <td><?php echo $consulta['cpf']; ?></td>
                        <td><?php echo $consulta['endereco']; ?></td>
                        <td><?php echo $consulta['cep']; ?></td>
                        <td><?php echo $consulta['horario']; ?></td>
                        <td>
                            <a href="editar.php?id=<?php echo $consulta['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="deletar.php?id=<?php echo $consulta['id']; ?>" class="btn btn-danger btn-sm">Deletar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
	

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
	<script>
		$(document).ready(function(){
       
        $('#cpf_filtro').mask('000.000.000-00');
		});
	</script>

<?php
	$conteudo = ob_get_clean();
	include 'base.php';
?>
