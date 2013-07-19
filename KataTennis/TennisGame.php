<?php
class TennisGame
{
    private $playerOneScore = 0;

    private $playerTwoScore = 0;

    public function getScore()
    {
        if ($this->hasWinner()) {
            return sprintf('Player %s wins', $this->playerWithHighestScore());
        }

        if ($this->isDeuce()) {
            return "Deuce";
        }

        if ($this->hasAdvantage()) {
            return "Avantage player ".$this->playerWithHighestScore();
        }

        if ($this->playerHaveSameScore()) {
            return $this->translateScore($this->playerOneScore).' All';
        }
    
        return $this->translateScore($this->playerOneScore).' - '.$this->translateScore($this->playerTwoScore);
    }

    public function playerOneScores()
    {
        $this->playerOneScore++;
    }

    public function playerTwoScores()
    {
        $this->playerTwoScore++;
    }

    private function translateScore($score)
    {
        switch ($score) {
            case 0:
                return 'Love';
            
            case 1:
                return 'Fifteen';

            case 2:
                return 'Thirty';

            case 3:
                return 'Forty';
        }

        throw new \InvalidArgumentException('Bad score');
    }

    private function playerHaveSameScore()
    {
        return $this->playerOneScore == $this->playerTwoScore;
    }

    private function isDeuce()
    {
        return $this->playerHaveSameScore() && $this->playerOneScore >= 3;
    }

    private function hasAdvantage()
    {
        return (!$this->playerHaveSameScore() && $this->playerOneScore >= 3 && $this->playerTwoScore >= 3);
    }

    private function playerWithHighestScore()
    {
        return ($this->playerOneScore > $this->playerTwoScore) ? '1' : '2';
    }

    private function hasWinner()
    {
        return ($this->isPlayerOneWinning() || $this->isPlayerTwoWinning());
    }

    private function isPlayerOneWinning()
    {
        return ($this->playerOneScore >= 4 && $this->playerOneScore >= $this->playerTwoScore + 2);
    }

    private function isPlayerTwoWinning()
    {
        return ($this->playerTwoScore >= 4 && $this->playerTwoScore >= $this->playerOneScore + 2);
    }
}
