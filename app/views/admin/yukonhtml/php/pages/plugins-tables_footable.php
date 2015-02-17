                    <div class="row">
                        <div class="col-md-2">
                            <div class="list-group">
                                <a href="javascript:void(0)" class="active list-group-item">Footable</a>
                                <a href="plugins-tables_datatable.html" class="list-group-item">Datatable</a>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-3">
                                    <input id="textFilter" type="text" class="form-control input-sm">
                                    <span class="help-block">Filter</span>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control input-sm" id="userStatus">
                                        <option></option>
                                        <option value="active">Active</option>
                                        <option value="disabled">Disabled</option>
                                        <option value="suspended">Suspended</option>
                                    </select>
                                    <span class="help-block">Status</span>
                                </div>
                                <div class="col-md-3">
                                    <a class="btn btn-default btn-sm" id="clearFilters">Clear</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-yuk2 toggle-arrow-tiny" id="footable_demo" data-filter="#textFilter" data-page-size="5">
                                        <thead>
                                            <tr>
                                                <th data-toggle="true">First Name</th>
                                                <th> Last Name</th>
                                                <th data-hide="phone,tablet">Job Title</th>
                                                <th data-hide="phone,tablet" data-name="Date Of Birth"> DOB</th>
                                                <th data-hide="phone"> Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Isidra</td>
                                                <td><a href="#">Boudreaux</a></td>
                                                <td>Traffic Court Referee</td>
                                                <td data-value="78025368997">22 Jun 1972</td>
                                                <td data-value="1"><span class="label label-success status-active" title="Active">Active</span></td>
                                            </tr>
                                            <tr>
                                                <td>Shona</td>
                                                <td>Woldt</td>
                                                <td><a href="#">Airline Transport Pilot</a></td>
                                                <td data-value="370961043292">3 Oct 1981</td>
                                                <td data-value="2"><span class="label label-default status-disabled" title="Disabled">Disabled</span></td>
                                            </tr>
                                            <tr>
                                                <td>Granville</td>
                                                <td>Leonardo</td>
                                                <td>Business Services Sales Representative</td>
                                                <td data-value="-22133780420">19 Apr 1969</td>
                                                <td data-value="3"><span class="label label-warning status-suspended" title="Suspended">Suspended</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Easer</td>
                                                <td>Dragoo</td>
                                                <td>Drywall Stripper</td>
                                                <td data-value="250833505574">13 Dec 1977</td>
                                                <td data-value="1"><span class="label label-success status-active" title="Active">Active</span></td>
                                            </tr>
                                            <tr>
                                                <td>Maple</td>
                                                <td>Halladay</td>
                                                <td>Aviation Tactical Readiness Officer</td>
                                                <td data-value="694116650726">30 Dec 1991</td>
                                                <td data-value="3"><span class="label label-warning status-suspended" title="Suspended">Suspended</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Maxine</td>
                                                <td><a href="#">Woldt</a></td>
                                                <td><a href="#">Business Services Sales Representative</a></td>
                                                <td data-value="561440464855">17 Oct 1987</td>
                                                <td data-value="2"><span class="label label-default status-disabled" title="Disabled">Disabled</span></td>
                                            </tr>
                                            <tr>
                                                <td>Lorraine</td>
                                                <td>Mcgaughy</td>
                                                <td>Hemodialysis Technician</td>
                                                <td data-value="437400551390">11 Nov 1983</td>
                                                <td data-value="2"><span class="label label-default status-disabled" title="Disabled">Disabled</span></td>
                                            </tr>
                                            <tr>
                                                <td>Lizzee</td>
                                                <td><a href="#">Goodlow</a></td>
                                                <td>Technical Services Librarian</td>
                                                <td data-value="-257733999319">1 Nov 1961</td>
                                                <td data-value="3"><span class="label label-warning status-suspended" title="Suspended">Suspended</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Judi</td>
                                                <td>Badgett</td>
                                                <td>Electrical Lineworker</td>
                                                <td data-value="362134712000">23 Jun 1981</td>
                                                <td data-value="1"><span class="label label-success status-active" title="Active">Active</span></td>
                                            </tr>
                                            <tr>
                                                <td>Lauri</td>
                                                <td>Hyland</td>
                                                <td>Blackjack Supervisor</td>
                                                <td data-value="500874333932">15 Nov 1985</td>
                                                <td data-value="3"><span class="label label-warning status-suspended" title="Suspended">Suspended</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot class="hide-if-no-paging">
                                            <tr>
                                                <td colspan="5">
                                                    <ul class="pagination pagination-sm"></ul>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
