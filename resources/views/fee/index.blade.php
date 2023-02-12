@extends("base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <h3 class="font-weight-bolder text-primary text-gradient">Fetch Student</h3>
            </div>
            @php $student = Session::get('student') @endphp
            <div class="card-body">
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
                <form role="form" method="post" action="{{ route('fee.fetch') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="mb-3">
                                    <input type="number" class="form-control" placeholder="Student ID" name="student" value="{{ old('student') }}" aria-label="Text" aria-describedby="text-addon">
                                </div>
                                @error('student')
                                    <small class="text-danger">{{ $errors->first('student') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-submit bg-gradient-primary">FETCH</button>
                        </div>                        
                    </div>
                </form>
                @if($student)
                <div class="row mt-5 border bg-info text-white">
                    <div class="col-md-3 border">
                        <div class="form-group">
                            <label>Student Name</label>
                            <div class="mb-3">
                                {{ $student->name }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 border">
                        <div class="form-group">
                            <label>Student Email</label>
                            <div class="mb-3">
                                {{ $student->email }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 border">
                        <div class="form-group">
                            <label>Student Mobile</label>
                            <div class="mb-3">
                                {{ $student->mobile }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 border">
                        <div class="form-group">
                            <label>Student Address</label>
                            <div class="mb-3">
                                {{ $student->address }}
                            </div>
                        </div>
                    </div>                        
                </div>
                <div class="row"><div class="col-12 text-center"><a href="/fee/create/{{$student->id}}" class="btn bg-gradient-primary mt-4 mb-0">Proceed</a></div></div>
                @endif
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="datatable-basic">
                        <thead class="thead-light">
                            <tr><th>SL No</th><th>Student Name</th><th>Batch Name</th><th>Fee Month</th><th>Fee Year</th><th>Paid Date</th><th>Fee</th><th>Receipt</th><th>Email</th><th>Edit</th><th>Remove</th></tr>
                        </thead>
                        <tbody>
                            @php $slno = 1 @endphp
                            @forelse($fees as $key => $fee)
                            <tr>
                                <td>{{ $slno++ }}</td>
                                <td>{{ $fee->student()->find($fee->student)->name }}</td>
                                <td>{{ $fee->batch()->find($fee->batch)->name }}</td>
                                <td>{{ DateTime::createFromFormat('!m', $fee->fee_month)->format('F') }}</td>
                                <td class="text-end">{{ $fee->fee_year }}</td>
                                <td>{{ date('d/M/Y', strtotime($fee->paid_date)) }}</td>                                
                                <td class="text-end">{{ $fee->fee }}</td>
                                <td></td>
                                <td></td>
                                <td class="text-center"><a href="/fee/edit/{{ $fee->id }}"><i class="fa fa-edit text-warning"></i></a></td>
                                <td class="text-center">
                                    <form method="post" action="{{ route('fee.delete', $fee->id) }}">
                                        @csrf 
                                        @method("DELETE")
                                        <button type="submit" class="border no-border" onclick="javascript: return confirm('Are you sure want to delete this record?');"><i class="fa fa-trash text-danger"></i></button>
                                    </form>
                                </td>
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
@endsection