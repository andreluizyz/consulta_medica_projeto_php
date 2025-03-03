<?php
// Este arquivo é incluído em todas as páginas, então ele define o layout padrão.
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo ?? "Sistema de Consultas"; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <style>
        body {
            background: linear-gradient(45deg, #00aaff, #ff6600);
            color: white;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 800px;
            margin-top: 50px;
            padding: 20px;
            background-color: #1E1E1E;
            border-radius: 8px;
        }
        .btn-primary {
            background-color: #6A0DAD;
            border: none;
        }
        .btn-primary:hover {
            background-color: #8A2BE2;
        }
        .nav-link {
            color: white;
        }
        .nav-link:hover {
            color: #ff6600;
        }
        .hidden {
            display: none;
        }
        .not-hidden {
            display: block;
        }
        nav {
            margin-bottom: 20px;
        }
        footer {
            text-align: center;
            margin-top: 40px;
            font-size: 1rem;
            color: white;
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Navegação -->
    <nav class="mb-4">
        <a href="index.php" class="btn btn-primary">Início</a>
        <a href="formulario.php" class="btn btn-primary">Cadastrar Paciente</a>
        <a href="listar_consultas.php" class="btn btn-primary">Listar Consultas</a>
        <a href="login.php" class="btn btn-primary">Login</a>
    </nav>
    
    <!-- Conteúdo da página -->
    <?php echo $conteudo ?? "<p>Conteúdo não disponível</p>"; ?>
</div>

<footer>
    <p>&copy; 2025 Sistema de Consultas Médicas. Todos os direitos reservados.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
