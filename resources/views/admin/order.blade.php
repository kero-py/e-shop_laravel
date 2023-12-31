<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.css')
    <style type="text/css">

        .orders_deg
        {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
        }

        .table_deg
        {
            border: 2px solid white;
            width: 80%;
            margin: auto;
            padding-top: 50px;
            text-align: center; 
        }

        .th_deg
        {
            background: #ff5722;
            padding-left: 20px;
            padding-right: 20px;
        }

        .img_size
        {
            width: 150px;
            height: 100px;
        }

    </style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
     @include('admin.sidebar')
      <!-- partial -->
      @include('admin.header')
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <h1 class="orders_deg">All Orders <br><br></h1>

            <div style="padding-left: 500px; padding-bottom: 30px;" >

                <form action="{{ url('search') }}" method="GET">

                    @csrf

                    <input style="color: black" type="text" name="search" placeholder="search for an order...">
                    <input type="submit" value="Search" class="btn btn-outline-primary">
                </form>

            </div>

                <table class="table_deg">
                    <tr>
                        <th class="th_deg">Name</th>
                        <th class="th_deg">Email</th>
                        <th class="th_deg">Address</th>
                        <th class="th_deg">Phone</th>
                        <th class="th_deg">Product Name</th>
                        <th class="th_deg">Quantity</th>
                        <th class="th_deg">Price</th>
                        <th class="th_deg">Payment Status</th>
                        <th class="th_deg">Delivery Status</th>
                        <th class="th_deg">Product ID</th>
                        <th class="th_deg">Image</th>
                        <th class="th_deg">Actioned</th>
                        <th class="th_deg">Print to PDF</th>
                    </tr>

                    @forelse($order as $order)

                    <tr>
                        <td>{{ $order->name }}</td>
                        <td>{{ $order->email }}</td>
                        <td>{{ $order->address }}</td>
                        <td>{{ $order->phone }}</td>
                        <td>{{ $order->product_title }}</td>
                        <td>{{ $order->quantity }}</td>
                        <td>{{ $order->price }}</td>
                        <td>{{ $order->payment_status }}</td>
                        <td>{{ $order->delivery_status }}</td>
                        <td>{{ $order->product_id }}</td>
                        <td>
                            <img class="img_size" src="/product/{{ $order->image }}">
                        </td>

                        <td>
                            @if($order->delivery_status=='processing')
                           
                            <a href="{{ url('actioned', $order->id) }}" onclick="return confirm('Has this item been delivered?')" class="btn btn-primary">Yes   
                                
                            @else
                                <p style="color: #24d33a">Actioned</p>
                            
                            @endif
                        </td>

                        <td>
                            <a href="{{ url('print_pdf', $order->id) }}" class="btn btn-secondary">Print PDF</a>
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="20">Order not found. Please try again.</td>
                    </tr>

                    @endforelse
                </table>
            </div>
        </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>