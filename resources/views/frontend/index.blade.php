@include('frontend.layouts.header')


<body>
      <!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MFV4PLF"
height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->

    <!-- Navbar  -->
    <div class="row text-center justify-content-center  shadow-lg p-4  rounded">
        <div class="col-md-8">
            <a class="navbar-brand" href="#">
                {{-- logo --}}
                <img class="rounded-pill" src="{{ asset($company_info->logo) }}" alt="Image_logo" style="height: 110px">
                {{-- Copany Name 
                <!--<span style="font-size: 22px">{{ $company_info->name }}</span>--> --}}
            </a>
        </div>
    </div>

    {{-- Body content --}}
    <div class="container-fluid">

        {{-- Paragrap div --}}
        <div class="row mt-5 justify-content-md-center header-text">
            <div class="col-md-8 text-wrap text-center">
                <p class="text-wrap-head">আপনার একটু অসতর্কতা পরিণত হতে পারে সারাজীবনের কান্নায়।</p>
            </div>
        </div>

        {{-- video section --}}
        <div class="video m-4 shadow p-4 mb-4 bg-white ">
          <iframe width="560" height="315" src="https://www.youtube.com/embed/F98lEjzx2Lo" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>

        {{-- Paragrap div --}}
        <div class="row mt-5 justify-content-md-center video-footer-text">
            <div class="col-md-8 text-wrap text-center">
                <p class="text-wrap">গ্যাসের আগুনে প্রতিবছর কেড়ে নেয় হাজারো প্রান। গ্যাসের আগুন এবং সিলিন্ডার বিস্ফোরণ
                    থেকে আপনার পরিবারকে সুরক্ষা দিতে ব্যবহার করুন গ্যাস সেইফটি ডিভাইস। </p>
            </div>
            @if (isset($product))
                <div class="row text-center ">
                    <div class="col-md-3 text-center justify-self-center offset-md-4">
                        <a href="#product-{{ $product->id }}" class="btn cart-btn text-center order-text"
                            data-bs-toggle="collapse" data-bs-target="#product-top" aria-expanded="false"
                            aria-controls="product-top" style='background-color:#654eed; color:white'>অর্ডার করুন</a>
                        </a>
                    </div>
                </div>
            @endif
            <div class="collapse" id="product-top">
                <div class="card card-body order-section">
                    <form action="{{ route('order.store') }}" method="POST" class="row g-3 needs-validation">
                        @csrf
                        <div class="col-12 text-center">
                            @if (isset($product))
                                <input type="hidden" name="product_title" value="{{ $product->title }}">
                                <input type="hidden" name="product_price" value="{{ $product->price }}">
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                            @endif
                        </div>
                        <div class="col-md-4">
                            <label for="name" class="form-label">নাম <span style="color: red;">*</span></label>
                            <input name="first_name" type="text" class="form-control" id="name"
                                placeholder="Enter your name" required>
                            @if ($errors->has('first_name'))
                                <span class="text-danger">{{ $errors->first('first_name') }}</span>
                            @endif
                        </div>


                        <div class="col-md-4">
                            <label for="phone" class="form-label">ফোন নাম্বার
                                <span style="color: red;">*</span>
                            </label>
                            <input type="tel" name="phone" class="form-control" id="phone"
                                aria-describedby="inputGroupPrepend" required placeholder="Enter your phone number">
                        </div>

                        <div class="col-md-4">
                            <label for="address1" class="form-label" placeholder="Enter your Address">সম্পূর্ণ ঠিকানা
                                <span style="color: red;">*</span></label>
                            <textarea name="address1" id="address1" class="form-control" aria-label="With textarea" required></textarea>
                        </div>


                        {{--
                        <!--<div class="col-md-4">-->
                        <!--    <label for="quantity" class="form-label">পরিমাণ</label>-->
                        <!--    <input type="number" name="quantity" value="1" id="quantity"-->
                        <!--        class="form-control" required>-->
                        <!--</div>-->  --}}


                        <input type="hidden" name="quantity" value="1" id="quantity" class="form-control">

                        {{-- <div class="col-md-4">
                            <label for="address" class="form-label">শিপিং</label>
                            <select name="shipping_id" id="" class="form-control select" required>
                                <option value="" hidden>Select Shipping Method</option>
                                @if (isset($shipping))
                                    @foreach ($shipping as $n)
                                        <option value="{{ $n->id }}">{{ $n->type }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div> --}}

                        <label>পেমেন্ট প্রক্রিয়া:</label>


                            <input type="hidden" name="pamyment_methods" id="flexRadioDefault1" value="Bkash"
                                autocomplete="off">

                            <div class="form-check">
                                <input class="pamyment_method form-check-input" type="radio" name="pamyment_methods"
                                    id="checkbox3" value="CashonDelivery" autocomplete="off" checked>
                                <label class="form-check-label" for="checkbox3">
                                    ক্যাশ অন ডেলিভারি
                                </label>
                            </div>


                            <div class="col-12 text-center">
                                <button class="btn btn-primary" id="addToCartButton">অর্ডার নিশ্চিত করুন</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- product section --}}
        <section class="products" id="products">
            <h1 class="heading"><span>পণ্য</span> </h1>
            @if ($product == null)
                <p style="text-align: center">কোনো পণ্য যোগ করা হইনি</p>
            @endif
            <div class="box-container">

                @if ($product != null)
                    <div class="box">
                        @php
                            $discount = ($product->discount * $product->price) / 100;
                            $shipping = 60;
                        @endphp
                        <span class="discount">-{{ 1001 }}৳</span>
                        <div class="image">
                            <img class="img-fluid rounded-4 shadow-2-strong"
                                src="{{ asset('product/' . $product->photo) }}" alt="Product Image">
                            <div class="icons">
                                {{-- <a href="javascript:void(0)" class="fas fa-thumbs-up"></a> --}}
                                <a href="#" class="cart-btn" data-bs-toggle="collapse"
                                    data-bs-target="#product-{{ $product->id }}" aria-expanded="false"
                                    aria-controls="product-{{ $product->id }}"
                                    style='margin-top: 15px; background-color:#654eed'>অর্ডার করুন</a>
                                {{-- <a href="javascript:void(0)" class="fas fa-thumbs-up"></a> --}}
                            </div>
                        </div>
                        <div class="content">



                            {{-- Order form --}}
                            <div class="collapse" id="product-{{ $product->id }}">
                                <div class="card card-body order-section">
                                    <form action="{{ route('order.store') }}" method="POST"
                                        class="row g-3 needs-validation">
                                        @csrf
                                        <div class="col-12 text-center">
                                            {{-- <label> Product Name <span class="text-danger"> {{ $data->title }}</span> --}}
                                            <input type="hidden" name="product_title"
                                                value="{{ $product->title }}">
                                            <input type="hidden" name="product_price"
                                                value="{{ $product->price }}">
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                                            </label>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="name" class="form-label">নাম <span
                                                    style="color: red;">*</span></label>
                                            <input name="first_name" type="text" class="form-control"
                                                id="name" placeholder="Enter your name" required>
                                            @if ($errors->has('first_name'))
                                                <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                            @endif
                                        </div>

                                        <div class="col-md-4">
                                            <label for="phone" class="form-label">ফোন নাম্বার
                                                <span style="color: red;">*</span>
                                            </label>
                                            <input type="tel" name="phone" class="form-control" id="phone"
                                                aria-describedby="inputGroupPrepend" required
                                                placeholder="Enter your phone number">
                                        </div>

                                        <div class="col-md-4">
                                            <label for="address1" class="form-label"
                                                placeholder="Enter your Address">সম্পূর্ণ
                                                ঠিকানা
                                                <span style="color: red;">*</span></label>
                                            <textarea name="address1" id="address1" class="form-control" aria-label="With textarea" required></textarea>
                                        </div>

                                        <input type="hidden" name="quantity" value="1" id="quantity"
                                            class="form-control">

                                        <label>পেমেন্ট প্রক্রিয়া:</label>
                                        <input type="hidden" name="pamyment_methods" value="Nagad"
                                            autocomplete="off">
                                        <div class="form-check">
                                            <input class="pamyment_method1 form-check-input" type="radio"
                                                name="pamyment_methods" id="checkbox3" value="CashonDelivery"
                                                autocomplete="off" checked>
                                            <label class="form-check-label" for="checkbox3">
                                                ক্যাশ অন ডেলিভারি
                                            </label>
                                        </div>


                                        <div class="col-12 text-center">
                                            <button class="btn btn-primary">অর্ডার নিশিত করুন</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <h3>{{ $product->title }}</h3>
                            @php
                                $discount = ($product->discount * $product->price) / 100;
                                
                            @endphp
                            <div class="price"> {{ round($product->price) }}৳
                                <span>2300৳</span>
                            </div>
                        </div>

                        <div class="row text-center">
                            <div class="col-md-4 offset-md-4">
                                <span id="heart" role="img" aria-label="heart"
                                    class="free-delivary  text-animation"
                                    style='background-color:#00ebff; color:#1a23ac;border-radius: 27%;font-size: 28px;'>অফার প্রাইস
                                    ১২৯৯ টাকা <br>
                                </span>
                            </div>
                        </div>
                        <div class='delivary-img-section'>

                            <img class='delivary-image'
                               src="{{ asset('assets/images/free-delivary.png') }}">

                            <div class='animation'>
                                <span class=''>ডেলিভারি চার্জ ফ্রি সীমিত সময়ের জন্য </span>
                            </div>

                        </div>


                    </div>

                @endif

            </div>
        </section>

        {{-- Why this product  --}}
        @if (isset($product->summary))
            <section class="why-us">

                <div class="row p-3 mb-5 rounded justify-content-md-center">
                    <h1 class="why-us-header">কেন গ্যাস
                        সেইফটি ডিভাইস ব্যবহার করবেন? </h1>
                </div>

                <div class="row shadow-lg p-3 mb-5 bg-body rounded justify-content-md-center">
                    <span class="why-us-emoji">⭕</span>
                    <h1 class="why-us-div-des">
                        চুলার অথবা গ্যাসের লুজ পাইপের যেকোনো ধরনের লিকেজ হলে অটোমেটিক গ্যাস বন্ধ হয়ে যাবে</h1>
                </div>
                <div class="row shadow-lg p-3 mb-5 bg-body rounded justify-content-md-center">
                    <span class="why-us-emoji">⭕</span>
                    <h1 class="why-us-div-des">
                        চুলার বার্ণার থেকে মরিচার যেকোনো ধরনের সিদ্র হলে অটোমেটিক গ্যাস বন্ধ করে সিলিন্ডার বিস্ফোরণ থেকে
                        আপনার পরিবারকে সুরক্ষিত রাখবে
                    </h1>
                </div>
                <div class="row shadow-lg p-3 mb-5 bg-body rounded justify-content-md-center">
                    <span class="why-us-emoji">⭕</span>
                    <h1 class="why-us-div-des">
                        সহজেই গ্যাস লিকেজ আছে কি না ডিভাইসটির মাধ্যমে পরীক্ষা করতে পারবেন
                    </h1>
                </div>
                <div class="row shadow-lg p-3 mb-5 bg-body rounded justify-content-md-center">
                    <span class="why-us-emoji">🔥</span>
                    <h1 class="why-us-div-des">
                        ২০%-২৫% পর্যন্ত গ্যাস বাচাবে
                    </h1>

                </div>
                <div class="row shadow-lg p-3 mb-5 bg-body rounded justify-content-md-center">
                    <span class="why-us-emoji">🔥</span>
                    <h1 class="why-us-div-des">
                        সাধারণ রেগুলেটরের মতো সহজে ব্যবহার করতে পারবেন
                    </h1>
                </div>
                <div class="row shadow-lg p-3 mb-5 bg-body rounded justify-content-md-center">
                    <span class="why-us-emoji">🔥</span>
                    <h1 class="why-us-div-des">
                        যেকোনো সিলিন্ডারে ব্যবহার করতে পারবেন
                    </h1>
                </div>
                <div class="row shadow-lg p-3 mb-5 bg-body rounded justify-content-md-center">
                    <span class="why-us-emoji">🔥</span>
                    <h1 class="why-us-div-des">
                        ২২মিঃমিঃ সাইজ
                    </h1>
                </div>
                <div class="row shadow-lg p-3 mb-5 bg-body rounded justify-content-md-center">
                    <span class="why-us-emoji">🔥</span>
                    <h1 class="why-us-div-des">
                        সাধারণ ৫ বছরের ওয়ারেন্টি
                    </h1>
                </div>
                <div class="row shadow-lg p-3 mb-5 bg-body rounded justify-content-md-center">
                    <span class="why-us-emoji">🔥</span>
                    <h1 class="why-us-div-des">
                        সাধারণ রেগুলেটরের মতো সহজে ব্যবহার করতে পারবেন
                    </h1>
                </div>
                <div class="row shadow-lg p-3 mb-5 why-us-footer rounded justify-content-md-center">
                    <h1 class="why-us-footer-text">
                        মনে রাখবেন একটি দূর্ঘটনা সারা জীবনের কান্না </h1>
                </div>

            </section>
        @endif

        {{-- review sectio --}}
        <section>
            {{-- <div class="row text-center shadow-lg p-3 mb-5 bg-body rounded "> --}}
            {{-- <h1>Customer Review</h1> --}}
            {{-- @foreach ($posts as $n)
                    <div class="col-md-6 about">
                        <img src="{{ url($n->photo) }}" alt="" width="100px">
                    </div>
                @endforeach --}}
            {{-- </div> --}}
            {{-- </section> --}}
            {{-- review sectio end --}}
    </div>

    <div>
        <div class="row justify-content-center social-icon">

            <div class="col-md-4">
                <a href="tel:{{ $company_contact_info->phone }}"><i class="fas fa-phone-alt"></i></a>
                <p><a href="tel:{{ $company_contact_info->phone }}">{{ $company_contact_info->phone }}</a></p>
            </div>
            <div class="col-md-4">
                <a href="{{ $company_contact_info->facebook_page_link }}"><i class="fab fa-facebook"></i>
                    <p>আমাদের ফেসবুক পেজ</p>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{ $company_contact_info->facebook_group_link }}"><i class="fab fa-youtube"></i>
                    <p>আমাদের ইউটিউব চ্যানেল</p>
                </a>
            </div>


        </div>
    </div>

    <div class="footer-top">
        <p>আপনাকে অনেক ধন্যবাদ আমদের ওয়েবসাইট টি ভিজিট করার জন্য</p>
    </div>
    <footer class="footer">
        <p>
            All Right Reserved By <span class="footer-text">SUNNAHAT</span> <br>
            Designed And developed by <span class="footer-text">Md. Nobir Hasan</span> <br>
            Powdered by <span class="footer-text">Business Mind Academy</span>
        </p>
    </footer>

    </div>
    @if (session()->has('script_msg'))
        {!! session()->get('script_msg') !!}
    @endif


