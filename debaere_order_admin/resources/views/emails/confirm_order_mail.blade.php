<!doctype html>

<?php 
?>

<html lang="en">
<head>
<title>Order Confirmation Recipt</title>

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

 <?php
    $totalPrice=0;
   ?>


<body style=" margin:10px;" >
    <div style="text-align:center; margin:5px;">
              <img src="{{ URL::asset('img/debaere_logo.png') }}" style="width:30%" >
    </div>
    
     <div style="text-align:center; margin:15px;">
              <h2>Dear {{ $order->customer->company_name }},  Your Following Order with order # {{ $order->order_no }}, Has Been Confirmed</h2>
    </div>


  
     
            <table  style="width:100%; border:solid 0px; font-weight:bold;">
            <thead>
              <tr>
                    <td style="width:33.3%;   text-align:left;" >
                        PO# {{$order->order_no}}</b> <?php if(!isset($_GET["print"])){ ?> <a target="blank" href="{{ route('mailview',['id'=>$order->id,'print'=>true]) }}" >Print</a>  <?php } ?> 
                    </td>
                    <td style="width:33.3%;   text-align:left;" >
                        CN# {{$order->customer->customer_number}}
                    </td>
                    <td style="width:33.3%;   text-align:left;" >
                        Location: {{ $order->customer->getLocation() }}
                    </td>
              </tr>
              </thead>
              </table>
     
     

     <table  style="width:100%; margin-top:5px;">
      <tbody>
          <tr>
            <td style="width:33.3%;   text-align:left;" >
                 <h4 style="margin:4px 0px 0px 4px;" >SUPPLIER</h4>
                <div style="margin:4px 0px 0px 4px;">
                    <b>De Baere Limited</b>
                    <p style="margin:0px;" >Unit 4,SEGRO Park<br>
                    Horsenden Lane South<br>
                    Greenford<br>
                    UB6 7RL<br>
                    Phone: 020 8998 1026<br>
                    Email: orders@debaere.co.uk</p>
                </div>
            </td>
            <td style="width:33.3%; text-align:left;">
                <div>
                    <h4 style="margin:4px 0px 0px 4px;" >INVOICE TO</h4>
                <div style="margin:4px 0px 0px 4px;">
                    <p style="margin:4px 0px 0px 4px;">{{ $order->customer->company_name }}<br>
                    {{ $order->customer->address_1 }}<br>
                    {{ $order->customer->address_2 }}<br>
                    {{ $order->customer->address_3 }}<br>
                    {{ $order->customer->address_4 }}</p>
                </div>
                </div>
            </td>
             <td style="width:33.3%; text-align:left;" >
                <div >
                    <h4 style="margin:4px 0px 0px 4px;">DELIVERY ADDRESS</h4>
                    <div style="margin:4px 0px 0px 4px;">
                        <p style="margin:4px 0px 0px 4px;">{{ $order->customer->company_name }}<br>
                        {{ $order->customer->d_address_1 }}<br>
                        {{ $order->customer->d_address_2 }}<br>
                        {{ $order->customer->d_address_3 }}<br>
                        {{ $order->customer->d_address_4 }}</p>
                    </div>
                </div>
            </td>
        </tr>
      </tbody>
    </table>

  

   
    
  

   

    <div style="margin-top:10px;" >
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

   <table style="margin-top:10px;" > 
        <thead>
        <tr>
            <th width="10%" >Product#</th>
            <th width="40%" >Description</th>
            <th width="10%" >QTY</th>
            <th width="10%" >Unit Price</th>
            <th width="10%" >Price</th>
            <th width="20%" >Options</th>
        </tr>
        </thead>
        <tbody>
            @foreach($products as $pdct)
            <?php $unitTotalPrice=$pdct->unit_price * $pdct->count; 
            $totalPrice+=$unitTotalPrice; ?>
            <tr>
                <td>{{ $pdct->product->product_number }}</td>
                <td>{{ $pdct->product->name }}
                    <?php if(isset($pdct->notes) && !empty($pdct->notes)){ ?>
                    <br>
                    <p><i>Message:{{ $pdct->notes }}</i></p>
                    <?php } ?>
                </td>
                <td>{{ $pdct->count }}</td>
                <td>{{ $pdct->unit_price }}</td>
                <td>{{ $unitTotalPrice }}</td>
                <td>{{ $pdct->extraOption() }}</td>
            </tr>
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td><b>Total</b></td>
                <td><b>{{ $totalPrice }}</b></td>
                <td></td>
            </tr>
        </tbody>
    </table>
</body>
</html>

<?php if(isset($_GET["print"])) { ?>
<script>
    window.print();
</script>
<?php } ?>
