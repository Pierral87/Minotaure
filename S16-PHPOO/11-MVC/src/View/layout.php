<?php 



require_once("partials/_header.php");
require_once("partials/_nav.php");
?>
 
    <main class="flex-shrink-0">
        <div class="container">
            <h1 class="mt-5"><?= $title ?></h1>
           
            <?= $content ?>
            
        </div>
    </main>

<?php 
require_once("partials/_footer.php");