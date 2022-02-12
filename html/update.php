<?php
  $dsn = 'mysql:host=localhost;dbname=live;charset=utf8';
  $user = 'shaw';
  $password = 'Shaw19940522';


  //DB接続
  try {
    $dbh = new PDO($dsn, $user, $password);
  } catch (PDOException $e){
    print('Error:'.$e->getMessage());
    die();
  }

  try {
    // トランザクション開始
    $dbh->beginTransaction();
    $link = mysqli_connect('localhost', 'shaw', 'Shaw19940522', 'live');
    mysqli_set_charset($link,"utf8");
    //例外処理を投げる（スロー）ようにする
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // テーブル削除(m_area)
    $dbh->exec("truncate table m_area");
    $dbh->exec("truncate table m_live_house");
    $dbh->exec("truncate table m_genre");
    $dbh->exec("truncate table m_live");
    // リクエストボディの解析
    $requestBody = file_get_contents('php://input');
    $params = json_decode($requestBody, true);
    $areaData = $params['area']; // 地域情報
    $liveHouseData = $params['livehouse']; // ライブハウス
    $eventData = $params['event']; // イベントデータ
    $genreData = $params['genre']; // ジャンル

    // 地域情報の更新
    for ($i = 0 ; $i < count($areaData); $i++) {
      $area = $areaData[$i];
      $live_data = mysqli_query($link, 'SELECT * FROM m_prefecture WHERE name = "'.$area['prefecture'].'";');
      while($obj = $live_data->fetch_object()) {
	$query = 'INSERT INTO m_area (area_name, prefecture_no, prefecture_name) VALUES ("'.$area['areaName'].'",'.$obj->id.', "'.$area['prefecture'].'");';
	$dbh->exec($query);
      }
    }
    // ライブハウス情報の更新
    for ($i = 0; $i < count($liveHouseData); $i++) {
      $liveHouse = $liveHouseData[$i];
      $area_from_db = mysqli_query($link, 'SELECT * FROM m_area WHERE area_name = "'.$liveHouse['area'].'";');
      while($obj = $area_from_db->fetch_object()) {
        $query = 'INSERT INTO m_live_house (live_house_name, live_house_prefecture, live_house_prefecture_no, live_house_area, live_house_area_no) VALUES ("'.$liveHouse['livehouseName'].'","'.$obj->prefecture_name.'",'.$obj->prefecture_no.',"'.$obj->area_name.'",'.$obj->area_no.');';
        $dbh->exec($query);
      }
    }
    // ジャンル情報の更新
    for ($i = 0; $i < count($genreData); $i++) {
      $genre = $genreData[$i];
      $query = 'INSERT INTO m_genre (genre_name) VALUES ("' .$genre['genre'] . '");';
      $dbh->exec($query);
    }

    // イベント情報の更新
    for ($i = 0; $i < count($eventData); $i++) {
      $event = $eventData[$i];
      $live_house_from_db = mysqli_query($link, 'SELECT * FROM m_live_house WHERE live_house_name = "'.$event['livehouse'].'";');
      while($obj = $live_house_from_db->fetch_object()) {
        $query = 'INSERT INTO m_live (sequence,live_house_no,live_area_no,live_info,href_url,live_date_time,quota,play,image_src,disp_flg, event_name, genre) VALUES ('.$event['sequence'].','.$obj->live_house_no.','.$obj->live_house_prefecture_no.',"'.$event['info'].'","'.$event['href'].'","'.substr($event['date'],0,  10).'","'.$event['quota'].'","'.$event['play'].'","'.$event['imgSrc'].'",'.$event['dispFlg'].',"'.$event['eventName'].'","'.$event['genre'].'");';
	//echo($query);
        $dbh->exec($query);
      }
    }
    $dbh->commit();
    echo "200";

  } catch (Exception $e) {
    $dbh->rollBack();
    echo $e;
  }

?>
