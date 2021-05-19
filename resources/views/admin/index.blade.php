@extends('layouts.admin')


@section('main')
<!-- Charting library -->
<script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
<!-- Chartisan -->
<script src="https://unpkg.com/{{'@'}}chartisan/echarts/dist/chartisan_echarts.js"></script>
<!-- Your application script -->

<div class="dashboard-screen">
    <div class="row top-widgets">
        <div class="col-md-4">
            <div class="widget">
                <div>
                    <i class="fas fa-cog" style="background: #01c0ef;color:white;"></i>
                </div>
                <div class="content">
                    <p>No of Topics</p>
                    <p class="font-weight-bold">{{$topics_count}}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="widget">
                <div>
                    <i class="far fa-flag" style="background: #dd4b39;color:white;"></i>
                </div>
                <div class="content">
                    <p>No of Tutorials</p>
                    <p class="font-weight-bold">{{$tutorial_count}}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="widget">
                <div>
                    <i class="fas fa-street-view" style="background: #04a65a;color:white;"></i>
                </div>
                <div class="content">
                    <p>No of Tutorial Views</p>
                    <p class="font-weight-bold">{{$tutorial_views_count}}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="charts">

        <div class="chart my-2">
            <h3>Tutorial Views Daily</h3>
            <div id="chart_daily" style="height: 300px;"></div>
        </div>

        <hr>

        <div class="chart my-2">
            <h3>Tutorial Views Monthly</h3>
            <div id="chart_monthly" style="height: 300px;"></div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    document.onreadystatechange = function () {
        if (document.readyState === 'complete') {
            new Chartisan({
                el: '#chart_daily',
                url: "@chart('tutorial_view_chart',['mode'=>'daily'])"
            });

            new Chartisan({
                el: '#chart_monthly',
                url: "@chart('tutorial_view_chart',['mode'=>'monthly'])"
            });
        }
    }
</script>
@endsection