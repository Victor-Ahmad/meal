<x-admin>
    @section('title')
        {{ 'Create Offer' }}
    @endsection
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Create Offer</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.offer.index') }}" class="btn btn-info btn-sm">Back</a>
                        </div>
                    </div>
                    <form class="needs-validation" novalidate action="{{ route('admin.offer.store') }}" method="POST"
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
                                        <label for="product" class="form-label">Product</label>
                                        <select name="product" id="product" class="form-control">
                                            <option value="" selected disabled>Select the Product</option>
                                            @foreach ($products as $product)
                                                <option {{ old($product->id) == $product->id ? 'selected' : '' }}
                                                    value="{{ $product->id }}">{{ $product->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="offer_price" class="form-label">Offer Price</label>
                                        <input type="number" name="offer_price" min="0" id="offer_price"
                                            value="{{ old('price') }}" class="form-control" required
                                            placeholder="Enter Price...">
                                        @error('offer_price')
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
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="offer-images" class="form-label">Offer Slider Images</label>
                                        <input type="file" name="offer_images[]" id="offer-images"
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
