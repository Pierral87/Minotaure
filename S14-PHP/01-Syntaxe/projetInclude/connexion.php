<?php
require_once("partials/_config.php");
require_once("partials/_functions.php");


// Le code PHP de traitement en rapport avec la page en cours  
// Ici traitement de la connexion





require_once("partials/_head.php"); // INITIALISATION DE MA PAGE -- DEBUT DES AFFICHAGES
require_once("partials/_nav.php");
?>
<!-- Begin page content -->
<main class="flex-shrink-0">
    <div class="container">
        <h1 class="mt-5">Connectez vous sur notre site</h1>
        <form>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</main>
<?php
require_once("partials/_footer.php");
