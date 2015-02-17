                    <div class="row">
                        <div class="col-md-3 col-lg-2">
                            <button class="btn btn-info btn-outline btn-sm">Compose</button>
                            <hr/>
                            <div class="list-group mailbox_menu">
                                <a href="pages-mailbox.html" class="active list-group-item">
                                    <span class="badge badge-danger">96</span>
                                    <span class="menu_icon icon_download"></span>Inbox
                                </a>
                                <a href="pages-mailbox.html" class="list-group-item">
                                    <span class="menu_icon icon_upload"></span>Sent
                                </a>
                                <a href="pages-mailbox.html" class="list-group-item">
                                    <span class="badge badge-danger">52</span>
                                    <span class="menu_icon icon_error-circle_alt"></span>Spam
                                </a>
                                <a href="pages-mailbox.html" class="list-group-item">
                                    <span class="menu_icon icon_pencil-edit"></span>Drafts
                                </a>
                                <a href="pages-mailbox.html" class="list-group-item">
                                    <span class="menu_icon icon_trash_alt"></span>Trash
                                </a>
                            </div>
                        </div>
                        <div class="col-md-9 col-lg-10">
                            <div class="row">
                                <div class="col-md-5 col-md-push-7">
                                    <input id="message_filter" type="text" class="form-control input-sm" placeholder="Search..."/>
                                </div>
                                <div class="col-md-5 col-md-pull-5">
                                    <div class="btn-group btn-group-sm">
                                        <button type="button" class="btn btn-default">Reply</button>
                                        <button type="button" class="btn btn-default">Spam</button>
                                        <button type="button" class="btn btn-default text-danger">Delete</button>
                                    </div>
                                </div>
                            </div>
                            <hr/>
                            <table id="mailbox_table" class="table table-yuk2 bg-fill toggle-arrow-tiny" data-page-size="20" data-filter="#message_filter">
                                <thead>
                                    <tr>
                                        <th class="cw footable_toggler"></th>
                                        <th class="cw"><input type="checkbox" id="msgSelectAll"></th>
                                        <th class="cw"></th>
                                        <th data-hide="phone,tablet">From</th>
                                        <th>Subject</th>
                                        <th data-hide="phone">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
<?php
$arr_dates = dateRange( 'Tue 01.07.2015', 'Tue 01.12.2015');
$arr_dates_rev = array_reverse($arr_dates);
$rand_mark = array('4','6','11','17','25','27','34','51','65');
for($i=1;$i<=96;$i++) { ?>
                                    <tr<?php if($i<7) { echo ' class="unreaded"'; }; ?>>
                                        <td></td>
                                        <td><div><input type="checkbox" class="msgSelect"></div></td>
                                        <td class="mbox_star<?php if(in_array($i,$rand_mark)) { echo ' marked'; }; ?>"><span class="<?php if(in_array($i,$rand_mark)) { echo 'icon_star'; } else { echo 'icon_star_alt'; }; ?>"></span></td>
                                        <td><?php echo $faker->name; ?></td>
                                        <td><a href="pages-mailbox_message.html"><?php echo $faker->sentence(6); ?></a></td>
                                        <td><?php echo $arr_dates_rev[$i]; ?></td>
                                    </tr>
<?php }; ?>
                                </tbody>
                                <tfoot class="hide-if-no-paging">
                                    <tr>
                                        <td colspan="6">
                                            <ul class="pagination pagination-sm"></ul>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
