<?php
    session_start();
   
?>
<!DOCTYPE html>
<html>

<head>
    <title>SAPply - Aggiorna zaino</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" type="image/png" href="../logo/SAPply_logo_32x32.png" sizes="32x32">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="popup_style.css">
    <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script type="text/javascript" lang="javascript" src="../js/bootstrap.min.js"> </script>
    <script type="text/javascript" lang="javascript" src="script.js"></script>

</head>

<body>
    <div class="topnav sticky-top">
        <a href="index.php" class="torna active">Indietro</a>
        <a href="#presidi">Presidi</a>
        <a href="#fialario">Fialario</a>
    </div>
    <section id="presidi" class="section text-center" autofocus>
        </br>
        </br>
        <div class="text-center">
            <div class=" text-center" autofocus>

                <h1>Zaino <?php echo $_SESSION["zaino"] ?></h1>
            </div>
            <div>
                <!-- Presidi-->
                <?php
                $message="";
            $dbconn=pg_connect("host=localhost port=5432 dbname=SAP user=postgres password=admin")    
                             or die('Could not connect: '. pg_last_error());
                if(isset($_POST['update'])) {          
                       
                    $codice= $_SESSION["zaino"];
                    $elemPres=$_POST['elemento'];                //salvo elemento nella variabile elemPres
                    $quantità=$_POST['quantita'];    
                     $data = array('quantità'=>$quantità);
                     $cond=array('codice'=>$codice,'elemento'=>$elemPres);
                   
                    $res = pg_update($dbconn, 'presidi', $data, $cond);
                    if ($res) {
                        echo "<script>
                        $(function(){
                            $( \"#dialog\" ).dialog({
                            autoOpen: open
                            });
                        });
                        </script>";
                        $var=$_SESSION['zaino'];
                        echo "<div id=\"dialog\" title=\"Operazione completata!\">
                            <h5>Lo zaino $codice ora contiene $quantità $elemPres.</h5>
                        </div>"; 
                    } 
 }  ?>

                <div class="row justify-content-center">
                    <form action="" method="POST" name="aggFPresidi" onSubmit="return aggiornaFormPresidi()">
                        <div class="form-group form-control">
                            <select name="elemento" required>
                                <option value="Abbassalingua">Abbassalingua</option>
                                <option value="Aghi Cannula Arancione">Aghi Cannula Arancione</option>
                                <option value="Aghi Cannula Rosa">Aghi Cannula Rosa</option>
                                <option value="Aghi Cannula Verde">Aghi Cannula Verde</option>
                                <option value="Aghi Diluzione">Aghi Diluzione</option>
                                <option value="Ambu Adulto">Ambu Adulto</option>
                                <option value="Ambu Pediatrico">Ambu Pediatrico</option>
                                <option value="Cerotto">Cerotto</option>
                                <option value="Deflussori">Deflussori</option>
                                <option value="Fonendoscopio">Fonendoscopio</option>
                                <option value="Forbici">Forbici</option>
                                <option value="Ghiaccio secco">Ghiaccio secco</option>
                                <option value="Guedel Arancione">Guedel Arancione</option>
                                <option value="Guedel Celeste">Guedel Celeste</option>
                                <option value="Guedel Gialla">Guedel Gialla</option>
                                <option value="Guedel Rossa">Guedel Rossa</option>
                                <option value="Laccio Emostatico">Laccio Emostatico</option>
                                <option value="Laeingoscopio">Laeingoscopio</option>
                                <option value="Maschera Laringea">Maschera Laringea</option>
                                <option value="Maschere Facciali">Maschere Facciali</option>
                                <option value="Metalline">Metalline</option>
                                <option value="Raccordo Tubo ET">Raccordo Tubo ET</option>
                                <option value="Sfigmomanometro">Sfigmomanometro</option>
                                <option value="Siringhe">Siringhe</option>
                                <option value="Termometro">Termometro</option>
                                <option value="Tubo ET sz6">Tubo ET sz6</option>
                                <option value="Tubo ET sz7">Tubo ET sz7</option>
                            </select>
                            <input type="text" name='quantita' placeholder="Quantità" required>
                            <button type="submit" name="update" class="btn btn-primary btn-sm btnred">Update</button>

                        </div>

                    </form>

                </div>
                <?php
             echo"<h5 >Presidi</h5>";
             echo "</table>";
             $conn=pg_connect("host=localhost port=5432 dbname=SAP user=postgres password=admin")
             or die('Could not connect: '. pg_last_error()); 
             $cod=$_SESSION['zaino'];
             $sql=" SELECT elemento,quantità from presidi where codice='$cod' and quantità>0 order by elemento";
             $queryRecords = pg_query($conn, $sql) or die("error to fetch inventario data");
            
             echo "<table class='text-center'>";
             echo "<thead><tr><th>Elemento</th><th>Quantità</th></tr></thead>";
             while($row=pg_fetch_array($queryRecords,null,PGSQL_ASSOC)){
                $elemento1=$row['elemento'];
                  echo "<tr><td>". $row['elemento']. "</td><td>". $row['quantità']."</td></tr>";
             }
             echo "</table>";
            echo "</br></br>";?>
            </div>
            <div>
    </section>
    <!-- Fialario-->
    <section id="fialario" class="section text-center" autofocus>
        </br>
        </br>
        <?php  if(isset($_POST['update2'])) {          
                       
                       $codice= $_SESSION["zaino"];
                       $elemPres2=$_POST['elemento'];                //salvo elemento nella variabile elemPres
                       $quantità2=$_POST['quantita']; 
                       $scadenza0=$_POST['scadenza'];   
                        $scadenza=date("Y-m-d", strtotime($scadenza0));
                        $data2 = array('quantità'=>$quantità2);
                        $cond2=array('codice'=>$codice,'elemento'=>$elemPres2,'scadenza'=>$scadenza);
                      
                       $res2 = pg_update($dbconn, 'inventario', $data2, $cond2);
                       if ($res2) {
                        echo "<script>
                        $(function(){
                            $( \"#dialog\" ).dialog({
                            autoOpen: open
                            });
                        });
                        </script>";
                        $var=$_SESSION['zaino'];
                        $scadenza1=date("d-m-Y", strtotime($scadenza0));
                        echo "<div id=\"dialog\" title=\"Operazione completata!\">
                            <h5>Lo zaino $codice ora contiene $quantità2 $elemPres2, con scadenza $scadenza1.</h5>
                        </div>"; 
                    } 
                       } 

                       //FUNZIONE AGGIUNGI

            $dbconn=pg_connect("host=localhost port=5432 dbname=SAP user=postgres password=admin")
            or die('Could not connect: '. pg_last_error());
            if(isset($_POST['aggiorna'])) { 
                $codice= $_SESSION["zaino"];                                         
                 $scade=$_POST['scadenza3'];
                 $nomeEl=$_POST['elemento3'];
                $q3="select * from inventario where codice=$1 and scadenza=$2 and elemento=$3 ";
                $result=pg_query_params($dbconn,$q3,array($codice,$scade,$nomeEl));
                if($line=pg_fetch_array($result,null,PGSQL_ASSOC)){                             
                    echo "<script>
                    $(function(){
                        $( \"#dialog\" ).dialog({
                        autoOpen: open
                        });
                    });
                    </script>";
                   
                    $scadenza1=date("d-m-Y", strtotime($scade));
                    echo "<div id=\"dialog\" title=\"Operazione completata!\">
                        <h5>Lo zaino $codice contiene già $nomeEl, con scadenza $scadenza1.</h5>
                    </div>";
                }
                else{  
                    $codice= $_SESSION["zaino"];
                    $nomeEl=$_POST['elemento3']; 
                    $quantita3=$_POST['quantita3'];
                    $scade=$_POST['scadenza3'];
                    $q3="insert into inventario values($1,$2,$3,$4)";                              //inserisce nel database in ordine
                    $data3=pg_query_params($dbconn,$q3,array($codice,$nomeEl,$quantita3,$scade)); //dà un valore di ritorno booleano,ordine importante nell'array, stesso ordine nel database
                if($data3){                                                                  //se true
                    echo "<script>
                    $(function(){
                        $( \"#dialog\" ).dialog({
                        autoOpen: open
                        });
                    });
                    </script>";
                    $scadenza1=date("d-m-Y", strtotime($scade));
                    echo "<div id=\"dialog\" title=\"Operazione completata!\">
                        <h5>Lo zaino $codice ora contiene $quantita3 $nomeEl, con scadenza $scadenza1.</h5>
                    </div>";
                }               
             }
            }
