@extends('layouts.master')

@section('title', 'Tickets')


@section('content')
    @error('message')
        <div class="alert shadow-lg">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    class="stroke-info flex-shrink-0 w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>{{ $message }}</span>
            </div>
        </div>
    @enderror
    <div class="mt-10 p-3 flex flex-col gap-5 min-h-[70vh] max-w-xl mx-auto border border-primary rounded-md">
        @if (!count($tickets))
            <div class="flex flex-col h-[50vh] justify-evenly">
                <h1 class="text-3xl text-center font-semibold">Such emtpy!!!</h1>
                @user
                <a class="btn btn-primary" href="{{ route('tickets.create') }}">Create your first ticket</a>
                @enduser
            </div>
        @else
            @foreach ($tickets as $ticket)
                <div class="p-3 border border-gray-300 rounded-md">
                    <div
                        class="flex flex-col gap-3 justify-center items-start md:flex-row md:justify-between md:items-center">
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
                    <p class="text-sm font-normal">{{ $ticket->created_at->diffForHumans() }}</p>
                </div>
            @endforeach
        @endif
    </div>
    <div class="max-w-xl mx-auto">
        {{ $tickets->links() }}
    </div>
@endsection
