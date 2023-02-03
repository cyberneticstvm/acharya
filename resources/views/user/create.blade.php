@extends("base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <h3 class="font-weight-bolder text-primary text-gradient">Create User</h3>
            </div>
            <div class="card-body">
                <form role="form" method="post" action="{{ route('user.save') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="req">Name</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Name" name="name" value="{{ old('name') }}" aria-label="Text" aria-describedby="text-addon">
                                </div>
                                @error('name')
                                    <small class="text-danger">{{ $errors->first('name') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
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
                        <div class="col-md-3">
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
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="req">Password</label>
                                <div class="mb-3">
                                    <input type="password" class="form-control" placeholder="******" name="password" aria-label="Password" aria-describedby="password-addon">
                                </div>
                                @error('password')
                                    <small class="text-danger">{{ $errors->first('password') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="req">Role</label>
                                <div class="mb-3">
                                    <select class="form-control" name="role">
                                        <option value="">Select</option>
                                        @forelse($roles as $key => $role)
                                        <option value="{{ $role->name }}" {{ ($role->name == old('role')) ? 'selected' : '' }}>{{ $role->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                                @error('role')
                                    <small class="text-danger">{{ $errors->first('role') }}</small>
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
                                        <option value="{{ $stat->name }}" {{ ($stat->name == old('status')) ? 'selected' : '' }}>{{ $stat->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                                @error('status')
                                    <small class="text-danger">{{ $errors->first('status') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="req">Branch</label>
                                <div class="mb-3">
                                    <select class="form-control" name="branch">
                                        <option value="">Select</option>
                                        @forelse($branches as $key => $branch)
                                        <option value="{{ $branch->id }}" {{ ($branch->id == old('branch')) ? 'selected' : '' }}>{{ $branch->name }}</option>
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