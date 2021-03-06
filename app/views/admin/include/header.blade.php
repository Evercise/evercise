            <!-- header -->
            <header id="main_header">
                <div class="container-fluid">
                    <div class="brand_section">
                        <a href="dashboard"><img src="/admin/assets/img/logo.png" alt="site_logo" width="63" height="26"></a>
                    </div>
                    <ul class="header_notifications clearfix hide">
                        <li class="dropdown">
                            <span class="label label-primary">2</span>
                            <a data-toggle="dropdown" href="#" class="dropdown-toggle"><i class="el-icon-bell"></i></a>
                            <div class="dropdown-menu">
                                <ul>
                                    <li>
                                        <p>Lorem ipsum dolor sit amet&hellip;</p>
                                        <small class="text-muted">20 minutes ago</small>
                                    </li>
                                    <li>
                                        <p>Lorem ipsum dolor sit&hellip;</p>
                                        <small class="text-muted">44 minutes ago</small>
                                    </li>
                                    <li>
                                        <p>Lorem ipsum dolor&hellip;</p>
                                        <small class="text-muted">10:55</small>
                                    </li>
                                    <li>
                                        <p>Lorem ipsum dolor sit amet&hellip;</p>
                                        <small class="text-muted">14.07.2014</small>
                                    </li>
                                    <li>
                                        <a href="#" class="btn btn-xs btn-primary btn-block">All Alerts</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                    <div class="header_user_actions dropdown">
                        <div data-toggle="dropdown" class="dropdown-toggle user_dropdown">
                            <div class="user_avatar">
                                <img src="{{ (!empty($user->image) ? asset($user->directory.'/small_'.$user->image) : '/admin/assets/img/avatars/avatar03@2x.png') }}" alt="" title="{{ $user->first_name or "" }}" width="38" height="38">
                            </div>
                            <span class="caret"></span>
                        </div>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="{{ URL::route('users.edit', ['id' => $user->display_name]) }}">User Profile</a></li>
                            <li><a href="{{ URL::route('auth.logout') }}">Log Out</a></li>
                        </ul>
                    </div>
                    <div class="search_section" style="width:440px">
                        <span class="cp btn btn-sm btn-primary run_indexer">Index All</span>
                        <span class="index_message" style="color:#fff"> </span>
                    </div>
                </div>
            </header>
