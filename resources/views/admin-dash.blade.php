@extends("base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <div class="row">
                    <div class="col">
                        <h3 class="font-weight-bolder text-primary text-gradient">Dashboard - Admin</h3>
                    </div>
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
                <div class="row">
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
                    <div class="col-md-6">
                        <div class="card z-index-2">
                            <div class="card-header p-3 pb-0">
                                <h6>Income & Expenses Current Month</h6>
                            </div>
                            <div class="card-body p-3">
                                <div class="chart">
                                    <canvas id="stud-fee-chart" class="chart-canvas" height="300" width="755" style="display: block; box-sizing: border-box; height: 300px; width: 755px;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card overflow-hidden">
                            <div class="card-header p-3 pb-0">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Students Cancelled</p>
                            </div>
                            <div class="card-body p-0">
                                <div class="chart">
                                    <canvas id="stud-canc-chart" class="chart-canvas" height="100" width="336" style="display: block; box-sizing: border-box; height: 100px; width: 336.4px;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 card">                        
                        <div class="card-header p-3 pb-0">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Income Current Month</p>                           
                        </div>
                        <div class="card-body mt-1">
                            <div class="numbers text-center">
                                <h5 class="font-weight-bolder mb-0">₹{{ number_format($income, 2) }}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 card">                        
                        <div class="card-header p-3 pb-0">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Expense Current Month</p>                           
                        </div>
                        <div class="card-body mt-1">
                            <div class="numbers text-center">
                                <h5 class="font-weight-bolder mb-0">₹{{ number_format($expense, 2) }}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 card">                        
                        <div class="card-header p-3 pb-0">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Net Profit Current Month</p>                           
                        </div>
                        <div class="card-body mt-1">
                            <div class="numbers text-center">
                                <h5 class="font-weight-bolder mb-0">₹{{ number_format($profit, 2) }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection