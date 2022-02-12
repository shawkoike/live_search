<?php
  header('Content-Type: text/html; charset=UTF-8');
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="keywords" content="ライブ出演バンド募集,ライブ出演募集,ライブ出演者募集,ライブブッキング,社会人バンドライブ,コピーバンドライブ,弾き語り,ボーカル,おやじバンド,土日ライブ,都内ライブ" />
<title>ライブ検索サービス</title>
<meta name="viewport" content="width=device-width">
<meta name="description" content="イベント企画/制作/運営 MOHANAK(モハナック)が主催する、東京/名古屋/神奈川/大阪を中心に土日音楽ライブイベント出演者募集。社会人バンド、コピーバンド、週末限定、プロ志向、アマ問いません。" />


<link href="http://netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.css" rel="stylesheet">
<link rel="stylesheet" href="css/style.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script>
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
  <!--
  <header class="discription-header">
    <p>東京/神奈川/名古屋を中心に音楽イベントを展開する「イベント企画/制作/運営 MOHANAK(モハナック)</p>
  </header>
  -->
  <header class="header">
    <div class="header-inner">
      <div class="header-site">
        <div class="site">
  	  <h1>
	    <a href="http://mohanak.net/"><img src="img/logo-header.jpg" alt="ライブ出演検索サービスのロゴ" width="250" height="33"></a>
          </h1>
        </div>
      </div>
      
      <div class="header-nav">
        <button type="button" id="menubtn">
	  <i class="fa fa-bars"></i><span>MENU</span>
        </button>
        <nav class="menu" id="menu">
	  <ul>
	    <li><a href="http://mohanak.net/">トップ</a></li>
	    <li><a href="http://mohanak.com/about/" target="blank">事業紹介</a></li>
	    <li><a href="http://mohanak.com/contact/" target="blank">お問い合わせ</a></li>
	  </ul>
        </nav>
      </div>
    </div>
  </header>

  <div class="photo">
    <div class="top">
      <img src="img/top.jpg" alt="ライブ出演検索サービスのロゴ" class="topimg">
	<!--
	<p class="catch">土日出演可能ライブ検索サービス（仮）<br>
	  東京と名古屋で参加できるライブを検索できます。
	</p>
	-->
    </div>
  </div>

<?php
  $link = mysqli_connect('localhost', 'shaw', 'Shaw19940522', 'live');
  mysqli_set_charset($link,"utf8");
  $tokyo_live_data = mysqli_query($link, "SELECT * FROM m_live WHERE live_area_no = 12 AND disp_flg = 0 ORDER BY live_date_time LIMIT 5;");
  $aichi_live_data = mysqli_query($link, "SELECT * FROM m_live WHERE live_area_no = 22 AND disp_flg = 0 ORDER BY live_date_time LIMIT 5;");
  $kanagawa_live_data = mysqli_query($link, "SELECT * FROM m_live WHERE live_area_no = 13 AND disp_flg = 0 ORDER BY live_date_time LIMIT 5;");
  $osaka_live_data = mysqli_query($link, "SELECT * FROM m_live WHERE live_area_no = 26 AND disp_flg = 0 ORDER BY live_date_time LIMIT 5;");
  $week = [
	    '日', //0
	      '月', //1
	        '火', //2
		  '水', //3
		    '木', //4
		      '金', //5
		        '土', //6
  ];
?>

