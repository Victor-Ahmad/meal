<x-admin>
    @section('title')
        {{ 'Dashboard' }}
    @endsection
    <x-dashboard />
    <div class="row">
        <div class="col-sm-4">

            <div id="sellsChart2">{!! $sells_chart_2->container() !!}</div>

        </div>
        <div class="col-sm-8">

            <div id="sellsChart1">{!! $sells_chart_1->container() !!}</div>

        </div>

    </div>
</x-admin>
{!! $sells_chart_1->script() !!}
{!! $sells_chart_2->script() !!}
