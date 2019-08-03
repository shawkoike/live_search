<?php
  $link = mysqli_connect('localhost', '', '', "live");
  mysqli_set_charset($link, "utf8");
  $jsonParams = file_get_contents('php://input');
  $array = json_decode( $jsonParams , true ) ;
  $area_no = $array["area"];
  if ($area_no == 12) {
    $tokyo_live_data = mysqli_query($link, "SELECT * FROM m_live WHERE live_area_no = 12 AND disp_flg = 0 ORDER BY sequence;");
    $result = array();
    while($obj = $tokyo_live_data->fetch_object()) {
      $sequence = $obj->sequence;
      $live_date = new DateTime($obj->live_date_time);
      $date = $live_date->format('Y-m-d');
      $live_place = mysqli_query($link, 'SELECT * FROM m_live_house WHERE live_house_no = '.$obj->live_house_no.';');
      $info = $obj->live_info;
      while($live_house = $live_place->fetch_object()) {
        $live_house_name = $live_house->live_house_name;
        $loop_ary = array("sequence"=>$sequence, "date"=>$date, "live_house"=>$live_house_name, "info"=>$info);
        array_push($result, $loop_ary);
      }
    }
    $response = array("result" => $result);
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
  } else if($area_no == 13) {
    $kanagawa_live_data = mysqli_query($link, "SELECT * FROM m_live WHERE live_area_no = 13 AND disp_flg = 0 ORDER BY sequence;");
    $result = array();
    while($obj = $kanagawa_live_data->fetch_object()) {
      $sequence = $obj->sequence;
      $live_date = new DateTime($obj->live_date_time);
      $date = $live_date->format('Y-m-d');
      $live_place = mysqli_query($link, 'SELECT * FROM m_live_house WHERE live_house_no = '.$obj->live_house_no.';');
      $info = $obj->live_info;
      while($live_house_name = $live_place->fetch_object()) {
        $live_house_name = $live_house->live_house_name;
	$loop_ary = array("sequence"=>$sequence, "date"=>$date, "live_house"=>$live_house_name, "info"=>$info);
	array_push($result, $loop_ary);
      }
    }
    $response = array("result" => $result);
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
  } else if ($area_no == 22) {
    $nagoya_live_data = mysqli_query($link, "SELECT * FROM m_live WHERE live_area_no = 22 AND disp_flg = 0 ORDER BY sequence;");
    $result = array();
    while($obj = $nagoya_live_data->fetch_object()) {
      $sequence = $obj->sequence;
      $live_date = new DateTime($obj->live_date_time);
      $date = $live_date->format('Y-m-d');
      $live_place = mysqli_query($link, 'SELECT * FROM m_live_house WHERE live_house_no = '.$obj->live_house_no.';');
      $info = $obj->live_info;
      while($live_house_name = $live_place->fetch_object()) {
        $live_house_name = $live_house->live_house_name;
	$loop_ary = array("sequence"=>$sequence, "date"=>$date, "live_house"=>$live_house_name, "info"=>$info);
	array_push($result, $loop_ary);
      }
    }
    $response = array("result" => $result);
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
  }
?>
