<?php
//image.phpをコピペして作る


//1. DB接続します
try {
  //localhostの時はこれ。さくらの場合さくらのデータベースをいれる
  //Password:MAMP='root',XAMPP=''
  // $pdo = new PDO('mysql:dbname=aoi;charset=utf8;host=localhost','root','root');
  $pdo = new PDO('mysql:dbname=second-cube_aoi;charset=utf8;host=mysql57.second-cube.sakura.ne.jp','second-cube','insta123');
} catch (PDOException $e) {//$eにエラー内容が入っている。
  exit('DBConnectError:'.$e->getMessage());//ここのDBConnectErrorはエラー時の文字表示の為、ここはなんでも良い。この項目２は基本idとpass以外コピペで覚えればOK
}


//2．データ登録SQL作成
//prepare("")の中にはmysqlのSQLで入力したINSERT文を入れて修正すれば良いイメージ
$stmt = $pdo->prepare("DELETE FROM aoi_hp_images2 WHERE id =:id");
$stmt->bindValue(':id', (int)$_GET['id'], PDO::PARAM_INT);  //画像投稿で初めてみた処理
$status = $stmt->execute();




//４．データ登録処理後（基本コピペ使用でOK)
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("SQLError:".$error[2]);//エラーが起きたらエラーの2番目の配列から取ります。ここは考えず、これを使えばOK
                             // SQLEErrorの部分はエラー時出てくる文なのでなんでもOK
}else{
  //５．index.phpへリダイレクト(エラーがなければindex.phpt)
  header('Location:makeup.php');//初めてみる処理
  exit();

}
  




?>
