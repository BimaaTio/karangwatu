  <!-- to top -->
  <a href="#beranda" id="to-top" class="items-center justify-center fixed bottom-4 right-4 z-[9999] h-14 w-14 bg-primary rounded-full hidden p-4 hover:animate-pulse">
    <span class="block w-5 h-5 rotate-45 border-t-2 border-l-2 mt-2 "></span>
  </a>
  <!-- /To top -->
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="{{ asset('sb/vendor/jquery/jquery.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>

  <script>
    AOS.init({
      mirroring: true
    });
    const swiper = new Swiper('.hero', {
      // Optional parameters
      direction: 'horizontal',
      loop: true,
      spaceBetween: 30,
      centeredSlides: false,
      autoplay: {
        delay: 3000,
        disableOnInteraction: true,
      },
      // If we need pagination
      // pagination: {
      //   el: '.swiper-pagination',
      // },
      // Navigation arrows
    });

    const news = new Swiper('.news', {
      slidesPerView: 3,
      spaceBetween: 30,
      autoplay: {
        delay: 3500,
        disableOnInteraction: true,
      },
      pagination: {
        el: '.swiper-pagination',
        dynamicBullets: true,
      },
      breakpoints: {
        320: {
          slidesPerView: 1,
        },
        640: {
          slidesPerView: 2,
        },
        1024: {
          slidesPerView: 3,
          spaceBetween: 30,
        },
      }
    });

    const galeri = new Swiper(".galeri", {
      loop: true,
      spaceBetween: 30,
      autoplay: {
        delay: 3000,
        disableOnInteraction: true,
      }
    });
  </script>