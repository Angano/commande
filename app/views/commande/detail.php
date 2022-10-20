<?php
$titlePage = 'Commande N°: '.$datas['commande']['ref'];
ob_start();
?>

<div class="row py-3 ">
        <div class="col-md-11 mx-auto">
            <h3>Détail d'une commande</h3>
        </div>
</div>
<div class="row px-0">
    <div class="card  col-12 col-md-5 offset-md-1 ms-auto" >
        <p><b>Réf: </b><?=$datas['commande']['ref']?> </p>
        <p><b><?=$datas['commande']['nom']?></b> </p>
        <p><?=$datas['commande']['address']?>  </p>
        <p><?=$datas['commande']['zip']?> <b><?=$datas['commande']['town']?> </b></p>
        <p><b>Status: </b><?php 
                    switch($datas['commande']['fk_statut']){
                        case 0:
                            echo ' 0';
                            break;
                        
                        case 1:
                            echo 'En préparation';
                            break;

                        case 2:
                            echo 'A livrer';
                            break;

                        case 3:
                            echo 'Livrée par: <b>'.$datas['commande']['livreur_firstname'].'-'. $datas['commande']['livreur_lastname'].'</b>, le: <b>'.$datas['commande']['delivery_at'].'</b>';
                            break;

                    }
                    
                    ?>
                    <form action="https://google.com/maps//dir" method="get" >

                    
                    </form><button class="btn btn-sm btn-primary ">G.P.S</button></p>
                    
                    
        
    </div>
    <div class="card  col-12 col-md-5 offset-md-1 me-auto px-0" >
        <?php if(isset($datas['commande']['todo']) && strlen($datas['commande']['todo'])>1){ ?>
        
        <div class="card-header">
            <p><b>Todo:</b></p>
        </div>
        <div class="card-body">
            <?=$datas['commande']['todo']?>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <div>
               <b><?= $datas['commande']['firstname']?>- <?= $datas['commande']['lastname']?></b>&nbsp;le :<?= $datas['commande']['created_at']?>   
            </div>
            <div>
                <a href="<?=URLROOT?>/commande/AddTodo/<?=$datas['commande']['rowid']?>" class="btn btn-sm btn-primary">Update !</a> 
            </div>
        </div>
            <?php } else { ?>
        
            <div class="card-header">
                <b>Todo:</b>
            </div>
            <div class="card-body">
            
            </div>
            <div class="card-footer">
                <a href="<?=URLROOT?>/commande/AddTodo/<?=$datas['commande']['rowid']?>" class="btn btn-primary">Add Todo !</a>
            </div>
       
            <?php } ?>
   </div>
</div>
<form action="" method="post">
    <div class="row">
        <div class="card col-12 col-sm-11 mx-auto mt-3 p-0">   
                <div class="row mt-2">
                        <div class="col-12 d-flex justify-content-end my-2">
                            
                            <div><b>Valider la livraison</b>:&nbsp;&nbsp;</div>
                            <div class="me-2">
                                <label for="com_<?= $datas['commande']['rowid']?>"><b><i class="fa-solid fa-check" ></i></b></label>
                                <input  type="radio" 
                                        name="valid_commande[<?= $datas['commande']['rowid'] ?>]" 
                                        id="com_<?= $datas['commande']['rowid']?>" 
                                        value="3" <?php if($datas['commande']['fk_statut']==3){ ?>
                                        checked <?php } ?>
                                        >
                            </div>
                            <div class=" ms-2">
                                <label for="com_e<?= $datas['commande']['rowid']?>"><b><i for="com_e<?= $datas['commande']['rowid']?>" class="fa-solid fa-xmark"></i></b></label>
                                <input  type="radio" 
                                        name="valid_commande[<?= $datas['commande']['rowid'] ?>]" 
                                        id="com_e<?= $datas['commande']['rowid']?>" 
                                        value="2" <?php if($datas['commande']['fk_statut']==2){ ?>
                                        checked <?php } ?>
                                        >
                            </div>
                        </div>
                </div>
            </div>

    </div>
