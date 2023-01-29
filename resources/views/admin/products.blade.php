@extends('admin_layout.admin')

@section('title')
Products
@endsection

@section('style')
<!-- DataTables -->
<link rel="stylesheet" href="backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<!-- Theme style -->
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Products</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Products</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    {{ Form::hidden('', $increment = 1) }}
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">All Products</h3>
                        </div>
                        @if (Session::has('status'))
                        <div class="alert alert-success">
                            {{ Session::get('status') }}
                            {{ Session::put('status', null) }}
                        </div>
                        @endif
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Num.</th>
                                        <th>Picture</th>
                                        <th>Product Name</th>
                                        <th>Product Category</th>
                                        <th>Product Price</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $increment }}</td>
                                        <td>
                                            <img src="storage/product_images/{{ $product->product_image }}"
                                                style="height : 50px; width : 50px" class="img-circle elevation-2"
                                                alt="User Image">
                                        </td>
                                        <td>{{ $product->product_name }}</td>
                                        <td> {{ $product->product_category }}</td>
                                        <td> {{'$ '. $product->product_price }}</td>
                                        <td>
                                            <a href="#" class="btn btn-success">Unactivate</a>
                                            <a href="{{ url('/editProduct/'.$product->id) }}" class="btn btn-primary"><i
                                                    class="nav-icon fas fa-edit"></i></a>
                                            <a href="#" id="delete" class="btn btn-danger"><i
                                                    class="nav-icon fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    {{ Form::hidden('', $increment = $increment + 1) }}
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Num.</th>
                                        <th>Picture</th>
                                        <th>Product Name</th>
                                        <th>Product Category</th>
                                        <th>Product Price</th>
                                        <th>Actions</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

@section('scripts')
<!-- DataTables -->
<script src="backend/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="backend/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>


<script src="backend/dist/js/bootbox.min.js"></script>
<!-- page script -->

<script>
    $(document).on("click", "#delete", function(e){
  e.preventDefault();
  var link = $(this).attr("href");
  bootbox.confirm("Do you really want to delete this element ?", function(confirmed){
    if (confirmed){
        window.location.href = link;
      };
    });
  });
</script>
<!-- page script -->
<script>
    $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
@endsection
