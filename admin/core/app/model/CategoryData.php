<?php
class CategoryData {
	public static $tablename = "category";
	public $id;
	public $name;
	public $description;

	public function __construct(){
		$this->name = "";
		$this->description = "";
	}

	public function add(){
		$con = Database::getCon();
		$name = mysqli_real_escape_string($con, strip_tags($this->name));
		$description = mysqli_real_escape_string($con, strip_tags($this->description));
		$sql = "insert into category (name,description) ";
		$sql .= "value (\"$name\",\"$description\")";
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

// partiendo de que ya tenemos creado un objecto CategoryData previamente utilizamos el contexto
	public function update(){
		$con = Database::getCon();
		$name = mysqli_real_escape_string($con, strip_tags($this->name));
		$description = mysqli_real_escape_string($con, strip_tags($this->description));
		$sql = "update ".self::$tablename." set name=\"$name\",description=\"$description\" where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new CategoryData());
	}

	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new CategoryData());

	}
	
	public static function countAll(){
		$sql = "select count(*) as c from ".self::$tablename;
		$query = Executor::doit($sql);
		return $query[0]->fetch_array()["c"];
	}

	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where name like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new CategoryData());
	}


}

?>
