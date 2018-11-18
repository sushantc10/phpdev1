<?php
class ShareModel extends Modal{
	public function index(){
		$this->query('select * from shares');
		$rows = $this->resultSet();
		return $rows;
	}

	public function add(){
		$post =  filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

		if($post['submit']){
			$this->query('insert into shares (title,body,link,user_id) values(:title,:body,:link,:user_id)');
			$this->bind(':title',$post['title']);
			$this->bind(':body',$post['body']);
			$this->bind(':link',$post['link']);
			$this->bind(':user_id',1);
			$this->execute();
			//verify

			if($this->lastInsertId()){
				header('location:'.ROOT_URL.'shares');
			}

			return;
		}
	}
}
?>