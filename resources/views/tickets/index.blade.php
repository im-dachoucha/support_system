@extends('layouts.master')

@section('title', 'Tickets')


@section('content')
    @foreach ($tickets as $ticket)
        <div>
            <h1 class="text-3xl">
                {{ $ticket->title }}
            </h1>
            <p>{{ $ticket->content }}</p>
        </div>
    @endforeach
    {{-- <div>
        {{ $tickets->links() }}
    </div> --}}
@endsection
