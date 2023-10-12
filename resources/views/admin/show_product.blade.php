<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.css')

    <style>
        .center {
            margin: auto;
            width: 50%;
            border: 2px solid white;
            margin-top: 30px;
        }

        .font_size {
            text-align: center;
            font-size: 40px;
            padding-top: 20px;
        }

        .img_size {
            width: auto;
            height: auto;
        }

        .th_colour {
            background: #ff5722;
        }

        .th_elem {
            padding: 20px;
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

                @if(session()->has('message'))

                <div class="alert alert-success">
    
                    <button type="button" class="close" data-bs-dismiss="alert" aria-hidden="true">
                        x
                    </button>

                    {{ session()->get('message') }}
                    
                </div>

                @endif

                <h2 class="font_size">All products</h2>
                <table class="center">

                    <tr class="th_colour">
                        <th class="th_elem">Product title</th>
                        <th class="th_elem">Description</th> 
                        <th class="th_elem">Quantity</th> 
                        <th class="th_elem">Category</th> 
                        <th class="th_elem">Price</th> 
                        <th class="th_elem">Discount Price</th> 
                        <th class="th_elem">Product Image</th>  
                        <th class="th_elem">Delete</th> 
                        <th class="th_elem">Edit</th>                           
                    </tr>

                    @foreach($product as $product)

                    <tr>
                        <td>{{ $product->title }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ $product->category }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->discount_price }}</td>
                        <td><img class="img_size" src="/product/{{ $product->image }}"></td>
                    
                        <td>
                            <a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?')" href="{{ url('delete_product', $product->id) }}">Delete</a>
                        </td>
                            
                        <td>
                            <a class="btn btn-success" href="{{ url('edit_product', $product->id) }}">Edit</a>
                        </td>
                    </tr>

                    @endforeach

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