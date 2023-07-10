{{-- @dd($acara) --}}
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

      <div class="w-full lg:w-2/3 mt-8 px-4">
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
                <a href="/acara" class="ml-1 text-sm font-medium text-gray-700 hover:text-amber-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">Acara</a>
              </div>
            </li>
            @if($title == str_contains($title, $title))
            <li>
              <div class="flex items-center">
                <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                </svg>
                <a href="/acara" class="ml-1 text-sm font-medium text-amber-700 hover:text-amber-600 md:ml-2 dark:text-amber-400 dark:hover:text-white">{{ $title }}</a>
              </div>
            </li>
            @else

            @endif
          </ol>
        </nav>
        @if($acara->count() > 0)
        @foreach($acara as $b)
        <div class="max-w w-full lg:flex  shadow dark:shadow-gray-600 my-5">
          <img class="h-48 lg:h-auto lg:w-80  sm:w-full sm:h-72 min-[412]:w-full flex-none bg-cover rounded text-center overflow-hidden" src="{{ asset('storage/'. $b->foto) }}">
          <div class="rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal dark:bg-gray-800">
            <div class="mb-8">
              <p class="text-sm text-grey-dark flex items-center">
                <a href="/acara/kategori/{{ $b->kategori->slug }}" class="bg-amber-100 hover:bg-amber-200 text-amber-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded border border-amber-400">{{ $b->kategori->nama }}</a>
              </p>
              <div class="font-bold text-2xl tracking-tight text-gray-900 dark:text-white mb-2"><a class="hover:underline" href="/acara/{{ $b->slug }}">{{ $b->nama_acara }}</a></div>
              <p class="my-3 dark:text-white text-lg font-semibold">Waktu Acara : {{ $b->waktu_acara }}</p>
            </div>
            <div class="flex items-center">
              <div class="text-sm">
                <p class="text-black dark:text-gray-400">Post By : <a href="/acara/author/{{ $b->user->name }}" class="text-amber-600 dark:text-amber-500 hover:underline"> {{ $b->user->name }} </a> </p>
                <p class="text-grey-dark dark:text-gray-400">{{ $b->updated_at->diffForHumans() }}</p>
              </div>
            </div>
          </div>
        </div>
        @endforeach
        @else
        <p class="text-center my-5 dark:text-white">Tidak Ada acara!</p>
        @endif
      </div>
      <div class="w-full lg:w-1/3 mt-8 px-4">
        <h1 class="text-lg font-medium text-center dark:text-white mb-2">acara Terakhir</h1>
        <div class="max-w p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
          <ul class="space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400">
            @if($acara->count() > 0)
            @foreach ($acara as $bl)
            <li class="my-4">
              <a href="/acara/{{$bl->slug}}" class="font-medium text-amber-600 dark:text-amber-500 hover:underline">{{ $bl->nama_acara }}</a>
            </li>
            @endforeach
            @else
            <p class="text-center my-3">Tidak Ada acara!</p>
            @endif
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
@include('partials.home.footer')
@endsection