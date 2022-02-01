<?php
    //前ページからデータ取得
    $omoide = $_POST['omoide'];
    $nickname = $_POST['nickname'];
    $mailaddress = $_POST['mailaddress'];

    //1. DB接続します
    try {
        //ID:'root', Password: 'root'
        $pdo = new PDO('mysql:dbname=olympic_qa;charset=utf8;host=localhost','root','root');
        //echo 'OK<br />';
    } catch (PDOException $e) {
        //echo 'NG<br />';
        exit('DBConnectError:'.$e->getMessage());
    }

    $stmt = $pdo->prepare("SELECT * FROM answer_table ORDER BY id DESC LIMIT 1");
    $status = $stmt->execute();
    $last_ans = $stmt->fetch(PDO::FETCH_ASSOC);
    $id = intval($last_ans["id"]);
    $event_no = intval($last_ans["event_no"]);
    $event_name = $last_ans["event_name"];
    $event_jp = $last_ans["event_jp"];
    //var_dump( $last_ans );
    //echo '<br />';

    //4. answer_tableデータ更新
    $stmt = $pdo->prepare("UPDATE  answer_table SET omoide = :omoide, nickname = :nickname, mailaddress = :mailaddress  WHERE id = :id");
    $stmt->bindValue(':omoide', $omoide, PDO:: PARAM_STR);
    $stmt->bindValue(':nickname', $nickname, PDO:: PARAM_STR);
    $stmt->bindValue(':mailaddress', $mailaddress, PDO:: PARAM_STR);
    $stmt->bindValue(':id', $id, PDO:: PARAM_INT);
    $status = $stmt->execute();
    
    //データ件数取得
    $stmt = $pdo->prepare("SELECT count(*) FROM answer_table");
    $status = $stmt->execute();
    $ans_all = $stmt->fetch(PDO::FETCH_ASSOC);
    //var_dump( $ans_all );
    //echo '<br />';

    //選択した競技の件数
    $stmt = $pdo->prepare("SELECT count(*) FROM answer_table WHERE event_no = :event_no");
    $stmt->bindValue(':event_no', $event_no, PDO:: PARAM_INT);
    $status = $stmt->execute();
    $eve_c = $stmt->fetch(PDO::FETCH_ASSOC);
    //var_dump( $eve_c );
    //echo '<br />';



    //選択した競技のコメント
    $stmt = $pdo->prepare("SELECT omoide FROM answer_table WHERE event_no = :event_no");
    $stmt->bindValue(':event_no', $event_no, PDO:: PARAM_INT);
    $status = $stmt->execute();

    $comment = "";
    while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
        //var_dump($result);
        //echo '<br />';
        $comment .= '<p>';
        $comment .= $result["omoide"];
        $comment .= '</p>';
    }
    
    
    if($event_no < 10){
        $event_no = "0".strval($event_no);
    }else{
        $event_no = strval($event_no);
    }
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
        <h2>現在の回答数は、<?= $ans_all["count(*)"]; ?>件です。<br>
        <?= $event_jp; ?>を選んだ回答は、<?= $eve_c["count(*)"]; ?>件です。<br>
        </h2>
        <img src="img/<?= $event_name; ?>.png" alt="test" class="ans_img"><br>
        
        <h3>こんな思い出の回答をもらっています。</h3>
        <div class="com_oya">
            <p class="comment"><?= $comment; ?></p>
        </div>

        <h3><?= $event_jp; ?>の気になる記事は、こちらからチェック！<br>
        <a href="https://www3.nhk.or.jp/news/special/beijing2022/latest-news/<?= $event_no; ?>/">リンク先（NHK）</a>
        </h3>
    </div>
</body>
</html>
