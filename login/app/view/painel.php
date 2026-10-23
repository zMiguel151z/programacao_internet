<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel</title>
   <link rel="stylesheet" href="/app/view/style/style.css">
</head>
<body>
    <center>
        <h1>
            Bem-vindo ao painel,
            <?php echo ($_SESSION['nome']); ?>
        </h1>
    
        <p>
            <a href="index.php?action=logout">Sair</a>
        </p>
    </center>
</body>
</html>