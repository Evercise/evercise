            <!-- main menu -->
            <nav id="main_menu">
                <ul>
                    <li class="first_level">
                        <a href="dashboard">
                            <span class="icon_house_alt first_level_icon"></span>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="first_level">
                        <a href="javascript:void(0)">
                            <span class="icon_document_alt first_level_icon"></span>
                            <span class="menu-title">Admin Tools</span>
                        </a>
                        <ul>
                            <li class="submenu-title">Admin tools</li>
                            <li><a <?php if($sPage == "forms-regular_elements") { echo 'class="act_nav" '; }; ?>href="pendingwithdrawals">Pending Withdrawals</a></li>
                            <li><a <?php if($sPage == "forms-regular_elements") { echo 'class="act_nav" '; }; ?>href="users">Users</a></li>
                            <li><a <?php if($sPage == "forms-regular_elements") { echo 'class="act_nav" '; }; ?>href="pendingtrainers">Pending Trainers</a></li>
                            <li><a <?php if($sPage == "forms-regular_elements") { echo 'class="act_nav" '; }; ?>href="log">Log</a></li>
                            <li><a <?php if($sPage == "forms-regular_elements") { echo 'class="act_nav" '; }; ?>href="categories">Categories</a></li>
                            <li><a <?php if($sPage == "forms-regular_elements") { echo 'class="act_nav" '; }; ?>href="groups">Classes</a></li>
                        </ul>
                    </li>
                </ul>
                <div class="menu_toggle">
                    <span class="icon_menu_toggle">
                        <i class="arrow_carrot-2left toggle_left"></i>
                        <i class="arrow_carrot-2right toggle_right" style="display:none"></i>
                    </span>
                </div>
            </nav>