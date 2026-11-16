<?php
session_start();
$MAX_ERRORS = 7; 

$mots = ["BITE","TRUC","CONNARD","CHIANT","PENIS","LINUX","DEBIAN","WINDOW"];



function newGame($mots)
{
    $word = $mots[array_rand($mots)];       
    $_SESSION['word']    = $word;
    $_SESSION['found']   = [$word[0]];      
    $_SESSION['missed']  = [];              
}


if (!isset($_SESSION['word']) || isset($_GET['new'])) {
    newGame($mots);
    header("Location: play.php");           
}



if (isset($_POST['letter'])) {
    $letter = strtoupper($_POST['letter']);


    if (preg_match('/^[A-Z]$/', $letter)
        && !in_array($letter, $_SESSION['found'])
        && !in_array($letter, $_SESSION['missed'])) {

        if (strpos($_SESSION['word'], $letter) !== false) {
            $_SESSION['found'][] = $letter;   
        } else {
            $_SESSION['missed'][] = $letter;  
        }
    }
}



$word    = $_SESSION['word'];
$display = "";
$won     = true;


for ($i = 0; $i < strlen($word); $i++) {
    if (in_array($word[$i], $_SESSION['found'])) {
        $display .= $word[$i] . " ";
    } else {
        $display .= "_ ";
        $won = false;   
    }
}

$errorCount = count($_SESSION['missed']);
$lost       = ($errorCount >= $MAX_ERRORS);
$finished   = $won || $lost;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hangman</title>
</head>
<body>
    <h1>Hangman</h1>

    <h2><?= $display ?></h2>

    <p>Mistakes: <?= $errorCount ?> / <?= $MAX_ERRORS ?></p>
    <p>Wrong letters: <?= implode(", ", $_SESSION['missed']) ?></p>

    <?php if ($won): ?>
        <p><strong>Congratulations, you won!</strong></p>
    <?php elseif ($lost): ?>
        <p><strong>You lost! The word was: <?= $word ?></strong></p>
    <?php else: ?>

        <form method="post">
            <input type="text" name="letter" maxlength="1" size="2" autofocus required>
            <button type="submit">Submit</button>
        </form>
    <?php endif; ?>

    <?php if ($finished): ?>
        <p><a href="play.php?new=1">Play again</a></p>
    <?php endif; ?>
</body>
</html>