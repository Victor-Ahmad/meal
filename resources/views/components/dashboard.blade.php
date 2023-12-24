<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info custom_small_box1">
            <div class="inner">
                <h3>{{ $user }}</h3>
                <p>Total Users</p>
            </div>
            <div class="icon">
                <i class="fa fa-users"></i>
            </div>
            <a href="{{ route('admin.user.index') }}" class="small-box-footer">View <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success custom_small_box2">
            <div class="inner">
                <h3>{{ $category }}</h3>
                <p>Total Categories</p>
            </div>
            <div class="icon">
                <i class="fas fa-list-alt"></i>
            </div>
            <a href="{{ route('admin.category.index') }}" class="small-box-footer">View <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-primary custom_small_box1">
            <div class="inner">
                <h3>{{ $product }}</h3>
                <p>Total Products</p>
            </div>
            <div class="icon">
                <i class="fas fas fa-th "></i>
            </div>
            <a href="{{ route('admin.product.index') }}" class="small-box-footer">View <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>


    {{-- <div class="col-lg-3 col-6">
        <div class="small-box bg-secondary custom_small_box2">
            <div class="inner">
                <h3>{{ $collection }}</h3>
                <p>Total Collections</p>
            </div>
            <div class="icon">
                <i class="fas fas fa-file-pdf"></i>
            </div>
            <a href="{{ route('admin.collection.index') }}" class="small-box-footer">View <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div> --}}
</div>
