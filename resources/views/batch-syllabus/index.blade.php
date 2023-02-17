@extends("base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <div class="row">
                    <div class="col"><h3 class="font-weight-bolder text-primary text-gradient">Syllabus Status</h3></div>
                </div>                
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
                <form role="form" method="post" action="{{ route('syllabus.fetch') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="mb-3">
                                    <select class="form-control bforSyl" name="batch">
                                        <option value="">Select Batch</option>
                                        @forelse($batches as $key => $batch)
                                            <option value="{{ $batch->id }}" {{ ($batch->id == old('batch')) ? '' : '' }}>{{ $batch->name }}</option>
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
                                <div class="mb-3">
                                    <select class="form-control bSyl" name="syllabus">                                    
                                    </select>
                                </div>
                                @error('syllabus')
                                    <small class="text-danger">{{ $errors->first('syllabus') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-submit bg-gradient-primary">FETCH</button>
                        </div>                       
                    </div>
                </form>
            </div>
            <div class="card-body">
                <div class="row">
                    <h5 class="mb-3">Modules</h5>
                    @php $modules = Session::get('modules'); @endphp
                    @if($modules)                    
                            @forelse($modules as $key => $module)
                            <div class="col form-check form-switch mb-3">
                                <input class="form-check-input chkModule" type="checkbox" value="1" data-mid="{{ $module->id }}" id="flexSwitchCheckDefault{{$module->id}}" {{ ($module->status == 1) ? 'checked': ''}}>
                                <label class="form-check-label" for="flexSwitchCheckDefault{{$module->id}}">{{ $module->module()->find($module->module)->name }}</label>
                            </div>
                            @empty
                            @endforelse                    
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection