@extends('public.layout.index')
@section('title', 'Miniseri - HomePage')
@section('content')

    @include('public.homepage.partials.hero')

    @include('public.homepage.partials.services')

    @include('public.homepage.partials.folio', ['folios' => $folios])

    @include('public.homepage.partials.s-k')

    @include('public.homepage.partials.faq')

    @include('public.homepage.partials.sineas')

    @include('public.homepage.partials.contact')

    @include('public.homepage.partials.modal-s-k')

    @include('public.homepage.partials.modal-join-sineas')

@endsection