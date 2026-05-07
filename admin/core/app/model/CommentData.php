<?php
class CommentData {
	public static $tablename = "comment";
	public $id;
	public $comment;
	public $post_id;
	public $user_id;
	public $created_at;
	public $status;

	public function __construct(){
		$this->comment = "";
		$this->post_id = "";
		$this->user_id = "";
		$this->created_at = "NOW()";
	}

	public function add(){
		$con = Database::getCon();
		$comment = mysqli_real_escape_string($con, strip_tags($this->comment));
		$sql = "insert into ".self::$tablename." (user_id,comment,post_id,status,created_at) ";
		$sql .= "value (\"$this->user_id\",\"$comment\",$this->post_id,2, NOW())";
		return Executor::doit($sql);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where id=$id";
		Executor::doit($sql);
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id=$this->id";
		Executor::doit($sql);
	}

// partiendo de que ya tenemos creado un objecto CommentData previamente utilizamos el contexto
	public function update(){
		$con = Database::getCon();
		$comment = mysqli_real_escape_string($con, strip_tags($this->comment));
		$sql = "update ".self::$tablename." set comment=\"$comment\" where id=$this->id";
		Executor::doit($sql);
	}

	public function accept(){
		$sql = "update ".self::$tablename." set status=2 where id=$this->id";
		Executor::doit($sql);
	}

	public function denied(){
		$sql = "update ".self::$tablename." set status=0 where id=$this->id";
		Executor::doit($sql);
	}


	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new CommentData());
	}

	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new CommentData());

	}

	public static function getPublicByPost($id){
		$sql = "select * from ".self::$tablename." where post_id=$id and status=2" ;
		$query = Executor::doit($sql);
		return Model::many($query[0],new CommentData());
	}

	public static function countByPost($id){
		$sql = "select count(*) as c from ".self::$tablename." where post_id=$id and status=2";
		$query = Executor::doit($sql);
		return $query[0]->fetch_array()["c"];
	}

	public static function countByUser($id){
		$sql = "select count(*) as c from ".self::$tablename." where user_id=$id and status=2";
		$query = Executor::doit($sql);
		return $query[0]->fetch_array()["c"];
	}
	
	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where name like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new CommentData());
	}


}

?>