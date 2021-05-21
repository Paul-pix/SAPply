<?php
    session_start();
    
// remove all session variables
session_unset();

// destroy the session
session_destroy();

?>
<!DOCTYPE html>
<html>
    <head>
        <title>SAPply - Selezione zaino</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <link rel="icon" type="image/png" href="../img/SAPply_logo_32x32.png" sizes="32x32">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="style.css">
        <script type="text/javascript" lang="javascript" src="../js/bootstrap.min.js"></script>
        <script type="text/javascript" lang="javascript" src="script.js"></script>
        
        
    </head>
    <body class="text-center">
        <div class="container">
        
            
            <div class="left">
                <br/><br/><br/>
                

                <div id="reader" style="display: inline-block;"></div>
                <script type="text/javascript" lang="javascript" src="html5-qrcode.min.js"></script>
                <script> var html5QrcodeScanner = new Html5QrcodeScanner(
                    "reader", { fps: 10, qrbox: 250 });
                html5QrcodeScanner.render(onScanSuccess); </script>
                <!--<img class="mb-4" src="../images/logo/SAPply_logo_512x512.png" alt="" width=80%/>-->
                
                
            </div>
            <div class="right">
                <a href="../login/index.html" role="button" class="btn btn-primary btn-lg logout " style="background-color:white ;color:#ff5555">  
                            Logout</a>
               <img class="mb-4" src="../images/logo/SAPply_logo_extended_566x256.png" alt=""/>
               
                <button type="button" class="btn btn-primary biggerbtn" ><b>Scansiona un tag QR</b></button>
                <img class="mb-4" src="../images/icons/qr_icon.png" alt=""/>
                <p class="text-center text"><b>Oppure immetti il numero dello zaino</b></p>
                <form action="codiceCheck.php"  method="POST" name="codiceForm" onsubmit="return validaCodice()">
                    <input type="text" name="codiceZaino" class="form-group" placeholder="Codice Zaino" size="2"  autofocus required   />
                    <button class="btn btn-sm btn-primary btn-block " name="codiceButton" type="submit" style="background-color:#ff5555 ;color:whitesmoke;">Gestisci</button>

                   
                </form>
                
            </div>
        </div>
        
                    
                   
                  
    </body>
    
</html>