<x-admin>
    @section('title')
        {{ 'Orders' }}
    @endsection
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Orders Table</h3>
            <div class="card-tools">
                <a href="{{ route('admin.orders.create') }}" class="btn btn-sm btn-info">New</a>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User Name</th>
                        <th>Order Status</th>
                        <th>Total Price</th>
                        <th>Created at</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $cat)
                        <tr>
                            <td>{{ $cat->id }}</td>
                            <td>{{ $cat->user->name }}</td>
                            <td>{{ $cat->orderStatus->name }}</td>
                            <td>{{ $cat->orderItems->sum(function ($orderItem) {return $orderItem->product->price;}) }}
                            </td>
                            <td>{{ $cat->created_at }}</td>
                            <td><a href="{{ route('admin.orders.edit', encrypt($cat->id)) }}"
                                    class="btn btn-sm btn-primary">Edit</a>
                                <a href="{{ route('admin.orders.show', encrypt($cat->id)) }}"
                                    class="btn btn-sm btn-info">View</a>
                                <a href="{{ route('admin.showOrderMap', encrypt($cat->id)) }}"
                                    class="btn btn-sm btn-success">Map</a>
                            </td>
                            <td>
                                <form action="{{ route('admin.orders.destroy', encrypt($cat->id)) }}" method="POST"
                                    onsubmit="return confirm('Are sure want to delete?')">
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
        <div class="card-footer clearfix float-right">
            {!! $data->links() !!}
        </div>
    </div>
</x-admin>
