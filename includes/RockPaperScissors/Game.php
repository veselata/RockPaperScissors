<?php
declare(strict_types=1);

namespace RockPaperScissors;

use RockPaperScissors\GameRound as GameRound;

class Game {

    /**
     * @var integer
     */
	protected $winnerStatus = 0;
	
	/**
     * @var integer
     */
	protected $totalRound = 3;
	
	/**
     *
     * @param integer $rounds
     * @return void
     */
	public function playRounds(int $rounds = 3) {
		$this->totalRound = $rounds;
	}

	/**
     *
     * @param string $human
     * @param string $computer
     */
	public function play($human, $computer) {
		if(!in_array($human, GameRound::getOptions()) || 
		   !in_array($computer, GameRound::getOptions()) || 
		   $human == GameRound::PICK_EMPTY
		) {	
			print "Please select an option below.\n";
		} else {
		
		$output = "You picked $human, Computer picked $computer.\n";
		
		switch ($human) {
			case GameRound::PICK_ROCK:
				if($computer == GameRound::PICK_SCISSORS) {
				   $output .= "Rock blunts Scissors.\n";
				   $this->winnerStatus = 1;
				} elseif($computer == GameRound::PICK_PAPER) {
				   $this->winnerStatus = 2;
				} else {
					$this->winnerStatus = 3;
				}
				break;
			case GameRound::PICK_PAPER:
				if($computer == GameRound::PICK_ROCK) {
				   $output .= "Paper wraps Rock.\n";
				   $this->winnerStatus = 1;
				} elseif($computer == GameRound::PICK_SCISSORS) {
				   $this->winnerStatus = 2;
				} else {
					$this->winnerStatus = 3;
				}
				break;
			case GameRound::PICK_SCISSORS:
				if($computer == GameRound::PICK_PAPER) {
				   $output .= "Scissors cut Paper.\n";
				   $this->winnerStatus = 1;
				} elseif($computer == GameRound::PICK_ROCK) {
					$this->winnerStatus = 2;
				} else {
					$this->winnerStatus = 3;				
				}
				break;
			default:
				$output .= "Something went wrong.\n";
		}
		
			return $output;
		}	
	}
	
	/**
     *
     * @return string
     */
    public function getWinnerStatus() {
        return $this->winnerStatus;
    }

	public function winner(){
		$output = '';
		
		switch ($this->winnerStatus) {
			case 0:
				break;
			case 1:
				$output .= "You win!\n";
				break;
			case 2:
				$output .= "The computer wins.\n";
				break;
			case 3:
				$output .= "It's a draw.\n";
				break;
			default:
				$output .= "Something went wrong.\n";
		}
		return $output;
	}
	
}