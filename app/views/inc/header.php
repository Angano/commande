<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Framework Php</title>

    <link rel="icon" href="<?= URLROOT;?>./images/icons/favicon.ico">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="<?= URLROOT ?>/css/cover.css">

<link rel="stylesheet" type="text/css" href="<?= URLROOT ?>/css/style.css">
</head>
 <body class="text-center">

    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
      <header class="masthead mb-auto">
        <div class="inner">
          <h3 class="masthead-brand">Cover</h3>
          <nav class="nav nav-masthead justify-content-center">
            <a class="nav-link active" href="<?= URLROOT ?>">Accueil</a>
            <?php if(isset($_SESSION['user_id'])) : ?>
             <a class="nav-link" href="<?= URLROOT?>/?url=users/logout">Deconnexion</a>
             <?php else: ?>
            <a class="nav-link" href="<?= URLROOT?>/?url=users/register">Inscription</a>
            <a class="nav-link" href="<?= URLROOT?>/?url=users/login">Connexion</a>
            <?php endif ;?>
          </nav>
        </div>
      </header>

      <main role="main" class="inner cover">


