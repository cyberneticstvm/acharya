@extends("base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <h3 class="font-weight-bolder text-primary text-gradient">Attendance</h3>
            </div>
            <div class="card-body">
                <form role="form" method="post" action="{{ route('report.attendance.fetch') }}">
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
                                    <th class="text-success">P</th>
                                    <th class="text-danger">A</th>
                                    <th class="text-warning">L</th>
                                    @for($i=1; $i<=$days; $i++)
                                    <th>{{ $i }}</th>
                                    @endfor                                    
                                </thead>
                                <tbody class="att">
                                    @forelse($records as $key => $record)
                                    <tr>
                                        <td>{{ $record->student()->find($record->student)->name }}</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        @for($i=1; $i<=$days; $i++)
                                        @php $attendance = $record->student()->find($record->student)->attendances()->whereDay('date', $i)->whereMonth('date', $inputs[1])->whereYear('date', $inputs[2])->selectRaw("CASE WHEN present = 1 THEN 'P' WHEN `leave` = 1 THEN 'L' ELSE 'A' END AS atype") @endphp
                                        <td class="text-center attTD fw-bold">{!! $attendance->value('atype') !!}</td>
                                        @endfor                                        
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