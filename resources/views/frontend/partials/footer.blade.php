<div class="footer">
    <div class="container">
        <div class="col-md-3 footer-grids fgd1">
            <a href="{{url('/')}}"><img src="{{ asset($fe_global_settings['footer_logo']) }}" alt=" " /><h3><?php echo $fe_global_settings['web_name'] ?></h3></a>
            <ul>
                <li>1234k Avenue, 4th block,</li>
                <li>New York City.</li>
                <li><a href="mailto:info@example.com">info@example.com</a></li>
                <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-dribbble" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
            </ul>
        </div>
        <div class="col-md-3 footer-grids fgd2">
            <h4>Information</h4>
            <?php echo $fe_menus_items_footer1_html ?>
        </div>
        <div class="col-md-3 footer-grids fgd3">
            <h4>Shop</h4>
            <?php echo $fe_menus_items_footer2_html ?>
        </div>
        <div class="col-md-3 footer-grids fgd4">
            <h4>My Account</h4>
            <ul>
                @guest
                    <li >
                        <a  href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li >
                            <a  href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>

                    @endif
                @else
                    <li >
                        <a  href="{{ route('logout') }}">{{ Auth::user()->name }} {{ __('Logout') }}</a>
                    </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="get" style="display: none;">
                        @csrf
                    </form>
                @endguest
            </ul>
        </div>
        <div class="clearfix"></div>
        <p class="copy-right">© 2016 Fashion Club . All rights reserved | Design by <a href="http://w3layouts.com"> W3layouts.</a></p>
    </div>
</div>
{{--<!-- cart-js -->
<script src="{{ asset('frontend_assets/js/minicart.js') }}"></script>
<script>
    w3ls1.render();

    w3ls1.cart.on('w3sb1_checkout', function (evt) {
        var items, len, i;

        if (this.subtotal() > 0) {
            items = this.items();

            for (i = 0, len = items.length; i < len; i++) {
                items[i].set('shipping', 0);
                items[i].set('shipping2', 0);
            }
        }
    });
</script>--}}
<!-- //cart-js -->