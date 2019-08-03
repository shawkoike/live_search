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
  $live_data = mysqli_query($link, "SELECT * FROM m_live INNER JOIN m_live_house ON m_live_house.live_house_no = m_live.live_house_no INNER JOIN m_prefecture ON m_live.live_area_no = m_prefecture.id WHERE sequence = ".$_GET["liveCd"].";");
?>

<div class="info">
  <div class="info-main">
    <!-- 東京都情報 -->
    <div class="news">
      <h1>ライブ詳細情報</h1>
      <ul>
        <?php
          $live_date_info = "";
          $live_house_info = "";
  	  while($obj = $live_data->fetch_object()) {
	    if ($obj->image_src != "") {
	      echo('<div class="eventImg"><img width=100% height=100% src="'.$obj->image_src.'" /></div>');
	    }
	    $live_date = new DateTime($obj->live_date_time);
	    $live_date_info = $live_date;
	    $live_house_info = $obj->live_house_name;
	    echo('<ul class="cp_list" title="List">');
	    echo('<li>');
	    echo('<div class="text live_datetime">日程：'.$live_date->format("Y/m/d")."</div>");
	    echo('</li>');
	    echo('<li>');
	    echo('<div class="text event_name">公演：'.$obj->event_name."</div>");
	    echo('</li>');
            echo('<li>');
	    echo('<div class="text live_house_name">'.$obj->web_page.'会場：'.$obj->live_house_name."</div>");
	    echo('</li>');
	    echo('<li>');
	    echo('<div class="text live_house_area">場所：'.$obj->live_house_prefecture."#".$obj->live_house_area."</div>");
	    echo('</li>');
	    echo('<li>');
	    echo('<div class="text live_house_play">演奏：'.$obj->play."</div>");
	    echo('</li>');
	    echo('<li>');
	    echo('<div class="text live_house_quota">出演条件：'.$obj->quota."</div>");
	    echo('</li>');
	    if ($obj->href_url != "") {
		echo('<li>');
		  echo('<div class="text live_house_name">');
	    	    echo('イベント詳細ページ：<a href="'.$obj->href_url.'">'.$obj->href_url.'</a>');
		  echo('</div>');
	    	echo('</li>');
	    }
	    echo('<li>');
	    echo('<div class="text live_house_name">備考：'.$obj->live_info."</div>");
	    echo('</li>');
	  }
        ?>
      </ul>
    </div>
    <!-- 登録フォーム -->
    <div class="form-title">
        <div class="form-wrapper">
	  <h2>出演希望 / 問い合わせ</h2>
          <form action="/send.php" method="post">
            <!-- 日程 -->
            <div class="form-item">
	      <p>日程：<?php echo($live_date_info->format("Y/m/d")) ?></p>
	      <?php
	        echo('<input type="hidden" name="date" value="'.$live_date_info->format("Y/m/d").'" />');
                echo('<input type="hidden" name="live_sequence" value="'.$_GET["liveCd"].'" />');
              ?>
	    </div>
            <!-- ライブハウス -->
            <div class="form-item">
	    <p>会場：<?php echo($live_house_info) ?></p>
            <?php echo('<input type="hidden" name="live_house" value="'.$live_house_info.'" />'); ?>
            <div class="cp_ipradio">
	      <label>
	        <input type="radio" class="option-input radio" name="cpipr02" value="commit" checked />
	        出演希望
	      </label>
	      <label>
	        <input type="radio" class="option-input radio" name="cpipr02" value="qa" />
	        お問い合わせ
	      </label>
	    </div>
            <!-- アーティスト名 -->
            <div class="form-item">
              <input type="name" name="artist-name" required="required" placeholder="出演者名"></input>
	    </div>
	    <!-- 代表者名 -->
            <div class="form-item">
	      <input type="name" name="daihyo-name" required="required" placeholder="代表者氏名"></input>
            </div>
            <!-- メールアドレス -->
            <div class="form-item">
              <label for="email"></label>
              <input type="email" name="email" required="required" placeholder="メールアドレス"></input>
	    </div>
            <!-- 電話番号 -->
            <div class="form-item">
              <input type="tel" name="tel" required="required" placeholder="電話番号"></input>
            </div>
            <!-- お問い合わせ内容 -->
            <div class="form-content">
              <textarea name="content" placeholder="お問い合わせ内容" ></textarea>
            </div>
            <!-- 同意 -->
            <div class="form-check">
              <input type="checkbox" name="agree" required="required"><a target="_blank" href="https://docs.google.com/document/d/19e8mYgj4tjAM25NCDcowkyTSCeuTz1B2Juhm05EOZs4/edit">利用規約</a>に同意してください。</input>
           </div>

            <div class="button-panel">
              <input type="submit" class="button" title="送信" value="送信"></input>
            </div>
          </form>
        </div>
    </div>
    </div>
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
	    MOHANAK（公式ページ）
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

