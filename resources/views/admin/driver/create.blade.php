<x-admin>
    @section('title')
        {{ 'Create Driver' }}
    @endsection
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Create Driver</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.driver.index') }}" class="btn btn-info btn-sm">Back</a>
                        </div>
                    </div>
                    <form class="needs-validation" novalidate action="{{ route('admin.driver.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="user" class="form-label">Driver</label>
                                        <input id="name" class="form-control" type="text" name="name"
                                            :value="old('name')" required autofocus autocomplete="name"
                                            placeholder="Enter name">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="phoneNumber" class="form-label">Phone Number</label>
                                        <input type="tel" name="phoneNumber" class="form-control"
                                        placeholder="Phone number" required>
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
