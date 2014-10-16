                    <fieldset>
                        <legend><span>Legend</span></legend>
                    </fieldset>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="reg_input">Text input</label>
                                <input type="text" id="reg_input" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="reg_textarea">Textarea</label>
                                <textarea name="reg_textarea" id="reg_textarea" cols="10" rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="reg_select">Select</label>
                                <select id="reg_select" class="form-control">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                    <option>6</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="reg_select_multiple">Select (multiple)</label>
                                <select multiple="multiple" id="reg_select_multiple" class="form-control">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                    <option>6</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <label>Checkbox (stacked)</label>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="">
                                    Option 1
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="">
                                    Option 2
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <label>Radio (stacked)</label>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                                    Option 1
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                                    Option 2
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <label>Checkbox (inline)</label>
                            <div class="form-group">
                                <label class="checkbox-inline">
                                    <input type="checkbox" id="inlineCheckbox1" value="option1"> Option 1
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" id="inlineCheckbox2" value="option2"> Option 2
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" id="inlineCheckbox3" value="option3"> Option 3
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <label>Radio (inline)</label>
                            <div class="form-group">
                                <label class="radio-inline">
                                    <input type="radio" name="inline_optionsRadios" id="inline_optionsRadios1" value="option1">
                                    Option 1
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="inline_optionsRadios" id="inline_optionsRadios2" value="option2" checked>
                                    Option 2
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="inline_optionsRadios" id="inline_optionsRadios3" value="option3">
                                    Option 3
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="heading_a"><span class="heading_text">Progress bars</span></div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 30%">
                                            <span class="sr-only">30% Complete</span>
                                        </div>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-success" role="progressbar" style="width: 40%">
                                            <span class="sr-only">40% Complete (success)</span>
                                        </div>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-info" role="progressbar" style="width: 20%">
                                            <span class="sr-only">20% Complete</span>
                                        </div>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" style="width: 60%">
                                            <span class="sr-only">60% Complete (warning)</span>
                                        </div>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" style="width: 80%">
                                            <span class="sr-only">80% Complete</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                            60%
                                        </div>
                                    </div>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar" role="progressbar" style="width: 45%">
                                            <span class="sr-only">45% Complete</span>
                                        </div>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-success" style="width: 35%">
                                            <span class="sr-only">35% Complete (success)</span>
                                        </div>
                                        <div class="progress-bar progress-bar-warning" style="width: 20%">
                                            <span class="sr-only">20% Complete (warning)</span>
                                        </div>
                                        <div class="progress-bar progress-bar-danger" style="width: 10%">
                                            <span class="sr-only">10% Complete (danger)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="heading_a"><span class="heading_text">Validation states</span></div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group has-success">
                                        <input type="text" class="form-control">
                                        <span class="help-block">Success!</span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group has-error">
                                        <input type="text" class="form-control">
                                        <span class="help-block">Please correct the error</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group has-info">
                                        <input type="text" class="form-control">
                                        <span class="help-block">Username is already taken</span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group has-warning">
                                        <input type="text" class="form-control">
                                        <span class="help-block">Something may have gone wrong</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group has-success has-feedback">
                                        <label class="control-label" for="inputSuccess">Input with success</label>
                                        <input type="text" class="form-control" id="inputSuccess">
                                        <span class="glyphicon glyphicon-ok form-control-feedback"></span>
                                    </div>
                                    <div class="form-group has-info has-feedback">
                                        <label class="control-label" for="inputInfo">Input with info</label>
                                        <input type="text" class="form-control" id="inputInfo">
                                        <span class="glyphicon glyphicon-info-sign form-control-feedback"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group has-error has-feedback">
                                        <label class="control-label" for="inputError">Input with error</label>
                                        <input type="text" class="form-control" id="inputError">
                                        <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                                    </div>
                                    <div class="form-group has-warning has-feedback">
                                        <label class="control-label" for="inputWarning">Input with warning</label>
                                        <input type="text" class="form-control" id="inputWarning">
                                        <span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="heading_a"><span class="heading_text">Prepended and appended inputs</span></div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="input-group sepH_b">
                                        <span class="input-group-addon">@</span>
                                        <input type="text" class="form-control" placeholder="Username">
                                    </div>
                                    <div class="input-group sepH_b">
                                        <input type="text" class="form-control">
                                        <span class="input-group-addon">.00</span>
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-addon">$</span>
                                        <input type="text" class="form-control">
                                        <span class="input-group-addon">.00</span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="input-group sepH_b">
                                        <div class="input-group-btn" dropdown>
                                            <button class="btn btn-primary" type="button">Action</button>
                                            <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" type="button">
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a href="#">Action</a></li>
                                                <li><a href="#">Another action</a></li>
                                                <li><a href="#">Something else here</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#">Separated link</a></li>
                                            </ul>
                                        </div>
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="input-group sepH_b">
                                        <input class="form-control" id="appendedInputButton" type="text">
                                        <span class="input-group-btn">
                                            <button class="btn btn-primary" type="button">Go!</button>
                                        </span>
                                    </div>
                                    <div class="input-group">
                                        <input type="text" id="appendedDropdownButton" class="form-control">
                                        <div class="input-group-btn dropdown">
                                            <button data-toggle="dropdown" class="btn btn-default dropdown-toggle">Action <span class="caret"></span></button>
                                            <ul class="dropdown-menu pull-right">
                                                <li><a href="#">Action</a></li>
                                                <li><a href="#">Another action</a></li>
                                                <li><a href="#">Something else here</a></li>
                                                <li><a href="#">Separated link</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="heading_a"><span class="heading_text">Grid</span></div>
                            <div class="row sepH_b">
                                <div class="col-sm-12">
                                    <input type="text" placeholder=".col-sm-12" class="form-control">
                                </div>
                            </div>
                            <div class="row sepH_b">
                                <div class="col-sm-5">
                                    <input type="text" placeholder=".col-sm-5" class="form-control">
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" placeholder=".col-sm-3" class="form-control">
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" placeholder=".col-sm-4" class="form-control">
                                </div>
                            </div>
                            <div class="row sepH_b">
                                <div class="col-sm-6">
                                    <input type="text" placeholder=".col-sm-4" class="form-control">
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" placeholder=".col-sm-4" class="form-control">
                                </div>
                            </div>
                            <div class="row sepH_b">
                                <div class="col-sm-2">
                                    <input type="text" placeholder=".col-sm-2" class="form-control">
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" placeholder=".col-sm-2" class="form-control">
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" placeholder=".col-sm-2" class="form-control">
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" placeholder=".col-sm-2" class="form-control">
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" placeholder=".col-sm-2" class="form-control">
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" placeholder=".col-sm-2" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="heading_a"><span class="heading_text">Control sizing</span></div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" placeholder=".input-lg" class="form-control input-lg">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" placeholder="Default input" class="form-control">
                                    </div>
                                    <input type="text" placeholder=".input-sm" class="form-control input-sm">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="heading_a"><span class="heading_text">Static control</span></div>
                            <div class="row">
                                <div class="col-md-12">
                                    <form class="form-horizontal" role="form">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Email</label>

                                            <div class="col-sm-10">
                                                <p class="form-control-static">email@example.com</p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPassword" class="col-sm-2 control-label">Password</label>

                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" id="inputPassword" placeholder="Password">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
