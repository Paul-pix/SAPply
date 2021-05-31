<?php 
session_start();
?>
<html>

    <head></head>
    <body>
        <?php
            $dbconn=pg_connect("host=localhost port=5432 dbname=SAP user=postgres password=admin")    
                             or die('Could not connect: '. pg_last_error());
                if(!(isset($_POST['update']))) {          
                        header("Location: ../index.html");      
                }
                else{
                    $codice= $_SESSION["zaino"];
                    $elemPres=$_POST['elemento'];                //salvo elemento nella variabile elemPres
                    $quantità=$_POST['quantita'];    
                     $data = array('quantità'=>$quantità);
                     $cond=array('codice'=>$codice,'elemento'=>$elemPres);
                   
                    $res = pg_update($dbconn, 'presidi', $data, $cond);
                    if ($res) {
                        echo "<meta http-equiv = \"refresh\" content =\"0; \"aggiorna.php\"\">";
                    } else {
                        echo "User must have sent wrong inputs\n";
                        echo "<meta http-equiv = \"refresh\" content =\"0; aggiorna.php\">";
                    }
                        
                           
                }
        ?>
    </body>
</html>