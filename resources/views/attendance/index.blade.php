@extends("base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <div class="row">
                    <div class="col"><h3 class="font-weight-bolder text-primary text-gradient">Attendance</h3></div>
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
                <form role="form" method="post" action="{{ route('attendance.sheet.create') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="mb-3">
                                    <input type="number" class="form-control" placeholder="Batch ID" name="batch" value="{{ old('batch') }}" aria-label="Text" aria-describedby="text-addon">
                                </div>
                                @error('batch')
                                    <small class="text-danger">{{ $errors->first('batch') }}</small>
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
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="datatable-basic">
                        <thead class="thead-light">
                            <tr><th>SL No</th><th>Student Name</th><th>Batch Name</th><th>Present</th><th>Absent</th><th>Leave</th></tr>
                        </thead>
                        <tbody>
                            @php 
                                $slno = 1; $sheets = Session::get('sheets')
                            @endphp
                            @if($sheets)
                                @forelse($sheets as $key => $sheet)
                                    <tr>
                                        <td>{{ $slno++ }}</td>
                                        <td>{{ $sheet->student()->find($sheet->student)->name }}</td>
                                        <td>{{ $sheet->batch()->find($sheet->batch)->name }}</td>
                                        <td class="text-center"><input class="rad_at" type="radio" name="rad_{{$sheet->id}}" data-aid="{{ $sheet->id }}" data-col="present" value="1" {{ ($sheet->present == 1) ? 'checked' : '' }} ></td>
                                        <td class="text-center"><input class="rad_at" type="radio" name="rad_{{$sheet->id}}" data-aid="{{ $sheet->id }}" data-col="absent" value="1" {{ ($sheet->absent == 1) ? 'checked' : '' }}></td>
                                        <td class="text-center"><input class="rad_at" type="radio" name="rad_{{$sheet->id}}" data-aid="{{ $sheet->id }}" data-col="leave" value="1" {{ ($sheet->leave == 1) ? 'checked' : '' }}></td>
                                    </tr>
                                @empty
                                @endforelse
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection