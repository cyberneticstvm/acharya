@extends("base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <h3 class="font-weight-bolder text-primary text-gradient">Update Branch</h3>
            </div>
            <div class="card-body">
                <form role="form" method="post" action="{{ route('branch.update', $branch->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="req">Branch Name</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Branch Name" name="name" value="{{ $branch->name }}" aria-label="Text" aria-describedby="text-addon">
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
                                    <input type="email" class="form-control" placeholder="Email ID" name="email" value="{{ $branch->email }}" aria-label="Email" aria-describedby="email-addon">
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
                                    <input type="text" class="form-control" placeholder="Mobile Number" name="mobile" value="{{ $branch->mobile }}" maxlength="10" aria-label="Text" aria-describedby="text-addon">
                                </div>
                                @error('mobile')
                                    <small class="text-danger">{{ $errors->first('mobile') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Branch Logo</label>
                                <div class="mb-3">
                                    <input type="file" class="form-control" name="logo" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="req">Address</label>
                                <div class="mb-3">
                                    <textarea class="form-control" name="address" placeholder="Address">{{ $branch->address }}</textarea>
                                </div>
                                @error('address')
                                    <small class="text-danger">{{ $errors->first('address') }}</small>
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