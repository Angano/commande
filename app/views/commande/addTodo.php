<?php

ob_start();?>



<div class="row">
        <div class="col-md-11 mx-auto">
            <?php 
                if(isset($datas['todo']) && strlen($datas['todo'])>1){?>
                    <h3>Mise à jour d'un todo</h3><?php
                    $titlePage = 'Mise à jour d\'un Todo';
                }else{?>
                    <h3>Ajout d'un todo</h3><?php
                    $titlePage = 'Ajoût d\'un Todo';
                }
                ?>
            
        </div>
</div>
<div class="row">
    <div class="card col-md-11 mx-auto mt-3">
        <p><b>Commande N°: </b> <a href="<?=URLROOT?>/commande/detail/<?= $datas['rowid']?>"><?=$datas['ref'] ?></a></p>
        <p><b><?=$datas['nom'] ?></b> </p>
        <p><?=$datas['address'] ?> <?=$datas['zip'] ?> <b><?=$datas['town'] ?></b></p>
    

    </div>
    <div class="row">

      <div class="col-md-11 mx-auto mt-3">
        <form action="" method="post">
            <input type="hidden" name="commande_id" id="" value="<?= $datas['rowid'] ?>">
            <textarea name="todo" placeholder="Todo" id="" class="w-100" rows="10" ><?php if(isset($datas['todo'])){echo $datas['todo'];}?></textarea>
            <div class="text-center mt-5">
                
                <?php 
                if(isset($datas['todo']) && strlen($datas['todo'])>1){?>
                 <input class="btn btn-success" type="submit" value="Mettre à jour"><?php
                }else{?>
                    <input class="btn btn-success" type="submit" value="Ajouter"><?php
                }
                ?>
            </div>
            
        </form>
    </div>
    </div>
 
</div>


<?php
$content = ob_get_clean();

require('../app/views/base.php');