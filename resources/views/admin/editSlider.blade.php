@extends('admin_layout.admin')

@section('title')
Edit slider
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Slider</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Slider</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Edit slider</h3>
                        </div>
                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li> {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        @if (Session::has('status'))
                        <div class="alert alert-success">
                            {{ Session::get('status') }}
                            {{ Session::put('status', null) }}
                        </div>
                        @endif
                        <!-- /.card-header -->
                        <!-- form start -->
                        {{-- <form> --}}
                            {!! Form::open(['action' => 'App\Http\Controllers\SliderController@updateSlider',
                            'enctype' => 'multipart/form-data', 'method' => 'POST']) !!}
                            {{ csrf_field() }}
                            <div class="card-body">
                                <div class="form-group">
                                    {{ Form::hidden('id', $slider->id) }}
                                    {{-- <labelfor="exampleInputEmail1">Sliderdescription1</label> --}}
                                        {{ Form::label('', 'Description one', ['for' => 'exampleInputEmail1']) }}

                                        {{--<input type="text" name="description1" class="form-control"
                                            id="exampleInputEmail1" placeholder="Enter slider description">--}}
                                        {{ Form::text('description1', $slider->description1, ['class' => 'form-control',
                                        'id' =>
                                        'exampleInputEmail1', 'placeholder' => 'Enter slider description']) }}
                                </div>
                                <div class="form-group">
                                    {{-- <labelfor="exampleInputEmail1">Sliderdescription2</label> --}}
                                        {{ Form::label('', 'Description two', ['for' => 'exampleInputEmail1']) }}

                                        {{--<input type="text" name="description2" class="form-control"
                                            id="exampleInputEmail1" placeholder="Enter slider description">--}}
                                        {{ Form::text('description2', $slider->description2, ['class' => 'form-control',
                                        'id' =>
                                        'exampleInputEmail1', 'placeholder' => 'Enter slider description']) }}
                                </div>
                                {{-- <labelfor="exampleInputFile">Sliderimage</label> --}}
                                    {{-- {{ Form::label('', 'Slider image', ['for' => 'exampleInputFile']) }} --}}
                                    <div class="input-group">
                                        <div class="custom-file">
                                            {{-- <inputtype="file"class="custom-file-input"id="exampleInputFile"> --}}

                                                {{ Form::file('slider_image', ['class' => 'custom-file-input',
                                                'id'
                                                =>
                                                'exampleInputFile']) }}

                                                {{-- <labelclass="custom-file-label"for="exampleInputFile">
                                                    Choosefile</label> --}}

                                                    {{ Form::label('', 'Choose file', ['for' => 'exampleInputFile',
                                                    'class' =>
                                                    'custom-file-label']) }}

                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                    </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <!-- <button type="submit" class="btn btn-warning">Submit</button> -->
                                {{-- <inputtype="submit"class="btnbtn-warning"value="Save"> --}}
                                    {{ Form::submit('Update', ['class' => 'btn btn-warning']) }}
                            </div>
                            {{--
                        </form> --}}
                        {!! Form::close() !!}
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
                <!-- right column -->
                <div class="col-md-6">

                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

@section('scripts')
<!-- jquery-validation -->
<script src="backend/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="backend/plugins/jquery-validation/additional-methods.min.js"></script>

<script>
    $(function () {
  $.validator.setDefaults({
    submitHandler: function () {
      alert( "Form successful submitted!" );
    }
  });
  $('#quickForm').validate({
    rules: {
      email: {
        required: true,
        email: true,
      },
      password: {
        required: true,
        minlength: 5
      },
      terms: {
        required: true
      },
    },
    messages: {
      email: {
        required: "Please enter a email address",
        email: "Please enter a vaild email address"
      },
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
      terms: "Please accept our terms"
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});
</script>

@endsection