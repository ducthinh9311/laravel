@extends('admin.layout.master')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Product Category</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">General Form</li>
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
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Add</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- In toàn bộ lỗi ra -->
                            {{-- @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif --}}
                            <!-- form start -->
                            <form role="form" method="post" action="{{ route('admin.product_category.store') }}">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input value="{{ old('name') }}" type="text" name="name"
                                            class="form-control" id="name" placeholder="Enter name">
                                        @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <!-- select -->
                                        <label>Status</label>
                                        <select name="status" class="custom-select">
                                            <option value="">---Please Select---</option>
                                            <option {{ old('status') === '1' ? 'selected' : '' }} value="1">Show
                                            </option>
                                            <option {{ old('status') === '0' ? 'selected' : '' }} value="0">Hide
                                            </option>
                                        </select>
                                        @error('status')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <!-- /.card-body -->
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    @endsection
