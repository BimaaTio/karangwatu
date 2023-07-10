@extends('layouts.home')
@section('content')
<!-- Hero  -->
@include('partials.home.hero')
<!-- /Hero  -->

<!-- Tentang Dusun -->
@include('partials.home.about')
<!-- /Tentang Dusun -->

<!-- Acara -->
@include('partials.home.acara')
<!-- /end acara -->

<!-- Berita Terbaru -->
@include('partials.home.news')
<!-- /Berita Terbaru -->
<!-- Galeri -->
@include('partials.home.galeri')
<!-- /Galeri -->
<!-- Contact -->
@include('partials.home.contact')
<!-- /Contact -->

<!-- Footer -->
@include('partials.home.footer')
<!-- /Footer -->
@endsection