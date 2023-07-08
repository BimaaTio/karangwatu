  <!-- to top -->
  <a href="#beranda" id="to-top" class="items-center justify-center fixed bottom-4 right-4 z-[9999] h-14 w-14 bg-primary rounded-full hidden p-4 hover:animate-pulse">
    <span class="block w-5 h-5 rotate-45 border-t-2 border-l-2 mt-2 "></span>
  </a>
  <!-- /To top -->
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="{{ asset('sb/vendor/jquery/jquery.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>

  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.1/lightgallery.min.js" integrity="sha512-dSI4QnNeaXiNEjX2N8bkb16B7aMu/8SI5/rE6NIa3Hr/HnWUO+EAZpizN2JQJrXuvU7z0HTgpBVk/sfGd0oW+w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.1/plugins/fullscreen/lg-fullscreen.min.js" integrity="sha512-wUl8rYJugCiHiMm1uyGDqcgkvwoY9paD9vLJzT3e4mwp46yB0cicFVcvzy8N6UpbtQyFlJDBzrQQ3BNL72w1+A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.1/plugins/thumbnail/lg-thumbnail.min.js" integrity="sha512-Jx+orEb1KJtJ6Ajfshhr7is0zqgUC7H9ylk76KMtB9Ea2WAf/Muyzpe9zvBAYQQQKdAbj+rNYEorsRQLsmRafA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
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
      loop: true,
      autoplay: {
        delay: 3500,
        disableOnInteraction: true,
      },
      // pagination: {
      //   el: '.swiper-pagination',
      //   dynamicBullets: true,
      // },
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

    // fn send mail
    (function() {
      emailjs.init("n3PHe1SZtjeNn25Uw");
    })();

    function sendMail() {
      const templateParams = {
        name: document.getElementById('name').value,
        mail: document.getElementById('email').value,
        email: 'dusun.karangwatu@gmail.com',
        pesan: document.getElementById('pesan').value,
      };

      const serviceId = 'service_r35fs6u';
      const tempId = 'template_10evje9';

      emailjs.send(serviceId, tempId, templateParams).then(res => {
        document.getElementById('name').value = "";
        document.getElementById('email').value = "";
        document.getElementById('pesan').value = "";
        console.log(res);
        Swal.fire({
          icon: 'success',
          title: 'Good !',
          text: 'Pesan Berhasil dikirim!',
        });
      }).catch(err => {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Something went wrong!'
        })
        console.log(err);
      });
    }
  </script>