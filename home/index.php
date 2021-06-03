<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>SAPply - Selezione zaino</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" type="image/png" href="../img/SAPply_logo_32x32.png" sizes="32x32">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="style.css">
    <script type="text/javascript" lang="javascript" src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" lang="javascript" src="script.js"></script>
    <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <link rel="stylesheet" type="text/css" href="../main/popup_style.css">


</head>

<body class="text-center">

    <?php
            $dbconn=pg_connect("host=localhost port=5432 dbname=SAP user=postgres password=admin")    // connessione database
                             or die('Could not connect: '. pg_last_error());

                if(isset($_POST['codiceButton'])) {           // contollo se la variabile per il codiceButton della chiamata POST esiste 
                       
                    $codice=$_POST['codiceZaino'];                //salvo codiceZaino nella variabile codice
                    $q1="select * from zaino where codice=$1";      //creo una query per verificare se un zaino esiste con questo codice
                    $result=pg_query_params($dbconn,$q1,array($codice));     //pg_query_params ( resource $connection = ? , string $query , array $params ) : resource|false
                    if(!($line=pg_fetch_array($result,null,PGSQL_ASSOC))){
                        echo "<script>
                        $(function(){
                            $( \"#dialog\" ).dialog({
                            autoOpen: open
                            });
                        });
                        </script>";
                        echo "<div id=\"dialog\" title=\"C'è stato un problema!\">
                            <h5>Lo zaino non è presente nel database.</h5>
                        </div>";
                    }
                    else{
                            
                            $_SESSION['zaino']=$codice; 
                           header('Location:../main/index.php');
                        }
                        
                        }
?>
    <div class="container">
        <div class="left">
            <br /><br /><br />
            <div id="reader" style="display: inline-block;"></div>
            <script type="text/javascript" lang="javascript" src="html5-qrcode.min.js"></script>
            <script>
                var html5QrcodeScanner = new Html5QrcodeScanner(
                    "reader", {
                        fps: 10,
                        qrbox: 250
                    });
                html5QrcodeScanner.render(onScanSuccess);
            </script>
            <!--<img class="mb-4" src="../images/logo/SAPply_logo_512x512.png" alt="" width=80%/>-->
    </div>
        <div class="right">

            <img class="mb-4" src="../logo/SAPply_logo_extended_566x256.png" alt="" />

            <button type="button" class="btn btn-primary biggerbtn"><b>Scansiona un tag QR</b></button>
            <img class="mb-4" src="../logo/icons/qr_icon.png" alt="" />
            <p class="text-center text"><b>Oppure immetti il numero dello zaino</b></p>
            <form class="form-inline" action="" method="POST" name="codiceForm" onsubmit="return validaCodice()">
                <input type="text" name="codiceZaino" class="form-group" placeholder="Codice Zaino" size="2" autofocus
                    required />
                <button class="btn btn-sm btn-primary btn-block btnred" name="codiceButton"
                    type="submit">Gestisci</button>
                </br></br>
                </br>
                <a href="../login/index.html" role="button" class="btn btn-primary btn-lg  "
                    style="background-color:#333 ;color:whitesmoke">
                    Logout</a>


            </form>

        </div>
    </div>




</body>

</html>