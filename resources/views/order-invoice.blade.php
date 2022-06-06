<!doctype html>
<html lang="en-US">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Order Invoice</title>

<style type="text/css">
    * {
        font-family: Verdana, Arial, sans-serif;
    }
    table{
        font-size: x-small;
    }
    tfoot tr td{
        font-weight: bold;
        font-size: x-small;
    }
    .gray {
        background-color: lightgray
    }
    .font{
      font-size: 15px;
    }
    .authority {
        /*text-align: center;*/
        float: right
    }
    .authority h5 {
        margin-top: -10px;
        color: green;
        /*text-align: center;*/
        margin-left: 35px;
    }
    .thanks p {
        color: green;;
        font-size: 16px;
        font-weight: normal;
        font-family: serif;
        margin-top: 20px;
    }
</style>

</head>
<body>

  <table width="100%" style="background: #F7F7F7; padding:0 20px 0 20px;">
    <tr>
        <td valign="top">
          <img src="{{ public_path('assets/frontend/images/logo2.png') }}" alt="" width="200px"/>
          {{-- <h2 style="color: green; font-size: 26px;"><strong>Flip</strong></h2> --}}
        </td>
        <td align="right">
            <pre class="font" >
               Flipmart Head Office
               Email: support@flipmart.com <br>
               Mobile: 03552-222011 <br>
               4/A 1207,Mohammadpur,Dhaka <br>
            </pre>
        </td>
    </tr>

  </table>


  <table width="100%" style="background:white; padding:2px;""></table>

  <table width="100%" style="background: #F7F7F7; padding:0 5 0 5px;" class="font">
    <tr>
        <td>
          <p class="font" style="margin-left: 20px;">
           <strong>Name:</strong> {{ $order->username }}<br>
           <strong>Email:</strong> {{ $order->email }} <br>
           <strong>Phone:</strong> {{ $order->phone }} <br> 
           <strong>Address:</strong> {{ $order->address }} <br>

         </p>
        </td>
        <td>
          <p class="font">
            <h3><span style="color: green;">Invoice:</span> #{{ $order->invoice_no}}</h3>
                Order Date: {{ $order->order_date }} <br>
                Delivery Date: {{ $order->delivered_date }} <br>
                Payment Type : {{ $order->payment_method }} </span>
         </p>
        </td>
    </tr>
  </table>
  <br/>
<h3>Products</h3>


  <table width="100%">
    <thead style="background-color: green; color:#FFFFFF;">
      <tr class="font">
        <th>Image</th>
        <th>Product</th>
        <th>Size</th>
        <th>Color</th>
        <th>Qty</th>
        <th>Discount</th>
        <th>Unit Price</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>

     @foreach($order_items as $item)
      <tr class="font">
        <td align="center">
            @if ($item->product->product_master_image != null)
                <img id="master_img" src="{{ public_path('uploads/products/' . $item->product->product_master_image) }}" alt="No Image" width="60px" height="60px">  
            @else
                <img id="master_img" src="{{ public_path('assets/backend/images/no-image.png') }}" alt="No Image" width="60px" height="60px">
            @endif
        </td>
        <td align="center"> {{ $item->product->product_name }}</td>
        <td align="center">{{ $item->product->product_color ?: 'NULL' }}</td>
        <td align="center">{{ $item->product->product_color ?: 'NULL' }}</td>
        <td align="center">{{ $item->qty }}</td>
        <td align="center">{{ $item->product->product_discounted_price ?: '0' }}%</td>

        @if ($item->product->product_discounted_price == NULL)
            <td align="center">Tk.{{ $item->price }}</td>
            <td align="center">Tk.{{ $item->price * $item->qty }} </td>
        @else
            @php
                $discount_price = ($item->product->product_regular_price * $item->product->product_discounted_price) / 100;
                $price = $item->product->product_regular_price - $discount_price;
            @endphp
            <td align="center">Tk.{{ $price }}</td>
            <td align="center">Tk.{{ $price * $item->qty }} </td>
        @endif

      </tr>
      @endforeach
      
    </tbody>
  </table>
  <br>
  <table width="100%" style=" padding:0 10px 0 10px;">
    <tr>
        <td align="right" >
            <h2><span style="color: green;">Subtotal:</span>Tk.{{ $order->amount }}</h2>
            <h2><span style="color: green;">Total:</span>Tk.{{ $order->amount }}</h2>
            {{-- <h2><span style="color: green;">Full Payment PAID</h2> --}}
        </td>
    </tr>
  </table>
  <div class="thanks mt-3">
    <p>Thanks For Buying Products..!!</p>
  </div>
  <div class="authority float-right mt-5">
      <p>-----------------------------------</p>
      <h5>Authority Signature:</h5>
    </div>
</body>
</html>