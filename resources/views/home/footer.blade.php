<footer>
    <div class="container">
       <div class="row">
          <div class="col-md-4">
              <div class="full">
                 <div class="logo_footer">
                   <a href="#"><img width="210" src="images/logo.png" alt="#" /></a>
                 </div>
                 <div class="information_f">
                   <p><strong>ADDRESS:</strong> 28 Loch Ness Street, Scotland</p>
                   <p><strong>TELEPHONE:</strong> +44 187 654 1111</p>
                   <p><strong>EMAIL:</strong> yourmain@domain.com</p>
                 </div>
              </div>
          </div>
          <div class="col-md-8">
             <div class="row">
             <div class="col-md-7">
                <div class="row">
                   <div class="col-md-6">
                <div class="widget_menu">
                   <h3>Menu</h3>
                   <ul>
                      <li><a href="#">Home</a></li>
                      <li><a href="{{ url('coming_soon') }}">About</a></li>
                      <li><a href="{{ url('coming_soon') }}">Services</a></li>
                      <li><a href="{{ url('coming_soon') }}">Testimonial</a></li>
                      <li><a href="{{ url('coming_soon') }}">Blog</a></li>
                      <li><a href="{{ url('coming_soon') }}">Contact</a></li>
                   </ul>
                </div>
             </div>
             <div class="col-md-6">
                <div class="widget_menu">
                   <h3>Account</h3>
                   <ul>
                      <li><a href="{{ url('show_order') }}">Account</a></li>
                      <li><a href="{{ url('show_cart') }}">Checkout</a></li>
                      <li><a href="{{ route('login') }}">Login</a></li>
                      <li><a href="{{ route('register') }}">Register</a></li>
                      <li><a href="{{ url('all_products') }}">Shopping</a></li>
                      <li><a href="{{ url('coming_soon') }}">Widget</a></li>
                   </ul>
                </div>
             </div>
                </div>
             </div>     
             <div class="col-md-5">
                <div class="widget_menu">
                   <h3>Newsletter</h3>
                   <div class="information_f">
                     <p>Subscribe to our newsletter and get updates on upcoming products.</p>
                   </div>
                   <div class="form_sub">
                      <form>
                         <fieldset>
                            <div class="field">
                               <input type="email" placeholder="Please enter your email" name="email" />
                               <input type="submit" value="Subscribe" />
                            </div>
                         </fieldset>
                      </form>
                   </div>
                </div>
             </div>
             </div>
          </div>
       </div>
    </div>
 </footer>