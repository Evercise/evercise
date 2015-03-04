@extends('admin.main')

@section('css')

    {{ HTML::style('assets/css/cropper.min.css') }}

    <style>

    </style>

@stop

@section('script')

    <script>

    </script>

@stop


@section('body')


    <div class="row">

    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="row">
                <div class="col-lg-11">
                    <P><strong>Original</strong></P>
                    <div class="form-group mb15">
                        <p>
                        @foreach($evercisegroup->getSubcategoryIds()as $subcatId)
                            {{$subcategories[$subcatId].', '}}
                        @endforeach
                        </p>
                    </div>
                    <div class="form-group mb15">
                        {{image( $evercisegroup->user->directory.'/preview_'.$evercisegroup->image)}}
                    </div>
                    <div class="form-group mb15">
                        {{$evercisegroup->name}}
                    </div>
                    <div class="form-group mb15">
                        {{$evercisegroup->description}}
                    </div>
                </div>
            </div>
        </div>
    </div>




@stop