<html>
    <head></head>
    <body>
        <?php
        $dbconn=pg_connect("host=localhost port=5432 dbname=Login user=postgres password=admin")    // connessione database
                or die('Could not connect: '. pg_last_error());
                if(!(isset($_POST['loginButton']))) {           // contollo se la variabile per il loginButton della chiamata POST esiste 
                        header("Location: ../index.html");      //se accedo a login.php senza passare dal login button vengo reindirizzato su index.html
                }
                else{
                    $email=$_POST['inputEmail'];                //salvo inputEmail nella variabile email
                    $q1="select * from utente where email=$1";      
                    $result=pg_query_params($dbconn,$q1,array($email));
                    if(!($line=pg_fetch_array($result,null,PGSQL,ASSOC))){
                        echo "<h1> You are not a registered user </h1> <a href=../registrazione/index.html>
                        Click here to register</a>";
                    }
                    else{
                        $password=md5($_POST['inputPassword']);
                        $q2="select * from utente where email=$1 and password=$2";
                        $result=pg_query_params($dbconn,$q2,array($email,$password));
                        if (!($line=pg_fetch_array($result,null,PGSQL_ASSOC))){
                            echo "<h1> The password is erroneous</h1> <a href=index.html>Click here to login </a>";
                        }
                        else{
                            $nome=$line['nome'];
                            echo "<a href=../Welcome.php?name=$nome>Premi qui </a> per iniziare ad utilizzare il SAPply";
                        }
                    }
                }
        ?>
    </body>
</html>