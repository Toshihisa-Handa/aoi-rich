<?php 
print_r($_FILES);
$path = './uplode/';

// ファイルがアップロードされているかと、POST通信でアップロードされたかを確認
if( !empty($_FILES['file1']['tmp_name']) && is_uploaded_file($_FILES['file1']['tmp_name']) ) {

  $filename = uniqid().'.jpg';
	// ファイルを指定したパスへ保存する
	if( move_uploaded_file( $_FILES['file1']['tmp_name'], $path.$filename) ) {
		echo 'アップロードされたファイルを保存しました。';
	} else {
		echo 'アップロードされたファイルの保存に失敗しました。';
	}
}

?>