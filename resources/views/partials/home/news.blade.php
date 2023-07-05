<section id="berita" class="pt-36 pb-16  dark:bg-gray-900">
  <div class="w-full px-4">
    <div class="max-w-xl mx-auto text-center mb-16" data-aos="fade-down" data-aos-duration="1000">
      <h4 class="font-semibold uppercase text-lg text-primary mb-2">Berita Terbaru</h4>
    </div>
  </div>
  <div class="w-full px-4 flex flex-wrap justify-center lg:w-10/12 xl:mx-auto">
    <div class="swiper news">
      <div class="swiper-wrapper">
        @if ($berita->count() < 3) <p class="text-center dark:text-white">
          Tidak ada Berita
          </p>
          @else
          @foreach($berita as $b)
          <div class="mb-12 p-4 md:w-1/3 swiper-slide">
            <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
              <a href="#">
                <img class="rounded-t-lg" src="{{ asset('storage/'. $b->foto) }}" alt="" />
              </a>
              <div class="p-5">
                <a href="/berita/kategori/{{ $b->kategori->slug }}" class="bg-amber-100 hover:bg-amber-200 text-amber-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded border border-amber-400">{{ $b->kategori->nama }}</a>
                <a href="#">
                  <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"><a href="/berita/{{ $b->slug }}" class="hover:underline">{{ $b->judul }}</a></h5>
                </a>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{!! $b->excerpt !!}</p>
                <a href="/berita/{{ $b->slug }}" class="inline-flex items-center mt-2 px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                  Read more
                  <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                  </svg>
                </a>
              </div>
            </div>
          </div>
          @endforeach
          @endif
      </div>
      <a href="" class="text-center mt-2 font-medium text-primary dark:text-amber-500 hover:underline">Semua Berita</a>
    </div>
</section>