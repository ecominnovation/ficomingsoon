<?php
class PDOConfig extends PDO {
	private $_engine;
	private $_host;
	private $_database;
	private $_user;
	private $_pass;

	public function __construct() {
		$this->_engine 	= 	'mysql';
		$this->_host	=	'localhost';
		$this->_database=	'comingsoon';
		$this->_user	=	'root';
		$this->_pass	=	'root';

		$dns = $this->_engine . ':dbname=' . $this->_database . ';host=' . $this->_host;
		parent::__construct( $dns, $this->_user, $this->_pass );
	}
}
