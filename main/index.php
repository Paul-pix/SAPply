<?php
    session_start();
    
?>
<!DOCTYPE html>
<html>

<head>
    <title>SAPply - Gestione zaino</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" type="image/png" href="../logo/SAPply_logo_32x32.png" sizes="32x32">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script type="text/javascript" lang="javascript" src="script.js"></script>
    </script>
</head>

<body>
    <div class="topnav sticky-top">
        <a href="../home/index.php" class="torna active">Indietro</a>
        <a href="#panoramica">Panoramica</a>
        <a href="#contenuto">Contenuto</a>
        <a href="#preleva/consegna">Preleva - Consegna</a>


    </div>

    <div class="text-center">
        <section id="panoramica" class="section text-center" autofocus>
            </br>
            </br>
            </br>
            <div>
                <img src="../logo/SAPply_logo_256x256.png" alt="">
                <h1>Zaino <?php echo $_SESSION["zaino"] ?></h1>
            </div>
            <!--ultimo volontario che ha usato lo zaino,nome zaino,data ultimo utilizzo,rifornito-->

            </br>

            <?php 
             
             $conn=pg_connect("host=localhost port=5432 dbname=SAP user=postgres password=admin")
             or die('Could not connect: '. pg_last_error());
             echo"</br>";
             $cod=$_SESSION['zaino'];
             $sql1= " SELECT lastuser from zaino where codice='$cod'";
             $queryPersona= pg_query($conn, $sql1) or die("error to fetch zaino data");
             $persona=pg_result($queryPersona,null,0);
             echo "<b>Utilizzato da: </b> <a>$persona</a>";
             echo"</br>";
             $sql2= " SELECT ultimadata from zaino where codice='$cod'";
             $queryData= pg_query($conn, $sql2) or die("error to fetch zaino data");
             $data= pg_result($queryData,null,0);
             $dataconv = date("d-m-Y", strtotime($data));
             echo "<b>Data dell'ultimo utilizzo: </b> <a>$dataconv</a>";
             echo"</br>";
             $sql3= " SELECT disponibile from zaino where codice='$cod'";
             $queryDisponibile= pg_query($conn, $sql3) or die("error to fetch zaino data");
             $dataD=pg_result($queryDisponibile,null,0);
             echo "<b>Disponibile: </b> <a>$dataD</a>";
             echo"</br>";
            
             
             ?>
            <div>
                <a href="aggiorna.php" role="button" class="btn btn-primary btn-lg  "
                    style="background-color:#ff555f; ;color:whitesmoke">
                    Aggiorna Inventario</a>
            </div>

        </section>
        <section id="contenuto" class="section text-center">
            </br>
            </br>
            </br>
            <div>
                <h1 class=" text-center">Contenuto</h1>
            </div>


            <?php
             
             $conn=pg_connect("host=localhost port=5432 dbname=SAP user=postgres password=admin")
             or die('Could not connect: '. pg_last_error());
             echo"<h5 >Presidi</h5>";                                                                                                   //PRESIDI
             echo "</table>";
             
             $cod=$_SESSION['zaino'];
             $sql=" SELECT elemento,quantità from presidi where codice='$cod' order by elemento";
             $queryRecords = pg_query($conn, $sql) or die("error to fetch inventario data");
             echo "<table class='text-center'>";
             echo "<tr><th>Elemento</th><th>Quantità</th></tr>";
             while($row=pg_fetch_array($queryRecords,null,PGSQL_ASSOC)){
                  echo "<tr><td>". $row['elemento']. "</td><td>". $row['quantità']."</td></tr>";
             }
            echo "</table>";
            echo "</br></br>";
             echo"<h5 >Fialario</h5>";                                                                                                  //FIALARIO
             $cod=$_SESSION['zaino'];
             $sql=" SELECT elemento,quantità,scadenza from inventario where codice='$cod' order by elemento";
             $queryRecords = pg_query($conn, $sql) or die("error to fetch inventario data");
             echo "<table class='centro'>";
             echo "<tr><th>Elemento</th><th>Quantità</th><th>Scadenza</th></tr>";
             while($row=pg_fetch_array($queryRecords,null,PGSQL_ASSOC)){
                $scad3=$row['scadenza'];
                $scad4=date("d-m-Y", strtotime($scad3));
                  echo "<tr><td>". $row['elemento']. "</td><td>". $row['quantità']. "</td><td>".$scad4."</td></tr>";
             }
             echo "</table>";
           ?>


        </section>

        <section id="preleva/consegna" class="section text-center field">
            <div class="center">
                </br>
                </br>
                </br>
                <h1>Preleva - Consegna</h1>
                </br>
                <form action="panoramica.php" class="form-signin form-inline" method="POST" name="prelevaForm"
                    onSubmit="return prelevaForm()">
                    <div class="form-group mx-sm-3 mb-2">
                        <input type="text" name="inputName" class="form-control" placeholder="Name" required />
                    </div>
                    <button class="btn btn-lg btn-primary btn-block mb-2" name="prelevaButton" type="submit"
                        style="background-color:#ff5555 ;color:whitesmoke">Preleva</button>
                </form>
                </br>
                </br>


                <form action="panoramica2.php" class="form-signin" method="POST" name="consegnaForm"
                    onSubmit="return consegnaForm()">
                    <button class="btn btn-lg btn-primary btn-block" name="consegnaButton" type="submit"
                        style="background-color:#ff5555 ;color:whitesmoke">Consegna</button>
                </form>
                </br>
            </div>
        </section>

    </div>

</body>

</html>