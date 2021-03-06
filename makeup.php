<?php 
session_start();
include('funcs.php');
loginCheck();



//2. DB接続します
try {
  //localhostの時はこれ。さくらの場合さくらのデータベースをいれる
  //Password:MAMP='root',XAMPP=''
  // $pdo = new PDO('mysql:dbname=aoi;charset=utf8;host=localhost','root','root');
  $pdo = new PDO('mysql:dbname=second-cube_aoi;charset=utf8;host=mysql57.second-cube.sakura.ne.jp','second-cube','insta123');
} catch (PDOException $e) {//$eにエラー内容が入っている。
  exit('DBConnectError:'.$e->getMessage());//ここのDBConnectErrorはエラー時の文字表示の為、ここはなんでも良い。この項目２は基本idとpass以外コピペで覚えればOK
}

if($_SERVER['REQUEST_METHOD'] != 'POST'){
//画像を取得
  
  //2．データ登録SQL作成
//prepare("")の中にはmysqlのSQLで入力したINSERT文を入れて修正すれば良いイメージ
$stmt = $pdo->prepare("SELECT* FROM aoi_hp_images2 ORDER BY indate DESC");//日付で登録が新しいものが上になる様に抽出
$status = $stmt->execute();
$images = $stmt->fetchAll();//今までなかった記述。画像のアップロード特有


}else{
  //1. POSTデータ取得
  //ここのFILESで[]されているimageはinput type=fileタグのname部分の名称
  $imgname = $_FILES['image']['name'];//ここのnameはアップロードされたファイルのファイル名
  $imgtype = $_FILES['image']['name'];//ここのtypeはアップロードされたファイルのMINEタイプ
  $imgcontent = file_get_contents($_FILES['image']['tmp_name']);
  $imgsize = $_FILES['image']['size'];//ここのnameはアップロードされたファイルのファイルサイズ


//３．データ登録SQL作成
//prepare("")の中にはmysqlのSQLで入力したINSERT文を入れて修正すれば良いイメージ
$stmt = $pdo->prepare("INSERT INTO aoi_hp_images2(imgname,imgtype,imgcontent,imgsize,indate)VALUES(:imgname,:imgtype,:imgcontent,:imgsize,sysdate());
");
$stmt->bindValue(':imgname', $imgname, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)  第３引数は省略出来るが、セキュリティの観点から記述している。文字列か数値はmysqlのデータベースに登録したものがvarcharaかintかというところで判断する
$stmt->bindValue(':imgtype', $imgtype, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':imgcontent', $imgcontent, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':imgsize', $imgsize, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();


//４．データ登録処理後（基本コピペ使用でOK)
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("SQLError:".$error[2]);//エラーが起きたらエラーの2番目の配列から取ります。ここは考えず、これを使えばOK
                             // SQLEErrorの部分はエラー時出てくる文なのでなんでもOK
}else{
  //５．index.phpへリダイレクト(エラーがなければindex.phpt)
  header('Location: makeup.php');//Location:の後ろの半角スペースは必ず入れる。
  exit();

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
  <link href="css/imags.css" rel="stylesheet">
  
</head>
<body>
<?php 
include('header.php');
?>

  <div class='contact-header'>
      <div class="container">
          <div class="contact-header-area">
        <div class=><img src="imgs/green.jpg" class="tama"></div>          
          </div>
      </div>
  </div>

 






  <form  class='upform' method='post' enctype='multipart/form-data'>
      <div class="form-group">
      <p>Upload File</p>
        <label class='fileUp'>
          Select Image
          <input type="file" name='image' required style="display:none;">
         </label>
         <button type='submit' class='Upbtn'>Upload</button>   

      </div>
     
  </form>          

  <div class="images-wrapper">
    <div class="container">
      <div class="images-area">
      <?php for($i = 0; $i <count($images); $i++): ?>
      <div class='upimgBox'>
        <a href="#">
          <img src="image.php?id=<?= $images[$i]['id']; ?>" width='100px' height='auto'>
        </a>
         <h5 class='imgsize'><?= $images[$i]['imgname']; ?> (<?= number_format($images[$i]['imgsize']/1000, 2); ?> KB)</h5>
        <a class='imgdelete' href="javascript:void(0);" onclick="var ok = confirm('削除しますか？'); if (ok) location.href='imgdelete.php?id=<?= $images[$i]['id']; ?> '">
          <i class="far fa-trash-alt"></i>Delete</a>
    </div>
    <?php endfor; ?>


      </div>
    </div>
  </div>
   <?php 
include('footer.php');
?>

</body>
</html>
