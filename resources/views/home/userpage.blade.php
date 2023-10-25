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

      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
        @include('home.header')
         <!-- end header section -->
         <!-- slider section -->
         @include('home.slider')
         <!-- end slider section -->
      </div>
      <!-- why section -->
      @include('home.why')
      <!-- end why section -->
      
      <!-- arrival section -->
      @include('home.new_arrival')
      <!-- end arrival section -->
      
      <!-- product section -->
      @include('home.product')
      <!-- end product section -->

      <!-- subscribe section -->
      @include('home.subscribe')
      <!-- end subscribe section -->
      <!-- client section -->
      @include('home.client')
      <!-- end client section -->
      <!-- customer testimonials/comments -->

      <div class="heading_container heading_center">

         <h1 style="font-size:38px; padding-bottom: 15px;">Send us your comments!</h1>

         <form action="{{ url('add_comment') }}" method="POST">

            @csrf

            <textarea name="comment" style="resize: none;" placeholder="Please tell us what you think..."></textarea>

           <input type="submit" class="btn btn-primary" value="comment">
         </form>

      </div>

      <h1 style="font-size: 38px; padding-top: 50px; padding-left: 20%; padding-bottom: 20px;">Others also commented:</h1>

      <div style= "height: 300px; width: 80%; padding-left: 20%; padding-top: 20px; overflow: auto;">
      
         @foreach($comment as $comment)

         <div style="padding-bottom: 15px;">

            <b>{{ $comment->name }}</b><br>
            <p>{{ $comment->comment }}</p>
            <a style="color: #f7444e; padding-bottom: 15px;" href="javascript::void(0);" onclick="reply(this)" comment_id="{{ $comment->id }}">Reply</a>

            @foreach($reply as $response)

            @if($response->comment_id==$comment->id)
   
            <div style="padding-left: 3%; padding-top: 15px;">
               <b>{{ $response->name }}</b>
               <p>{{ $response->reply }}</p>
               <a style="color: #f7444e; padding-top: 20px;" href="javascript::void(0);" onclick="reply(this)" comment_id="{{ $comment->id }}">Reply</a>
            </div>

            @endif
            @endforeach
         </div>

         @endforeach

         <!-- Reply textarea -->

         <div style="padding-top: 20px; display: none;" class="replyDiv">

            <form action="{{ url('add_reply') }}" method="POST">

            @csrf

            <input type="text" id="commentID" name="commentID" hidden="">
            <textarea name="reply" style="height: 100px; width 100px; margin-bottom: 5px; resize: none;" placeholder="write a reply..."></textarea>
            <br><button type="submit" style="background-color: dodgerblue; color: white; padding: 10px; border-radius: 10px;">Reply</button>
            <a href="javascript::void(0);" class="btn" onClick="reply_close(this)">Cancel</a>

         </form>
         </div>

      
         </div>

      </div>
   

      <!-- end customer testimonials/comments -->
      <!-- footer start -->
      @include('home.footer')
      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         
         </p>
      </div>

      <script type="text/javascript">

         function reply(caller)
         {
            document.getElementById('commentID').value=$(caller).attr('comment_id');
            $('.replyDiv').insertAfter($(caller));
            $('.replyDiv').show();

         }

         function reply_close(caller)
         {

            $('.replyDiv').hide();

         }
      </script>

<script>
   document.addEventListener("DOMContentLoaded", function(event) { 
       var scrollpos = localStorage.getItem('scrollpos');
       if (scrollpos) window.scrollTo(0, scrollpos);
   });

   window.onbeforeunload = function(e) {
       localStorage.setItem('scrollpos', window.scrollY);
   };
</script>


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