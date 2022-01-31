<?php
    //集計用CSVファイル御読み込み
    $row = 1;
    // ファイルが存在しているかチェックする
    if (($handle = fopen("sum.csv", "r")) !== FALSE) {
        // 1行ずつfgetcsv()関数を使って読み込む
        while (($data = fgetcsv($handle))) {
            //echo $row.'行目<br />';
            $row += 1;
            //foreach ($data as $value) {
            //    echo $data[3].'<br />';
            //}
        }
        fclose($handle);
    }
    
    
    //最終的に書き込みjson読み込み
    $last = file_get_contents("result.json");
    $last_d =  json_decode($last, true);
    //var_dump( $last_d );
    //echo '<br />';
    
    //集計(行数確認)
    $count = 0;
    while($last_d["Olympic_Winter_Games"][$count]["id"] != NULL){
        $count += 1;
    }
    //echo '現在の回答数は、'.$count.'件です。<br />';


    $omoide = $_POST['omoide'];
    $nickname = $_POST['nickname'];
    $mailaddress = $_POST['mailaddress'];

    //前のページで作ったjson読み込み
    $test = file_get_contents("test.json");
    
    $test = mb_convert_encoding($test, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
    //var_dump( $test );
    $first = json_decode($test, true);
    $first['id'] = $count + 1;
    $ans_all = $first['id'];
    //echo '現在の回答数は、'.$first['id'].'件です。<br />';

    $event = $first['event'];
    $event_name = $first['event_name'];
    $event_no = $first['event_no'];
    
    if($event_no < 10){
        $event_no = "0".strval($event_no);
    }else{
        $event_no = strval($event_no);
    }


    $second = array(
        "omoide" => $omoide,
        "nickname" => $nickname,
        "mailaddress" => $mailaddress
    );
    //$second = json_encode($second);
    //var_dump( $second );
    //echo '<br />';
    
    $json_add = array_merge($first, $second);
    //var_dump( $json_add );
    //echo '<br />';
    //書き込み用json完成

    $eve_c = 0;
    $comment = "";
    $count = 0;
    while($count < $ans_all){
        if($last_d["Olympic_Winter_Games"][$count]["event_no"] == $event_no){
            $eve_c += 1;
            $comment = $comment."<br>".$last_d["Olympic_Winter_Games"][$count]["omoide"];
        }
        $count += 1;
    }
    $eve_c += 1;
    $comment = $comment."<br>".$second["omoide"];

    
    $json_mrg = array_merge($last_d["Olympic_Winter_Games"], array($json_add));
    $json_orig = array(
        "Olympic_Winter_Games" => $json_mrg
    );
    //echo 'ORIG <br />';
    //var_dump( $json_orig );
    $json_orig = json_encode($json_orig);

    file_put_contents("result.json", array($json_orig));
    //★★★追加方法を要検討
    
    
    //var_dump( $json_add );
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result</title>
    <link rel='stylesheet' href='css/reset.css'>
    <link rel='stylesheet' href='css/format.css'>
</head>
<body>
    <div class="result">
        <h2>現在の回答数は、<?= $ans_all; ?>件です。<br>
        <?= $event_name; ?>を選んだ回答は、<?= $eve_c; ?>件です。<br>
        </h2>
        <img src="img/<?= $event; ?>.png" alt="test" class="ans_img"><br>
        
        <h3>こんな思い出の回答をもらっています。</h3>
        <div class="com_oya">
            <p class="comment"><?= $comment; ?></p>
        </div>

        <h3><?= $event_name; ?>の気になる記事は、こちらからチェック！<br>
        <a href="https://www3.nhk.or.jp/news/special/beijing2022/latest-news/<?= $event_no; ?>/">リンク先（NHK）</a>
        </h3>
    </div>
</body>
</html>
