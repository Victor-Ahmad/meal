<x-admin>
    @section('title')
        {{ 'Offer' }}
    @endsection
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Offer Table</h3>
            <div class="card-tools">
                <a href="{{ route('admin.offer.create') }}" class="btn btn-sm btn-info">New</a>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Product</th>
                        <th>Offer Price</th>
                        <th>Price</th>
                        <th>Amount</th>
                        <th>Images</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $offer)
                        <tr>
                            <td>{{ $offer->name }}</td>
                            <td>{{ $offer->product->name }}</td>
                            <td>{{ $offer->offer_price }}</td>
                            <td>{{ $offer->product->price }}</td>
                            <td>{{ $offer->amount }}</td>
                            <td>
                                <button class="btn btn-sm btn-secondary view-image" data-toggle="modal"
                                    data-target="#imageModal"
                                    data-images="{{ $offer->images->pluck('image')->map(function ($img) {return asset('offer-slider-images/' . $img);}) }}">
                                    View Images
                                </button>

                            </td>
                            <td><a href="{{ route('admin.offer.edit', encrypt($offer->id)) }}"
                                    class="btn btn-sm btn-primary">Edit</a></td>
                            <td>
                                <form action="{{ route('admin.offer.destroy', encrypt($offer->id)) }}" method="POST"
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
        {{-- <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="imageModalLabel">Product Images</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="image-slider">
                            <!-- Images will be dynamically added here -->
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="imageModalLabel">Product Images</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner image-slider">
                                <!-- Images will be dynamically added here -->
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
                                data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls" role="button"
                                data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="card-footer clearfix float-right">
            {!! $data->links() !!}
        </div>
    </div>
    <script>
        // document.addEventListener('DOMContentLoaded', function() {
        //     var imageModal = $('#imageModal');
        //     var imageSlider = $('.image-slider'); // Ensure this is the correct selector for your slider container

        //     $('.view-image').on('click', function() {
        //         var images = $(this).data('images');
        //         imageSlider.empty(); // Clear previous images

        //         images.forEach(function(imageUrl) {
        //             console.log(imageUrl);
        //             var imgElement = $('<img>').attr('src', imageUrl).addClass('img-fluid');
        //             imageSlider.append($('<div>').addClass('slide').append(imgElement));
        //         });

        //         // Initialize or update your slider here, if using a library like Swiper
        //     });

        //     imageModal.on('hide.bs.modal', function() {
        //         imageSlider.empty(); // Clear images when modal is hidden
        //     });
        // });
        document.addEventListener('DOMContentLoaded', function() {
            var imageModal = $('#imageModal');
            var imageSlider = $('.image-slider'); // Ensure this is the correct selector for your slider container

            $('.view-image').on('click', function() {
                var images = $(this).data('images');
                imageSlider.empty(); // Clear previous images

                images.forEach(function(imageUrl, index) {
                    var imgElement = $('<img>').attr('src', imageUrl).addClass('img-fluid');
                    var itemDiv = $('<div>').addClass('carousel-item').append(imgElement);
                    if (index === 0) {
                        itemDiv.addClass('active');
                    }
                    imageSlider.append(itemDiv);
                });

                // Reinitialize the carousel (if needed)
                $('#carouselExampleControls').carousel();
            });

            imageModal.on('hide.bs.modal', function() {
                imageSlider.empty(); // Clear images when modal is hidden
            });
        });
    </script>

</x-admin>
