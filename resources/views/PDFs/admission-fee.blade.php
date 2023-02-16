<!DOCTYPE html>
<html>
<head>
    <title>Acharya Educations</title>
    <style>
        table{
            border: 1px solid #e6e6e6;
            font-size: 12px;
        }
        thead{
            border-bottom: 1px solid #e6e6e6;
        }
        table thead th, table tbody td{
            padding: 5px;
            font-size: 1rem;
            border: 1px solid #000;
        }
        .bordered td{
            border: 1px solid #e6e6e6;
        }
        .text-right{
            text-align: right;
        }
        .fw-bold{
            font-weight: bold;
        }
    </style>
</head>
<body>
    <center>
        <img src="./assets/img/logos/acharya.jpg" width="100%"/><br/>
    </center>
    <br/>
    <table width="100%" cellpadding="0" cellspacing="0">
        <thead><tr><th text-align="center" colspan="6">Admission Fee Receipt</th></tr></thead>
        <tbody>
            <tr>
                <td>Student Name</td>
                <td class="fw-bold">{{ $student->name }}</td>                
                <td>Mobile</td>
                <td class="fw-bold">{{ $student->mobile }}</td>
                <td>Date</td>
                <td class="fw-bold">{{ date('d/M/Y', strtotime($student->admission_date)) }}</td>
            </tr>
            <tr>
                <td>Address</td>
                <td colspan="5" class="fw-bold">{{ $student->address }}</td>
            </tr>
        </tbody>
    </table>
    <table width="100%" cellpadding="0" cellspacing="0">
        <thead><tr><th>SL No</th><th width="70%">Particulars</th><th>Amount</th></tr></thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Admission Fee</td>                
                <td class="text-right">{{ $student->fee }}</td>
            </tr>
            <tr><td colspan="2" class="text-right fw-bold">Total</td><td class="text-right fw-bold">{{ $student->fee }}</td></tr>
        </tbody>
    </table>
    <br><br><br><br><br>
    <div class="text-right">Authorised Signatory</div>
</body>
</html>