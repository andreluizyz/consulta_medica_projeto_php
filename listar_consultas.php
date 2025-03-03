<?php
include('conexao.php');

$paginacao = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$limite = 10;
$inicio = ($paginacao - 1) * $limite;

$sql = "SELECT * FROM pacientes LIMIT $inicio, $limite";
$stmt = $conexao->query($sql);
$consultas = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total = $conexao->query("SELECT COUNT(*) FROM pacientes")->fetchColumn();
$total_paginas = ceil($total / $limite);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultas Médicas</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container my-5">
        <h2 class="text-center mb-4">Lista de Consultas</h2>

       
        <table class="table table-bordered table-striped table-hover">
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

     
        <nav aria-label="Página de resultados">
            <ul class="pagination justify-content-center">
               
                <li class="page-item <?php echo ($paginacao == 1) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?pagina=1">Primeira</a>
                </li>

                
                <li class="page-item <?php echo ($paginacao == 1) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?pagina=<?php echo max(1, $paginacao - 1); ?>">Anterior</a>
                </li>

                
                <li class="page-item <?php echo ($paginacao == $total_paginas) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?pagina=<?php echo min($total_paginas, $paginacao + 1); ?>">Próxima</a>
                </li>

               
                <li class="page-item <?php echo ($paginacao == $total_paginas) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?pagina=<?php echo $total_paginas; ?>">Última</a>
                </li>
            </ul>
        </nav>
    </div>

  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
