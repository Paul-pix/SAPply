<html>
    <head></head>
    <body>
        <?php
            $dbconn=pg_connect("host=localhost port=5432 dbname=SAP user=postgres password=admin")
            or die('Could not connect: '. pg_last_error());
                                                                                        
                    $nome=$_POST['inputName'];
                    $data=$_POST['inputData'] ;                                     
                    $q1="insert into zaino values($1,$2,$3,$4,$5)";                              //inserisce nel database in ordine
                    $data=pg_query_params($dbconn,$q1,array($email,$nome,$data)); //dà un valore di ritorno booleano,ordine importante nell'array, stesso ordine nel database
                if($data){                                                                  //se true
                     echo "<h1>Registrazione utilizzo </br></h1>";
                    
                }               
             
        ?>
    </body>
</html>