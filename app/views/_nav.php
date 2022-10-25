<nav class="navbar navbar-expand-lg bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?=URLROOT?>/home"><b>Home</b></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
            <ul class="navbar-nav">
                 <li class="nav-item ">
                    <a href="<?=URLROOT?>/commandes" class="nav-link">Commandes</a>
                </li>
                <li class="nav-item ">
                    <a href="/<?php $_SERVER['REQUEST_SCHEME'].$_SERVER['HTTP_HOST']?>centrex/home/login" target="_blank" class="nav-link">Centrex</a>
                </li>
                <li class="nav-item ">
                    <a href="<?=URLROOT?>/admin" target="_blank" class="nav-link">Admin</a>
                </li>
            </ul>

            <ul class="navbar-nav">
           
                <?php
                if(true){ ?>
                    
                    <li class="nav-item">
                        <a  data-bs-toggle="modal" data-bs-target="#get-profil" class="nav-link" href="#"><i class="fa fa-user" aria-hidden="true"></i>
                  </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/<?php $_SERVER['REQUEST_SCHEME'].$_SERVER['HTTP_HOST']?>commande/security/logout">Logout</a>
                    </li>
                <?php }
                else{ ?>
                    <li class="nav-item ">
                        <a class="nav-link" href="">login</a>
                    </li>
                 
                <?php } ?>
            </ul>
     

        </div>
    </div>
</nav>
<!-- Modal -->
<div class="modal fade" id="get-profil" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Profil</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table">
            <tr><th>Civilite</th><td id="current-civility"></td></tr>
            <tr><th>Nom</th><td id="current-lastname"></td></tr>
            <tr><th>Prénom</th><td id="current-firstname"></td></tr>
            <tr><th>Société</th><td id="current-soc"></td></tr>
            <tr><th>Job</th><td id="current-job"></td></tr>
            <tr><th>Login</th><td id="current-login"></td></tr>
            <tr><th>Email</th><td id="current-email"></td></tr>
            <tr><th>adresse</th><td id="current-address"></td></tr>
            <tr><th>Zip</th><td id="current-zip"></td></tr>
            <tr><th>Ville</th><td id="current-town"></td></tr>
            
        </table>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
        <a href="#"  class="btn btn-primary">Mettre à jour mon profil</a>
      </div>
    </div>
  </div>
</div>
