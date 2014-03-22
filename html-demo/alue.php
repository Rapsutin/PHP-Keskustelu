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
            <div  class="panel panel-default">
               
                <table class="table table-bordered">
                    <col width="400px" />
                    <col width="10px" />
                    
                    <tr>
                        <th>Aihe</th>
                        <th>Viestejä</th> 

                    </tr>
                    <tr>
                        <td><span class="glyphicon glyphicon-envelope"></span> <a href="aihe.php">Olympialaiset</a></td>
                        <td>77</td> 

                    </tr>
                    <tr>
                        <td><a href="aihe.php">Paras kebabmesta (Oikeesti olympialaiset)</td>
                        <td>17</td> 

                    </tr>
                </table>
            </div>


    </body>
</html>
