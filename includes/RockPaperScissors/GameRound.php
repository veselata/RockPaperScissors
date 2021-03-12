<?php
declare(strict_types=1);

namespace RockPaperScissors;

class GameRound {

	const PICK_EMPTY = 'N\A';
	const PICK_ROCK = 'Rock';
	const PICK_PAPER = 'Paper';
	const PICK_SCISSORS = 'Scissors';
	
	/**
     *
     * @return array
     */
	public static function getOptions() : array {
		return [
			self::PICK_ROCK,
			self::PICK_PAPER,
			self::PICK_SCISSORS,
		];
	}
	
	/**
     *
     * @return array
     */
	public function player($choice) {
		if(!empty($choice)){
			$string = ucfirst($choice);
			if(in_array($string, self::getOptions())) {
				return $string;
			}
		}
		return self::PICK_EMPTY;	
	}

	/**
     *
     * @return array
     */
	public function computer() {
		$options = self::getOptions();
		return $options[array_rand($options)];
	}
}