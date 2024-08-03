<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> master
<?php

function formatMoney($amount) {
    return number_format($amount, 2, '.', ',');
}

?>
<<<<<<< HEAD
=======
=======
>>>>>>> bf60db9 (fix:error)
>>>>>>> master
<table>
  <thead>
  <tr>
      <th>Customer Name</th>
      <th>Customer Email</th>
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> master
      <th>Phone Number</th>
      <th>Savings Title</th>
      <th>Savings Type</th>
      <th>Savings Frequency</th>
      <th>Savings Balance</th>
      <th>Interest Earned</th>
      <th>Interest Rate</th>
<<<<<<< HEAD
=======
=======
      <th>Savings Title</th>
      <th>Total Amount Saved</th>
      <th>Total Interest Earned</th>
>>>>>>> bf60db9 (fix:error)
=======
      <th>Phone Number</th>
      <th>Savings Title</th>
      <th>Savings Type</th>
      <th>Savings Frequency</th>
      <th>Savings Balance</th>
      <th>Interest Earned</th>
      <th>Interest Rate</th>
>>>>>>> 1a8ef9d (add: command to audit savings transaction)
>>>>>>> master
      <th>Start Date</th>
      <th>End Date</th>
  </tr>
  </thead>
  <tbody>
  @foreach($savings as $saving)
      <tr>
          <td>{{ $saving->user->name ?? "Nil" }}</td>
          <td>{{ $saving->user->email ?? "Nil" }}</td>
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 1a8ef9d (add: command to audit savings transaction)
>>>>>>> master
          <td>{{ $saving->user->phone_number ?? "Nil" }}</td>
          <td>{{ $saving->title ?? "Nil" }}</td>
          <td>{{ $saving->type ?? "Nil" }}</td>
          <td>{{ $saving->frequency_name ?? "Nil" }}</td>
          <td>{{ formatMoney($saving->balance->available_balance) ?? formatMoney(0.00) }}</td>
          <td>{{ formatMoney($saving->cash_back) ?? formatMoney(0.00) }}</td>
          <td>{{ $saving->interest_rate ?? "Nil" }}</td>
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
          <td>{{ $saving->title ?? "Nil" }}</td>
          <td>{{ $saving->balance->available_balance ?? 0.00 }}</td>
          <td>{{ $saving->cash_back ?? 0.00 }}</td>
>>>>>>> bf60db9 (fix:error)
=======
>>>>>>> 1a8ef9d (add: command to audit savings transaction)
>>>>>>> master
          <td>{{ $saving->start_date ?? "Nil" }}</td>
          <td>{{ $saving->end_date ?? "Nil" }}</td>
      </tr>
  @endforeach
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> master
  <tr>
    <td colspan="3"><strong>Total:</strong></td>
    <td><strong>{{ formatMoney($savings->sum('balance.available_balance')) }}</strong></td>
    <td><strong>{{ formatMoney($savings->sum('cash_back')) }}</strong></td>
    <td></td>
    <td></td>
</tr>
<<<<<<< HEAD
=======
=======
>>>>>>> bf60db9 (fix:error)
>>>>>>> master
  </tbody>
</table>