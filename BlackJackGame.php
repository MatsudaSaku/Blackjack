<?php
require_once "Deck.php";
require_once "Card.php";
require_once "PlayerDealer.php";

//ゲームの制御、勝敗
class BlackJackGame
{
    private $deck;
    private $player;
    private $dealer;
    private $card;

    public function __construct()
    {
        $this->deck = new Deck();
        $this->player = new Player();
        $this->dealer = new Dealer();
        $this->card = new Card();
    }

    public function gamestart()
    {
        echo 'ブラックジャックを開始します。' . PHP_EOL;
        $cntp = 0;
        $cntd = 0;

        $this->deck->DeckShuffle();

        $this->DrawPlayerHand();
        $this->player->GetHand($cntp);
        $cntp++;
        $this->DrawPlayerHand();
        $this->player->GetHand($cntp);
        $cntp++;

        $this->DrawDealerHand();
        $this->dealer->GetHand($cntd);
        $cntd++;
        $this->DrawDealerHand();
        $this->dealer->GetHand($cntd);
        $cntd++;

        $res = $this->player->DrawOrStand();

        while ($res == 'y' || $res == 'Y') {
            $this->DrawPlayerHand();
            $this->player->GetHand($cntp);
            $cntp++;
            $res = $this->player->DrawOrStand();
        }

        if ($this->player->score > 21) {
            echo 'あなたの得点は' . $this->player->score . 'です。' . PHP_EOL;
            echo 'バーストです。あなたの負けです。' . PHP_EOL;
            echo 'ブラックジャックを終了します。' . PHP_EOL;
            return;
        }

        $this->dealer->FlipCardDealer();

        while ($this->dealer->score < 17) {
            $this->DrawDealerHand();
            $this->dealer->GetHand($cntd);
            echo 'ディーラーの現在の得点は' . $this->dealer->score . 'です。' . PHP_EOL;
            $cntd++;
        }
        if ($this->dealer->score > 21) {
            echo 'あなたの得点は' . $this->player->score . 'です。' . PHP_EOL;
            echo 'ディーラーの得点は' . $this->dealer->score . 'です。' . PHP_EOL;
            echo 'ディーラーのバーストです。あなたの勝ちです！' . PHP_EOL;
            echo 'ブラックジャックを終了します。' . PHP_EOL;
            return;
        }

        echo 'あなたの得点は' . $this->player->score . 'です。' . PHP_EOL;
        echo 'ディーラーの得点は' . $this->dealer->score . 'です。' . PHP_EOL;

        if ($this->player->score > $this->dealer->score) {
            echo 'あなたの勝ちです！' . PHP_EOL;
            echo 'ブラックジャックを終了します。' . PHP_EOL;
        } else if ($this->player->score < $this->dealer->score) {
            echo 'あなたの負けです。' . PHP_EOL;
            echo 'ブラックジャックを終了します。' . PHP_EOL;
        } else {
            echo '引き分けです。' . PHP_EOL;
            echo 'ブラックジャックを終了します。' . PHP_EOL;
        }
        return;
    }

    public function DrawPlayerHand()
    {

        $this->card->SetCard($this->deck);

        $this->player->SetPlayer($this->card);
    }

    public function DrawDealerHand()
    {

        $this->card->SetCard($this->deck);
        $this->dealer->SetDealer($this->card);
    }
}
