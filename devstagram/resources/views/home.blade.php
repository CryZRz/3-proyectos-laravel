@extends("layouts.app")

@section("titulo")
Principal
@endsection

@section("contenido")
    <x-ListarPost :posts="$posts" />
@endsection