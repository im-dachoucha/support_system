@extends('layouts.master')

@section('title', 'Tickets')


@section('content')
    <div class="mt-10 p-3 flex flex-col gap-5 min-h-[70vh] max-w-xl mx-auto border border-primary rounded-md">
        @if (!count($tickets))
            <div class="flex flex-col h-[50vh] justify-evenly">
                <h1 class="text-3xl text-center font-semibold">You have not created a ticket yet</h1>
                <a class="btn btn-primary" href="{{ route('tickets.create') }}">Create your first ticket</a>
            </div>
        @else
            @foreach ($tickets as $ticket)
                <div class="p-3 border border-gray-300 rounded-md">
                    <div class="flex justify-between items-center">
                        <h1 class="text-3xl">
                            {{ $ticket->title }}
                        </h1>
                        <div>
                            <span class="badge badge-sm badge-secondary">{{ $ticket->status->entitled }}</span>
                            <span class="badge badge-sm badge-secondary">{{ $ticket->service->entitled }}</span>
                        </div>
                    </div>
                    <p class="max-w-[100ch] text-ellipsis overflow-hidden whitespace-nowrap mt-3">{{ $ticket->content }}
                    </p>
                    <a class="link link-primary inline-block mt-2"
                        href="{{ route('tickets.answer', $ticket->id) }}">Answer</a>
                    @user
                    @if ($ticket->status_id == 1)
                        <form action="{{ route('tickets.status', $ticket->id) }}" method="POST" class="inline-block">
                            @csrf
                            <input type="text" name="status_id" value="2" hidden="hidden">
                            <button class="link link-primary inline-block mt-2" type="submit">
                                Mark as resolved
                            </button>
                        </form> |
                    @endif
                    @if ($ticket->status_id != 3)
                        <form action="{{ route('tickets.status', $ticket->id) }}" method="POST" class="inline-block">
                            @csrf
                            <input type="text" name="status_id" value="3" hidden="hidden">
                            <button class="link link-primary inline-block mt-2" type="submit">
                                Close ticket
                            </button>
                        </form>
                    @endif
                    @enduser
                </div>
            @endforeach
        @endif
    </div>
    <div class="max-w-xl mx-auto">
        {{ $tickets->links() }}
    </div>
@endsection
