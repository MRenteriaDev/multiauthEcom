@extends('admin.admin_master')

@section('admin_content')
    {{-- START CONTENT --}}
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Category</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ url('/brand/update/' . $brand->id) }}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="brand_name">Category Name</label>
                                    <input type="text" value="{{ $brand->brand_name }}" name="brand_name"
                                        class="form-control" id="exampleInputEmail1" placeholder="Enter Category Name">
                                </div>
                                <div class="form-group">
                                    <label for="brand_logo">Brand Image</label>
                                    <input type="file" value="{{ $brand->brand_logo }}" name="brand_logo"
                                        class="form-control" id="exampleInputEmail1" placeholder="Enter Category Name">
                                </div>
                                <div class="form-group">
                                    <label for="brand_logo">Brand Image</label>
                                    <input type="hidden" value="{{ $brand->brand_logo }}" name="brand_logo"
                                        class="form-control" name="old_logo" value="{{ $brand->brand_logo }}"
                                        id="exampleInputEmail1" placeholder="Enter Category Name">
                                </div>
                            </div>
                            <!-- /.card-body -->

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
