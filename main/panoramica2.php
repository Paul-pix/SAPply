<!--consegna-->
<?php
    session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script type="text/javascript" lang="javascript" src="script.js"></script>

</head>

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

                        //INIZIO POP-UP 

                        echo "<script>
                        $(function(){
                            $( \"#dialog\" ).dialog({
                            autoOpen: false
                            });
                            
                            $('#bottone').on(\"click\" , function() {
                                $( \"#dialog\" ).dialog(\"open\");
                            });
                        });
                        </script>";
                        $var=$_SESSION['zaino'];
                        echo "<div id=\"dialog\" title=\"Titolo del dialogo\">
                            <h1>Premi per tornare alla pagina di Selezione Zaino</h1>
                        </div>";
                        echo "<button id=\"bottone\">premi</button> <!-- SPOSTA IL BOTTONE DOVE SEVE NEL BODY --->";                    
                        
                        //FINE POP-UP

                    }else{                                                                 
                    date_default_timezone_set("Europe/Rome");
                    $date = date('Y-m-d');
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