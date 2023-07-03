<section id="galeri" class="pt-36 pb-32 bg-slate-100 dark:bg-dark">
  <div class="flex flex-wrap">
    <div class="w-full px-4">
      <div class="max-w-xl mx-auto text-center mb-16" data-aos="fade-down" data-aos-duration="1000">
        <h4 class="font-semibold uppercase text-lg text-primary mb-2">Galeri</h4>
      </div>
    </div>
    <div class="w-full px-4 lg:w-1/2">
      <div class="grid grid-cols-2 gap-2">
        <div>
          <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-1.jpg" alt="">
        </div>
        <div>
          <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-2.jpg" alt="">
        </div>
        <div>
          <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-3.jpg" alt="">
        </div>
        <div>
          <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-4.jpg" alt="">
        </div>
      </div>
    </div>
    <div class="w-full lg:w-1/2 px-4 mt-6 ">
      <div class="swiper galeri">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <figure class="">
              <img class="h-auto max-w-full rounded-lg" src="{{ asset('storage/slider/slide1.jpg') }}" alt="image description">
            </figure>
          </div>
          <div class="swiper-slide">
            <figure class="">
              <img class="h-auto max-w-full rounded-lg" src="{{ asset('storage/slider/slide2.jpg') }}" alt="image description">
            </figure>
          </div>
          <div class="swiper-slide">
            <figure class="">
              <img class="h-auto max-w-full rounded-lg" src="{{ asset('storage/slider/slide3.jpg') }}" alt="image description">
            </figure>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>