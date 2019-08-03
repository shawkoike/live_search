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
<link rel="stylesheet" href="css/style-search.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-126289985-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-126289985-2');
</script>
<script type="text/javascript">
$(function(){
	$("#menubtn").click(function(){
		$("#menu").slideToggle();
	});
        
	$('#YearMonth').datepicker({
                format: 'yyyy年mm月',
	        language: 'ja',       // カレンダー日本語化のため
                minViewMode : 1
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

<div class="info">
  <div class="info-main">
    <form action="result.php" method="post">
      <h2 class="top-title">ライブ詳細検索</h2>
      <p class="content">開催場所</p>
      <div class="cp_ipselect cp_sl01">
        <select name="area_no" required>
          <option value="" hidden>開催場所</option>
          <option value="12">東京</option>
          <option value="22">名古屋</option>
          <option value="13">神奈川</option>
        </select>
      </div>
      <p class="content">開催月</p>
      <div>
	<!--<input type="date" name="date"></input>-->
        <input type="month" name="date" />
      </div>
      <div class="button-panel">
        <input type="submit" class="button" title="検索" value="検索"></input>
      </div>
    </form>
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

