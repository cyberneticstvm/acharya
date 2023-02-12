@extends("base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <h3 class="font-weight-bolder text-primary text-gradient">Upadte Head</h3>
            </div>
            <div class="card-body">
                <form role="form" method="post" action="{{ route('head.update', $head->id) }}">
                    @csrf
                    @method("PUT")
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="req">Head Name</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Head Name" name="name" value="{{ $head->name }}" aria-label="Text" aria-describedby="text-addon">
                                </div>
                                @error('name')
                                    <small class="text-danger">{{ $errors->first('name') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="req">Category</label>
                                <div class="mb-3">
                                    <select name="category" class="form-control">
                                        <option value="">Select</option>
                                        <option value="Income" {{ ($head->category == 'Income') ? 'selected' : '' }}>Income</option>
                                        <option value="Expense" {{ ($head->category == 'Expense') ? 'selected' : '' }}>Expense</option>
                                    </select>
                                </div>
                                @error('category')
                                    <small class="text-danger">{{ $errors->first('category') }}</small>
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