<div class="info">
  <div class="info-main">
    <!-- 東京都情報 -->
    <div class="news">
      <h1>東京新着情報</h1>
      <ul>
        <?php
  	  while($obj = $tokyo_live_data->fetch_object()) {
            $live_date = new DateTime($obj->live_date_time);
            echo('<li><a href="http://mohanak.net/info.php?liveCd='.$obj->sequence.'">');
	    $date = $live_date->format('Y-m-d');
	    $datetime = new DateTime($date);
	    $w = (int)$datetime->format('w');
	    if ($w == 0) {
	      echo('<time>'.$live_date->format('m/d').'<br />&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:red;">'.$week[$w].'</span></time>');
	    } else if ($w == 6) {
	      echo('<time>'.$live_date->format('m/d').'<br />&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:blue;">'.$week[$w].'</span></time>');
	    } else {
	      echo('<time>'.$live_date->format('m/d').'<br />&nbsp;&nbsp;&nbsp;&nbsp;<span>'.$week[$w].'</span></time>');
	    }
	    // ライブハウス名を取得する
            $live_place = mysqli_query($link, 'SELECT * FROM m_live_house WHERE live_house_no = '.$obj->live_house_no.';');
	    while($live_house = $live_place->fetch_object()) {
	      echo('<div class="text live_house">'.$live_house->live_house_name.'</div>');
            }
	    echo('<div class="text live_info">'.$obj->live_info."</div>");
            echo('</a></li>');
	  }
        ?>
      </ul>
      <a class="more" href="http://mohanak.net/result.php?area_no=12">もっと見る</a>
    </div>
    <!-- 愛知県情報 -->
    <div class="news">
      <h1>名古屋新着情報</h1>
      <ul>
        <?php
  	  while($obj = $aichi_live_data->fetch_object()) {
            $live_date = new DateTime($obj->live_date_time);
	    echo('<li><a href="http://mohanak.net/info.php?liveCd='.$obj->sequence.'">');
	    $date = $live_date->format('Y-m-d');
	    $datetime = new DateTime($date);
	    $w = (int)$datetime->format('w');
	    if ($w == 0) {
	      echo('<time>'.$live_date->format('m/d').'<br />&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:red;">'.$week[$w].'</span></time>');
	    } else if ($w == 6) {
	      echo('<time>'.$live_date->format('m/d').'<br />&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:blue;">'.$week[$w].'</span></time>');
	    } else {
	      echo('<time>'.$live_date->format('m/d').'<br />&nbsp;&nbsp;&nbsp;&nbsp;<span>'.$week[$w].'</span></time>');
	    }
	    // ライブハウス名を取得する
            $live_place = mysqli_query($link, 'SELECT * FROM m_live_house WHERE live_house_no = '.$obj->live_house_no.';');
	    while($live_house = $live_place->fetch_object()) {
	      echo('<div class="text live_house">'.$live_house->live_house_name.'</div>');
            }
	    echo('<div class="text live_info">'.$obj->live_info."</div>");
            echo('</a></li>');
	  }
        ?>
      </ul>
      <a class="more" href="http://mohanak.net/result.php?area_no=22">もっと見る</a>
    </div>
    <!-- 神奈川県情報 -->
    <div class="news">
      <h1>神奈川新着情報</h1>
      <ul>
        <?php
  	  while($obj = $kanagawa_live_data->fetch_object()) {
            $live_date = new DateTime($obj->live_date_time);
            echo('<li><a href="http://mohanak.net/info.php?liveCd='.$obj->sequence.'">');
	    $date = $live_date->format('Y-m-d');
	    $datetime = new DateTime($date);
	    $w = (int)$datetime->format('w');
	    if ($w == 0) {
	      echo('<time>'.$live_date->format('m/d').'<br />&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:red;">'.$week[$w].'</span></time>');
	    } else if ($w == 6) {
	      echo('<time>'.$live_date->format('m/d').'<br />&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:blue;">'.$week[$w].'</span></time>');
	    } else {
	      echo('<time>'.$live_date->format('m/d').'<br />&nbsp;&nbsp;&nbsp;&nbsp;<span>'.$week[$w].'</span></time>');
	    }
	    // ライブハウス名を取得する
            $live_place = mysqli_query($link, 'SELECT * FROM m_live_house WHERE live_house_no = '.$obj->live_house_no.';');
	    while($live_house = $live_place->fetch_object()) {
	      echo('<div class="text live_house">'.$live_house->live_house_name.'</div>');
            }
	    echo('<div class="text live_info">'.$obj->live_info."</div>");
            echo('</a></li>');
	  }
        ?>
      </ul>
      <a class="more" href="http://mohanak.net/result.php?area_no=13">もっと見る</a>
    </div>

    <!-- 大阪情報 -->
    <!--
    <div class="news">
      <h1>大阪新着情報</h1>
      <ul>
        <?php
  	  while($obj = $osaka_live_data->fetch_object()) {
            $live_date = new DateTime($obj->live_date_time);
            echo('<li><a href="http://mohanak.net/info.php?liveCd='.$obj->sequence.'">');
	    $date = $live_date->format('Y-m-d');
	    $datetime = new DateTime($date);
	    $w = (int)$datetime->format('w');
	    if ($w == 0) {
	      echo('<time>'.$live_date->format('m/d').'<br />&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:red;">'.$week[$w].'</span></time>');
	    } else if ($w == 6) {
	      echo('<time>'.$live_date->format('m/d').'<br />&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:blue;">'.$week[$w].'</span></time>');
	    } else {
	      echo('<time>'.$live_date->format('m/d').'<br />&nbsp;&nbsp;&nbsp;&nbsp;<span>'.$week[$w].'</span></time>');
	    }
	    // ライブハウス名を取得する
            $live_place = mysqli_query($link, 'SELECT * FROM m_live_house WHERE live_house_no = '.$obj->live_house_no.';');
	    while($live_house = $live_place->fetch_object()) {
	      echo('<div class="text live_house">'.$live_house->live_house_name.'</div>');
            }
	    echo('<div class="text live_info">'.$obj->live_info."</div>");
            echo('</a></li>');
	  }
        ?>
      </ul>
    </div>
    -->



  </div>

  <!-- サイドメニュー -->
  <div class="info-sub">
    <div class="follow">
      <ul>
	<!--
	<li>
          <div class="gaiyou">
            <a href="http://35.213.2.106/search.php">
              <i class="fa fa-music side-music"></i>
              <h1>ライブ検索はこちら</h1>
              <p>様々な条件から出演可能なライブ検索が可能です。</p>
            </a>
          </div>
	</li>
	-->

	<a href="tel:0428127000" class="btn-tel">お電話での問い合わせはこちらから</a>
	<li>
          <div class="gaiyou">
            <a href="http://mohanak.net/search.php">
              <img class="search_img" alt="ライブ出演検索導線" src="img/search.jpg" />
              <p>様々な条件から出演可能なライブが検索できます。</p>
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
	    <i><img class="side-img" alt="M運営会社ロゴ" src="img/mohanak.jpg" /></i>
	    MOHANAK（公式ページ）
	  </a>
	</li>
      </ul>
    </div>
  </div>
</div>

<a href="tel:0428127000">
  <img class="tel-fixed" src="./tel-b.png">
</a>

<footer class="footer">
<div class="footer-inner">
	<div class="copyright">
	<p>Copyright &copy; MOHANAK</p>
	</div>
</div>
</footer>


</body>
</html>

