<div class="discover-nav container-fluid">
    <div class="container">
        <div class="row">
            <form  role="form">
                <div class="col-sm-5">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group col-sm-12 with-addon">
                                <div class="input-group-addon"><span class="icon icon-search"></span></div>
                                <input class="form-control" type="text" placeholder="Search for Classes...">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="button">
                                         Find a Class
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-sm-7">
                    <div class="row">
                        <div class="col-sm-4 no-gutter">
                            <div class="form-group col-sm-12">
                                 <div class="custom-select">
                                    {{ Form::select('filter',
                                        [
                                            '' => 'Filter',
                                            'gomp' => 'gomp'
                                        ]
                                     , '', ['class' => 'form-control'] ) }}
                                 </div>
                            </div>
                        </div>
                        <div class="col-sm-4 no-gutter">
                            <div class="form-group col-sm-12">
                                 <div class="custom-select">
                                    {{ Form::select('sort',
                                        [
                                            '' => 'Sort',
                                            'gomp' => 'gomp'
                                        ]
                                     , '', ['class' => 'form-control'] ) }}
                                 </div>
                            </div>
                        </div>
                        <div class="col-sm-4 no-gutter">
                            <div class="form-group">
                                <span class="icon icon-grid mr10 hover"></span>
                                <span class="icon icon-list mr10 active"></span>
                                <span class="icon icon-map hover"></span>
                            </div>

                        </div>
                    </div>

                </div>


            </form>
        </div>


    </div>





</div>