<header id="header" class="clearfix">
    <div class="header-pc clearfix">
        <div class="logo">
            <a href="" class="logo-icon router-link-active">
                <img src="public/images/logo.png" alt="" class="main-logo">
            </a>
        </div>
        <div class="navmt7">
            <ul>
                <li><a href="">Home</a></li>
                <li><a href="">Game</a></li>
                <li><a href="">Bonus</a></li>
                <li>
                    <a data-toggle="modal" 
                        <?php 
                            if($this->Auth->checkSignin() === true){
                                echo 'data-target="#myTransfer"';
                            }else{
                                echo 'data-target="#myModalLogin"';
                            }

                        ?> 
                        href="">Transfer
                    </a>
                </li>
            </ul>
        </div>
        
        <div class="right">
            <button type="button" class="xbutton head-button xbutton-gray xbadge-wrap" data-toggle="modal" 
                <?php 
                    if($this->Auth->checkSignin() === true){
                        echo 'data-target="#myWallet"';
                    }else{
                        echo 'data-target="#myModalLogin"';
                    }
                ?>
            >
                <i class="fas fa-wallet" aria-hidden="true"></i>
            </button>
            <button type="button" class="xbutton head-button xbutton-gray xbadge-wrap">
                <i class="fa fa-bell" aria-hidden="true"></i>
            </button>
            <?php if(!$data_index['info_user']['fullname']){ ?>
                <a class='xbutton login-button' data-toggle='modal' data-target='#myModalLogin'>
                    <span class='login-icon'>
                        <i class='fas fa-user-alt' aria-hidden='true'></i>
                    </span>
                    <span class='login-label'>SIGN IN</span>
                </a>
            <?php }else{ ?>
                <div class="dropdown myAccount">
                    <a class="dropdown-toggle fullname" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user-shield"></i>
                            <?php echo $data_index['info_user']['fullname'];?>
                        <i class="fas fa-caret-down"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item account" href="dashboard/profile.html"><i class="fas fa-user-cog"></i> Profile</a>
                        <a class="dropdown-item" href="dashboard/logout.html"><i class="fas fa-sign-out-alt"></i> Sign Out</a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="clear"></div>
    <div class="sub-header">
        <div class="sub-header-wrap">
            <div id="broadcast">
                <img src="https://bc.game/img/horn.ec3d01d0.svg" alt="" class="hron-img">
                <div class="msg">
                    <div class="text">WELCOME <i><?php echo $data_index['info_user']['fullname'];?></i> JOIN THE GAME</div>
                </div>
            </div>
        </div>
    </div>
</header>