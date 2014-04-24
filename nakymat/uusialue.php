<?php ?>

<div class="container">
    <form action ="uusialue.php" method ="POST">
        <div>
            Uuden alueen nimi
            <input type="text" style="width: 240px" class="form-control" name="alueenNimi" value="<?php echo $data->nimi; ?>"></input>
            <button class="btn btn-default">Tallenna</button>
        </div>
    </form>
</div>
