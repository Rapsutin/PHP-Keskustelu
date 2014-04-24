
<div class="container">
    <form action ="muokkaaAluetta.php?alueID=<?php echo $data->alueID ?>" method ="POST">
        <div>
            Alueen nimi
            <input type="text" style="width: 240px" class="form-control" name="alueenNimi" 
                   value="<?php 
                   if(isset($data->nimi)) {
                       echo $data->nimi;
                   } else {
                       echo $data->alueID;
                   }
                   ?>"></input>
                   
            <button class="btn btn-default">Tallenna</button>
            <a type="button" class="btn btn-danger" href="muokkaaAluetta.php?poista=<?php echo $data->alueID; ?>"><span class="glyphicon glyphicon-remove-sign"></span> Poista</a>
        </div>
    </form>
</div>

