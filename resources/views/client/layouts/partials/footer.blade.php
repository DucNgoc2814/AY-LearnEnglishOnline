<section class="footer wow  animate__animated animate__fadeIn" data-wow-duration="1000" data-wow-delay="500"
data-wow-duration="1000" data-wow-delay="600">
<div class="container">
    <div class="row">
        <div class="col-lg-5 col-md-12 col-sm-12 col-12">
            <img loading="lazy" src="{{ asset('uploads/logos/logo 3.png') }}" style="width: 60%; height: auto; object-fit: cover;">
            <p>Nghiên cứu bất kỳ chủ đề, bất cứ lúc nào. Khám phá hàng ngàn khóa học với giá thấp nhất từ ​​trước đến nay!</p>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-4 col-4 mb-5">
            <h1>Danh mục</h1>
            <ul>
                @foreach ($categories as $category) 
                    <li><a href="home/coursesb5f1.html?category=html-amp-css"> {{ $category->name }}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-4 col-4">
            <h1>Liên hệ</h1>
            <ul>
                <li> <a href="home/become_an_instructor.html">Become an instructor</a></li>
                <li> <a href="blog.html">Blog</a></li>
                <li><a href="home/courses.html">All courses</a></li>
                <li><a href="sign_up.html">Sign up</a></li>
            </ul>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-4 col-4">
            <h1>Cộng đồng</h1>
            <ul>
                <li><a href="home/contact_us.html">Contact us</a></li>
                <li><a href="home/about_us.html">About us</a></li>
                <li><a href="home/privacy_policy.html">Privacy policy</a></li>
                <li><a href="home/terms_and_condition.html">Terms and condition</a></li>
                <li><a href="home/faq.html">Faq</a></li>
                <li><a href="home/refund_policy.html">Refund policy</a></li>
            </ul>
        </div>
    </div>

</div>
</section>
