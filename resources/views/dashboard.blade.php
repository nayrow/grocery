@extends('layout.layout')

@section('content')
    @livewire('search-item')
    <script>
        function submitForm(event) {
            const form = event.target.closest('form');
            form.submit();
        }
    </script>
@endsection
