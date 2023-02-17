@extends("base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <div class="row">
                    <div class="col"><h3 class="font-weight-bolder text-primary text-gradient">Student Register</h3></div>
                    <div class="col text-end"><a href="/student/create" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">CREATE</a></div>
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
                <form method="post" action="{{ route('student.batch.save') }}">
                    @csrf
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="datatable-basic">
                            <thead class="thead-light">
                                <tr><th>SL No</th><th>Student ID</th><th>Student Name</th><th>Email</th><th>Mobile</th><th>Address</th><th>Photo</th><th>Branch</th><th>Receipt</th><th>Email</th><th>Edit</th><th>Assign</th></tr>
                            </thead>
                            <tbody>
                                @php $slno = 1 @endphp
                                @forelse($students as $key => $student)
                                <tr>
                                    <td>{{ $slno++ }}</td>
                                    <td>{{ $student->id }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->email }}</td>
                                    <td>{{ $student->mobile }}</td>
                                    <td>{{ $student->address }}</td>
                                    <td class="text-center"><a href="/public/storage/photos/{{ $student->photo }}" target="_blank"><i class="fa fa-image text-info"></i></a></td>
                                    <td>{{ $student->branch()->find($student->branch)->name }}</td>
                                    <td class="text-center"><a href="/pdf/admission-fee/{{ $student->id }}" target="_blank"><i class="fa fa-file-pdf-o text-danger"></i></a></td>
                                    <td class="text-center"><a href="/email/admission-fee/{{ $student->id }}"><i class="fa fa-envelope text-success"></i></a></td>                                
                                    <td class="text-center"><a href="/student/edit/{{ $student->id }}"><i class="fa fa-edit text-warning"></i></a></td>
                                    <td class="text-center"><input type="checkbox" name="students[]" value="{{ $student->id }}" /></td>
                                </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="row mt-5">
                        @error('students')
                            <small class="text-danger">{{ $errors->first('students') }}</small>
                        @enderror
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="req">Date of Join</label>
                                <div class="mb-3">
                                    <input type="date" class="form-control" name="date_joined" value="{{ (old('date_joined')) ? old('date_joined') : date('Y-m-d') }}" aria-label="Date" aria-describedby="date-addon">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="req">Batch</label>
                                <div class="mb-3">
                                    <select class="form-control" name="batch">
                                        <option value="">Select</option>
                                        @forelse($batches as $key => $batch)
                                            <option value="{{ $batch->id }}">{{ $batch->name }}</option>
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
                                            <option value="{{ $stat->name }}">{{ $stat->name }}</option>
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
                                <label>&nbsp;</label>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-submit btn-primary btn-md">Assign</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection