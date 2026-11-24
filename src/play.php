<?php
session_start();
$MAX_ERRORS = 7; 

$mots = ["LINUX", "DISTRO", "NIXOS", "DEBIAN", "CODEBERG"];



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
    exit;
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
require __DIR__ . '/header.php';
?>
<main class="play">
    <section class="game-card" aria-labelledby="game-title">
        <div class="game-heading">
            <h2 id="game-title">Hangman</h2>
            <span class="mistakes">Mistakes <strong><?= $errorCount ?> / <?= $MAX_ERRORS ?></strong></span>
        </div>

        <div class="word-slots" role="group" aria-label="Word">
            <?php foreach (explode(' ', trim($display)) as $slot): ?>
                <span><?= $slot ?></span>
            <?php endforeach; ?>
        </div>

        <p class="missed-letters">Wrong letters
            <strong><?= $_SESSION['missed'] ? implode(', ', $_SESSION['missed']) : 'None yet' ?></strong>
        </p>

        <?php if ($finished): ?>
            <div class="game-result">
                <?php if ($won): ?>
                    <p>Congratulations, you won!</p>
                <?php else: ?>
                    <p>You lost! The word was <strong><?= $word ?></strong>.</p>
                <?php endif; ?>
                <a class="game-action" href="play.php?new=1">Play again</a>
            </div>
        <?php else: ?>
            <form method="post" class="guess-form">
                <label for="letter">Guess a letter</label>
                <div class="guess-controls">
                    <input id="letter" type="text" name="letter" maxlength="1" pattern="[A-Za-z]"
                           autocomplete="off" autocapitalize="characters" autofocus required>
                    <button type="submit" class="game-action">Submit</button>
                </div>
            </form>
        <?php endif; ?>
    </section>
</main>
</body>
</html>
