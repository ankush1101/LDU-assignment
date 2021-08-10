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
        function countWords($string){

            $string = strtolower($string);
            $data   = preg_split('/\s+/', $string);

            $rep = array_count_values($data);
            arsort($rep);

            echo "<table border='1'>
            <tr>
            <th>Word</th>
            <th>count</th>
            </tr>";
        
            foreach ($rep as $key => $value) {
            echo "<tr>";
            echo "<td>" . $key . "</td>";
            echo "<td>" . $value. "</td>";
            echo "</tr>";

            }

            echo "</table>";
        }
   

        ?>
        <form action = "<?php echo $_SERVER["PHP_SELF"];?>" method = "GET">
              
              String : <input type = "text" name = "string" placeholder = "String" />
                    
              <br><br>
                
              <input type = "submit" name = "submit" value = "Submit">
        </form>

        <?php
            if(isset($_GET['string']) && !empty($_GET['string'])){
                $string = $_GET['string'];
                countWords($string);
            } else {
                echo "String is empty";
            }


        ?>


    </div>
    
</body>
</html>