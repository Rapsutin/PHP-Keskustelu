
<?php
require_once 'libs/mallit/Aihe.php';
?>
<div class="container">

    <form action ="uusiaihe.php?alue=<?php echo $data->alue ?>" method ="POST">
        <p>
        <div>
            Uuden aiheen nimi*
            <input type="text" style="width: 240px" class="form-control" name="aiheenNimi" value="<?php echo $data->aiheenNimi; ?>"></input>
        </div>
        
        </p>

        <div>
            Aloitusviesti*
        </div>
        
        <textarea rows="6" cols="50" name ="viesti"><?php echo $data->viesti; ?></textarea>

        <div>
            <button><span class="glyphicon glyphicon-share-alt"></span> Lähetä</button>
        </div>
    </form>
</div>
