<?php
declare(strict_types=1);

use RockPaperScissors\GameRound as GameRound;
use PHPUnit\Framework\TestCase;

class GameRoundTest extends TestCase {

    /**
     *
     * @var PHPUnit\Framework\TestCase
     */
    protected $gameRoundMock;
	
	/**
     *
     * @var GameRound
     */
    protected $classObj;
	
	/**
     *
     * @var array
     */
    protected $data;

	protected function setUp(): void { 
		$this->gameRoundMock = $this->getMockBuilder(GameRound::class)
							->disableOriginalConstructor()
							->getMock();
							
		$this->classObj = new GameRound();
		
		$this->data = [
			'Rock',
			'Paper',
			'Scissors',
		];
	}
	
	public function testGetOptionsMethod() {
		$this->assertIsArray($this->classObj::getOptions());
	}
	
	
	public function testGetOptionsStub(){
		$array = ['option1', 'option2', 'option3'];
		
		$this->gameRoundMock->expects($this->any())
			 ->method('getOptions')
             ->will($this->returnValue($array));
			 
		$this->assertIsArray($this->classObj::getOptions());
	}
	
	public function testPlayerChoiceMethodInvalidParameter(){
		$empty ='N\A';
		$string = 'some string';
		
		$this->gameRoundMock->expects($this->any())
			 ->method('player')
			 ->with($this->equalTo($string))
             ->will($this->returnValue($empty));
			 
		$this->assertEquals($empty, $this->gameRoundMock->player($string));
	}
	
	public function testPlayerChoiceMethod(){
		$playerChoice = $this->data[0];
		
		$this->gameRoundMock->expects($this->any())
			 ->method('player')
			 ->with($this->equalTo($playerChoice))
             ->will($this->returnValue($playerChoice));
			 
		$this->assertEquals($playerChoice, $this->gameRoundMock->player($playerChoice));	
		$this->assertContains($this->gameRoundMock->player($playerChoice), $this->data);
	}
	
	public function testComputerChoiceMethod() {	
		$computerChoice = $this->data[0];
		$this->gameRoundMock->expects($this->any())
			 ->method('computer')
             ->will($this->returnValue($computerChoice));
			 
		$this->assertEquals($computerChoice, $this->gameRoundMock->computer());
	}
}
