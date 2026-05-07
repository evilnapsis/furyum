<?php
class PostData {
	public static $tablename = "post";
	public $id;
	public $title;
	public $brief;
	public $content;
	public $image;
	public $created_at;
	public $status;
	public $category_id;
	public $user_id;

	public function __construct(){
		$this->title = "";
		$this->content = "";
		$this->image = "";
		$this->category_id = "";
		$this->user_id = "";
		$this->created_at = "NOW()";
	}

	public function add(){
		$con = Database::getCon();
		$title = mysqli_real_escape_string($con, strip_tags($this->title));
		$brief = mysqli_real_escape_string($con, strip_tags($this->brief));
		$content = mysqli_real_escape_string($con, strip_tags($this->content));
		$sql = "insert into ".self::$tablename." (title,brief,content,category_id,image,user_id,created_at) ";
		$sql .= "value (\"$title\",\"$brief\",\"$content\",$this->category_id,\"$this->image\",$this->user_id, NOW())";
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

// partiendo de que ya tenemos creado un objecto PostData previamente utilizamos el contexto
	public function update(){
		$con = Database::getCon();
		$title = mysqli_real_escape_string($con, strip_tags($this->title));
		$brief = mysqli_real_escape_string($con, strip_tags($this->brief));
		$content = mysqli_real_escape_string($con, strip_tags($this->content));
		$sql = "update ".self::$tablename." set title=\"$title\",brief=\"$brief\",content=\"$content\",image=\"$this->image\",category_id=\"$this->category_id\",status=$this->status where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new PostData());
	}

	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new PostData());

	}

	public static function getAllByUser($id){
		$sql = "select * from ".self::$tablename." where user_id=$id order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new PostData());

	}
	
		public static function getAllActive(){
		$sql = "select * from ".self::$tablename." where status=1";
		$query = Executor::doit($sql);
		return Model::many($query[0],new PostData());

	}

			public static function getAllByCat($id){
		$sql = "select * from ".self::$tablename." where category_id=$id and status=1 order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new PostData());

	}

	public static function getRecentByCat($id, $limit=10){
		$sql = "select * from ".self::$tablename." where category_id=$id and status=1 order by created_at desc limit $limit";
		$query = Executor::doit($sql);
		return Model::many($query[0],new PostData());
	}

	public static function countAll(){
		$sql = "select count(*) as c from ".self::$tablename;
		$query = Executor::doit($sql);
		return $query[0]->fetch_array()["c"];
	}

	public static function countByCat($id){
		$sql = "select count(*) as c from ".self::$tablename." where category_id=$id";
		$query = Executor::doit($sql);
		return $query[0]->fetch_array()["c"];
	}

	public static function countByUser($id){
		$sql = "select count(*) as c from ".self::$tablename." where user_id=$id";
		$query = Executor::doit($sql);
		return $query[0]->fetch_array()["c"];
	}

	public static function getRecent($limit=10){
		$sql = "select * from ".self::$tablename." order by created_at desc limit $limit";
		$query = Executor::doit($sql);
		return Model::many($query[0],new PostData());
	}

	public static function getSearch($q, $limit=25){
		$sql = "select * from ".self::$tablename." where (title like '%$q%' or content like '%$q%') and status=1 order by created_at desc limit $limit";
		$query = Executor::doit($sql);
		return Model::many($query[0],new PostData());
	}

	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where name like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new PostData());
	}


}

?>
