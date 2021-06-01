<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../main/popup_style.css">
        <link rel="stylesheet" type="text/css" href="style.css">
        <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
        <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"/>
        <script type="text/javascript" lang="javascript" src="../js/bootstrap.min.js"></script>
    </head>
    <body>
        <?php
            $dbconn=pg_connect("host=localhost port=5432 dbname=Login user=postgres password=admin")
            or die('Could not connect: '. pg_last_error());
            if(!(isset($_POST['registrationButton']))) {                                          //reindirizzati alla pagina index se non accediamo tramite il registration button
                header("Location: ../index.html");
            }
            else{
                $email=$_POST['inputEmail'];
                $q1="select * from utente where email=$1";
                $result=pg_query_params($dbconn,$q1,array($email));
                if($line=pg_fetch_array($result,null,PGSQL_ASSOC)){                              //se è una mail già registrata manda messaggio di errore
                    echo "<script>
                            $(function(){
                                $( \"#dialog\" ).dialog({
                                autoOpen: open
                                });
                            });
                            </script>";
                            echo "<div id=\"dialog\" title=\"Registrazione non riuscita!\">
                                <h5>L'utenete è già registrato.</h5>
                                <div><a id=\"botto\" href=\"../login/index.html\" role=\"button\" class=\"btn btn-primary btn-sm btnred\">Torna al Login</a></div>
                            </div>";
                }
                else{                                                                             //inseriamo in utente
                    $nome=$_POST['inputName'];
                    $cognome=$_POST['inputSurname'];
                    $cap=$_POST['cap'];
                    $password=md5($_POST['inputPassword']);                                       //md5 crea stringa pseudocasuale
                    $q2="insert into utente values($1,$2,$3,$4,$5)";                              //inserisce nel database in ordine
                    $data=pg_query_params($dbconn,$q2,array($email,$nome,$cognome,$cap,$password)); //dà un valore di ritorno booleano,ordine importante nell'array, stesso ordine nel database
                if($data){                                                                  //se true
                    echo "<script>
                    $(function(){
                        $( \"#dialog\" ).dialog({
                        autoOpen: open
                        });
                    });
                    </script>";
                    echo "<div id=\"dialog\" title=\"Registrazione riuscita!\">
                        <h5>L'utenete è stato registrato. Esegui l'accesso per usare SAPply</h5>
                        <div><a id=\"botto\" href=\"../login/index.html\" role=\"button\" class=\"btn btn-primary btn-sm btnred\">Torna al Login</a></div>
                    </div>";
                }               
             }
            }
        ?>
    </body>
</html>
