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
<link rel="stylesheet" href="css/style-result.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-126289985-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-126289985-2');
</script>
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
  $link = mysqli_connect('localhost', 'shaw', 'Shaw19940522', 'live');
  mysqli_set_charset($link,"utf8");
  if ($_POST["area_no"]) {
    $live_data = mysqli_query($link, "SELECT * FROM m_live INNER JOIN m_live_house ON m_live_house.live_house_no = m_live.live_house_no INNER JOIN m_prefecture ON m_live.live_area_no = m_prefecture.id WHERE live_area_no = ".$_POST["area_no"].' AND live_date_time >= "'.str_replace('/', '-', $_POST["date"]).'-01 00:00:00" AND live_date_time <="'.str_replace('/', '-', $_POST["date"]).'-31 23:59:59";');
  } else if ($_GET["area_no"]) {
    $live_data = mysqli_query($link, "SELECT * FROM m_live INNER JOIN m_live_house ON m_live_house.live_house_no = m_live.live_house_no INNER JOIN m_prefecture ON m_live.live_area_no = m_prefecture.id WHERE live_area_no = ".$_GET["area_no"]);
  }
?>

<div class="info">
  <div class="info-main">
    <?php
      while($obj = $live_data->fetch_object()) {
        echo('<div class="cp_card04">');
	  echo('<div class="details">');
	    echo('<div class="category">');
	      echo('<p>'.$obj->live_house_area.'</p>');
	    echo('</div>');
	  echo('</div>');
          echo('<div class="description">');
	    echo('<h1>'.$obj->live_house_name.'</h1>');
	    echo('<div class="text">');
              $live_date = new DateTime($obj->live_date_time);
	      echo('<p>開催日 : '.$live_date->format("m/d").'</p>');
	      echo('<p>'.$obj->live_info.'</p>');
	      echo('<a href="http://35.213.2.106/info.php?liveCd='.$obj->sequence.'" class="">詳しく見る</a>');
	    echo('</div>');
	  echo('</div>');
	echo('</div>');
      }
    ?>
  </div>
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

