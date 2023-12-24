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
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="products" class="form-label">Products</label>
                                        <select name="products" id="products" class="form-control">
                                            <option value="" selected disabled>select the Product</option>
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
                                        <input type="number" name="amount" id="amount" value="{{ old('amount') }}"
                                            class="form-control" required>
                                        @error('amount')
                                            <span>{{ $message }}</span>
                                        @enderror
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
</x-admin>
