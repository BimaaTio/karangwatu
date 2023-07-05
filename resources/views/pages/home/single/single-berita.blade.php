{{-- @dd($data) --}}
@extends('layouts.home')
@section('content')
<section class="py-32 dark:bg-dark pb-32">
  <div class="container dark:bg-dark mt-3">
    <div class="flex flex-wrap">
      <div class="flex w-full items-center space-x-4">
        <div class="flex-1 border-b border-gray-500 mt-5 dark:border-white"></div>
        <h1 class="text-3xl tracking-wide lg:text-3xl dark:text-white mt-5">{{ $data->judul }}</h1>
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
                <a href="/berita" class="ml-1 text-sm font-medium text-gray-700 hover:text-amber-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">Berita</a>
              </div>
            </li>
            <li>
              <div class="flex items-center">
                <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                </svg>
                <a href="#" class="ml-1 text-sm font-medium text-amber-700 hover:text-amber-600 md:ml-2 dark:text-amber-400 dark:hover:text-white"> {{ $data->judul }} </a>
              </div>
            </li>
          </ol>
        </nav>
        <div class="max-w w-full my-5">
          <img class="h-auto max-w-full" src="{{ asset('storage/'. $data->foto) }}" alt="image description">
          <ul class="flex flex-wrap my-4 text-gray-900 dark:text-white">
            <li class="mt-1">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
                <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
              </svg>
            </li>
            <li class="ml-2 mr-4">
              {{ $data->updated_at->translatedFormat('d F Y H:i:s') }} WIB
            </li>
            <li class="mt-1 ml-4">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="ml-2" viewBox="0 0 16 16">
                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
              </svg>
            </li>
            <li class="ml-2">
              <a href="/berita/author/{{ $data->user->name }}" class="text-amber-600 dark:text-amber-500 hover:underline">{{ $data->user->name }}</a>
            </li>
          </ul>
          <article class="mb-3 text-gray-500 dark:text-white">
            {!! $data->body !!}
          </article>
        </div>
      </div>
      <div class="w-full lg:w-1/3 mt-8 px-4">
        <h1 class="text-lg font-medium text-center dark:text-white mb-2">Berita Terakhir</h1>
        <div class="max-w p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
          <ul class="space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400">
            @foreach ($berita as $bl)
            <li class="my-4">
              <a href="/berita/{{$bl->slug}}" class="font-medium text-amber-600 dark:text-amber-500 hover:underline">{{ $bl->judul }}</a>
            </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
</section>
@include('partials.home.footer')
@endsection