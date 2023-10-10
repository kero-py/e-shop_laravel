<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="images/favicon.png" type="">
      <title>Famms - Fashion HTML Template</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
      <!-- font awesome style -->
      <link href="home/css/font-awesome.min.css" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="home/css/style.css" rel="stylesheet" />
      <!-- responsive style -->
      <link href="home/css/responsive.css" rel="stylesheet" />
      <style type="text/css">

        .cart
        {
            margin: auto;
            width: 50%;
            text-align: center;
            padding: 30px;
        }

        table,th,td
        {
            border: 1px solid black;
        }

        .th_deg
        {
            font-size: 30px;
            padding: 5px;
            width: 10%;
            background: #FDB44E;
        }

        .img_deg
        {
            height: 200px;
            width: 200px;
        }

        .total_price
        {
            font-size: 24px;
            font-weight: bold;
            padding:  30px;
            text-align: right;
        }

        .checkout
        {
            font-size: 25px;
            padding-bottom: 15px;
        }

      </style>
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
        @include('home.header')

        @if(session()->has('message'))

                <div class="alert alert-success">

                    {{ session()->get('message') }}
                    
                </div>

        @endif
         <!-- end header section -->

      <!-- items in cart table -->
      <div class="cart">
        <table>
            <tr>
                <th class="th_deg">Product name</th>
                <th class="th_deg">Quantity</th>
                <th class="th_deg">Price</th>
                <th class="th_deg">Image</th>
                <th class="th_deg">Action</th>
            </tr>

            <?php $total_price=0; ?>

            @foreach ($cart as $cart)

            
            <tr>
                <td>{{ $cart->product_title }}</td>
                <td>{{ $cart->quantity}}</td>
                <td>£{{ $cart->price }}</td>
                <td><img class="img_deg" src="/product/{{ $cart->image }}"></td>
                <td><a href="{{ url('/remove_item', $cart->id) }}" onclick="return confirm('Are you sure you want to remove this item?')" class="btn btn-danger">Remove item</td>
            </tr>

            <?php $total_price=$total_price + $cart->price ?>

            @endforeach
        </table>

        <div>
            <h1 class="total_price">Total price: £{{ $total_price }}</h1>
        </div>

        <div>
            <h1 class="checkout"><< Proceed to checkout >></h1>
            <a href="{{ url('cash_order') }}" class="btn btn-danger">Cash on delivery</a>
            <a href="" class="btn btn-danger">Pay by card</a>
        </div>

      </div>
      <!-- footer start -->
      @include('home.footer')
      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         
         </p>
      </div>
      <!-- jQery -->
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="home/js/custom.js"></script>
   </body>
</html>