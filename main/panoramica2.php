<!--consegna-->
<?php
    session_start();
?>
<!DOCTYPE html>
<html>

<head>
<title>Consegna zaino</title>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width initial-scale=1"/>
<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="style.css"/>
<link rel="stylesheet" type="text/css" href="popup_style.css">
<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript" lang="javascript" src="script.js"></script>
</head>

<body class="text-center">
    <div><img class="text-center reind_img" src="../logo/SAPply_logo_extended_283x128.png"></div>
    </br>

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
                            autoOpen: open
                            });
                        });
                        </script>";
                        $var=$_SESSION['zaino'];
                        echo "<div id=\"dialog\" title=\"Operazione fallita!\">
                            <h5>Lo zaino non può essere consegnato.</h5>
                            <h5>Lo zaino è ancora disponibile per il prelievo.</h5>
                            <div><a href=\"index.php\" role=\"button\" class=\"btn btn-primary btn-lg btnred \">Ritorna alla pagina dello zaino</a></div>
                        </div>";                                   
                        
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
                    echo "<script>
                    $(function(){
                        $( \"#dialog\" ).dialog({
                        autoOpen: open
                        });
                    });
                    </script>";
                    $var=$_SESSION['zaino'];
                    echo "<div id=\"dialog\" title=\"Operazione completata!\">
                        <h5>Lo zaino è stato consegnato con successo.</h5>
                        <h5>Ricordati di aggiornare il contenuto dello zaino per gli altri colleghi!</h5>
                        <div><a href=\"../home/index.php\" role=\"button\" class=\"btn btn-primary btn-lg btnred \">Ritorna alla scelta dello zaino</a></div>
                    </div>";  
                    
                }
            }
                             
            } 
        ?>
</body>

</html>