?>
        <div class="row justify-content-center">
            <form action="" method="POST" name="aggFform" onSubmit="return aggiornaFormFialario()">
                <div class="form-group form-control">
                    <select name="elemento" required>
                        <option value="Acido tranexamico 500mg/5ml">Acido tranexamico 500mg/5ml</option>
                        <option value="Adrenalina">Adrenalina</option>
                        <option value="Anexate">Anexate</option>
                        <option value="Atropina">Atropina</option>
                        <option value="Bentelan 1,5mg">Bentelan 1,5mg</option>
                        <option value="Bentelan 4g">Bentelan 4g</option>
                        <option value="Broncovaleas">Broncovaleas</option>
                        <option value="Buscopan">Buscopan</option>
                        <option value="Clonidina">Clonidina</option>
                        <option value="Condarone">Condarone</option>
                        <option value="Contramal">Contramal</option>
                        <option value="Contramal 50mg/1ml">Contramal 50mg/1ml</option>
                        <option value="Diclofenac">Diclofenac</option>
                        <option value="Efedrina">Efedrina</option>
                        <option value="Furosemide">Furosemide</option>
                        <option value="Glucosio 33%">Glucosio 33%</option>
                        <option value="Lidocaina">Lidocaina</option>
                        <option value="Metadoxil 300mg">Metadoxil 300mg</option>
                        <option value="Naloxone 0,4mg">Naloxone 0,4mg</option>
                        <option value="Noradrenalina">Noradrenalina</option>
                        <option value="Plasil">Plasil</option>
                        <option value="Propofol">Propofol</option>
                        <option value="Talofen">Talofen</option>
                        <option value="Tefamin">Tefamin</option>
                        <option value="Urbason 20mg">Urbason 20mg</option>
                        <option value="Valium">Valium</option>

                    </select>
                    <input type="text" name='quantita' placeholder="Quantità" required>
                    <input type="date" name='scadenza' placeholder="Scadenza" required>
                    <button type="submit" name="update2" class="btn btn-primary btn-sm btnred">Update</button>
                </div>
            </form> <!-- FORM AGGIUNGI-->
            <form action="" method="POST" name="aggFform2" onSubmit="return aggiungiFormFialario()">
                <div class="form-group form-control">
                    <select name="elemento3" required>
                        <option value="Acido tranexamico 500mg/5ml">Acido tranexamico 500mg/5ml</option>
                        <option value="Adrenalina">Adrenalina</option>
                        <option value="Anexate">Anexate</option>
                        <option value="Atropina">Atropina</option>
                        <option value="Bentelan 1,5mg">Bentelan 1,5mg</option>
                        <option value="Bentelan 4g">Bentelan 4g</option>
                        <option value="Broncovaleas">Broncovaleas</option>
                        <option value="Buscopan">Buscopan</option>
                        <option value="Clonidina">Clonidina</option>
                        <option value="Condarone">Condarone</option>
                        <option value="Contramal">Contramal</option>
                        <option value="Contramal 50mg/1ml">Contramal 50mg/1ml</option>
                        <option value="Diclofenac">Diclofenac</option>
                        <option value="Efedrina">Efedrina</option>
                        <option value="Furosemide">Furosemide</option>
                        <option value="Glucosio 33%">Glucosio 33%</option>
                        <option value="Lidocaina">Lidocaina</option>
                        <option value="Metadoxil 300mg">Metadoxil 300mg</option>
                        <option value="Naloxone 0,4mg">Naloxone 0,4mg</option>
                        <option value="Noradrenalina">Noradrenalina</option>
                        <option value="Plasil">Plasil</option>
                        <option value="Propofol">Propofol</option>
                        <option value="Talofen">Talofen</option>
                        <option value="Tefamin">Tefamin</option>
                        <option value="Urbason 20mg">Urbason 20mg</option>
                        <option value="Valium">Valium</option>

                    </select>
                    <input type="text" name='quantita3' placeholder="Quantità" required>
                    <input type="date" name='scadenza3' placeholder="Scadenza" required>
                    <button type="submit" name="aggiorna" class="btn btn-primary btn-sm btnred">Aggiungi nuovo</button>
            </form>
        </div>
        </div>


        <?php
             echo"<h5 >Fialario</h5>";
             $cod=$_SESSION['zaino'];
             $sql=" SELECT elemento,quantità,scadenza from inventario where codice='$cod' and quantità>0 order by elemento";
             $queryRecords = pg_query($conn, $sql) or die("error to fetch inventario data");
             echo "<table class='centro'>";
             echo "<tr><th>Elemento</th><th>Quantità</th><th>Scadenza</th><th>Scaduto</th></tr></thead>";
             while($row=pg_fetch_array($queryRecords,null,PGSQL_ASSOC)){ 
                 $el=$row['elemento'];
                 $scad1=$row['scadenza'];
                 $scad2=date("d-m-Y", strtotime($scad1));
                if(date('Y-m-d') > date('Y-m-d', strtotime($scad1))){
                   
                    $scaduto = "sì";
                    echo "<tr><td>". $row['elemento']. "</td><td>". $row['quantità']. "</td><td>".$scad2."</td><td>".$scaduto."</td></tr>";
                }   
            }
            $sql2=" SELECT elemento,quantità,scadenza from inventario where codice='$cod' order by elemento";
             $queryRecords2 = pg_query($conn, $sql2) or die("error to fetch inventario data");
            while($row=pg_fetch_array($queryRecords2,null,PGSQL_ASSOC)){ 
                $el=$row['elemento'];
                $scad1=$row['scadenza'];
                $scad2=date("d-m-Y", strtotime($scad1));
               if(date('Y-m-d') < date('Y-m-d', strtotime($scad1))){
                  $scaduto="no";
                  echo "<tr><td>". $row['elemento']. "</td><td>". $row['quantità']. "</td><td>".$scad2."</td><td>".$scaduto."</td></tr>";
                  
             }
            }
             echo "</table>";

           ?>
        </div>
    </section>
</body>