<?php 
 define('FILE_PATH',$_SERVER['DOCUMENT_ROOT'].'/foodwebsite/Client/img/');
 function redirect($link){ ?>
    <script>
        window.location.href ='<?php  echo $link ?>';
    </script>
  <?php
  die();
}
?>