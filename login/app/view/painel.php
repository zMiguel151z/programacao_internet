<?php
require_once __DIR__ . "/../controller/LoginController.php";

$controller = new LoginController();
$controller->exigirLogin();

$usuario = $controller->buscarUsuario();

$erro = "";
$acao = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $acao = $_POST["acao"] ?? "";

    if ($acao === "editar") {
        $nome = trim($_POST["nome"] ?? "");
        $email = trim($_POST["email"] ?? "");
        $senha = $_POST["senha"] ?? "";

        if ($nome === "" || $email === "" || $senha === "") {
            $erro = "Preencha todos os campos.";
        } else {
            try {
                if ($controller->atualizar($nome, $email, $senha)) {
                    $_SESSION['usuario_nome'] = $nome;
                    header("Location: painel.php?ok=editar");
                    exit;
                }
                $erro = "Não foi possível atualizar o perfil.";
            } catch (Throwable $e) {
                $erro = "Não foi possível atualizar. O email já pode estar em uso.";
            }
        }
    } elseif ($acao === "deletar") {
        try {
            if ($controller->deletar((int) $_SESSION['usuario_id'])) {
                $controller->logout();
                header("Location: login.php");
                exit;
            }
            $erro = "Não foi possível deletar a conta.";
        } catch (Throwable $e) {
            $erro = "Não foi possível deletar a conta.";
        }
    }
}

$nomeValor = $usuario['nome'] ?? '';
$emailValor = $usuario['email'] ?? '';

if ($acao === "editar" && $_SERVER["REQUEST_METHOD"] === "POST") {
    $nomeValor = trim($_POST["nome"] ?? '');
    $emailValor = trim($_POST["email"] ?? '');
}

$mensagem = "";
if (($_GET["ok"] ?? "") === "editar") {
    $mensagem = "Perfil atualizado com sucesso.";
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel</title>
    <style>
        .modal {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            align-items: center;
            justify-content: center;
        }
        .modal.aberto {
            display: flex;
        }
        .modal-caixa {
            background: #fff;
            padding: 20px;
            min-width: 320px;
            max-width: 90%;
            border: 1px solid #ccc;
        }
        .acoes {
            display: flex;
            gap: 8px;
        }
    </style>
</head>
<body>
    <h1>Painel do usuário</h1>

    <?php if ($mensagem !== ""): ?>
        <p><?= htmlspecialchars($mensagem) ?></p>
    <?php endif; ?>

    <?php if ($erro !== ""): ?>
        <p><?= htmlspecialchars($erro) ?></p>
    <?php endif; ?>

    <p>Olá, <?= htmlspecialchars($_SESSION['usuario_nome']) ?>!</p>
    <p>ID do usuário: <?= htmlspecialchars((string) $_SESSION['usuario_id']) ?></p>

    <div class="acoes">
        <button type="button" onclick="abrirModal('modal-editar')">Editar perfil</button>
        <button type="button" onclick="abrirModal('modal-deletar')">Deletar conta</button>
        <form method="get" action="logout.php">
            <button type="submit">Sair</button>
        </form>
    </div>

    <div id="modal-editar" class="modal" onclick="if (event.target === this) fecharModal('modal-editar')">
        <div class="modal-caixa">
            <h2>Editar perfil</h2>

            <form method="post" action="painel.php">
                <input type="hidden" name="acao" value="editar">
                <p>
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($nomeValor) ?>" required>
                </p>
                <p>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?= htmlspecialchars($emailValor) ?>" required>
                </p>
                <p>
                    <label for="senha">Nova ou atual senha:</label>
                    <input type="password" id="senha" name="senha" required>
                </p>
                <div class="acoes">
                    <button type="submit">Salvar</button>
                    <button type="button" onclick="fecharModal('modal-editar')">Cancelar</button>
                </div>
            </form>
        </div>
    </div>

    <div id="modal-deletar" class="modal" onclick="if (event.target === this) fecharModal('modal-deletar')">
        <div class="modal-caixa">
            <h2>Deletar conta</h2>

            <p>Tem certeza de que deseja deletar a conta de <?= htmlspecialchars($_SESSION['usuario_nome']) ?>? Esta ação não pode ser desfeita.</p>

            <form method="post" action="painel.php">
                <input type="hidden" name="acao" value="deletar">
                <div class="acoes">
                    <button type="submit">Sim, deletar</button>
                    <button type="button" onclick="fecharModal('modal-deletar')">Cancelar</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function abrirModal(id) {
            document.getElementById(id).classList.add('aberto');
        }

        function fecharModal(id) {
            document.getElementById(id).classList.remove('aberto');
        }

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                document.querySelectorAll('.modal.aberto').forEach(function (modal) {
                    modal.classList.remove('aberto');
                });
            }
        });

        <?php if ($erro !== "" && $acao === "editar"): ?>
            abrirModal('modal-editar');
        <?php endif; ?>

        <?php if ($erro !== "" && $acao === "deletar"): ?>
            abrirModal('modal-deletar');
        <?php endif; ?>
    </script>
</body>
</html>
