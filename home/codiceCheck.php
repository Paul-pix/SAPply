<?php 
session_start();?>
<html>

    <head></head>
    <body>
        <?php
            $dbconn=pg_connect("host=localhost port=5432 dbname=SAP user=postgres password=admin")    // connessione database
                             or die('Could not connect: '. pg_last_error());
                if(!(isset($_POST['codiceButton']))) {           // contollo se la variabile per il codiceButton della chiamata POST esiste 
                        header("Location: ../index.html");      //se accedo a codiceCheck.php senza passare dal login button vengo reindirizzato su index.html
                }
                else{
                    $codice=$_POST['codiceZaino'];                //salvo codiceZaino nella variabile codice
                    $q1="select * from zaino where codice=$1";      //creo una query per verificare se un zaino esiste con questo codice
                    $result=pg_query_params($dbconn,$q1,array($codice));     //pg_query_params ( resource $connection = ? , string $query , array $params ) : resource|false
                    if(!($line=pg_fetch_array($result,null,PGSQL_ASSOC))){
                        echo "<h1> Lo zaino non è presente nel database  </h1> <br> <a href=index.php>
                        Riprova</a>";
                    }
                    else{
                            
                            $_SESSION['zaino']=$codice; 
                           header('Location:../main/index.php');
                        }
                        
                        }
                    
                        
                           
                
        ?>
    </body>
</html>