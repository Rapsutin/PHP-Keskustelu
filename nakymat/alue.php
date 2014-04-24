<?php
require_once 'libs/mallit/Viesti.php';
require_once 'libs/mallit/Luetut.php';
require_once 'libs/kirjautunut.php';
?>
<div class="container">
    <h4><?php echo $data->alueID ?> <?php 
        if (onKirjautunut()) {
            if($_SESSION['kirjautunut']->onkoYllapitaja()) {
        ?>
        <a type="button" class="btn btn-link" href="muokkaaAluetta.php?alueID=<?php echo $data->alueID; ?>">
            Muokkaa aluetta
        </a>
        <?php }} ?></h4>
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
                            <?php 
                            if(onKirjautunut()):
                                
                                $kirjautunut = $_SESSION['kirjautunut'];
                                $nimimerkki = $kirjautunut->getNimimerkki();
                                
                                if(!onkoLuettu($nimimerkki, $aihe->getID())): ?>
                                    <span class="glyphicon glyphicon-envelope"></span>
                                
                            <?php endif; endif; ?>
                            
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
    <a type="button" class="btn btn-default" href="uusiaihe.php?alue=<?php echo $data->alueID ?>">
                <span class="glyphicon glyphicon-plus"></span> Uusi aihe
            </a>
    <?php } ?>
</div>
