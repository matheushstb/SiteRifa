<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="pag1.css">
    <title>Rifa - Dia das Mães</title>
    <style>
        .center { text-align: center; }
        button { margin: 10px; }
        .clicked {
            background-color: red;
            color: white;
            pointer-events: none;
        }
    </style>
</head>
<body>
    <nav>
        <ul id="lista">
            <li class="rifa"><h1>Rifa</h1></li>
            <li class="home"><h4>Home</h4></li>
            <li class="premio"><h4>Prêmios</h4></li>
            <li class="faq"><h4>FAQ</h4></li>
            <li><h4>Suehtam's co-production</h4></li>
        </ul>
    </nav>
    <h1 class="center">Rifa de Dia das Mães!</h1><br><br>
    <h2 class="center" style="color: #633b28">Escolha um número(nome):</h2><br><br><br>
    <?php
    session_start();

    $nomes = [
        "1 - Albina", "2 - Arlinda", "3 - Bruna", "4 - Beatriz", "5 - Bárbara",
        "6 - Celina", "7 - Carla", "8 - Elaine", "9 - Eva", "10 - Fabiana",
        "11 - Gabriela", "12 - Heloisa", "13 - Hagata", "14 - Janaina", "15 - Joana",
        "16 - Larissa", "17 - Luana", "18 - Maria", "19 - Mariana", "20 - Nayane",
        "21 - Olívia", "22 - Patrícia", "23 - Paula", "24 - Renata", "25 - Rafaela",
        "26 - Sarah", "27 - Silvia", "28 - Tatiana", "29 - Thaís", "30 - Viviane"
    ];

    if (!isset($_SESSION['clicked_buttons'])) {
        $_SESSION['clicked_buttons'] = array_fill(0, count($nomes), false);
    }

    if (!isset($_SESSION['usernames'])) {
        $_SESSION['usernames'] = array_fill(0, count($nomes), "");
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['button_index'])) {
        $index = (int)$_POST['button_index'];
        $username = htmlspecialchars($_POST['username']);
        $_SESSION['clicked_buttons'][$index] = true;
        $_SESSION['usernames'][$index] = $username;
        echo "<p class='center' style='color: #3d2013'>Bem-vindo(a), $username! Você escolheu {$nomes[$index]}</p><br><br>";
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['sortear'])) {
        $sorteado = rand(1, 30);
        $sorteado_nome = $nomes[$sorteado - 1];
        if ($_SESSION['clicked_buttons'][$sorteado - 1]) {
            $ganhador = $_SESSION['usernames'][$sorteado - 1];
            echo "<p class='center'>Parabéns! $sorteado_nome foi sorteada, nome escolhido por $ganhador!</p>";
        } else {
            echo "<p class='center'>$sorteado_nome foi sorteada! Nome não selecionado.</p>";
        }
    }
    ?>

    <form id="nomes" class="center" method="POST" action="">
        <?php
            foreach ($nomes as $index => $nome) {
                $disabled = $_SESSION['clicked_buttons'][$index] ? 'disabled class="clicked"' : '';
                echo "<button type=\"button\" onclick=\"showAlert($index, '$nome')\" $disabled>$nome</button>";
            }
        ?>
        <br><br><br><br><br><br>
        <input type="submit" value="Sortear" name="sortear">
    </form><br><br>

    <form id="usernameForm" method="POST" action="" style="display: none;">
        <input type="hidden" id="button_index" name="button_index" value="">
        <input type="hidden" id="username" name="username" value="">
    </form>

    <script>
        function showAlert(index, nome) {
            var username = prompt("Digite o seu nome:");
            if (username !== null && username !== "") {
                document.getElementById('button_index').value = index;
                document.getElementById('username').value = username;
                document.getElementById('usernameForm').submit();
            }
        }
    </script>
</body>
</html>
