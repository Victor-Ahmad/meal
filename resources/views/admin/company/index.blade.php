<x-admin>
    @section('title')
        {{ 'Company' }}
    @endsection
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Company Table</h3>
            <div class="card-tools">
                <a href="{{ route('admin.company.create') }}" class="btn btn-sm btn-info">New</a>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Products</th>
                        <th>Image</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $comp)
                        <tr>
                            <td>{{ $comp->name }}</td>
                            <td>{{ $comp->products->count() }}</td>
                            <td>
                                <button class="btn btn-sm btn-secondary view-image" data-toggle="modal"
                                    data-target="#imageModal"
                                    data-image="{{ asset('company-image/' . $product->image) }}">View Image</button>
                            </td>
                            <td><a href="{{ route('admin.company.edit', encrypt($comp->id)) }}"
                                    class="btn btn-sm btn-primary">Edit</a></td>
                            <td>
                                <form action="{{ route('admin.company.destroy', encrypt($comp->id)) }}" method="POST"
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
        <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Product Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img id="productImage" src="" class="img-fluid" alt="Product Image">
                </div>
            </div>
        </div>
    </div>
        {{-- <div class="card-footer clearfix float-right">
            {!! $data->links() !!}
        </div> --}}
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var imageModal = $('#imageModal');
            var productImage = $('#productImage');

            $('.view-image').on('click', function() {
                var imageUrl = $(this).data('image');
                productImage.attr('src', imageUrl);
            });

            imageModal.on('hide.bs.modal', function() {
                productImage.attr('src', '');
            });
        });
    </script>
</x-admin>
