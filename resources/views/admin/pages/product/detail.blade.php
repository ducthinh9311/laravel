@extends('admin.layout.master')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Product</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Product</li>
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

                            <!-- form start -->
                            <form role="form" method="post"
                                action="{{ route('admin.product.update', ['product' => $product->id]) }}"
                                enctype="multipart/form-data">

                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input value="{{ $product->name }}" type="text" n ame="name"
                                            class="form-control" id="name" placeholder="Enter name">
                                        @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="slug">Slug</label>
                                        <input value="{{ $product->slug }}" type="text" name="slug"
                                            class="form-control" id="slug" placeholder="a-b-c">
                                        @error('slug')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input value="{{ $product->price }}" type="text" name="price"
                                            class="form-control" id="price" placeholder="123">
                                        @error('price')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="discount_price">Discout Price</label>
                                        <input value="{{ $product->discount_price }}" type="number" name="discount_price"
                                            class="form-control" id="discount_price" placeholder="123">
                                        @error('discount_price')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="short_description">Short Description</label>
                                        <textarea placeholder="Describe yourself here..." class="form-control" name="short_description" id="short_description">{{ $product->short_description }}</textarea>
                                        @error('short_description')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea placeholder="Describe yourself here..." class="form-control" name="description" id="description">{{ $product->description }}</textarea>

                                        @error('description')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="information">Information</label>
                                        <textarea placeholder="Describe yourself here..." class="form-control" name="information" id="information">{{ $product->information }}</textarea>
                                        @error('information')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="qty">Qty</label>
                                        <input value="{{ $product->qty }}" type="text" name="qty"
                                            class="form-control" id="qty" placeholder="123">
                                        @error('qty')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="shipping">Shipping</label>
                                        <textarea placeholder="Describe yourself here..." class="form-control" name="shipping" id="shipping">{{ $product->shipping }}</textarea>
                                        @error('shipping')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="weight">Weight</label>
                                        <input value="{{ $product->weight }}" type="number" name="weight"
                                            class="form-control" id="weight" placeholder="Describe yourself here...">
                                        @error('weight')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <!-- select -->
                                        <label>Status</label>
                                        <select name="status" class="custom-select">
                                            <option value="">---Please Select---</option>
                                            <option {{ $product->status == '1' ? 'selected' : '' }} value="1">Show
                                            </option>
                                            <option {{ $product->status == '0' ? 'selected' : '' }} value="0">Hide
                                            </option>
                                        </select>
                                        @error('status')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <!-- /.card-body -->
                                    </div>
                                    <div class="form-group">
                                        <!-- select -->
                                        <label>Product Category</label>
                                        <select name="product_category_id" class="custom-select">
                                            <option value="">---Please Select---</option>
                                            @foreach ($productCategories as $productCategory)
                                                <option
                                                    {{ $productCategory->id === $product->product_category_id ? 'selected' : '' }}
                                                    value="{{ $productCategory->id }}">{{ $productCategory->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('product_category_id')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <!-- /.card-body -->
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Image</label>
                                        <input type="file" name="image" class="form-control" id="image"
                                            placeholder="Describe yourself here...">
                                        @error('image')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                    @csrf
                                    @method('put')
                            </form>
                        </div>
                        <!-- /.card -->
                    @endsection

                    @section('js-custom')
                        <script>
                            ClassicEditor
                                .create(document.querySelector('#short_description'), {
                                    ckfinder: {
                                        // Upload the images to the server using the CKFinder QuickUpload command.
                                        uploadUrl: '{{ route('admin.product.ckedit.upload.image') . '?_token=' . csrf_token() }}'
                                    }
                                })
                                .catch(error => {
                                    console.error(error);
                                });
                            ClassicEditor
                                .create(document.querySelector('#description'))
                                .catch(error => {
                                    console.error(error);
                                });
                            ClassicEditor
                                .create(document.querySelector('#information'))
                                .catch(error => {
                                    console.error(error);
                                });
                        </script>
                        <script type="text/javascript">
                            //selector jQuery = $('')
                            $(document).ready(function() {
                                $('#name').on('keyup', function() {
                                    var name = $('#name').val();


                                    $.ajax({
                                        method: "POST", //method form
                                        url: "{{ route('admin.product.create.slug') }}", //action form
                                        data: {
                                            'name': name,
                                            '_token': '{{ csrf_token() }}'
                                        },
                                        success: function(response) {
                                            $('#slug').val(response.slug);
                                        }
                                    });
                                });
                            });
                        </script>
                    @endsection