<?php if(count($datas['commandes'])>0){ 
    
     var_dump($datas['commande']);
    ?>
   
    <div class="row pb-3">
            <div class="col-md-11 mx-auto mt-3">
                <h4>Egalement pour ce client</h4>
                <span class="btn btn-sm btn-primary" id="showCommandes">Show</span>
            </div>
    </div>
    <div id="display_commandes" style="display:none">


    
  
    <?php
        foreach($datas['commandesBySoc'] as $commande){
            if($commande['ref']!==$datas['commande']['ref']){ ?>
                <div class="row  mx-auto alternate_color col-12 col-sm-11 my-2 justify-content-end">
                    <div class="col-12 d-flex justify-content-between">
                        <div>
                            <a href="<?= URLROOT?>/commande/detail/<?= $commande['rowid']?>" ><?= $commande['ref'] ?></a>
                            <small class="ms-2">
                                <?php 
                                switch($commande['fk_statut']){
                                    case 0:
                                        echo ' 0';
                                        break;
                                    
                                    case 1:
                                        echo 'En préparation';
                                        break;

                                    case 2:
                                        echo 'A livrer';
                                        break;

                                    case 3:
                                        echo 'Livrée';
                                        break;   }             ?>
                            </small>
                            <?php if(isset($commande['todo']) ){ ?>
                        
                                <span type="button" class="btn btn-sm btn-primary ms-4" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="<?=$commande['todo'] ?>">Todo !</span>
                            
                            <?php
                                }?>

                        </div>


                        <div  class=" d-flex justify-content-end my-2 ">
                            <div class="me-2">
                                <label for="com_1<?= $commande['rowid']?>"><small><b><i class="fa-solid fa-check"></i></b> </small> </label>
                                <input 
                                    type="radio" 
                                    name="valid_commande[<?= $commande['rowid']?>]" 
                                    id="com_1<?= $commande['rowid']?>" 
                                    value="3" <?php if($commande['fk_statut']==3){ ?>
                                    checked <?php } ?>>
                            </div>
                            <div class="ms-2">
                                <label for="com_<?= $commande['rowid']?>"><small><b><i class="fa-solid fa-xmark"></i></b> </small> </label>
                                <input  
                                    type="radio" 
                                    name="valid_commande[<?= $commande['rowid']?>]" 
                                    id="com_<?= $commande['rowid']?>" 
                                    value="2" <?php if($commande['fk_statut']==2){ ?>
                                    checked <?php } ?>>
                            </div>
                        </div>

                    </div>              
                </div>
                <?php  }  } }?>
                                    </div>
    <div class="row mt-5 ">
        <div class="col-11 mx-auto p-0 d-flex justify-content-end">
            <div>
                 <input type="reset" value="Reset" class="btn btn btn-warning">
                <input type="submit" value="Valider la livraison" class="btn btn btn-success" >
            </div>
               
            </div>
  
    </div>
</form>
<?php if($datas['commandes']){?>}
<div class="row mt-3 py-3">
    <div class="col-md-11 mx-auto">
        <h4>Livraison en attente dans un rayon de <?= $datas['limite']?> km pour d'autre client</h4>
    </div>
</div>


<?php
    foreach($datas['commandes'] as $commande){
        if($commande['ref']!==$datas['commande']['ref']){

               ?>
    <div class="row col-md-11 mx-auto alternate_color my-2">
        
            <div class="col-md-3 ps-5 col-6">
                 <a href="<?=URLROOT?>/commande/detail/<?=$commande['rowid'] ?>" ><?= $commande['ref'] ?> </a><?php if(isset($commande['distance'])){ echo '&nbsp;<b>'.$commande['distance'].' Kms</b>'; } ?>
            </div>
        
        <div class="col-md-4">
            <?= $commande['nom']?>
        </div>
        <div class="col-md-4">
            <?= $commande['zip']?>-<b><?= $commande['town']?></b>-<?php 
                    switch($commande['fk_statut']){
                        case 0:
                            echo ' 0';
                            break;
                        
                        case 1:
                            echo 'En préparation';
                            break;

                        case 2:
                            echo 'A livrer';
                            break;

                        case 3:
                            echo 'Livrée';
                            break;

                    }
                    
                    
                    
                    ?>
        </div>
            <div class="col-md-1">
                <?php if(isset($commande['todo']) ){ ?>
                <span type="button" class="btn btn-sm btn-primary py-0" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="<?=$commande['todo'] ?>">Todo !</span>
            <?php
                }?>
            </div>
            </div>
      
            
           
        
    </div>

<?php 
        }}
    
    }
    

?>



<?php
$content = ob_get_clean();

ob_start();
?>
<script src="<?=URLROOT?>/public/assets/js/detail.js"></script>
<?php
$script=ob_get_clean();

require('../app/views/base.php');