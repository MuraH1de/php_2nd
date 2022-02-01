<?php
    //前ページからデータ取得
    $event_name = $_POST['event'];
    //echo $event_name.'<br />';

    //id割り振り
    if ($event_name == "freestyle")  {$event_jp = "スキーフリースタイル"; $event_no=1;}
    elseif($event_name == "alpen")   {$event_jp = "スキーアルペン"; $event_no=2;}
    elseif($event_name == "ccs" )    {$event_jp = "スキークロスカントリー"; $event_no=3;}
    elseif($event_name == "jump")    {$event_jp = "スキージャンプ"; $event_no=4;}
    elseif($event_name == "nordic")  {$event_jp = "ノルディック複合"; $event_no=5;}
    elseif($event_name == "figure")  {$event_jp = "フィギュアスケート"; $event_no=6;}
    elseif($event_name == "st")      {$event_jp = "ショートトラック"; $event_no=7;}
    elseif($event_name == "sskate")  {$event_jp = "スピードスケート"; $event_no=8;}
    elseif($event_name == "sb")      {$event_jp = "スノーボード"; $event_no=9;}
    elseif($event_name == "ih")      {$event_jp = "アイスホッケー"; $event_no=10;}
    elseif($event_name == "curling") {$event_jp = "カーリング"; $event_no=11;}
    elseif($event_name == "biaslon") {$event_jp = "バイアスロン"; $event_no=12;}
    elseif($event_name == "skelton") {$event_jp = "スケルトン"; $event_no=13;}
    elseif($event_name == "luge")    {$event_jp = "リュージュ"; $event_no=14;}
    elseif($event_name == "bb")      {$event_jp = "ボブスレー"; $event_no=15;}
    else                             {$event_jp = "特にない"; $event_no=16;}

    //echo $event_no.'<br />';


    //1. DB接続します
    try {
        //ID:'root', Password: 'root'
        $pdo = new PDO('mysql:dbname=olympic_qa;charset=utf8;host=localhost','root','root');
        //echo 'OK<br />';
    } catch (PDOException $e) {
        //echo 'NG<br />';
        exit('DBConnectError:'.$e->getMessage());
    }
    
    //2. データ取得
    $stmt = $pdo->prepare("SELECT counter FROM event_table WHERE id = :id");
    //$stmt = $pdo->prepare("SELECT * FROM event_table");
    $stmt->bindValue(':id', $event_no, PDO:: PARAM_INT);
    $status = $stmt->execute();
    //echo 'STATUS->'.$status.'<br />';

    //3. カウンタ
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $counter = $result["counter"] +1;
    //echo 'DB->'.$counter.'<br />';
    
    //4. データ更新
    $stmt = $pdo->prepare("UPDATE  event_table SET counter = :counter WHERE id = :id");
    $stmt->bindValue(':counter', $counter, PDO:: PARAM_INT);
    $stmt->bindValue(':id', $event_no, PDO:: PARAM_INT);
    $status = $stmt->execute();

    //5. データ表示
    $stmt = $pdo->prepare("SELECT * FROM event_table");
    $status = $stmt->execute();

    $view = "";
    $i = 0;
    while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
        //var_dump($result);
        //echo '<br />';
        $sort_data[$i] = $result; 

        $view .= '<p>';
        $view .= $result["event_name"] ."︓". $result["counter"] ;
        $view .= '</p>';
        $i += 1;
    }
    // var_dump($sort_data);
    // echo '<br />';

    //6. ソート(DBを配列に入れてソートしている)
    foreach($sort_data as $key => $value)
    {
        $sort_keys[$key] = intval($sort_data[$key]["counter"]);
        //echo intval($sort_data[$key]["counter"]).'<br />';
    }
    array_multisort($sort_keys, SORT_DESC, $sort_data);
    // var_dump($sort_data);
    // echo '<br />';
    $num = 0;
    while($num < 16){
        //echo $sort_data[$num]["id"].'<br />';
        if(intval($sort_data[$num]["id"]) == intval($event_no)){
            //echo '条件一致<br />';
            $class = $num + 1;
            break;
        }
        $num += 1;
    }

    //4. answer_tableデータ追加
    $stmt = $pdo->prepare("INSERT INTO answer_table(id, event_name, event_jp, event_no, omoide, nickname, mailaddress)VALUES(NULL, :event_name, :event_jp, :event_no, '', '', '')");
    $stmt->bindValue(':event_name', $event_name, PDO:: PARAM_STR);
    $stmt->bindValue(':event_jp', $event_jp, PDO:: PARAM_STR);
    $stmt->bindValue(':event_no', $event_no, PDO:: PARAM_INT);
    $status = $stmt->execute();




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
    <form action='result.php' method="post">
        <div class="q_add">
            <h1>アンケート回答ありがとうございます！</h1>
            <h2>あなたが選んだ競技種目は「<?= $event_jp; ?>」です。<br>
                人気順位は<?= $class; ?>位です。</h2>
            <img src="img/<?= $event_name; ?>.png" alt="test" class="ans_img"><br>


            <h3>冬のオリンピックで印象に残っているものがあれば記入してください。</h3>
            <textarea name='omoide' id=''></textarea>

            <h3>あなたのニックネームを記入してください。</h3>
            <textarea name='nickname' id=''></textarea>

            <h3>あなたのメールアドレスを記入してください。</h3>
            <textarea name='mailaddress' id=''></textarea>
            <br>

            <button type="submit">送信！</button>
        </div>
    </form>
</body>
</html>