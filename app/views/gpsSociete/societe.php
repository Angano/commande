<?php
ob_start();?>

hello GpsSociete
<br>
<pre>

<?php


      var_dump($datas[1]);
   

?>
</pre>

<?php
$content = ob_get_clean();
require('../app/views/base.php');