@extends('layout.layout')

@section('content')
    @livewire('current-list')
    <script>
        function submitForm(event) {
            const form = event.target.closest('form');
            form.submit();
        }
    </script>
@endsection
