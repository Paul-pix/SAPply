<html>
    <head>
        <title>Database login</title>
    </head>
    <body>
        <?php
        $dbconn= pg_connect("host=localhost port=5432 
                            dbname=SAP
                            user=postgres password=admin")
                            or die('Could not connect: '. pg_last_error());
    ?>
    </body>
    
</html>