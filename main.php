<?php
require_once "BlackJackGame.php";
require_once "Deck.php";

do {
    $blackjack = new BlackJackGame();
    $blackjack->gamestart();
    echo 'ゲームを続けますか？(Y/N)' . PHP_EOL;
    $res = trim(fgets(STDIN));
} while ($res == 'y');
?>
