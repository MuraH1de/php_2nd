<?php
    //前ページからデータ取得
    $event = $_POST['event'];
    echo $event.'<br />';

    //id割り振り
    if ($event == "freestyle")  {$event_name = "スキーフリースタイル"; $event_no=1;}
    elseif($event == "alpen")   {$event_name = "スキーアルペン"; $event_no=2;}
    elseif($event == "ccs" )    {$event_name = "スキークロスカントリー"; $event_no=3;}
    elseif($event == "jump")    {$event_name = "スキージャンプ"; $event_no=4;}
    elseif($event == "nordic")  {$event_name = "ノルディック複合"; $event_no=5;}
    elseif($event == "figure")  {$event_name = "フィギュアスケート"; $event_no=6;}
    elseif($event == "st")      {$event_name = "ショートトラック"; $event_no=7;}
    elseif($event == "sskate")  {$event_name = "スピードスケート"; $event_no=8;}
    elseif($event == "sb")      {$event_name = "スノーボード"; $event_no=9;}
    elseif($event == "ih")      {$event_name = "アイスホッケー"; $event_no=10;}
    elseif($event == "curling") {$event_name = "カーリング"; $event_no=11;}
    elseif($event == "biaslon") {$event_name = "バイアスロン"; $event_no=12;}
    elseif($event == "skelton") {$event_name = "スケルトン"; $event_no=13;}
    elseif($event == "luge")    {$event_name = "リュージュ"; $event_no=14;}
    elseif($event == "bb")      {$event_name = "ボブスレー"; $event_no=15;}
    else                        {$event_name = "特にない"; $event_no=16;}

    echo $event_no.'<br />';


    //DB接続します
    try {
        //ID:'root', Password: 'root'
        $pdo = new PDO('mysql:dbname=olympic_qa;charset=utf8;host=localhost','root','root');
        //echo 'OK<br />';
    } catch (PDOException $e) {
        //echo 'NG<br />';
        exit('DBConnectError:'.$e->getMessage());
    }
    
    //２．データ取得
    //$stmt = $pdo->prepare("SELECT counter FROM event_table where id = 1");
    $stmt = $pdo->prepare("SELECT * FROM event_table");
    //$stmt->bindValue(':id', $event_no, PDO:: PARAM_INT);
    $status = $stmt->execute();
    echo $status.'<br />';
    echo $stmt.'<br />';
    
    //データ更新

















?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Second</title>
    <link rel='stylesheet' href='css/reset.css'>
    <link rel='stylesheet' href='css/format.css'>
</head>
<body>

</body>
</html>