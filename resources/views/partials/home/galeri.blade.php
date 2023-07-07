{{-- @dd($galeri) --}}
<section id="galeri" class="pt-36 pb-32 bg-slate-100 dark:bg-dark">
  <div class="flex flex-wrap">
    <div class="w-full px-4">
      <div class="max-w-xl mx-auto text-center mb-16" data-aos="fade-down" data-aos-duration="1000">
        <h4 class="font-semibold uppercase text-lg text-primary mb-2">Galeri</h4>
      </div>
    </div>
    <div class="w-full px-4 lg:w-1/2" data-aos="fade-up" data-aos-duration="1000">
      <div class="grid grid-cols-2 gap-2">
        @if(count($galeri) < 4) <p class="text-center items-center justify-center">Tidak Ada Foto</p>
          @else
          @foreach($galeri as $foto)
          @if(!$foto->url)
          <div>
            <img class="h-auto max-w-full rounded-lg" src="{{ asset('storage/'. $foto->foto) }}" alt="">
          </div>
          @endif
          @endforeach
          @endif
      </div>
    </div>
    <div class="w-full lg:w-1/2 px-4 mt-6 " data-aos="fade-up" data-aos-duration="1000">
      <div class="swiper galeri"></div>
      <div class="swiper-wrapper">
        @foreach ($galeri as $slide)
        <div class="swiper-slide">
          <figure class="">
            <img class="h-auto max-w-full rounded-lg" src="{{ asset('storage/'. $slide->foto) }}" alt="image description">
          </figure>
        </div>
        @endforeach
      </div>
    </div>
  </div>
  </div>
</section>