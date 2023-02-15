@extends("base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <h3 class="font-weight-bolder text-primary text-gradient">Fee</h3>
            </div>
            <div class="card-body">
                <form role="form" method="post" action="{{ route('report.fee.fetch') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="req">From Date</label>
                                <div class="mb-3">
                                    <input type="date" class="form-control" name="from_date" value="{{ ($inputs && $inputs[0]) ?$inputs[0] : date('Y-m-d') }}" aria-label="Date" aria-describedby="date-addon">
                                </div>
                                @error('from_date')
                                <small class="text-danger">{{ $errors->first('from_date') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="req">To Date</label>
                                <div class="mb-3">
                                    <input type="date" class="form-control" name="to_date" value="{{ ($inputs && $inputs[1]) ?$inputs[1] : date('Y-m-d') }}" aria-label="Date" aria-describedby="date-addon">
                                </div>
                                @error('to_date')
                                <small class="text-danger">{{ $errors->first('to_date') }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-submit bg-gradient-primary mt-4 mb-0">FETCH</button>
                        <button type="button" onclick="history.back()" class="btn bg-gradient-warning mt-4 mb-0">CANCEL</button>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="datatable-basic">
                                <thead class="thead-light">
                                    <tr><th>SL No</th><th>Student Name</th><th>Batch</th><th>Fee Month</th><th>Paid Date</th><th>Amount</th></tr>
                                </thead>
                                <tbody>
                                    @php $slno = 1 @endphp
                                    @forelse($records as $key => $record)
                                    <tr>
                                        <td>{{ $slno++ }}</td>
                                        <td>{{ $record->student()->find($record->student)->name }}</td>
                                        <td>{{ $record->batch()->find($record->batch)->name }}</td>
                                        <td>{{ $record->mname()->find($record->fee_month)->short_name }} / {{ $record->fee_year }}</td>
                                        <td>{{ date('d/M/Y', strtotime($record->paid_date)) }}</td>
                                        <td>{{ $record->fee }}</td>
                                    </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection