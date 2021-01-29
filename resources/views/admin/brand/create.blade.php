@extends('admin.admin_master')

@section('admin_content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Inline Charts</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('brand.index') }}" class="btn btn-primary">All
                                Brands</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    {{-- START CONTENT --}}
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add Brand </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ route('brand.store') }}" enctype="multipart/form-data" >
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="brand_name">Category Name</label>
                                    <input type="text" name="brand_name" class="form-control" id="exampleInputEmail1"
                                        placeholder="Enter Category Name">
                                </div>
                                <div class="form-group">
                                    <label for="brand_logo">Category Name</label>
                                    <input type="file" name="brand_logo" class="form-control" id="exampleInputEmail1"
                                        placeholder="Upload Logo">
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="text-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->

                </div>
            </div>
        </div>
    </div>
    {{-- ENDING CONTENT --}}
@endsection
