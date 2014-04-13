
<?php
require_once 'libs/mallit/Aihe.php';
require_once 'libs/mallit/Alue.php';


$muokattavanID = $data->aiheID;
$muokattavaAihe = Aihe::getAiheJollaID($muokattavanID);

?>
<div class="container">

    <form action ="muokkaaAihetta.php?aiheID="<?php echo $muokattavanID; ?> method ="POST">
        <p>
        <div>
            Alue
        </div>
        <select name="alue">
        <?php foreach(Alue::haeKaikkiAlueet() as $alue){?>
            
          <option value="<?php echo $alue->getNimi(); ?>"><?php echo $alue->getNimi(); ?></option>
        
        <?php } ?>
        </select>
    </p>
    
    <p>
    <div>
        Aiheen nimi
        <input type="text" style="width: 240px" class="form-control" name="aiheenNimi" value="<?php echo $muokattavaAihe->getNimi(); ?>"></input>
    </div>

    </p>
        
        

        
        

        <div>
            <button class="btn btn-default">Tallenna</button>
            <a type="button" class="btn btn-danger" href="muokkaaAihetta.php.php?poista=<?php echo $muokattavaAihe->getId() ?>"><span class="glyphicon glyphicon-remove-sign"></span> Poista</a>
        </div>
    
    </form>
</div>
