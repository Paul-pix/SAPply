<?php
    session_start();
?>
<!DOCTYPE html>
<html>

<head></head>

<body>
    <?php
            $dbconn=pg_connect("host=localhost port=5432 dbname=SAP user=postgres password=admin")
            or die('Could not connect: '. pg_last_error());
            if(!(isset($_POST['prelevaButton']))) {                                          //reindirizzati alla pagina index se non accediamo tramite il registration button
                header("Location: index.php");
            }else{
                $cod=$_SESSION['zaino']; 
                    $q1="select disponibile from zaino where codice='$cod'";
                    $disp=pg_query($dbconn,$q1);
                    if(pg_result($disp,null,0)=='no'){
                        echo "<h1> Lo zaino è stato già preso in carico</h1>";
                        echo "<a href=index.php> Premi qui  </a>   per tornare alla panoramica";
                    }else{                                                                 
                    $nome=$_POST['inputName'];
                    date_default_timezone_set("Europe/Rome");
                    $date = date('Y-m-d');
                    $status='no';                                
                    $q2="UPDATE zaino
                    SET lastuser =$1,ultimadata=$2,disponibile=$3
                    WHERE codice ='$cod'";  
                    $data=pg_query_params($dbconn,$q2,array($nome,$date,$status));
                if($data){                                                                  //se true
                     echo "<h1>Registrazione utilizzo</h1>";
                    echo "<a href=../home/index.php> Premi qui </a> per tornare a selezione zaino";                        
                     echo "<h1> </br></h1>";
                }
            }
                             
            } 
        ?>
</body>

</html>