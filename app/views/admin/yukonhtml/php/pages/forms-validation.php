                    <div class="row">
                        <div class="col-md-12">
                            <form id="form_validation" novalidate>
                                <div class="heading_a"><span class="heading_text">Basic Validation</span></div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="val_first_name" class="req">First Name</label>
                                        <input type="text" id="val_first_name" required class="form-control"/>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="val_last_name" class="req">Last Name</label>
                                        <input type="text" id="val_last_name" required class="form-control"/>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="val_email" class="req">Email</label>
                                        <input type="email" id="val_email" required class="form-control"/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="val_password" class="req">Password</label>
                                        <input type="text" id="val_password" required class="form-control"/>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="val_password_repeat" class="req">Repeat Password</label>
                                        <input type="text" id="val_password_repeat" data-parsley-equalto="#val_password" required class="form-control"/>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="val_select" class="req">Select option</label>
                                        <select name="val_select" id="val_select" class="form-control" required>
                                            <option value="">---</option>
                                            <option value="val1">Option 1</option>
                                            <option value="val2">Option 2</option>
                                            <option value="val3">Option 3</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Select option (min 2)</label>
                                        <label for="val_chbox_a" class="checkbox-inline"><input type="checkbox" name="val_chbox" id="val_chbox_a" value="chbox_a" data-parsley-mincheck="2">A</label>
                                        <label for="val_chbox_b" class="checkbox-inline"><input type="checkbox" name="val_chbox" id="val_chbox_b" value="chbox_b">B</label>
                                        <label for="val_chbox_c" class="checkbox-inline"><input type="checkbox" name="val_chbox" id="val_chbox_c" value="chbox_c">C</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="val_textarea_message" class="req">Message</label>
                                        <textarea name="val_textarea_message" id="val_textarea_message" cols="30" rows="4" class="form-control" data-parsley-required="true" data-parsley-minlength="40"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button class="btn btn-primary">Validate form</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
