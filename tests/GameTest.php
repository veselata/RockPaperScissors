<?php
declare(strict_types=1);

use RockPaperScissors\Game as Game;
use PHPUnit\Framework\TestCase;

class GameTest extends TestCase {

    /**
     *
     * @var PHPUnit\Framework\TestCase
     */
    protected $gameMock;
	
	/**
     *
     * @var Game
     */
    protected $classObj;
	
	/**
     *
     * @var array
     */
    protected $data;

	protected function setUp(): void { 
		$this->gameMock = $this->getMockBuilder(Game::class)
							->disableOriginalConstructor()
							->getMock();
							
		$this->classObj = new Game();
		
		$this->data = [
			'Rock',
			'Paper',
			'Scissors',
		];
	}

	public function testConstructorMethod() {
		$this->assertClassHasAttribute('winnerStatus', get_class($this->classObj));
		$this->assertClassHasAttribute('totalRound', get_class($this->classObj));
	}

	public function testPlayerChoiceMethod() {
		$number = 10;
		
		$this->gameMock->expects($this->any())
			 ->method('playRounds')
			 ->with($this->equalTo($number));
			 
		$reflection = new \ReflectionClass($this->classObj);
		$reflection_property = $reflection->getProperty('totalRound');
		$reflection_property->setAccessible(true);
		$reflection_property->setValue($this->classObj, $number);
			 
		$this->assertSame($this->classObj->playRounds($number), $this->gameMock->playRounds($number));
	}
	
	public function testPlayerChoiceMethodInvalidParameter(){
		$string = "number";
		$this->expectException(\TypeError::class);
		
		$this->classObj->playRounds($string);
	} 
	
	public function testPlayMethod() {
		$human = $this->data[0];
		$computer = $this->data[1];
		$message = "You picked $human, Computer picked $computer.";
		
		$this->gameMock->expects($this->any())
			 ->method('play')
			 ->with($this->equalTo($human), $this->equalTo($computer))
             ->will($this->returnValue($message));
			 
		$this->assertEquals($message, $this->gameMock->play($human, $computer));
	}

	public function testPlayMethodInvalidParameters() {
		$human = 'human';
		$computer = 'computer';
		$message = 'Please select an option below';
		
		$this->gameMock->expects($this->any())
			 ->method('play')
			 ->with($this->equalTo($human), $this->equalTo($computer))
             ->will($this->returnValue($message));
			 
		$this->assertEquals($message, $this->gameMock->play($human, $computer));
	}
	
	public function testWinnerMethod() {
		$status = $this->classObj->getWinnerStatus();
		
		$this->gameMock->expects($this->any())
			 ->method('winner');

		$this->assertEmpty($this->gameMock->winner());
	}
	
	public function testWinnerMethodInvalidStatus() {
		$status = 10;
		$message = "Something went wrong";
		
		$this->gameMock->expects($this->any())
			 ->method('winner')
			 ->will($this->returnValue($message));

		$this->assertEquals($message, $this->gameMock->winner());
	}
	
	public function testGetWinnerStatusMethod() {	
		$status = 5;
		$this->gameMock->expects($this->any())
			 ->method('getWinnerStatus')
             ->will($this->returnValue($status));
			 
		$this->assertEquals($status, $this->gameMock->getWinnerStatus());
	}
}