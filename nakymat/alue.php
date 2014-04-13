<?php
require_once '../libs/mallit/Viesti.php';
require_once '../libs/kirjautunut.php'
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

            <?php
                foreach ($data->aiheet as $aihe) {
                    ?>
                    <tr>
                        <td>
                            <span class="glyphicon glyphicon-envelope"></span> 
                            <a href="aihe.php?id=<?php echo $aihe->getID(); ?>">
                                <?php echo htmlspecialchars($aihe->getNimi()); ?>
                            </a>
                        </td>
                        <td><?php echo Viesti::montaViestiaAiheessa($aihe->getID()); ?></td> 

                    </tr>

            <?php }?>

            </table>

        </div>
    <?php if (onKirjautunut()) { ?>
            <a type="button" class="btn btn-default" href="../libs/uusiaihe.php?alue=Yleinen%20keskustelu">
                <span class="glyphicon glyphicon-plus"></span> Uusi aihe
            </a>
    <?php } ?>
</div>
