<?
require_once "Card.php";

class Player
{
    public $hand = [];
    public $score = 0;

    public function SetPlayer($card)
    {
        $this->hand[] = clone $card;
    }

    public function GetHand($turn)
    {

        $card = $this->hand[$turn];
        echo 'あなたの引いたカードは' . $card->GetSuit() . 'の' . $card->GetNumber() . 'です。' . PHP_EOL;

        $num = $card->GetNumber();

        if ($num == 'A') {
            $this->score += 11;
        } else if ($num == 'J' || $num == 'Q' || $num == 'K') {
            $this->score += 10;
        } else {
            $this->score += (int)$num;
        }
        //スコアが21を超えたときにAのカードを変化し、スコアを10減らす。
        if ($this->score > 21) {
            foreach ($this->hand as $index => $card) {
                if ($card->GetNumber() == 'A') {
                    $this->score -= 10;

                    $newACard = new Card();
                    $newACard->suit = $card->suit;
                    $newACard->number = '1.A';
                    $this->hand[$index] = $newACard;

                    break;
                }
            }
        }
    }

    public function DrawOrStand()
    {
        if ($this->score < 21) {
            echo 'あなたの現在の得点は' . $this->score . 'です。カードを引きますか？(Y/N)' . PHP_EOL;
            $res = trim(fgets(STDIN));
            return $res;
        }
    }
}
//ディーラーの得点、手札
class Dealer
{
    public $hand = [];
    public $score = 0;

    public function SetDealer($card)
    {
        $this->hand[] = $card;
    }

    public function GetHand($turn)
    {

        $card = $this->hand[$turn];

        if ($turn != 1) {

            echo 'ディーラーの引いたカードは' . $card->GetSuit() . 'の' . $card->GetNumber() . 'です。' . PHP_EOL;
        } else {
            echo 'ディーラーの引いた2枚目のカードはわかりません。' . PHP_EOL;
        }

        $cardnum = $card->GetNumber();

        if ($cardnum == 'A') {
            $this->score += 11;
        } else if ($cardnum == 'J' || $cardnum == 'Q' || $cardnum == 'K') {
            $this->score += 10;
        } else {
            $this->score += (int)$cardnum;
        }

        if ($this->score > 21) {
            foreach ($this->hand as $index => $card) {
                if ($card->GetNumber() == 'A') {
                    $this->score -= 10;

                    $newACard = new Card();
                    $newACard->suit = $card->suit;
                    $newACard->number = '1.A';
                    $this->hand[$index] = $newACard;

                    break;
                }
            }
        }
    }

    public function FlipCardDealer()
    {
        $card = $this->hand[1];
        echo 'ディーラーの引いた2枚目のカードは' . $card->GetSuit() . 'の' . $card->GetNumber() . 'でした。' . PHP_EOL;
        echo 'ディーラーの現在の得点は' . $this->score . 'です。' . PHP_EOL;
    }
}
