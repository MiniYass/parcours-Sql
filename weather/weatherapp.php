<?php 

$dbHost="localhost";
$dbuser="root";
$dbpwd="";
$dbname="weatherapp";
    try{
        $dns="mysql:host=".$dbHost.";dbname=".$dbname.";charset=utf8";
        $pdo= new PDO($dns,$dbuser,$dbpwd);
        $test=$pdo->query("SELECT * FROM meteo");
        // while($data = $test->fetch()){
        //     echo $data['ville'].' \r \n'; autre methode que le foreach mais pas la meilleur 
        //     echo $data['haut'].' \r \n';
        //     echo $data['bas'].' \r \n';
        // }

        foreach ($test as $row) {
            print $row["ville"] . " temp max: " . $row["haut"] ." temp min: ". $row["bas"]."<br/>";
        }   
    }catch(PDOExeption $e){
        echo "DB connexion ratey";
    }

if(isset($_POST['btnphp'])){
    $test = $pdo->prepare("INSERT INTO meteo (ville,haut,bas) VALUES (?,?,?)");
    $test->bindParam(1, $ville);
    $test->bindParam(2, $haut);
    $test->bindParam(3, $bas);

    $ville =$_POST['ville'];
    $haut =$_POST['haut'];
    $bas=$_POST['bas'];

    $test->execute();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        <form method="post" action="index.php">
                <input name="ville" type="text" placeholder="ville">
                <input name="haut" type="text" placeholder="temperature">
                <input name="bas" type="text" placeholder="temperature">

                <input name="btnphp" id="run" type="submit" value="submit">
        </form>

</body>
</html>