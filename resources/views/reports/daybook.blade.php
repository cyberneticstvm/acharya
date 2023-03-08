@extends("base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <h3 class="font-weight-bolder text-primary text-gradient">Daybook</h3>
            </div>
            <div class="card-body">
                <form role="form" method="post" action="{{ route('report.daybook.fetch') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="req">Date</label>
                                <div class="mb-3">
                                    <input type="date" class="form-control" name="date" value="{{ ($inputs && $inputs[0]) ? $inputs[0] : date('Y-m-d') }}" aria-label="Date" aria-describedby="date-addon">
                                </div>
                                @error('date')
                                <small class="text-danger">{{ $errors->first('date') }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-submit bg-gradient-primary mt-4 mb-0">FETCH</button>
                        <button type="button" onclick="history.back()" class="btn bg-gradient-warning mt-4 mb-0">CANCEL</button>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table text-right">
                                <thead class="bg-default">
                                    <tr>
                                        <th scope="col" class="pe-2 text-start ps-2">SL No</th>
                                        <th scope="col" class="pe-2">Particulars</th>
                                        <th scope="col" class="pe-2">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr><td class="h5">Fee</td></tr>
                                    @php $slno = 1 @endphp
                                    @forelse($fee as $key => $record)
                                    <tr>
                                        <td class="text-start">{{ $slno++ }}</td>                                
                                        <td class="ps-4">{{ $record->student()->find($record->student)->name }}</td>                                
                                        <td class="ps-4">{{ $record->fee }}</td>                                
                                    </tr>
                                    @empty
                                    @endforelse
                                    <tr><td colspan="2" class="text-end">Total</td><td class="text-end fw-bold">{{ number_format($fee->pluck('fee')->sum(), 2) }}</td></tr>
                                    <tr><td class="h5">Income</td></tr>
                                    @php $slno = 1 @endphp
                                    @forelse($income as $key => $record)
                                    <tr>
                                        <td class="text-start">{{ $slno++ }}</td>                                
                                        <td class="ps-4">{{ $record->description }}</td>                                
                                        <td class="ps-4">{{ $record->amount }}</td>                                
                                    </tr>
                                    @empty
                                    @endforelse
                                    <tr><td colspan="2" class="text-end">Total</td><td class="text-end fw-bold">{{ number_format($income->pluck('amount')->sum(), 2) }}</td></tr>
                                    <tr><td class="h5">Expenses</td></tr>
                                    @php $slno = 1 @endphp
                                    @forelse($expense as $key => $record)
                                    <tr>
                                        <td class="text-start">{{ $slno++ }}</td>                                
                                        <td class="ps-4">{{ $record->description }}</td>                                
                                        <td class="ps-4">{{ $record->amount }}</td>                                
                                    </tr>
                                    @empty
                                    @endforelse
                                    <tr><td colspan="2" class="text-end">Total</td><td class="text-end fw-bold">{{ number_format($expense->pluck('amount')->sum(), 2) }}</td></tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th class="h5 ps-4" colspan="2">Total</th>
                                        <th colspan="1" class="text-right h5 ps-4">{{ number_format(($fee->pluck('fee')->sum()+$income->pluck('amount')->sum())-$expense->pluck('amount')->sum(), 2) }}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection