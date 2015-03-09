<?php
  class MySQL {
  
	  private $host;
	  private $user;
	  private $pass;
	  private $dbname;
	  protected $mysqli;
	  
	  //コンストラクタ
	  public function __construct(){
	  
		date_default_timezone_set('Asia/Tokyo'); 
		$this->host = "localhost";
		$this->user = "j12027";
		$this->pass = "j12027";
		$this->dbname = "j12027";
			  
		$this->mysqli = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
			$this->mysqli->set_charset("utf8");
			if ($this->mysqli->connect_error){
				//print("接続失敗！E . $mysqli->connect_error);
				exit();
			}
	  }
	  
	  //チE��トラクタ
	  public function __destruct() {
		  $this->mysqli->close();
	  }
	  
	function add($name, $comment){

		$stmt = $this->mysqli->prepare("INSERT INTO upload (name, comment) VALUES (?, ?)");
		$stmt->bind_param('ss', $name, $comment);
		$stmt->execute();
	}
	
	function insert($illustname, $groupId, $groupType){
		if($groupType == '0'){
			$result = $this->mysqli->query("SELECT COUNT(*) FROM paints");
			$num = $result->fetch_row();
			$groupId = $num[0] + 1;
		}
		$stmt = $this->mysqli->prepare("INSERT INTO paints (illustname, groupId, groupType) VALUES (?, ?, ?)");
		$stmt->bind_param('sii', $illustname, $groupId, $groupType);
		$stmt->execute();
	}

	function getFileName($number) {
	
		$result = mysql_query('SELECT illustname FROM paints WHERE id<=9');
		$row = mysql_fetch_assoc($result);
//		return $row;
		return "test";
	}
  }
?>