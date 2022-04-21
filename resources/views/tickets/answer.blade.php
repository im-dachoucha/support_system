@extends("layouts.master")


@section('title', 'Answer ticket')



@section('content')
    <div class="mt-10 p-3 flex flex-col gap-5 min-h-[70vh] max-w-xl mx-auto border border-primary rounded-md">
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
            <p class="mt-3">{{ $ticket->content }}</p>
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
        <div class="p-3 border border-gray-300 rounded-md">
            <form action="{{ route('answer.store') }}" method="POST">
                @csrf
                <input type="text" name="ticket_id" value="{{ $ticket->id }}" hidden>
                <div class="form-control">
                    <label class="label" for="answer">
                        <span class="label-text">Answer</span>
                    </label>
                    <textarea name="content" id="answer" cols="30" rows="10" class="textarea focus:textarea-primary textarea-bordered h-24"
                        placeholder="Your answer">{{ old('answer') }}</textarea>
                    @error('answer')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-control mt-3">
                    <button class="btn btn-primary">Answer</button>
                </div>
            </form>
            {{-- <form action="{{ route('tickets.answer', $ticket->id) }}" method="POST">
                @csrf
                <div class="flex flex-col gap-5">
                    <label for="content" class="text-sm">Answer</label>
                    <textarea name="content" id="content" cols="30" rows="5"
                        class="textarea textarea-bordered focus:textarea-primary"></textarea>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="btn btn-primary">Answer</button>
                </div>
            </form> --}}
        </div>
        @foreach ($answers as $answer)
            <div class="p-3 border border-gray-300 rounded-md">
                <p class="text-xl font-bold">{{ $answer->user->username }} <span
                        class="text-sm font-normal">{{ $answer->created_at->diffForHumans() }}</span> </p>
                <p>{{ $answer->content }}</p>
            </div>
        @endforeach
    </div>
    <div class="max-w-xl mx-auto">
        {{ $answers->links() }}
    </div>
@endsection
