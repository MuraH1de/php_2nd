<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question</title>
    <link rel='stylesheet' href='css/reset.css'>
    <link rel='stylesheet' href='css/format.css'>
</head>
<body>

    <h1>北京冬季オリンピックで開催される競技の中で好きなものを選んでください。</h1>

    <div class="select_button">
        <form action='second.php' method="post">
            <input type="radio" name="event" value="freestyle" id="freestyle">
                <label class="label-event" for="freestyle">スキーフリースタイル</label>
            <input type="radio" name="event" value="alpen" id="alpen">
                <label class="label-event" for="alpen">スキーアルペン</label>
            <input type="radio" name="event" value="ccs" id="ccs">
                <label class="label-event" for="ccs">スキークロスカントリー</label>
            <input type="radio" name="event" value="jump" id="jump">
                <label class="label-event" for="jump">スキージャンプ</label><br>
            
            <input type="radio" name="event" value="nordic" id="nordic">
                <label class="label-event" for="nordic">ノルディック複合</label>
            <input type="radio" name="event" value="figure" id="figure">
                <label class="label-event" for="figure">フィギュアスケート</label>
            <input type="radio" name="event" value="st" id="st">
                <label class="label-event" for="st">ショートトラック</label>
            <input type="radio" name="event" value="sskate" id="sskate">
                <label class="label-event" for="sskate">スピードスケート</label><br>

            <input type="radio" name="event" value="sb" id="sb">
                <label class="label-event" for="sb">スノーボード</label>
            <input type="radio" name="event" value="ih" id="ih">
                <label class="label-event" for="ih">アイスホッケー</label>
            <input type="radio" name="event" value="curling" id="curling">
                <label class="label-event" for="curling">カーリング</label>
            <input type="radio" name="event" value="biaslon" id="biaslon">
                <label class="label-event" for="biaslon">バイアスロン</label><br>

            <input type="radio" name="event" value="skelton" id="skelton">
                <label class="label-event" for="skelton">スケルトン</label>
            <input type="radio" name="event" value="luge" id="luge">
                <label class="label-event" for="luge">リュージュ</label>
            <input type="radio" name="event" value="bb" id="bb">
                <label class="label-event" for="bb">ボブスレー</label>
            <input type="radio" name="event" value="none" id="none">
                <label class="label-event" for="none">特にない</label><br>
            
            
            <button type="submit">回答！</button>
        </form>
    </div>

</body>
</html>