@extends("base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <h3 class="font-weight-bolder text-primary text-gradient">Attendance Summary</h3>
            </div>
            <div class="card-body">
                <form role="form" method="post" action="{{ route('report.attendance.summary.fetch') }}">
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
                                <label class="req">Date</label>
                                <div class="mb-3">
                                    <input type="date" class="form-control" name="date" value="{{ ($inputs && $inputs[1]) ? $inputs[1] : date('Y-m-d') }}" aria-label="Date" aria-describedby="date-addon">
                                </div>
                                @error('date')
                                <small class="text-danger">{{ $errors->first('date') }}</small>
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
                    <div class="col-4">Present: <span class="text-success fw-bold">{{ $att->where('present', 1)->count('id') }}</span></div>
                    <div class="col-4">Absent: <span class="text-warning fw-bold">{{ $att->where('absent', 1)->count('id') }}</span></div>
                    <div class="col-4">Leave: <span class="text-danger fw-bold">{{ $att->where('leave', 1)->count('id') }}</span></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection