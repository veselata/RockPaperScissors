<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use RockPaperScissors\Player as Player;

class PlayerTest extends TestCase {

    /**
     *
     * @var RockPaperScissors\Player
     */
    protected $classObj;
	
	/**
     *
     * @var array
     */
    protected $data;
	
	protected function setUp(): void { 
		$this->data = [
			'username' => 'username',
			'nickname' => 'nickname',
			'score' => '0',
		];
		
		$this->classObj = new Player($this->data);
	}

	public function testConstructorMethod() {
		$this->assertClassHasAttribute('values', get_class($this->classObj));
		
		$this->assertEquals($this->data['username'], $this->classObj->username);
        $this->assertEquals($this->data['nickname'], $this->classObj->nickname);
        $this->assertEquals($this->data['score'], $this->classObj->score);

	}
	
	public function testGetMethodNotEqual() {
		$username = 'admin';
		
		$this->assertNotEquals($username, $this->classObj->username);
	}

	public function testGetMethod() {
		$username = 'username';
		
		$this->assertEquals($username, $this->classObj->username);
	}
	
	public function testSetMethodProperty() {
		$username = 'player';
		$this->classObj->username = $username;
		
		$this->assertEquals($username, $this->classObj->username);
	}
	
	public function testSetMethodAddProperty() {
		$username = 'username';
		$this->classObj->player = $username;
		
		$this->assertEquals($username, $this->classObj->player);
	}
	
	public function testIssetMethod() {
		$this->assertTrue(isset($this->classObj->username));
	}
	
	public function testIssetMethodInvalidProperty() {
		$this->assertFalse(isset($this->classObj->unknown));
	}
	
	public function testUnsetMethod() {
		$this->assertArrayHasKey('username', $this->data);
		unset($this->classObj->username);
		
		$this->assertFalse(isset($this->classObj->username));
	}
}
