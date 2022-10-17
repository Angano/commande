<?php
$titlePage = 'Document';
ob_start();
?>
<div id="resultat"></div>
<div class="row py-1 pb-3 d-flex">
        <div class="col-md-6 mx-auto">
            <h3>Listes des commandes</h3>
        </div>
        <div class="col-md-5 mx-auto align-self-center">
            <form class="d-flex" role="search" method="POST" action="<?= URLROOT?>/commande/commande">
                <input type="hidden" name="soc" value="" id="societe">
                <input value ="" class="form-control me-2" id="search" name=search" type="search" placeholder="Search" aria-label="Search" autocomplete="off">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
        
</div>
<div id="tutu">


<?php
foreach($datas['commandes'] as $commande){
    ?>

    <div class="row card my-1 flex-row societe py-1 ">
        
            <div class="col-6   col-sm-6 col-md-6   col-lg-2 col-xl-2 ">
                <span class=" "><b>Réf: </b> <a class="" href="<?= URLROOT?>/commande/detail/<?= $commande['rowid']?>" target="_blank" ><?= $commande['ref']?></a></span>
                
            </div>
          
            <div class="col-6   col-sm-6  col-md-6 col-lg-2 col-xl-2 text-end">

                <?php 
                
                    if(isset($commande['todo']) && strlen($commande['todo'])>1){?>
                    <span type="button" class="btn btn-sm btn-primary w-75" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="<?=$commande['todo'] ?>">Todo !</span>

                     <?php }
                    else{ ?>
                        <a href="<?= URLROOT?>/commande/AddTodo/<?= $commande['rowid']?>" class="btn btn-sm btn-secondary w-75">Add a Todo</a>
                      
                    <?php } ?>
            </div>
            <div class="col-12  col-sm-12 col-md-5 col-lg-4 col-xl-4"><b><?= $commande['nom']?></b></div>
            <div class="col-9  col-sm-9   col-md-5 col-lg-3 col-xl-3"><?=$commande['town']?></div>
            <div class="col-3   col-sm-3  col-md-2 col-lg-1 col-xl-1"><small><b>
                <?php 
                    switch($commande['fk_statut']){
                        case 0:
                            echo ' 0';
                            break;
                        
                        case 1:
                            echo 'En prépa';
                            break;

                        case 2:
                            echo 'A livrer';
                            break;

                        case 3:
                            echo 'Livrée';
                            break;

                    }
                    
                    
                    
                    ?></b></small></div>
            
        </div>

            
            
    </div>
   <?php } ?>

<div class="row">
    <div class="col-md-12 mb-5 margin-auto">
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">

            <?php 
                if(intval($datas['shorTable']['offset'])>intval($datas['shorTable']['limit'])){ ?>
                
                    <li class="page-item"><a class="page-link" href="
                    <?=  URLROOT.'/commande/index/?limit='.'30'.'&offset='.(intval($datas['shorTable']['offset'])-intval($datas['shorTable']['limit'])).'&soc='.$datas['shorTable']['soc'].'"' ?>
                    ">Précédent</a></li><?php 
                } ?>
                <?php
                $max = intval($datas['shorTable']['offset']+intval($datas['shorTable']['limit']));
                $min = intval($datas['shorTable']['offset']);
             
                    $url = '';
                        for ($i=0; $i<intval($datas['count']); $i= $i+intval($datas['shorTable']['limit'])){ 
                                $url = $url . '<li class="page-item">';
                     
                               
                                if( $i>=$min &&  $i<$max){
                                   
                                    $url = $url . '<a class="page-link active" >'.($i).'</a>';

                                }elseif($i!==0){
                                    $url = $url . '<a class="page-link" href="'.URLROOT.'/commande/index/?limit='.'30'.'&offset='.$i.'&soc='.$datas['shorTable']['soc'].'">'.($i).'</a>';
                                }
                                $url = $url."</li>";
                        }
                    ?>
                    <?= $url ?>
                    <?php if(intval($datas['shorTable']['offset'])+intval($datas['shorTable']['limit']) < intval($datas['count'])){ ?>
                                        <li class="page-item"><a class="page-link" href="<?=  URLROOT.'/commande/index/?limit='.$datas['shorTable']['limit'].'&offset='.(intval($datas['shorTable']['offset'])+intval($datas['shorTable']['limit'])).'&soc='.$datas['shorTable']['soc'].'"' ?>">Suivant</a></li>

                    <?php }
                    ?>
            </ul>
        </nav>
    </div>
</div> 
                    </div>       
<?php
    $content = ob_get_clean();
    ob_start();
    ?>
    <script src="<?=URLROOT?>/public/assets/js/commandes.js"></script>
<?php
    $script=ob_get_clean();
    require('../app/views/base.php');
