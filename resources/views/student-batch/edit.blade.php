@extends("base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <h3 class="font-weight-bolder text-primary text-gradient">Update Student => Batch</h3>
            </div>
            <div class="card-body">
                <form role="form" method="post" action="{{ route('student.batch.update', $sb->id) }}">
                    @csrf
                    @method("PUT")
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="req">Date of Join</label>
                                <div class="mb-3">
                                    <input type="date" class="form-control" name="date_joined" value="{{ $sb->date_joined }}" aria-label="Date" aria-describedby="date-addon">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="req">Student</label>
                                <div class="mb-3">
                                    <select class="form-control" name="student">
                                        <option value="">Select</option>
                                        @forelse($students as $key => $stud)
                                            <option value="{{ $stud->id }}" {{ ($stud->id == $sb->student) ? 'selected' : '' }}>{{ $stud->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                                @error('batch')
                                    <small class="text-danger">{{ $errors->first('batch') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="req">Batch</label>
                                <div class="mb-3">
                                    <select class="form-control" name="batch">
                                        <option value="">Select</option>
                                        @forelse($batches as $key => $batch)
                                            <option value="{{ $batch->id }}" {{ ($batch->id == $sb->batch) ? 'selected' : '' }}>{{ $batch->name }}</option>
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
                                <label class="req">Status</label>
                                <div class="mb-3">
                                    <select class="form-control" name="status">
                                        <option value="">Select</option>
                                        @forelse($status as $key => $stat)
                                            <option value="{{ $stat->name }}" {{ ($stat->name == $sb->status) ? 'selected' : '' }}>{{ $stat->name }}</option>
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
                                <label class="req">Cancelled</label>
                                <div class="mb-3">
                                    <select class="form-control" name="cancelled">
                                        <option value="">Select</option>
                                        <option value="0" {{ ($sb->cancelled == 0) ? 'selected' : '' }}>No</option>
                                        <option value="1" {{ ($sb->cancelled == 1) ? 'selected' : '' }}>Yes</option>
                                    </select>
                                </div>
                                @error('cancelled')
                                    <small class="text-danger">{{ $errors->first('cancelled') }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-submit bg-gradient-primary mt-4 mb-0">UPDATE</button>
                        <button type="button" onclick="history.back()" class="btn bg-gradient-warning mt-4 mb-0">CANCEL</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection