<?php

class Messages{
	public static function setMsg($txt,$type){
		if($type == 'error'){
			$_SESSION['errorMsg'] = $txt;
		}else{
			$_SESSION['successMsg'] = $txt;
		}
	}
	public static function display(){
		if(isset($_SESSION['errorMsg'])){
			echo '<div class="alert alert-danger">'.$_SESSION['errorMsg'].'</div>';
			unset($_SESSION['errorMsg']);
		}
		if(isset($_SESSION['successMsg'])){
			echo '<div class="alert alert-success">'.$_SESSION['successMsg'].'</div>';
			unset($_SESSION['successMsg']);
		}
	}
}

?>