@extends("base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <h3 class="font-weight-bolder text-primary text-gradient">Fee Pending</h3>
            </div>
            <div class="card-body">
                <form role="form" method="post" action="{{ route('report.feepending.fetch') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="req">Batch</label>
                                <div class="mb-3">
                                    <select class="form-control" name="batch">
                                        <option value="">Select</option>
                                        @forelse($batches as $key => $batch)
                                            <option value="{{ $batch->id }}" {{ ($inputs && $inputs[0] == $batch->id) ? 'selected' : '' }}>{{ $batch->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                                @error('batch')
                                <small class="text-danger">{{ $errors->first('batch') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="req">Month</label>
                                <div class="mb-3">
                                    <select class="form-control" name="month">
                                        <option value="">Select</option>
                                        @forelse($months as $key => $month)
                                            <option value="{{ $month->id }}" {{ ($inputs && $inputs[1] == $month->id) ? 'selected' : '' }}>{{ $month->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                                @error('month')
                                <small class="text-danger">{{ $errors->first('month') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="req">Year</label>
                                <div class="mb-3">
                                    <select class="form-control" name="year">
                                        <option value="">Select</option>
                                        @forelse($years as $key => $year)
                                            <option value="{{ $year->year }}" {{ ($inputs && $inputs[2] == $year->year) ? 'selected' : '' }}>{{ $year->year }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                                @error('year')
                                <small class="text-danger">{{ $errors->first('year') }}</small>
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
                            <table class="table table-striped table-bordered">
                                <thead class="thead-light">
                                    <th>Student</th>
                                    <th>Contact</th>
                                    <th>Fee</th>
                                    <th>Date Paid</th>
                                    <th>Status</th>
                                </thead>
                                <tbody>
                                    @forelse($records as $key => $record)
                                    @php $fee = $record->student()->find($record->student)->batchFee()->where('fee_month', $inputs[1])->where('fee_year', $inputs[2])->where('batch', $inputs[0]) @endphp
                                    <tr>
                                        <td>{{ $record->student()->find($record->student)->name }}</td>
                                        <td>{{ $record->student()->find($record->student)->mobile }}</td>
                                        <td>{{ $fee->value('fee') }}</td>
                                        <td>{{ ($fee->value('paid_date')) ? date('d/M/Y', strtotime($fee->value('paid_date'))) : '' }}</td>
                                        <td class="text-center">{!! ($fee->value('fee') > 0) ? "<i class='fa fa-check text-success'>" : "<i class='fa fa-times text-danger'>" !!}</td>
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