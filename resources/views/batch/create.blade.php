@extends("base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <h3 class="font-weight-bolder text-primary text-gradient">Create Batch</h3>
            </div>
            <div class="card-body">
                <form role="form" method="post" action="{{ route('batch.save') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Batch Start Date</label>
                                <div class="mb-3">
                                    <input type="date" class="form-control" name="start_date" value="{{ (old('start_date')) ? old('start_date') : date('Y-m-d') }}" aria-label="Date" aria-describedby="date-addon">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="req">Batch Name</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Batch Name" name="name" value="{{ old('name') }}" aria-label="Text" aria-describedby="text-addon">
                                </div>
                                @error('name')
                                    <small class="text-danger">{{ $errors->first('name') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="req">Course Name</label>
                                <div class="mb-3">
                                    <select class="form-control" name="course">
                                        <option value="">Select</option>
                                        @forelse($courses as $key => $course)
                                            <option value="{{ $course->id }}" {{ ($course->id == old('course')) ? 'selected' : '' }}>{{ $course->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                                @error('course')
                                    <small class="text-danger">{{ $errors->first('course') }}</small>
                                @enderror
                            </div>
                        </div>                        
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="req">Fee / Student</label>
                                <div class="mb-3">
                                    <input type="number" class="form-control" name="fee" min="1" step="1" value="{{ old('fee') }}" placeholder="0.00" />
                                </div>
                                @error('fee')
                                    <small class="text-danger">{{ $errors->first('fee') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="req">Syllabus</label>
                                <div class="mb-3">
                                    <select class="form-control select2" name="syllabi[]" data-placeholder="Select" multiple>
                                        @forelse($syllabi as $key => $syl)
                                            <option value="{{ $syl->id }}" {{ ($syl->id == old('syllabus')) ? 'selected' : '' }}>{{ $syl->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                                @error('syllabi')
                                    <small class="text-danger">{{ $errors->first('syllabi') }}</small>
                                @enderror
                            </div>
                        </div>                        
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-submit bg-gradient-primary mt-4 mb-0">CREATE</button>
                        <button type="button" onclick="history.back()" class="btn bg-gradient-warning mt-4 mb-0">CANCEL</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection