@extends('layouts.master')

@section('title', 'services')


@section('content')
    <div class="flex flex-col justify-start min-h-[80vh] gap-16">
        <div class="flex flex-col items-center mt-5 w-full">
            @error('message')
                <div class="alert alert-error shadow-lg max-w-md">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{ $message }}</span>
                    </div>
                </div>
            @enderror
            <div class="text-center lg:text-left">
                <h1 class="text-3xl font-bold">Create Service</h1>
            </div>
            <div class="card flex-shrink-0 w-full max-w-sm shadow-2xl bg-base-100">
                <form action="{{ route('services.create') }}" method="POST" class="card-body">
                    @csrf
                    <div class="form-control">
                        <label class="label" for="entitled">
                            <span class="label-text">Entitled</span>
                        </label>
                        <input type="text" id="entitled" placeholder="entitled" name="entitled"
                            class="input focus:input-primary input-bordered" value="{{ old('entitled') }}">
                        @error('entitled')
                            <p class="  text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-control mt-6">
                        <button class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="w-full flex flex-col gap-3 items-center">
            @foreach ($services as $service)
                <div class="w-full max-w-md flex justify-between">
                    <h1 class="text-xl">{{ $service->entitled }}</h1>
                    <div class="manage btn btn-md" data-id="{{ $service->id }}"
                        data-entitled="{{ $service->entitled }}">manage</div>
                </div>
            @endforeach
            {{-- <div class="w-full max-w-md">service 2</div> --}}
            <div class="w-full max-w-md">
                {{ $services->links() }}
            </div>
        </div>
    </div>
    <script>
        const manage = document.querySelectorAll('.manage');
        manage.forEach(element => {
            element.addEventListener('click', (e) => {
                const id = e.target.dataset.id;
                const entitled = e.target.dataset.entitled
                console.log(id, entitled);
            });
        });
    </script>
@endsection
