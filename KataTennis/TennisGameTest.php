<?php
include "TennisGame.php";

class TennisGameTest extends PHPUnit_Framework_TestCase
{
    private $game;

    public function setUp()
    {
        $this->game = new TennisGame();
    }
    
    public function testNewGameBeginsWithLoveA()
    {
        $this->assertEquals("Love All", $this->game->getScore());
    }

    public function testPlayerOneWinsFirstBall()
    {
        $this->createScore(1, 0);

        $this->assertEquals("Fifteen - Love", $this->game->getScore());
    }

    public function testPlayerTwoWinsFirstBall()
    {
        $this->createScore(0, 1);
        
        $this->assertEquals("Love - Fifteen", $this->game->getScore());
    }

    public function testTwoPlayersWinsOneBall()
    {
        $this->createScore(1, 1);

        $this->assertEquals("Fifteen All", $this->game->getScore());
    }

    public function testPlayerOneWinsTwoBalls()
    {
        $this->createScore(2, 0);

        $this->assertEquals("Thirty - Love", $this->game->getScore());
    }

    public function testPlayerTwoWinsTwoBalls()
    {
        $this->createScore(0, 2);

        $this->assertEquals("Love - Thirty", $this->game->getScore());
    }

    public function testPlayerOneWinsTwoBallsAndPlayerOneWinOneBall()
    {
        $this->createScore(1, 2);

        $this->assertEquals("Fifteen - Thirty", $this->game->getScore());
    }

    public function testPlayerOneWinsThreeBallsAndPlayerOneWinTwoBall()
    {
        $this->createScore(3, 2);

        $this->assertEquals("Forty - Thirty", $this->game->getScore());
    }

    public function testPlayerOneWinsOneBallAndPlayerOneWinsThreeBalls()
    {
        $this->createScore(1, 3);

        $this->assertEquals("Fifteen - Forty", $this->game->getScore());
    }

    public function testPlayersAreDeuce()
    {
        $this->createScore(3, 3);

        $this->assertEquals("Deuce", $this->game->getScore());
    }

    public function testPlayersAreDeuceWith4()
    {
        $this->createScore(4, 4);

        $this->assertEquals("Deuce", $this->game->getScore());
    }

    public function testAdvantagePlayer1()
    {
        $this->createScore(4, 3);

        $this->assertEquals("Avantage player 1", $this->game->getScore());
    }

    public function testAdvantagePlayer2With5Balls()
    {
        $this->createScore(4, 5);

        $this->assertEquals("Avantage player 2", $this->game->getScore());
    }

    public function testPlayer1WinsTheGame()
    {
        $this->createScore(4, 0);

        $this->assertEquals("Player 1 wins", $this->game->getScore());   
    }

    public function testPlayer2WinsTheGame()
    {
        $this->createScore(2, 4);

        $this->assertEquals("Player 2 wins", $this->game->getScore());   
    }

    public function testPlayer1WinsTheGameWithAdvantage()
    {
        $this->createScore(5, 3);

        $this->assertEquals("Player 1 wins", $this->game->getScore());   
    }

    public function testPlayer2WinsTheGameWithAdvantage()
    {
        $this->createScore(5, 7);

        $this->assertEquals("Player 2 wins", $this->game->getScore());   
    }

    private function createScore($playerOneScore, $playerTwoScore)
    {
        for ($score=0; $score < $playerOneScore; $score++) { 
            $this->game->playerOneScores();
        }

        for ($score=0; $score < $playerTwoScore; $score++) { 
            $this->game->playerTwoScores();
        }
    }
}
