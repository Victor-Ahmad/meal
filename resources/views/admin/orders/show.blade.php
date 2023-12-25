<x-admin>
    @section('title')
        {{ 'Order Items' }}
    @endsection
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Order Items</h3>
            {{-- <div class="card-tools">
                <a href="{{ route('admin.orders.create') }}" class="btn btn-sm btn-info">New</a>
            </div> --}}
        </div>
        <div class="card-body p-0">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product</th>
                        <th>Amount</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Sub Category</th>
                        <th>Created at</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderItems as $orderItem)
                        <tr>
                            <td>{{ $orderItem->id }}</td>
                            <td>{{ $orderItem->product->name }}</td>
                            <td>{{ $orderItem->amount }}</td>
                            <td>{{ $orderItem->product->price }}</td>
                            <td>{{ $orderItem->product->category->name }}</td>
                            <td>{{ $orderItem->product->subcategory->name }}</td>
                            <td>{{ $orderItem->created_at }}</td>
                            <td><a href="{{ route('admin.orders.edit', encrypt($orderItem->id)) }}"
                                    class="btn btn-sm btn-primary">Edit</a>
                            </td>
                            <td>
                                <form action="{{ route('admin.orders.destroy', encrypt($orderItem->id)) }}"
                                    method="POST" onsubmit="return confirm('Are sure want to delete?')">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- <div class="card-footer clearfix float-right">
            {!! $order->links() !!}
        </div> --}}
    </div>
</x-admin>
