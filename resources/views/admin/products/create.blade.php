<x-admin>
    @section('title')
        {{ 'Create Product' }}
    @endsection
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Create Product</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.product.index') }}" class="btn btn-info btn-sm">Back</a>
                        </div>
                    </div>
                    <form class="needs-validation" novalidate action="{{ route('admin.product.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                                            class="form-control" required placeholder="Enter Name...">
                                        @error('name')
                                            <span>{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="price" class="form-label">Price</label>
                                        <input type="number" name="price" min="0" id="price"
                                            value="{{ old('price') }}" class="form-control" required
                                            placeholder="Enter Price...">
                                        @error('price')
                                            <span>{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="amount" class="form-label">Amount</label>
                                        <input type="number" name="amount" min="0" id="amount"
                                            value="{{ old('amount') }}" class="form-control" required
                                            placeholder="Enter Amount...">
                                        @error('amount')
                                            <span>{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="collection">Collection</label>
                                        <select name="collection" id="collection" class="form-control" required>
                                            <option value="" selected disabled>Select collection</option>
                                            @foreach ($collection as $collect)
                                                <option {{ old($collect->id) == $collect->id ? 'selected' : '' }}
                                                    value="{{ $collect->id }}">{{ $collect->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('collection')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div> --}}
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="company" class="form-label">Company</label>
                                        <select name="company" id="company" class="form-control">
                                            <option value="" selected disabled>select the Company</option>
                                            @foreach ($companies as $comp)
                                                <option {{ old($comp->id) == $comp->id ? 'selected' : '' }}
                                                    value="{{ $comp->id }}">{{ $comp->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="category" class="form-label">Category</label>
                                        <select name="category" id="category" class="form-control">
                                            <option value="" selected disabled>select the category</option>
                                            @foreach ($category as $cat)
                                                <option {{ old($cat->id) == $cat->id ? 'selected' : '' }}
                                                    value="{{ $cat->id }}">{{ $cat->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="subcategory" class="form-label">Sub Category</label>
                                        <select name="subcategory" id="subcategory" class="form-control">
                                            <option value="" selected disabled>select the subcategory</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="image" class="form-label">Image</label>
                                        <input type="file" name="image" id="image" class="form-control"
                                            required>
                                        @error('image')
                                            <span>{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="product-images" class="form-label">Product Slider Images</label>
                                        <input type="file" name="product_images[]" id="product-images"
                                            class="form-control" multiple>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" id="submit" class="btn btn-primary float-right">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @section('js')
        <script>
            $("#category").on('change', function() {
                let category = $("#category").val();
                $("#submit").attr('disabled', 'disabled');
                $("#submit").html('Please wait');
                $.ajax({
                    url: "{{ route('admin.getsubcategory') }}",
                    type: 'GET',
                    data: {
                        category: category,
                    },
                    success: function(data) {
                        if (data) {
                            $("#submit").removeAttr('disabled', 'disabled');
                            $("#submit").html('Save');
                            $("#subcategory").html(data);
                        }
                    }
                });
            });
        </script>
    @endsection
</x-admin>
