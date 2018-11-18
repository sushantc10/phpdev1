<?php
 
require 'classes/database.php';


$database = new Database();
$post = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
if($post['submit']){
	$id = $post['id'];
	$title = $post['title'];
	$body  = $post['body'];

	$database->query('update posts set title = :title,body=:body where id = :id');

	//$database->query('insert into posts (title,body) values(:title,:body)');
	$database->bind(':title',$title);
	$database->bind(':body',$body);
	$database->bind(':id',$id);
	$database->execute();

	/*if($database->lastInsertId()){
		echo '<p>Post Added</p>';
	}else{
		echo "not added";
	}*/
}
if($_POST['delete']){
	$delete_id = $_POST['delete_id'];

	$database->query('delete from posts where id = :id');
	$database->bind(':id',$delete_id);
	$database->execute();

}

$database->query('select * from posts');
//$database->bind(':id',1);

$rows = $database->resultset();
?>
<h1>Add Post</h1>
<form method="post" action="<?php $_SERVER['PHP_SELF'];?>">
	<label>Post Id</label>
	<input type="text" name="id" placeholder="specify id..."><br/><br/>
	<label>Post Title</label>
	<input type="text" name="title" placeholder="Add a title..."><br/><br/>
	<label>Post Body</label>
	<textarea name="body"></textarea><br/><br/>
	<input type="submit" name="submit" value="Submit">
</form>

<h1>POSTS</h1>
<div>
<?foreach($rows as $row):?>
	<div>
			<h3><?php echo $row['title'];?></h3>
			<p><?php echo $row['body'];?></p><br/>
			<form method="post" action="<?php $_SERVER['PHP_SELF'];?>">
				<input type="hidden" name="delete_id" value="<?php echo $row['id'];?>">
				<input type="submit" name="delete" value="Delete">
			</form>
	</div>
<?php endforeach;?>
</div>