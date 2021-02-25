@extends('admin.admin_master')

@section('admin_content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Coupons</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('coupon.index') }}" class="btn btn-primary">All
                                Coupons</a></li>
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
                            <h3 class="card-title">Editar Categoria</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ url('/coupon/update/' . $coupon->id) }}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="coupon">Coupon</label>
                                    <input type="text" value="{{ $coupon->coupon }}" name="coupon" class="form-control"
                                        id="exampleInputEmail1" placeholder="Enter Coupon Name">
                                </div>
                                <div class="form-group">
                                    <label for="discount">Discount</label>
                                    <input type="text" class="form-control" name="discount" placeholder="Discount %"
                                        value="{{ $coupon->discount }}">
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
