<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <link href="../css/bootstrap.css" rel="stylesheet">
        <link href="../css/bootstrap-theme.css" rel="stylesheet">
        <link href="../css/main.css" rel="stylesheet">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require_once 'navigointi.php';
        ?>

        <div class="container">
            
            <h4>Aihe: Olympialaiset</h4>
            <div  class="panel panel-default">
                <table class="table table-bordered">
                    <col width="50px" />
                    <col width="300px" />
                    <tr>
                        <td>
                            <p><a href="#">Rapsutin</a></p>
                            <p><img src="http://upload.wikimedia.org/wikipedia/commons/1/1e/G._Rasputin.JPG" style="max-height: 100px; max-width: 100px;" /></p>
                            <p>Liittynyt: 09/2010</p>
                            Viestejä: 49
                        </td>
                        <td>  Lorem ipsum blaa blaa Lorem ipsum blaa blaa Lorem ipsum blaa blaa
                            Lorem iprem ipsum blaa blaaLorem ipsum blaa blaa.
                            <p><div class="btn-group">

                                <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-edit"></span> Muokkaa</button>
                                <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-transfer"></span> Vastaa</button>
                            </div></p>


                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p><a href="#">Rapsutin</a></p>
                            <p><img src="http://upload.wikimedia.org/wikipedia/commons/1/1e/G._Rasputin.JPG" style="max-height: 100px; max-width: 100px;" /></p>
                            <p>Liittynyt: 09/2010</p>
                            Viestejä: 49
                        </td>
                        <td>
                            Tuplapostaus uliuli
                            <p><div class="btn-group">

                                <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-edit"></span> Muokkaa</button>
                                <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-transfer"></span> Vastaa</button>
                            </div></p>
                        </td> 

                    </tr>
                </table>
            </div>
            

                
            
            <a type="button" class="btn btn-default" href="uusiviesti.php">
                <span class="glyphicon glyphicon-share-alt"></span> Uusi viesti
            </a>
        </div>
    </body>
</html>
