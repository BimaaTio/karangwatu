<section class="pt-32 pb-36 dark:bg-gray-900">
  <div class="flex flex-wrap">
    <div class="w-full self-center px-4 lg:w-1/2" data-aos="fade-right" data-aos-duration="1000">
      <h1 id="" class="text-base font-semibold text-primary md:text-xl dark:text-white"><span id="typed"></span><span id="typed2" class="block font-bold text-dark text-4xl mt-1 lg:text-5xl dark:text-white">Sugeng Rawuh</span></h1>
      <h2 class="font-medium text-secondary text-lg mb-5 lg:text-2xl mt-1">Wonten ing Dusun<span class="text-dark dark:text-white"> Karangwatu</span></h2>
      <a href="#" class="text-base font-semibold text-white bg-primary py-3 px-8 rounded-full hover:shadow-lg hover:opacity-80 transition duration-300 ease-in-out">Kunjungi Sekarang!</a>
    </div>
    <div class="w-full self-center px-4 lg:w-1/2" data-aos="fade-left" data-aos-duration="1000">
      <div class="swiper hero" style="margin-top: 25px;">
        <div class="swiper-wrapper">
          @foreach($slider as $slide)
          <div class="swiper-slide">
            <figure class="">
              <img class="h-auto max-w-full rounded-lg" src="{{ asset('storage/slider/slide1.jpg') }}" alt="image description">
            </figure>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>