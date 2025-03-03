<?php
$titulo = "Listar Consultas";
include 'conexao.php';

$paginacao = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$limite = 10;
$inicio = ($paginacao - 1) * $limite;

$sql = "SELECT * FROM pacientes ORDER BY horario ASC LIMIT $inicio, $limite";
$result = $conexao->query($sql);

$total = $conexao->query("SELECT COUNT(*) FROM pacientes")->fetchColumn();
$total_paginas = ceil($total / $limite);

ob_start();
?>

<h2 class="text-center mb-4">Consultas Agendadas</h2>
<a href="filtrar_cpf.php" class="btn btn-primary">Procurar Paciente</a>
<table class="table table-dark table-striped">
    <thead>
        <tr>
            <th>Nome</th>
            <th>CPF</th>
            <th>Endereço</th>
            <th>CEP</th>
            <th>Horário</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
            <tr>
                <td><?= htmlspecialchars($row['nome']) ?></td>
                <td><?= htmlspecialchars($row['cpf']) ?></td>
                <td><?= htmlspecialchars($row['endereco']) ?></td>
                <td><?= htmlspecialchars($row['cep']) ?></td>
                <td><?= htmlspecialchars($row['horario']) ?></td>
                <td>
                    <a href="editar.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                    <a href="excluir.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm">Excluir</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>


<!-- Paginação -->
<nav aria-label="Navegação de páginas">
    <ul class="pagination justify-content-center">
        <li class="page-item <?= ($paginacao == 1) ? 'disabled' : '' ?>">
            <a class="page-link" href="?pagina=1">Primeira</a>
        </li>
        <li class="page-item <?= ($paginacao == 1) ? 'disabled' : '' ?>">
            <a class="page-link" href="?pagina=<?= max(1, $paginacao - 1) ?>">Anterior</a>
        </li>

        <!-- Exibe números das páginas -->
        <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
            <li class="page-item <?= ($paginacao == $i) ? 'active' : '' ?>">
                <a class="page-link" href="?pagina=<?= $i ?>"><?= $i ?></a>
            </li>
        <?php endfor; ?>

        <li class="page-item <?= ($paginacao == $total_paginas) ? 'disabled' : '' ?>">
            <a class="page-link" href="?pagina=<?= min($total_paginas, $paginacao + 1) ?>">Próxima</a>
        </li>
        <li class="page-item <?= ($paginacao == $total_paginas) ? 'disabled' : '' ?>">
            <a class="page-link" href="?pagina=<?= $total_paginas ?>">Última</a>
        </li>
    </ul>
</nav>

<?php
$conteudo = ob_get_clean();
include 'base.php';
?>
