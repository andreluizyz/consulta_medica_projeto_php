<?php
$titulo = "Login e Cadastro";
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["acao"]) && $_POST["acao"] == "cadastrar") {
		
        // Cadastro
		
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha')";

        if ($conexao->query($sql) === TRUE) {
            echo "Cadastro realizado com sucesso!";
        } else {
            echo "Erro ao cadastrar: " . $conexao->error;
        }
    } elseif (isset($_POST["acao"]) && $_POST["acao"] == "logar") {
		
        // Login
		
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $sql = "SELECT * FROM usuarios WHERE email='$email'";
        $result = $conexao->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($senha, $row['senha'])) {
                echo "Login realizado com sucesso!";
            } else {
                echo "Senha incorreta.";
            }
        } else {
            echo "Usuário não encontrado.";
        }
    }
}
ob_start();
?>




<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(45deg, #00aaff, #ff6600);
            color: white;
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        .card {
            width: 100%;
            max-width: 400px;
            margin: 20px;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 20px;
            border-radius: 10px;
        }

        .card-header {
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
            color: #ff6600;
        }

        .form-control {
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .btn-custom {
            background-color: #ff6600;
            color: white;
            padding: 12px 24px;
            font-size: 1.2rem;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .btn-custom:hover {
            background-color: #ff4500;
        }

        .toggle-btn {
            color: #ff6600;
            background: none;
            border: none;
            font-size: 1rem;
            cursor: pointer;
            margin-top: 10px;
        }
		
    </style>
</head>
<body>

<div class="login-container">
    <div id="loginForm" class="card">
        <div class="card-header">Entrar</div>
        <form method="POST">
            <input type="hidden" name="acao" value="logar">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="mb-3">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" class="form-control" name="senha" required>
            </div>
            <button type="submit" class="btn btn-custom">Entrar</button>
            <button type="button" class="toggle-btn" onclick="toggleForm()">Criar Conta</button>
        </form>
    </div>

    <div id="cadastroForm" class="card" style="display: none;">
        <div class="card-header">Criar Conta</div>
        <form method="POST">
            <input type="hidden" name="acao" value="cadastrar">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome Completo</label>
                <input type="text" class="form-control" name="nome" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="mb-3">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" class="form-control" name="senha" required>
            </div>
            <button type="submit" class="btn btn-custom">Cadastrar</button>
            <button type="button" class="toggle-btn" onclick="toggleForm()">Já tenho conta</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function toggleForm() {
        var loginForm = document.getElementById('loginForm');
        var cadastroForm = document.getElementById('cadastroForm');

        if (loginForm.style.display === 'none') {
            loginForm.style.display = 'block';
            cadastroForm.style.display = 'none';
        } else {
            loginForm.style.display = 'none';
            cadastroForm.style.display = 'block';
        }
    }
</script>
</body>
</html>

<?php
$conteudo = ob_get_clean();
include 'base.php';
?>
