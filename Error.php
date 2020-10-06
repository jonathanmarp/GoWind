<?php

  require_once 'app/config/config.php';

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name='viewport' 
     content='width=device-width, initial-scale=1.0, maximum-scale=1.0, 
     user-scalable=0' >

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="public/assets/css/bootstrap.css">

    <title>Error Server</title>
    <link rel="stylesheet" href="Error.css" />
    <link rel="icon" href="public/assets/img/icon/<?= favicon; ?>" />
  </head>
  <body>
  <div>
        <aside>
            <img src="<?= base_url; ?>assets/img/Mirror.png" alt="404 Image" />
        </aside>
        <main>
            <h1>Sorry!</h1>
            <p>
              Sorry there was an out of sync server error <em>. . . Forgive me.</em>
            </p>
            <button>Soory About This</button>
        </main>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="public/assets/js/jquery.js"></script>
    <script src="public/assets/js/pooper.js"></script>
    <script src="public/assets/js/bootstrap.js"></script>
  </body>
</html>