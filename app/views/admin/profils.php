<?php ob_start();
$titlePage = 'Commandes: profils authorisés'
?>









<div class="row py-1">
        <div class="col-md-11">
            <h3>Gestion des profils authorisés à gérer les commandes</h3>
        </div>      
</div>

    <div class="row">
        <div class="col-md-11">
<form action="" method="POST">


<?php 
foreach($datas['profils'] as $profil){?>
    <div>
        <label for="profil_<?= $profil['id']?>"><?= $profil['intitule']?>#<?= $profil['id']?></label>
        <input  type="checkbox" 
                name="profil[]" 
                id="profil_<?= $profil['id']?>" 
                value="<?= $profil['fk_profil']?>" <?php if($profil['actif']==='1'){ ?> checked <?php } ?> >
    </div>
<?php } ?>


<div>
    <input type="reset" value="reset">
    <input type="submit" value="add">
</div>








</form>      
</div>
    </div>



<?php

$content = ob_get_clean();
require('../app/views/base.php');