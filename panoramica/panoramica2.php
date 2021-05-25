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
            if(!(isset($_POST['consegnaButton']))) {                                          //reindirizzati alla pagina index se non accediamo tramite il registration button
                header("Location: index.php");
            }else{
                $cod=$_SESSION['zaino']; 
                    $q1="select disponibile from zaino where codice='$cod'";
                    $disp=pg_query($dbconn,$q1);
                    if(pg_result($disp,null,0)=='sì'){
                        echo "<h1> Lo zaino è ancora disponibile, impossibile consegnare</h1>";
                        echo "<a href=index.php> Premi qui  </a>   per tornare alla panoramica</br>";
                        echo "</br><a href=../home/index.php> Premi qui  </a>   per tornare alla selezione zaino";
                    }else{                                                                 
                    $date = date('Y-m-d', strtotime($_POST["inputDate2"]));
                    $status='sì';                                
                    $q2="UPDATE zaino
                    SET ultimadata=$1,disponibile=$2
                    WHERE codice ='$cod'";  
                    $data=pg_query_params($dbconn,$q2,array($date,$status));
                if($data){                                                                  //se true
                     echo "<h1>Zaino riconsegnato con successo</h1>";
                    echo "<a href=../home/index.php> Premi qui </a> per tornare a selezione zaino";                        
                     echo "<h1> </br></h1>";
                }
            }
                             
            } 
        ?>
</body>

</html>