@extends("base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <h3 class="font-weight-bolder text-primary text-gradient">Settings</h3>
                @if(session()->has('success'))
                    <div class="alert alert-success text-white">
                        {{ session()->get('success') }}
                    </div>
                @endif
                @if(session()->has('error'))
                    <div class="alert alert-danger text-white">
                        {{ session()->get('error') }}
                    </div>
                @endif
            </div>
            <div class="card-body">
                <form role="form" method="post" action="{{ route('settings.update', ($settings) ? $settings->id : 0) }}">
                    @csrf
                    @method("PUT")
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="req">Admin Name</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Admin Name" name="admin_name" value="{{ ($settings) ? $settings->admin_name : '' }}" aria-label="Text" aria-describedby="text-addon">
                                </div>
                                @error('admin_name')
                                    <small class="text-danger">{{ $errors->first('admin_name') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="req">Admin Email</label>
                                <div class="mb-3">
                                    <input type="email" class="form-control" placeholder="Admin Email" name="admin_email" value="{{ ($settings) ? $settings->admin_email : '' }}" aria-label="Email" aria-describedby="email-addon">
                                </div>
                                @error('admin_email')
                                    <small class="text-danger">{{ $errors->first('admin_email') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="req">Batch discount Percentage</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="0%" name="batch_fee_discount_percentage" value="{{ ($settings) ? $settings->batch_fee_discount_percentage : '' }}" maxlength="3" aria-label="Text" aria-describedby="text-addon">
                                </div>
                                @error('batch_fee_discount_percentage')
                                    <small class="text-danger">{{ $errors->first('batch_fee_discount_percentage') }}</small>
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