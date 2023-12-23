<? //デッキの初期化
class Deck
{
    public $deck;

    public function DeckShuffle()
    {
        $this->deck = range(1, 52);
        shuffle($this->deck);
    }

    public function GetDeck()
    {
        return array_shift($this->deck);
    }
}
