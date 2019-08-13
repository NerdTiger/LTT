
<div class="container-fluid ">
    <div class="row" id ="row01">
        <div class="col-sm-3" align="left">
            <div class="container" style="padding:1px;">
                <img itemprop="image"  src="images/TT-Logo.png" alt="Logo" style="height: 70%;">
            </div>
        </div>
        <div class="col-sm-7" ></div>
        <div class="col-sm-2" align="right">
            <div class="dropdown">
                <button type="button" id="button_admindropdownbutton" class="btn btn-primary dropdown-toggle menufontstyle" data-toggle="dropdown" >
                  <?php echo $_SESSION['loginusername']?>
                </button><div class='menufontstyle'><?php echo $_SESSION['userauthorises'][array_keys(array_column($_SESSION['userauthorises'], 'user_type_id'), $_SESSION['usertype'])[0]]['user_type_name'];?></div>
                <div class="dropdown-menu dropdown-menu-right">
                <?php include 'menuitems.php';?>    
                    <a class="dropdown-item" href="FC_dispatcher.php?controller=login&action=logout"><img itemprop="image" class="mobile" src="images/signout3.svg" alt="Logout" style="height: 16px;margin-right:30px;">Sign Out</a>
                </div>
          </div>
        </div>
    </div>   
</div>





