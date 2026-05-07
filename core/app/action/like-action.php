<?php
if(isset($_SESSION["user_id"])){
	$post_id = $_GET["post_id"];
	$user_id = $_SESSION["user_id"];

	$like = LikeData::getByUserAndPost($user_id, $post_id);
	if($like == null){
		$l = new LikeData();
		$l->post_id = $post_id;
		$l->user_id = $user_id;
		$l->add();
	}
	Core::redir("./?view=post&id=$post_id");
}else{
	Core::redir("./?view=login");
}
?>
