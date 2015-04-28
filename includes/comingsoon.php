<?php
require_once 'PDOConfig.php';
class ComingSoonModel {
	private $_pdo = null;

	public function __construct() {
		$this->_pdo = new PDOConfig();
	}
	
	public function insert($email) {
		$created = new DateTime('NOW');

		$stmt = $this->_pdo->prepare("insert into user (user_email, user_created) values (:user_email, :user_created)");
		$stmt->bindParam(':user_email', $email);
		$stmt->bindParam(':user_created', $created->format(DateTime::ISO8601));
		$stmt->execute();

		return $stmt->errorCode();
	}
}
Header('Access-Control-Allow-Origin: http://www.feteimperiale.fr');
Header('Content-Type: application/json; charset=UTF8');

$news = new ComingSoonModel();
$result = $news->insert($_GET['email']);

switch($result) {
	case '23000':
		echo json_encode(array('code' => 400, 'msg' => 'Duplicate entry'));
		break;
	case '00000':
		echo json_encode(array('code' => 200, 'msg' => 'Success'));
		break;
	default:
		echo json_encode(array('code' => 500, 'msg' => 'Unknown error'));
}
