@extends("base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <div class="row">
                    <div class="col"><h3 class="font-weight-bolder text-primary text-gradient">Dashboard - Admin</h3></div>
                </div>                
                @if(session()->has('success'))
                    <div class="alert alert-success text-white">
                        {{ session()->get('success') }}
                    </div>
                @endif
                @if(session()->has('error'))
                    <div class="alert alert-danger text-white">
                        {{ session()->get('error') }}
                    </div>
                @endif
            </div>
            <div class="card-body">
                <div class="col-md-6">
                    <div class="card z-index-2">
                        <div class="card-header p-3 pb-0">
                            <h6>Student Registration</h6>
                        </div>
                        <div class="card-body p-3">
                            <div class="chart">
                                <canvas id="stud-reg-chart" class="chart-canvas" height="300" width="755" style="display: block; box-sizing: border-box; height: 300px; width: 755px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection