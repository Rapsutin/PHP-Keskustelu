<?php
require_once 'libs/mallit/Alue.php';
require_once 'libs/mallit/Kayttaja.php';
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
            <?php foreach (Alue::haeKaikkiAlueet() as $alue): ?>
                <tr>
                    <td><a href="alue.php?id=<?php echo $alue->getNimi(); ?>"><?php echo $alue->getNimi(); ?></a></td>
                    <td><?php echo $alue->getAiheitaAlueella(); ?></td> 
                    <td><?php echo $alue->getViestejaAlueella(); ?></td>
                </tr>
            <?php endforeach; ?> 

        </table>


        
    </div>
    <?php 
        session_start();
        if(isset($_SESSION['kirjautunut'])):
            if($_SESSION['kirjautunut']->onkoYllapitaja()):
        ?>
                <a type="button" class="btn btn-default" href="uusialue.php"><span class="glyphicon glyphicon-plus"></span> Uusi alue</a>
        <?php 
            endif;
        endif;
        ?>
</div>