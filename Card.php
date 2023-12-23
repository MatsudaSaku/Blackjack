<?

class Card{
    public $suit;
    public $number;

    public function SetCard($deck){
        $cardNumber = $deck->GetDeck();
        $num = $this->CreateSuit($cardNumber);
        $this->CreatePictureCard($num);
    }

    public function CreatePictureCard($num){
        if($num == 1){
            $this->number = 'A';
        }
        else if($num == 11){
            $this->number = 'J';
        }
        else if($num == 12){
            $this->number = 'Q';
        }
        else if($num == 13){
            $this->number = 'K';
        }
        else{
            $this->number = (string)$num;
        }
    }

    public function CreateSuit($num){
        if($num >= 1 && $num <= 13){
            $this->suit = 'クラブ'; 
            return $num;
        }
        else if($num >= 14 && $num <= 26){
            $this->suit = 'スペード';
            return $num -13;
        }
        else if($num >= 27 && $num <= 39){
            $this->suit = 'ダイヤ';
            return $num -26;
        }
        else{
            $this->suit = 'ハート';
            return $num -39;
        } 
    }

   

    public function GetSuit(){
        return $this->suit;
    }

    public function GetNumber(){
        return $this->number;
    }
}


?>