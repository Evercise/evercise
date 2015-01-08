            <!-- main menu -->
            <nav id="main_menu">
                <ul>
                    <li class="first_level">
                        <a href="{{ URL::route('admin.dashboard') }}">
                            <span class="icon_house_alt first_level_icon"></span>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="first_level">
                        <a href="{{ URL::route('admin.users') }}">
                            <span class="icon_group first_level_icon"></span>
                            <span class="menu-title">Users</span>
                        </a>
                    </li>
                    <li class="first_level">
                        <a href="{{ URL::route('admin.listClasses') }}">
                            <span class="icon_globe-2 first_level_icon"></span>
                            <span class="menu-title">Classes</span>
                        </a>
                    </li>


                    <li class="first_level">
                        <a href="{{ URL::route('admin.categories') }}">
                            <span class="icon_ul first_level_icon"></span>
                            <span class="menu-title">Class Categories</span>
                        </a>
                    </li>
                    <li class="first_level">
                        <a href="{{ URL::route('admin.articles') }}">
                            <span class="icon_menu-square_alt2 first_level_icon"></span>
                            <span class="menu-title">Articles</span>
                        </a>
                    </li>
                    <li class="first_level">
                        <a href="{{ URL::route('admin.article.categories') }}">
                            <span class="icon_ul first_level_icon"></span>
                            <span class="menu-title">Article Categories</span>
                        </a>
                    </li>

                    <li class="first_level">
                        <a href="{{ URL::route('admin.gallery') }}">
                            <span class="icon_images first_level_icon"></span>
                            <span class="menu-title">Gallery</span>
                        </a>
                    </li>

                    <li class="first_level">
                        <a href="{{ URL::route('admin.pending_withdrawal') }}">
                            <span class="icon_currency first_level_icon"></span>
                            <span class="menu-title">Pending Withdrawals</span>
                        </a>
                    </li>
                    <li class="first_level">
                        <a href="{{ URL::route('admin.pendingtrainers') }}">
                            <span class="el-icon-universal-access first_level_icon"></span>
                            <span class="menu-title">Pending Trainers</span>
                        </a>
                    </li>

                    <li class="first_level">
                        <a href="{{ URL::route('admin.expired') }}">
                            <span class="icon_error-triangle_alt first_level_icon"></span>
                            <span class="menu-title">Expired Classes</span>
                        </a>
                    </li>

                    <li class="first_level">
                        <a href="{{ URL::route('admin.log') }}">
                            <span class="icon_error-triangle_alt first_level_icon"></span>
                            <span class="menu-title">Error Log</span>
                        </a>
                    </li>

                    <li class="first_level">
                        <a href="{{ URL::route('admin.searchstats') }}">
                            <span class="icon_piechart first_level_icon"></span>
                            <span class="menu-title">Search Stats</span>
                        </a>
                    </li>

                    <li class="first_level">
                        <a href="{{ URL::route('admin.sales') }}">
                            <span class="icon_currency first_level_icon"></span>
                            <span class="menu-title">Sales ({{ Sessionmember::todaysSales() }})</span>
                        </a>
                    </li>

                    <li class="first_level">
                        <a href="{{ URL::route('admin.transactions') }}">
                            <span class="icon_currency first_level_icon"></span>
                            <span class="menu-title">Transactions</span>
                        </a>
                    </li>
                </ul>
                <div class="menu_toggle">
                    <span class="icon_menu_toggle">
                        <i class="arrow_carrot-2left toggle_left"></i>
                        <i class="arrow_carrot-2right toggle_right" style="display:none"></i>
                    </span>
                </div>
            </nav>