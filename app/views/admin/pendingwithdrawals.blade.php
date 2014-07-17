@extends('layouts.master')

@section('content')
	<div class="full-width">

		<h1>Pending Withdrawals</h1>
		<table class="admin_table">
			<tr>
				<th>user</th>
				<th>payment type</th>
				<th>payment details</th>
				<th>amount</th>
				<th>action</th>
			</tr>
			
			@foreach($pendingWithdrawals as $key => $withdrawal)
				<tr>
					<td>{{ $withdrawal->user->first_name.' '.$withdrawal->user->last_name }}</td>
					<td>{{ $withdrawal->acc_type }}</td>
					<td>{{ $withdrawal->account }} </td>
					<td>{{ $withdrawal->transaction_amount }} </td>
					<td>
					{{ Form::open(array('id' => 'process'.$key, 'url' => 'admin/process_withdrawal', 'method' => 'post', 'class' => '')) }}

						{{ Form::hidden( 'withdrawal_id' , $withdrawal->id, array('id' => 'withdrawal_id')) }}

						{{ Form::submit('Mark Processed' , array('class'=>'btn-yellow ')) }}

					{{ Form::close() }}


					</td>
				</tr>
			@endforeach
		</table>
		<br>
		<br>
		<br>
		<h1>Recently Processed Withdrawals</h1>
		<table class="admin_table">
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
	</div>
@stop