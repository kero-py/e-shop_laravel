{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit product</title>
</head>
<body>
    Edit

    {{ $product->title }}
    {{ $product->description }}
    
    <img src="/product/{{ $product->image }}">
</body>
</html> --}}

<!DOCTYPE html>
<html lang="en">
  <head>

    <base href="/public">
    @include('admin.css')

    <style type="text/css">

    .div_center
    {
        text-align: center;
        padding-top: 40px;
    }

    .font_size
    {
        font-size: 40px;
        padding-bottom: 40px;
    }

    .text_colour
    {
        color: black;
    }

    .img_text_colour
    {
        color: white;
    }

    .label{
        display: inline-block;
        width: 200px;
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

                <div class="div_center">
                    <div>
                        <h1 class="font_size">Edit product</h1>
                    </div>
                        <form action="{{ url('/edit_product_save', $product->id) }}" method="POST" enctype="multipart/form-data">
                       
                        @csrf
                       
                        <div> 
                        <label>Product name: </label>
                        <input class="text_colour" type="text" name="product_name" placeholder="Please enter the product name" required="" value="{{ $product->title }}">
                        </div>
                

                                <div>
                                <label>Description: </label>
                                <input class="text_colour" type="text" name="product_description" placeholder="Please enter the product name" required="" value="{{ $product->description }}">
                            </div>

                        <div>
                        <label>Product price: </label>
                        <input class="text_colour" type="integer" name="price" placeholder="Please enter the price of the product" required="" value="{{ $product->price }}">
                    </div>

                    <div>
                    <label>Discounted price: </label>
                    <input class="text_colour" type="integer" name="discount_price" placeholder="Please enter the discounted price of the product" value="{{ $product->discount_price }}">
                        </div>

                    <div>
                    <label>Product quantity: </label>
                    <input class="text_colour" type="number" min="0" name="quantity" placeholder="Please enter the quantity of the product" required="" value="{{ $product->quantity}}">
                    </div>

                    <div>
                    <label>Product category: </label>
                    <select class="text_colour" name="category_name" placeholder="{{ $product->category }}" required="">
                        <option value="{{ $product->category }}" selected="">{{ $product->category }}</option>
                        
                        @foreach($category as $category)

                        <option value="{{ $category->category_name }}">{{ $category->category_name }}</option>

                        @endforeach
                    </select>
                    </div>
                    <div>
                    <label>Product image: </label>
                    <img style="margin:auto" height= "500px" width="500px" src="/product/{{ $product->image }}">
                    <input class="img_text_colour" type="file" min="0" name="image">
                    </div>
                    <div>
                        <input type="submit" value="Save" class="btn btn-primary">
                        </div>
                    </form>
                </div>
                    

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