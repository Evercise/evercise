
<header id="main_header">
    <div class="container-fluid">
        <div class="brand_section">
            <a href="dashboard"><img src="assets/img/logo.png" alt="site_logo" width="63" height="26"></a>
        </div>
        <ul class="header_notifications clearfix">
            <li class="dropdown">
                <span class="label label-primary"><?php echo ( count($unconfirmedTrainers) + count($pendingWithdrawals) ); ?></span>
                <a data-toggle="dropdown" href="#" class="dropdown-toggle"><i class="el-icon-bell"></i></a>
                <div class="dropdown-menu">
                    <ul>
                        <?php foreach($unconfirmedTrainers as $ut) {?>
                        <li>
                            <p><a href="pendingtrainers">New Trainer awaiting approval&hellip;</a></p>
                            <small class="text-muted"><?php echo $ut->user->display_name ?></small>
                        </li>
                        <?php } ?>
                        <?php foreach($pendingWithdrawals as $pw) {?>
                        <li>
                            <p><a href="pendingwithdrawals">Withdrawal awaiting processing&hellip;</a></p>
                            <small class="text-muted"><?php echo $pw->user->display_name ?></small>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </li>
        </ul>
        <div class="header_user_actions dropdown">
            <div data-toggle="dropdown" class="dropdown-toggle user_dropdown">
                <div class="user_avatar">
                    <img src="../<?php echo $userImage ?>" alt="" title="Carrol Clark (carrol@example.com)" width="38" height="38">
                </div>
                <span class="caret"></span>
            </div>
            <ul class="dropdown-menu dropdown-menu-right">
                <li><a href="pages-user_profile.html">User Profile</a></li>
                <li><a href="login_page.html">Log Out</a></li>
            </ul>
        </div>
        <div class="search_section hidden-sm hidden-xs">
            <input type="text" class="form-control input-sm">
            <button class="btn btn-link btn-sm" type="button"><span class="icon_search"></span></button>
        </div>
    </div>
</header>