<script type="text/javascript">
  $('#addToCartButton').click(function() {
    fbq('track', 'Purchase', {currency: "BDT", value: 1299.00});
  });
  </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script>
        // $(document).ready(function({
        //     $('#payment_method').on()(function() {
        //         var value = $(this).val();
        //         alert(value);
        //     });
        // }));
        $(document).ready(function() {
            $('.pamyment_method').each(function(index) {
                $(this).on('click', function() {
                    var value = $(this).val();
                    if (value == 'Bkash') {
                        $('#bkash').css('display', 'block');
                        $('#bkash_input').prop('disabled', false);
                        $('#nagad_input').prop('disabled', true);
                        $('#nagad').css('display', 'none');

                        $('#bkash1').css('display', 'block');
                        $('#bkash_input1').prop('disabled', false);
                        $('#nagad_input1').prop('disabled', true);
                        $('#nagad1').css('display', 'none');
                    } else if (value == 'Nagad') {
                        $('#bkash_input').prop('disabled', true);
                        $('#nagad_input').prop('disabled', false);
                        $('#bkash').css('display', 'none');
                        $('#nagad').css('display', 'block');

                        $('#bkash_input1').prop('disabled', true);
                        $('#nagad_input1').prop('disabled', false);
                        $('#bkash1').css('display', 'none');
                        $('#nagad1').css('display', 'block');
                    } else {
                        $('#bkash_input').prop('disabled', true);
                        $('#nagad_input').prop('disabled', true);
                        $('#bkash').css('display', 'none');
                        $('#nagad').css('display', 'none');

                        $('#bkash_input1').prop('disabled', true);
                        $('#nagad_input1').prop('disabled', true);
                        $('#bkash1').css('display', 'none');
                        $('#nagad1').css('display', 'none');
                    }
                })
            });

            $('.pamyment_method1').each(function(index) {
                $(this).on('click', function() {
                    $('#nagad_input').prop('disabled', true);
                    $('#bkash_input').prop('disabled', true);
                    var value = $(this).val();
                    if (value == 'Bkash') {
                        $('#bkash1').css('display', 'block');
                        $('#bkash_input1').prop('disabled', false);
                        $('#nagad_input1').prop('disabled', true);
                        $('#nagad1').css('display', 'none');
                    } else if (value == 'Nagad') {

                        $('#bkash_input1').prop('disabled', true);
                        $('#nagad_input1').prop('disabled', false);
                        $('#bkash1').css('display', 'none');
                        $('#nagad1').css('display', 'block');
                    } else {
                        $('#bkash_input1').prop('disabled', true);
                        $('#nagad_input1').prop('disabled', true);
                        $('#bkash1').css('display', 'none');
                        $('#nagad1').css('display', 'none');
                    }
                })
            });


            const Confetti = (() => {
                "use strict";
                const e = 10;
                let t, o, n = 75,
                    i = 25,
                    r = 1,
                    s = !1,
                    l = !0,
                    a = [],
                    d = (new Date).getTime();

                function p(e) {
                    if (t = document.createElement("canvas"), o = t.getContext("2d"), t.width = 2 * window
                        .innerWidth, t.height = 2 * window.innerHeight, t.style.position = "fixed", t.style
                        .top = 0, t.style.left = 0, t.style.width = "calc(100%)", t.style.height =
                        "calc(100%)", t.style.margin = 0, t.style.padding = 0, t.style.zIndex = 999999999, t
                        .style.pointerEvents = "none", document.body.appendChild(t), null != e) {
                        let t = document.getElementById(e);
                        null != t && t.addEventListener("click", e => {
                            ! function(e, t) {
                                let o = [];
                                for (let i = 0; i < n; i++) o.push(c(e, t));
                                a.push({
                                    particles: o
                                })
                            }(2 * e.clientX, 2 * e.clientY), l && (e.target.style.visibility =
                                "hidden")
                        })
                    }
                    window.addEventListener("resize", () => {
                        t.width = 2 * window.innerWidth, t.height = 2 * window.innerHeight
                    })
                }

                function y(e) {
                    return e.pos.y - 2 * e.size.x > 2 * window.innerHeight
                }

                function c(e, t) {
                    let o = (16 * Math.random() + 4) * r,
                        n = (4 * Math.random() + 4) * r;
                    return {
                        pos: {
                            x: e - o / 2,
                            y: t - n / 2
                        },
                        vel: h(),
                        size: {
                            x: o,
                            y: n
                        },
                        rotation: 360 * Math.random(),
                        rotation_speed: 10 * (Math.random() - .5),
                        hue: 360 * Math.random(),
                        opacity: 100,
                        lifetime: Math.random() + .25
                    }
                }

                function h() {
                    let e = Math.random() - .5,
                        t = Math.random() - .7,
                        o = Math.sqrt(e * e + t * t);
                    return t /= o, {
                        x: (e /= o) * (Math.random() * i),
                        y: t * (Math.random() * i)
                    }
                }
                return p.prototype.setCount = (e => {
                    "number" == typeof e ? n = e : console.error(
                        "[ERROR] Confetti.setCount() - Input needs to be of type 'number'")
                }), p.prototype.setPower = (e => {
                    "number" == typeof e ? i = e : console.error(
                        "[ERROR] Confetti.setPower() - Input needs to be of type 'number'")
                }), p.prototype.setSize = (e => {
                    "number" == typeof e ? r = e : console.error(
                        "[ERROR] Confetti.setSize() - Input needs to be of type 'number'")
                }), p.prototype.setFade = (e => {
                    "boolean" == typeof e ? s = e : console.error(
                        "[ERROR] Confetti.setFade() - Input needs to be of type 'boolean'")
                }), p.prototype.destroyTarget = (e => {
                    "boolean" == typeof e ? l = e : console.error(
                        "[ERROR] Confetti.destroyTarget() - Input needs to be of type 'boolean'"
                    )
                }), window.requestAnimationFrame(function t(n) {
                    let i = (n - d) / 1e3;
                    d = n;
                    for (let t = a.length - 1; t >= 0; t--) {
                        let o = a[t];
                        for (let t = o.particles.length - 1; t >= 0; t--) {
                            let n = o.particles[t];
                            n.vel.y += e * (n.size.y / (10 * r)) * i, n.vel.x += 25 * (Math
                                    .random() - .5) * i, n.vel.x *= .98, n.vel.y *= .98, n.pos.x +=
                                n
                                .vel.x, n.pos.y += n.vel.y, n.rotation += n.rotation_speed, s && (n
                                    .opacity -= n.lifetime), y(n) && o.particles.splice(t, 1)
                        }
                        0 == o.particles.length && a.splice(t, 1)
                    }! function() {
                        o.clearRect(0, 0, 2 * window.innerWidth, 2 * window.innerHeight);
                        for (const d of a)
                            for (const a of d.particles) e = a.pos.x, t = a.pos.y, n = a.size.x, i =
                                a.size.y, r = a.rotation, s = a.hue, l = a.opacity, o.save(), o
                                .beginPath(), o.translate(e + n / 2, t + i / 2), o.rotate(r * Math
                                    .PI / 180), o.rect(-n / 2, -i / 2, n, i), o.fillStyle =
                                `hsla(${s}deg, 90%, 65%, ${l}%)`, o.fill(), o.restore();
                        var e, t, n, i, r, s, l
                    }(), window.requestAnimationFrame(t)
                }), p
            })();

            // Pass in the id of an element
            let confetti = new Confetti('heart');

            // Edit given parameters
            confetti.setCount(75);
            confetti.setSize(1);
            confetti.setPower(25);
            confetti.setFade(false);
            confetti.destroyTarget(true);
        });

        $('.order-text').click(function() {
            $.scrollTo($('#product-1'), 1000);
        });
    </script>
</body>

</html>
