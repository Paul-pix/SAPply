<!--preleva-->
<?php
    session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width initial-scale=1"/>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script type="text/javascript" lang="javascript" src="script.js"></script>
</head>

<body class="text-center"> 
    <div><img class="text-center" src="../logo/SAPply_logo_128x128.png"></div>
    <div><button class="btn btn-primary">Prosegui</button></div>
    
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
                        
                        //INIZIO POP-UP 

                        echo "<script>
                        $(function(){
                            $( \"#dialog\" ).dialog({
                            autoOpen: open
                            });
                            
                            $('#bottone').on(\"click\" , function() {
                                $( \"#dialog\" ).dialog(\"open\");
                            });
                        });
                        </script>";
                        $var=$_SESSION['zaino'];
                        echo "<div id=\"dialog\" title=\"Operazione fallita!\">
                            <h1>Lo zaino non può essere prelevato. Zaino non disponibile.</h1>
                        </div>";               
                        echo "<button id=\"bottone\" class=\"btn btn-primary text-center\">Pop up</button>";

                        //FINE POP-UP

                    }else{                                                                 
                    $nome=$_POST['inputName'];
                    date_default_timezone_set("Europe/Rome");
                    $date = date('Y-m-d');
                    $status='no';                                
                    $q2="UPDATE zaino
                    SET lastuser =$1,ultimadata=$2,disponibile=$3
                    WHERE codice ='$cod'";  
                    $data=pg_query_params($dbconn,$q2,array($nome,$date,$status));
                if($data){       
                                                                              //se true
                     //INIZIO POP-UP 

                     echo "<script>
                     $(function(){
                         $( \"#dialog\" ).dialog({
                         autoOpen: open
                         });
                         
                         $('#bottone').on(\"click\" , function() {
                             $( \"#dialog\" ).dialog(\"open\");
                         });
                     });
                     </script>";
                     $var=$_SESSION['zaino'];
                     echo "<div id=\"dialog\" title=\"Operazione completata!\">
                         <h1>Lo zaino è stato prelevato con successo.</h1>
                     </div>";
                     echo "<button id=\"bottone\" class=\"btn btn-primary text-center\">Pop up</button>";                    
                     
                     //FINE POP-UP

                }
            }
                             
            } 
        ?>
    
</body>

</html>