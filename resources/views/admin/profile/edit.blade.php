<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>編集</title>
</head>
<body>
    <?php
    function name($last_neme, $family_name){
        return "名前:". $last_neme. $family_name. "です。";
    }
    echo name("Jason","Friday");
    echo "</br>";
    
    function age($years_old){
        return "年齢:". $years_old."歳です。";
    }
    echo age(1000000);
    ?>
</body>
</html>