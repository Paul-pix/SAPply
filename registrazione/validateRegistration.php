<html>
    <head></head>
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
                    echo "<h1> Sorry, you are already a registered user </h1>
                    <a href=../login/index.html Click here to login </a>";
                }
                else{                                                                             //inseriamo in utente
                    $nome=$_POST['inputName'];
                    $cognome=$_POST['inputSurname'];
                    $cap=$_POST['cap'];
                    $password=md5($_POST['inputPassword']);                                       //md5 crea stringa pseudocasuale
                    $q2="insert into utente values($1,$2,$3,$4,$5)";                              //inserisce nel database in ordine
                    $data=pg_query_params($dbconn,$q2,array($email,$nome,$cognome,$cap,$password)); //dà un valore di ritorno booleano,ordine importante nell'array, stesso ordine nel database
                if($data){                                                                  //se true
                    //header("Location:registrationCompleted.html");
                    echo "<h1>Registration is completed.
                    Start using the website </br></h1>";
                    echo "<a href=../Welcome.php?name=$nome> Premi qui </a> per iniziare ad utilizzare il sito web"; // dopo il ? ho coppie parametro=valore 
                }               
             }
            }
        ?>
    </body>
</html>
