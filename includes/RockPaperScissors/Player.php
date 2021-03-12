<?php
declare(strict_types=1);

namespace RockPaperScissors;

class Player {
	
	/**
     * Array of user data
     *
     * @var array
     */
	private $values = [];
	
    /**
     * @param array
	 * @return void
     */
    public function __construct($params = []) {
		$this->values = $params;
    }

    /**
     * @param string
     */
    public function __get( $key ) : ?string {
		if (array_key_exists($key, $this->values)) {
			return $this->values[ $key ];
		}
    }

    /**
     * @param string
	 * @param mixed
     */
    public function __set( $key, $value ) : void {
        $this->values[ $key ] = $value;
    }
	
	/**
     * @param string
	 * @param boot
     */
	public function __isset($key) : bool {
        return array_key_exists($key, $this->values);
    }
	
    /**
     * @param string
     */
    public function __unset($key) : void {
        unset($this->values[$key]);
    }
	
	/**
 	 * @return void
     */
    private function __clone() { }

}