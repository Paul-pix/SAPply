<html>

<head>
    <link rel="stylesheet" type="text/css" href="../main/popup_style.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" />
    <script type="text/javascript" lang="javascript" src="../js/bootstrap.min.js"></script>
</head>

<body>
    <?php
            $dbconn=pg_connect("host=localhost port=5432 dbname=Login user=postgres password=admin")    // connessione database
                             or die('Could not connect: '. pg_last_error());
                if(!(isset($_POST['loginButton']))) {           // contollo se la variabile per il loginButton della chiamata POST esiste 
                        header("Location: ../index.html");      //se accedo a login.php senza passare dal login button vengo reindirizzato su index.html
                }
                else{
                    $email=$_POST['inputEmail'];                //salvo inputEmail nella variabile email
                    $q1="select * from utente where email=$1";      //creo una query per verificare se un utente esiste con questa email
                    $result=pg_query_params($dbconn,$q1,array($email));     //pg_query_params ( resource $connection = ? , string $query , array $params ) : resource|false
                    if(!($line=pg_fetch_array($result,null,PGSQL_ASSOC))){
                        echo "<script>
                            $(function(){
                                $( \"#dialog\" ).dialog({
                                autoOpen: open
                                });
                            });
                            </script>";
                            echo "<div id=\"dialog\" title=\"Login non riuscito!\">
                                <h5>Le credenziali di accesso non sono corrette.</h5>
                                <div><a id=\"botto\" href=\"index.html\" role=\"button\" class=\"btn btn-primary btn-sm btnred\">Torna al Login</a></div>
                            </div>";
                    }
                    else{
                        $password=md5($_POST['inputPassword']);
                        $q2="select * from utente where email = $1 and password = $2"; //controllo se email e password sono nel database
                        $result=pg_query_params($dbconn,$q2,array($email,$password));
                        if (!($line=pg_fetch_array($result,null,PGSQL_ASSOC))){
                            echo "<script>
                            $(function(){
                                $( \"#dialog\" ).dialog({
                                autoOpen: open
                                });
                            });
                            </script>";
                            echo "<div id=\"dialog\" title=\"Login non riuscito!\">
                                <h5>Le credenziali di accesso non sono corrette.</h5>
                                <div><a id=\"botto\" href=\"index.html\" role=\"button\" class=\"btn btn-primary btn-sm btnred\">Torna al Login</a></div>
                            </div>"; 
                        }
                        else{
                            header('Location:../home/index.php');
                        }
                    }
                }
        ?>
</body>

</html>