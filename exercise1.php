<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class = "container">
        <?php
        
        function isBitten(){
            $a = rand(0,1);
            return $a;
        }
        $a = isBitten();
        
        function charlie($a){
            if($a==1){
                echo "Charlie bit your finger!";
            }
            else{
                echo "Charlie did not bite your finger!";
            }
        }
        charlie($a);

        ?>

    </div>
</body>
</html>