<x-admin>
    @section('title')
        {{ 'Create Order' }}
    @endsection
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Create Order</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.orders.index') }}" class="btn btn-info btn-sm">Back</a>
                        </div>
                    </div>
                    <form class="needs-validation" novalidate action="{{ route('admin.orders.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="user" class="form-label">User</label>
                                        <select name="user" id="user" class="form-control">
                                            <option value="" selected disabled>select the User</option>
                                            @foreach ($users as $user)
                                                <option {{ old($user->id) == $user->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="orderStatus" class="form-label">Order Status</label>
                                        <select name="orderStatus" id="orderStatus" class="form-control">
                                            <option value="" selected disabled>select the User</option>
                                            @foreach ($orderStatuses as $orderStatus)
                                                <option
                                                    {{ old($orderStatus->id) == $orderStatus->id ? 'selected' : '' }}
                                                    value="{{ $orderStatus->id }}">{{ $orderStatus->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div id="product-entries">
                                <!-- Initial product entry -->
                                <div class="row product-entry">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="products" class="form-label">Product</label>
                                            <select name="products[]" class="form-control">
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
                                            <label for="amount" class="form-label">Amount</label>
                                            <input type="number" name="amounts[]" class="form-control"
                                                placeholder="Amount" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <button type="button" class="btn btn-success" id="add-product">Add Product</button>
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
        document.addEventListener('DOMContentLoaded', function() {
            // Add product entry
            document.getElementById('add-product').addEventListener('click', function() {
                var productEntry = document.querySelector('.product-entry').cloneNode(true);
                document.getElementById('product-entries').appendChild(productEntry);
            });
        });
    </script>
@endsection
</x-admin>


