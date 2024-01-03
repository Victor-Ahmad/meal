
@props(['sellsChart1'])


<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info custom_small_box1">
            <div class="inner">
                <h3>{{ $users }}</h3>
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
                <h3>{{ $orders }}</h3>
                <p>Total Orders</p>
            </div>
            <div class="icon">
                <i class="fas fa-globe"></i>
            </div>
            <a href="{{ route('admin.orders.index') }}" class="small-box-footer">View <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-primary custom_small_box1">
            <div class="inner">
                <h3>{{ $newOrders }}</h3>
                <p>New Orders</p>
            </div>
            <div class="icon">
                <i class="fas fas fa-star "></i>
            </div>
            <a href="{{ route('admin.orders.index') }}" class="small-box-footer">View <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>


    <div class="col-lg-3 col-6">
        <div class="small-box bg-secondary custom_small_box2">
            <div class="inner">
                <h3>{{ $canceledOrders }}</h3>
                <p>Canceled Orders</p>
            </div>
            <div class="icon">
                <i class="fas fa-ban"></i>
            </div>
            <a href="{{ route('admin.orders.index') }}" class="small-box-footer">View <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>


<script src="https://code.highcharts.com/highcharts.js"></script>

