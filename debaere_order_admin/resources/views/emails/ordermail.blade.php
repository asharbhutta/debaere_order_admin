<!doctype html>

<?php 
?>

<html lang="en">
<head>
<title>Order Recipt</title>

   <style type="text/css">
   	
   

   	.boldsize
   	{
   		font-weight: bold;
   	}

    table {

        border-collapse:collapse;
        width:100%;
        padding:10px;
    }

    table, th, td {
  border: 1px solid #998059;;
  text-align:center;
}

th {

}

tr:nth-child(even) {
  background-color: #f2f2f2
}

.wrap {
    position: relative;
}
.left {
    float: left;
    width:50%;
    border:1px solid black;
}
.right {
    float: right;
    width:49%;
    border:1px solid black;
}


   </style>


</head>
<body style=" margin:10px;" >
    <div style="text-align:center; margin:5px;">
              <img src="{{ URL::asset('img/debaere_logo.png') }}" style="width:30%" >
    </div>

    <table style="width:100%;">
      <tbody>
          <tr>
            <td style="width:50%;   text-align:left;" >
                 <h4 style="margin:15px;" >SUPPLIER</h4>
                <div style="margin-left:15px;">
                    <b>De Baere Limited</b>
                    <p>Unit 4,SEGRO Park<br>
                    Horsenden Lane South<br>
                    Greenford<br>
                    UB6 7RL<br>
                    Phone: 020 8998 1026<br>
                    Email: orders@debaere.co.uk</p>
                </div>
            </td>
            <td>
                <div style="width:50%; text-align:left;">
                    <div style="margin-left:15px;">
                        <b>PURCHASE ORDER</b>
                        <p>PO# {{$order->order_no}}<br>
                        Failure to quote this number may cause delay in payment.</p>
                    </div>
                </div>
            </td>
        </tr>
      </tbody>
    </table>


    <table style="width:100%;">
        <tr>
            <td style="width:50%;   text-align:left;">
                 <h4 style="margin-left:5px;" >INVOICE TO</h4>
                <div style="margin-left:15px;">
                    <p>{{ $order->customer->company_name }}<br>
                    {{ $order->customer->address_1 }}<br>
                    {{ $order->customer->address_2 }}<br>
                    {{ $order->customer->address_3 }}<br>
                    {{ $order->customer->address_4 }}</p>
                </div>
            </td>
            <td style="width:50%;   text-align:left;">
                <h4 style="margin-left:5px;" >DELIVERY ADDRESS</h4>
                <div style="margin-left:15px;">
                     <p>{{ $order->customer->company_name }}<br>
                    {{ $order->customer->d_address_1 }}<br>
                    {{ $order->customer->d_address_2 }}<br>
                    {{ $order->customer->d_address_3 }}<br>
                    {{ $order->customer->d_address_4 }}</p>
                </div>
            </td>
        </tr>
    </table>

   

   

    <div style="margin-top:30px;" >
        <table>
            <thead>
                <tr>
                    <th width="30%" >ORDERED ON</th>
                    <th width="20%">ORDERED BY</th>
                    <th width="20%" >DELIVERY DATE</th>
                    <th width="15%" >BETWEEN</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <td>{{ date('d/m/Y H:i:s', strtotime($order->created_at)); }}</td>
                <td>{{ $order->customer->company_name }}</td>
                <td> {{ date('d/m/Y', strtotime($order->date)); }} </td>
                <td>24 Hours</td>
                </tr>
            </tbody>
        </table>
    </div>

    <?php  $products=$order->orderProducts ?>

    <table style="margin-top:30px;" > 
        <thead>
        <tr>
            <th width="10%" >Product#</th>
            <th width="50%" >Description</th>
            <th width="20%" >QTY</th>
            <th width="20%" >Options</th>
        </tr>
        </thead>
        <tbody>
            @foreach($products as $pdct)
            <tr>
                <td>{{ $pdct->product->product_number }}</td>
                <td>{{ $pdct->product->name }}</td>
                <td>{{ $pdct->count }}</td>
                <td>{{ $pdct->extraOption() }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>