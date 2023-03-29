@extends("base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <h3 class="font-weight-bolder text-primary text-gradient">Income / Expense</h3>
            </div>
            <div class="card-body">
                <form role="form" method="post" action="{{ route('report.ie.fetch') }}">
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
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="req">Type</label>
                                <div class="mb-3">
                                    <select class="form-control" name="type">
                                        <option value="">Select</option>
                                        <option value="Income" {{ ($inputs && $inputs[2] == 'Income') ? 'selected' : '' }}>Income</option>
                                        <option value="Expense" {{ ($inputs && $inputs[2] == 'Expense') ? 'selected' : '' }}>Expense</option>
                                    </select>
                                </div>
                                @error('to_date')
                                <small class="text-danger">{{ $errors->first('to_date') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="req">Head</label>
                                <div class="mb-3">
                                    <select class="form-control" name="head">
                                        <option value="">Select</option>
                                        @forelse($heads as $key => $head)
                                            <option value="{{ $head->id }}" {{ ($inputs && $inputs[3] == $head->id) ? 'selected' : '' }}>{{ $head->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                                @error('head')
                                <small class="text-danger">{{ $errors->first('head') }}</small>
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
                                    <tr><th>SL No</th><th>Head</th><th>Type</th><th>Description</th><th>Date</th><th>Amount</th></tr>
                                </thead>
                                <tbody>
                                    @php $slno = 1 @endphp
                                    @forelse($ies as $key => $ie)
                                    <tr>
                                        <td>{{ $slno++ }}</td>
                                        <td>{{ $ie->heads->name }}</td>
                                        <td>{{ $inputs[2] }}</td>
                                        <td>{{ $ie->description }}</td>
                                        <td>{{ date('d/M/Y', strtotime($ie->date)) }}</td>
                                        <td>{{ $ie->amount }}</td>
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