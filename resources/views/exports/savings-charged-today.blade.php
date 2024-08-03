<?php

function formatMoney($amount) {
    return number_format($amount, 2, '.', ',');
}

?>
<table>
  <thead>
  <tr>
      <th>Customer Name</th>
      <th>Customer Email</th>
      <th>Savings Title</th>
      <th>Amount</th>
      <th>Previous Balance</th>
      <th>New Balance</th>
      <th>Total Cashback</th>
      <th>Start Date</th>
      <th>End Date</th>
  </tr>
  </thead>
  <tbody>
  @foreach($transactions as $transaction)
      <tr>
          <td>{{ $transaction->user->name ?? "Nil" }}</td>
          <td>{{ $transaction->user->email ?? "Nil" }}</td>
          <td>{{ $transaction->savings->title ?? "Nil" }}</td>
          <td>{{ $transaction->amount ?? "Nil" }}</td>
          <td>{{ formatMoney($transaction->savings->balance->previous_available_balance) ?? formatMoney(0.00) }}</td>
          <td>{{ formatMoney($transaction->savings->balance->available_balance) ?? formatMoney(0.00) }}</td>
          <td>{{ formatMoney($transaction->savings->cashBacks->sum('amount')) ?? formatMoney(0.00) }}</td>
          <td>{{ $transaction->savings->start_date ?? "Nil" }}</td>
          <td>{{ $transaction->savings->end_date ?? "Nil" }}</td>
      </tr>
  @endforeach
  <tr>
    <td colspan="4"><strong>Total:</strong></td>
    <td><strong>{{ formatMoney($transactions->sum('amount')) }}</strong></td>
    <td><strong>{{ formatMoney($transactions->sum('cash_backs.amount')) }}</strong></td>
    <td></td>
    <td></td>
</tr>
  </tbody>
</table>