<?php
  header('Content-Type: text/html; charset=UTF-8');
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>ライブ検索サービス</title>
<meta name="viewport" content="width=device-width">

<link href="http://netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.css" rel="stylesheet">
<link rel="stylesheet" href="css/style-info.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script>
$(function(){
	$("#menubtn").click(function(){
		$("#menu").slideToggle();
	});

});
</script>
</head>
<body>
  <header class="header">
    <div class="header-inner">
      <div class="header-site">
        <div class="site">
  	  <h1>
	    <a href="http://mohanak.net/"><img src="img/logo-header.jpg" alt="Mohanak logo" width="250" height="33"></a>
          </h1>
        </div>
      </div>
      
      <div class="header-nav">
        <button type="button" id="menubtn">
	  <i class="fa fa-bars"></i><span>MENU</span>
        </button>
        <nav class="menu" id="menu">
	  <ul>
	    <li><a href="http://mohanak.net">トップ</a></li>
	    <li><a href="http://mohanak.com/about/" target="blank">事業紹介</a></li>
	    <li><a href="http://mohanak.com/contact/" target="blank">お問い合わせ</a></li>
	  </ul>
        </nav>
      </div>
    </div>
  </header>

<?php
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

  require 'PHPMailer/vendor/autoload.php';

  $mail = new PHPMailer(true);
  try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = '';
    $mail->Password = '';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587; 
    $mail->setFrom('shaw.koike@gmail.com', 'From System mohanak.net');
    $mail->addAddress('info@mohanak.com', 'Mohanak'); 
    $mail->isHTML(true);
    echo('<h1>'.$_POST["cpipr01"].'</h1>');
    if ($_POST["cpipr02"] == "commit") {
      $mail->Subject = "From System mohanak.net(Commit Form)";
    } else {
      $mail->Subject = "From System mohanak.net(FAQ Form)";
    }
    $mail->Body    = '日付 : '.$_POST["date"].'<br />ライブハウス : '.$_POST["live_house"].'<br /><br />代表者氏名 : '.$_POST["daihyo-name"].'<br />メールアドレス : '.$_POST["email"].'<br />電話番号 : '.$_POST["tel"].'<br /><br />特記事項 : '.$_POST["content"];
    $mail->AltBody = '';

    $mail->send();

    echo('<div class="info">');
    echo('<div class="message info-main">');
    echo('<h3>お問い合わせありがとうございます。</h3>');
    echo('<h3>２〜３日営業日以内に担当者よりご連絡いたします。</h3>');
    echo('<h3>折り返しの連絡がない場合はお手数ですが info@mohanak.com までお問い合わせください。</h3>');
    echo('</div>');
  } catch (Throwable $e) {
    echo('<div class="info">');
    echo('<div class="error info-main">');
    echo('<h3>申し訳ございません。エラーが発生しました。</h3>');
    echo('<h3>もう一度最初からやり直すか info@mohanak.com までお問い合わせください。</h3>');
    echo('</div>');
  }
?>

  <!-- サイドメニュー -->
  <div class="info-sub">
    <div class="follow">
      <ul>
	<li>
          <div class="gaiyou">
            <a href="http://35.213.2.106/search.php">
	      <img class="search_img" src="img/search.jpg" />
              <p>様々な条件から出演可能なライブ検索が可能です。</p>
            </a>
          </div>
	</li>

        <p class="follow-info">最新情報はこちらでも配信しています</p>

        <li>
          <a href="https://twitter.com/MOHANAK_info" class="follow-tw">
	    <i class="fa fa-fw fa-twitter"></i>
	    Twitter
	  </a>
        </li>
	<li>
          <a href="https://www.facebook.com/mohanak087/" class="follow-fb">
	    <i class="fa fa-fw fa-facebook"></i>
	    Facebook
	  </a>
        </li>
	<li>
	  <a href="http://mohanak.com/" class="follow-mohanak">
	    <i><img class="side-img" src="img/mohanak.jpg" /></i>
	    MOHANAK
	  </a>
	</li>
      </ul>
    </div>
  </div>
</div>

<footer class="footer">
<div class="footer-inner">
	<div class="copyright">
	<p>Copyright &copy; MOHANAK</p>
	</div>
</div>
</footer>


</body>
</html>

