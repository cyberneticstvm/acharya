@extends("base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <h3 class="font-weight-bolder text-primary text-gradient">Create Student</h3>
            </div>
            <div class="card-body">
                <form role="form" method="post" action="{{ route('student.save') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="req">Date of Admission</label>
                                <div class="mb-3">
                                    <input type="date" class="form-control" name="admission_date" value="{{ (old('admission_date')) ? old('admission_date') : date('Y-m-d') }}" aria-label="Date" aria-describedby="date-addon">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="req">Student Name</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Student Name" name="name" value="{{ old('name') }}" aria-label="Text" aria-describedby="text-addon">
                                </div>
                                @error('name')
                                    <small class="text-danger">{{ $errors->first('name') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="req">Email ID</label>
                                <div class="mb-3">
                                    <input type="email" class="form-control" placeholder="Email ID" name="email" value="{{ old('email') }}" aria-label="Email" aria-describedby="email-addon">
                                </div>
                                @error('email')
                                    <small class="text-danger">{{ $errors->first('email') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="req">Mobile Number</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Mobile Number" name="mobile" value="{{ old('mobile') }}" maxlength="10" aria-label="Text" aria-describedby="text-addon">
                                </div>
                                @error('mobile')
                                    <small class="text-danger">{{ $errors->first('mobile') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Alternative Mobile</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Alternative Mobile" name="mobile_alt" value="{{ old('mobile_alt') }}" maxlength="10" aria-label="Text" aria-describedby="text-addon">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Date of Birth</label>
                                <div class="mb-3">
                                    <input type="date" class="form-control" name="dob" value="{{ old('dob') }}" aria-label="Date" aria-describedby="date-addon">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Educational Qualification</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Educational Qualification" name="qualification" value="{{ old('qualification') }}" aria-label="Text" aria-describedby="text-addon">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Reservation Category</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Reservation Category" name="category" value="{{ old('category') }}" aria-label="Text" aria-describedby="text-addon">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Profile Photo</label>
                                <div class="mb-3">
                                    <input type="file" class="form-control" name="photo" />
                                </div>
                            </div>
                        </div>                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="req">Address</label>
                                <div class="mb-3">
                                    <textarea class="form-control" name="address" placeholder="Address">{{ old('address') }}</textarea>
                                </div>
                                @error('address')
                                    <small class="text-danger">{{ $errors->first('address') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="req">Admission Fee</label>
                                <div class="mb-3">
                                    <input type="number" class="form-control" name="fee" min="1" step="1" value="{{ old('fee') }}" placeholder="0.00" />
                                </div>
                                @error('fee')
                                    <small class="text-danger">{{ $errors->first('fee') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="req">Branch</label>
                                <div class="mb-3">
                                    <select class="form-control" name="branch">
                                        <option value="">Select</option>
                                        @forelse($branches as $key => $branch)
                                            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                                @error('branch')
                                    <small class="text-danger">{{ $errors->first('branch') }}</small>
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