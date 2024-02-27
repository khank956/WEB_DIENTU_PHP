<style>
.slider-item {
    margin-top: 10px;
    width: 80vw;
    height: 59vh;
    margin-left: -10px;
    margin-right: 40%;
    text-align: center;
}

.slider-item-one {
    background-image: url("https://alphavina.com/wp-content/uploads/2022/09/Group-30106.jpg");
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}

.slider-item-two {
    background-image: url("https://alphavina.com/wp-content/uploads/2022/10/Thiet-ke-chua-co-ten-36-1024x405.png");
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}

.slider-item-three {
    background-image: url("https://alphavina.com/wp-content/uploads/2022/10/Thiet-ke-chua-co-ten-39-1024x405.png");
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}

.slider-item-four {
    background-image: url("https://alphavina.com/wp-content/uploads/2022/10/Thiet-ke-chua-co-ten-37-1024x405.png");
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}

/* .slider-item-five {
    background-image: url("https://img.tgdd.vn/imgt/f_webp,fit_outside,quality_100/https://cdn.tgdd.vn/2024/01/banner/Lap-tet-720-220-720x220.png");
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}

.slider-item-six {
    background-image: url("https://img.tgdd.vn/imgt/f_webp,fit_outside,quality_100/https://cdn.tgdd.vn/2024/01/banner/C67-tet-720-220-720x220-3.png");
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}

.slider-item-7 {
    background-image: url("https://img.tgdd.vn/imgt/f_webp,fit_outside,quality_100/https://cdn.tgdd.vn/2024/01/banner/A15-A25--720-220-720x220.png");
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}

.slider-item-8 {
    background-image: url("https://img.tgdd.vn/imgt/f_webp,fit_outside,quality_100/https://cdn.tgdd.vn/2023/09/banner/720-220-720x220-110.png");
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
} */

.owl-prev {

    position: absolute;
    left: 5x;
    top: 50%;
    transform: translateY(-50%);
    font-size: 45px !important;
    color: aqua !important;
}

.owl-next {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 45px !important;
    color: aqua !important;
}

.owl-prev,
.owl-next:hover {
    background: none !important;
}

/* cac nut hien thi so luong hinh anh*/
/* .owl-dot {
    width: 23px;
    height: 23px;
    border: 2px solid #fff !important;
    border-radius: 50%;
    font-size: 2px !important;

    text-align: center;

}

.owl-dot span {
    width: 15px !important;
    height: 15px !important;
    margin: 0 !important;
    font-size: 2px !important;
    /* background-color: transparent!important;
}

*/
</style>

<body>

    <section class="slide owl-carousel owl-theme">
        <div class="slider-item slider-item-one">

        </div>
        <div class="slider-item slider-item-two">


        </div>
        <div class="slider-item slider-item-three">
        </div>
        <div class="slider-item slider-item-four">
        </div>


    </section>


    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="OwlCarousel2-2.3.4/dist/owl.carousel.min.js"></script>
    <script>
    $(document).ready(function() {
        $(".owl-carousel").owlCarousel();
    });
    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        autoplay: true,
        autoplayTimeout: 2000,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    })
    </script>

    <!-- </body>
 </html>
   -->