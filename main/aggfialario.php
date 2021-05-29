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
                else if(isset($_POST['update'])){
                    $codice= $_SESSION["zaino"];
                    $elemPres=$_POST['elemento'];                //salvo elemento nella variabile elemPres
                    $quantità=$_POST['quantita']; 
                    $scadenza0=$_POST['scadenza'];
                    $scadenza=date("Y-m-d", strtotime($scadenza0));
                     $data = array('quantità'=>$quantità);
                     $cond=array('codice'=>$codice,'elemento'=>$elemPres,'scadenza'=>$scadenza);
                   
                    $res = pg_update($dbconn, 'inventario', $data, $cond);
                    
                        
                           
                }
              
                
        ?>
    </body>
</html>