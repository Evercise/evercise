@extends('admin.main')

@section('css')
@stop

@section('script')
<script>
$(document).ready(function() {
    $('#all').click(function(event) {  //on click
        if(this.checked) { // check select status
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"
            });
        }else{
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"
            });
        }
    });

});
</script>

@stop

@section('body')


            <h1>Pending Withdrawals</h1>
            {{ Form::open(['route' => 'admin.pending.process.manual', 'method' => 'post']) }}
            <table class="table-condensed">
                <tr>
                    <th><input type="checkbox" id="all"/> ALL/None</th>
                    <th>User</th>
                    <th>Payment type</th>
                    <th>payment details</th>
                    <th>amount</th>
                    <th>action</th>
                </tr>

                @foreach($pendingWithdrawals as $key => $withdrawal)
                    <tr>
                        <td><input type="checkbox" class="checkbox1" name="process[{{$withdrawal->id}}]" value="1"/> </td>
                        <td>{{ $withdrawal->user->first_name.' '.$withdrawal->user->last_name }}</td>
                        <td>{{ $withdrawal->acc_type }}</td>
                        <td>{{ $withdrawal->account }} </td>
                        <td>{{ $withdrawal->transaction_amount }} </td>
                    </tr>
                @endforeach
            </table>
            <br>
            {{ Form::submit('Process manually!', array('class'=>'btn-yellow btn btn-info')) }}
            {{ Form::close() }}
            <br>
            <br>
            <h1>Recently Processed Withdrawals</h1>
            <table class="table-condensed">
                <tr>
                    <th>user</th>
                    <th>payment type</th>
                    <th>payment details</th>
                    <th>amount</th>
                    <th>processed</th>
                </tr>

                @foreach($processedWithdrawals as $key => $withdrawal)
                    <tr>
                        <td>{{ $withdrawal->user->first_name.' '.$withdrawal->user->last_name }}</td>
                        <td>{{ $withdrawal->acc_type }}</td>
                        <td>{{ $withdrawal->account }} </td>
                        <td>{{ $withdrawal->amount }} </td>
                        <td>{{ $withdrawal->updated_at}}</td>
                    </tr>
                @endforeach
            </table>
@stop