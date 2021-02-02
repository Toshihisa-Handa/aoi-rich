<?php
session_start();
include('funcs.php');//別の階層にfuncs.phpがある場合は「betukaisou/funcs.php」などパスを変えてincludesする
loginCheck();


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
$stmt = $pdo->prepare("SELECT* FROM aoi_hp_contact");
$status = $stmt->execute();


//3．データ登録処理後（基本コピペ使用でOK)
$viewDate='';
$viewName='';
$viewEmail='';
$viewMessage='';
$view='';
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("SQLError:".$error[2]);//エラーが起きたらエラーの2番目の配列から取ります。ここは考えず、これを使えばOK
                             // SQLEErrorの部分はエラー時出てくる文なのでなんでもOK
}else{
 //selectデータの数だけ自動でループしてくれる

  while( $r = $stmt->fetch(PDO::FETCH_ASSOC)){
    //  $view.='<p>'.$r['id'].$r['name'].$r['author'].$r['kan'].$r['kansou'].$r['indate'].'</p>';
  
    //更新用リンクを埋め込んだ表示コード(元のselect.phpから修正する箇所)
    $view .='<p class="contactBox">'.'Date : '.$r['indate'];
    //以下はupdateのリンクタグの記述
    $view .='  ';
    $view .='<a class="contactLink" href="u_view.php? id='.$r["id"].'">';
    $view .='[Update]';
    $view .='</a>';
    //以下はdeleteのリンクタグの記述
    $view .='  ';
    $view .='<a class="contactLink" href="delete.php? id='.$r["id"].'">';
    $view .='[Delete]';
    $view .='</a>'.'<br>';
    $view .='Name : '.$r['name'].'<br>';
    $view .='Email : '.$r['email'].'<br>';
    $view .='Message : '.'<br>'.$r['message'];  
    $view .='</p>';
   }


}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="css/style.css" rel="stylesheet">
  <link href="css/con.css" rel="stylesheet">

</head>
<body>

<?php 
include('header.php');
?>
  <div class='contact-header'>
      <div class="container">
          <div class="contact-header-area">
          <div class=><img src="imgs/contact.jpg" class="tama"></div>          
          </div>
      </div>
  </div>
<!-- 結果の表示 -->
  <div class="main-wrapper">
    <div class="container">
      <div class="main-area">
        <h2>Send your Message</h2>
      </div>
    </div>
  </div>

  <div class="form-wrapper">
      <div class="container">
          <div class="form-area">
            <form class='answerBox' action="contactw.php"  method='post'>
            <div class='formBox'>

              <p class='answer'> <?=$view?></p>

             </div>            
            </form>
     
          </div>
      </div>
   </div>






   <?php 
include('footer.php');
?>

</body>
</html>
