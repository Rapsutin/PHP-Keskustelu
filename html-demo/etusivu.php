<!DOCTYPE html>
<html>
    <head>
        <link href="../css/bootstrap.css" rel="stylesheet">
        <link href="../css/bootstrap-theme.css" rel="stylesheet">
        <link href="../css/main.css" rel="stylesheet">
        <title>PHP-Keskustelu</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
        <?php
        require_once 'navigointi.php';
        ?>
        <div class="container">
            <div class="panel panel-default">
                
                <table class="table table-bordered">
                    <col width="400px" />
                    <col width="10px" />
                    <col width="10px" />
                    <tr>
                        <th>Alue</th>
                        <th>Aiheita</th> 
                        <th>Viestejä</th>
                    </tr>
                    <tr>
                        <td><a href="alue.php">Yleinen keskustelu</a></td>
                        <td>77</td> 
                        <td>506</td>
                    </tr>
                    <tr>
                        <td><a href="alue.php">Kalastus</td>
                        <td>17</td> 
                        <td>108</td>
                    </tr>
                </table>



            </div>


    </body>
</html>
