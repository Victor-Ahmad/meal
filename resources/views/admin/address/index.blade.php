<x-admin>
    @section('title')
        {{ 'Address' }}
    @endsection
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Address Table</h3>
            <div class="card-tools">
                <a href="{{ route('admin.address.create') }}" class="btn btn-sm btn-info">New</a>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Address Name</th>
                        <th>Location</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $address)
                        <tr>
                            <td>{{ $address->user->name }}</td>
                            <td>{{ $address->name }}</td>
                            <td><a href="{{ route('admin.showAddressMap', encrypt($address->id)) }}"
                                    class="btn btn-sm btn-success">Map</a></td>
                            <td><a href="{{ route('admin.address.edit', encrypt($address->id)) }}"
                                    class="btn btn-sm btn-primary">Edit</a></td>
                            <td>
                                <form action="{{ route('admin.address.destroy', encrypt($address->id)) }}"
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
            {!! $data->links() !!}
        </div> --}}
    </div>
</x-admin>
