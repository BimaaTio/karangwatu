@extends('layouts.home')
@section('content')
<section class="py-32 dark:bg-dark pb-32">
  <div class="container dark:bg-dark mt-3">
    <div class="flex flex-wrap">
      <div class="flex w-full items-center space-x-4">
        <div class="flex-1 border-b border-gray-500 mt-5 dark:border-white"></div>
        <h1 class="text-3xl tracking-wide lg:text-3xl dark:text-white mt-5">{{ $title }}</h1>
        <div class="flex-1 border-b border-gray-500 mt-5 dark:border-white"></div>
      </div>

      <div class="w-full mt-8 px-4">
        <!-- Breadcrumb -->
        <nav class="flex px-5 py-3 text-gray-700 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700" aria-label="Breadcrumb">
          <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
              <a href="/" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-amber-600 dark:text-gray-400 dark:hover:text-white">
                <svg aria-hidden="true" class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                  <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                </svg>
                Home
              </a>
            </li>
            <li>
              <div class="flex items-center">
                <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                </svg>
                <a href="/galeri" class="ml-1 text-sm font-medium text-gray-700 hover:text-amber-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">Galeri</a>
              </div>
            </li>
            @if($title == str_contains($title, $title))
            <li>
              <div class="flex items-center">
                <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                </svg>
                <a href="#" class="ml-1 text-sm font-medium text-amber-700 hover:text-amber-600 md:ml-2 dark:text-amber-400 dark:hover:text-white">{{ $title }}</a>
              </div>
            </li>
            @else

            @endif
          </ol>
        </nav>

        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 my-4" id="galeri">
          @foreach($data as $galeri)
          @if($galeri->foto == NULL && $galeri->url == str_contains($galeri->url,'embed'))
          <div>
            <iframe src="https://www.youtube.com/{{ $galeri->url }}" frameborder="0" allowfullscreen class="h-[270px] w-96 rounded-lg"></iframe>
          </div>
          @else
          <div>
            <img class="h-auto max-w-full rounded-lg" src="{{ asset('storage/'. $galeri->foto) }}" alt="">
          </div>
          @endif
          @if($galeri->foto == NULL && $galeri->url != str_contains($galeri->url,'embed'))
          <div>
            <img class="h-auto max-w-full rounded-lg" src="{{ $galeri->url }}" alt="">
          </div>
          @endif
          @endforeach
        </div>

      </div>
    </div>
  </div>
</section>
@include('partials.home.footer')
@endsection