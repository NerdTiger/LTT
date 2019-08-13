
<?php

require_once 'rightcornermenu-desktop.php'; 
?>  

<div class="container-fluid headertop">  

<div class="row">
<div class="col-sm-8 nopaddingtablecell_div" align="left">
<?php   

require_once 'buttons-desktop.php';
?>
</div>
<div class="col-sm-4 nopaddingtablecell_div" align="right">
  <h3 class ="menufontstyle" style="border-bottom:none;">LOCKED OFF: <?php echo $_SESSION['lockdate']?></h3>
</div>

    
</div>
</div>
