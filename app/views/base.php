<!DOCTYPE html>
<html lang="frob">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titlePage ?></title>
    <link rel="stylesheet" href="<?=URLROOT?>/public/assets/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="<?=URLROOT?>/public/assets/css/style.css">
</head>
<body>
    <container class="container px-0" style="max-width:1400px;display:block; overflow:hidden">
 <?php 
    $messages ='';
    require_once(APPROOT.'/views/_nav.php');
 
   
    ?>

        <div class="row" >
            <div class="col-md-8 mx-auto" id="tata">
                <div id="toto">

                <?php  
                if($messages){
                    foreach($messages as $message){ ?>
                        <div class="message alert alert-<?=$message[0] ?>"><?=$message[1]?></div>
                    <?php 
                    }

                cleanMessage(); 
                }
                    
                    
                ?>
                </div>
                
            </div>
        </div>

        <!-- Chargement du contenu -->
        <?php
            if(isset($content)){
                echo $content; 
            }
        ?>
    </container>


    <script src="<?=URLROOT?>/public/assets/js/bootstrap/bootstrap.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script>
        const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
        const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))

    </script>
    
    
    <!-- Chargement des scripts -->
    <?php
        if(isset($script)){
            echo $script;
        }
    ?>
        
</body>
</html>