<?php
class LikeData {
	public static $tablename = "heart";
	public $id;
	public $post_id;
	public $user_id;
	public $created_at;

	public function __construct(){
		$this->post_id = "";
		$this->user_id = "";
		$this->created_at = "NOW()";
	}

	public function add(){
		$sql = "insert into `".self::$tablename."` (post_id,user_id,created_at) ";
		$sql .= "value ($this->post_id,$this->user_id, NOW())";
		return Executor::doit($sql);
	}

	public static function delById($id){
		$sql = "delete from `".self::$tablename."` where id=$id";
		Executor::doit($sql);
	}

	public static function countByPost($post_id){
		$sql = "select count(*) as c from `".self::$tablename."` where post_id=$post_id";
		$query = Executor::doit($sql);
		return $query[0]->fetch_array()["c"];
	}

	public static function getByUserAndPost($user_id, $post_id){
		$sql = "select * from `".self::$tablename."` where user_id=$user_id and post_id=$post_id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new LikeData());
	}

	public static function countByUserKarma($user_id){
		$sql = "select count(*) as c from `".self::$tablename."` where post_id in (select id from post where user_id=$user_id)";
		$query = Executor::doit($sql);
		return $query[0]->fetch_array()["c"];
	}

}
?>
