@extends('layouts.master')

@section('title', 'Create Ticket')

@section('content')
    <div class="hero min-h-[80vh]">
        <div class="hero-content flex-col w-full">
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
                <h1 class="text-5xl font-bold">Create ticket</h1>
            </div>
            <div class="card flex-shrink-0 w-full max-w-sm shadow-2xl bg-base-100">
                <form action="{{ route('tickets.create') }}" method="POST" class="card-body">
                    @csrf
                    <div class="form-control">
                        <label class="label" for="title">
                            <span class="label-text">Title</span>
                        </label>
                        <input type="text" id="title" placeholder="Title" name="title"
                            class="input focus:input-primary input-bordered" value="{{ old('title') }}">
                        @error('title')
                            <p class="  text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-control">
                        <label class="label" for="service">
                            <span class="label-text">Service</span>
                        </label>
                        <select name="service" id="service"
                            class="select focus:select-primary select-bordered w-full max-w-xs">
                            <option disabled selected>--Select a service--</option>
                            @foreach ($services as $service)
                                <option value="{{ $service->id }}">
                                    {{ $service->entitled }}
                                </option>
                            @endforeach
                        </select>
                        @error('service')
                            <p class="  text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-control">
                        <label class="label" for="content">
                            <span class="label-text">Content</span>
                        </label>
                        <textarea name="content" id="content" cols="30" rows="10" class="textarea focus:textarea-primary textarea-bordered h-24"
                            placeholder="Content">{{ old('content') }}</textarea>
                        @error('content')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-control mt-6">
                        <button class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


{{-- <div class="hero min-h-[80vh]">
        <div class="hero-content flex-col w-full">
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
                <h1 class="text-5xl font-bold">Create Ticket</h1>
            </div>
            <div class="card flex-shrink-0 w-full max-w-sm shadow-2xl bg-base-100">
                <form action="" method="POST" class="card-body">
                    @csrf
                    <div class="form-control">
                        <label class="label" for="title">
                            <span class="label-text">Title</span>
                        </label>
                        <input type="text" id="title" placeholder="title" name="title" class="input input-bordered"
                            value="{{ old('title') }}">
                        @error('title')
                            <p class="  text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-control">
                        <label class="label" for="content">
                            <span class="label-text">Content</span>
                        </label>
                        <textarea id="content" name="content" class="input input-bordered"
                            placeholder="content">{{ old('content') }}</textarea>
                        @error('content')
                            <p class="  text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-control">
                        <label class="label" for="status">
                            <span class="label-text">Status</span>
                        </label>
                        <select id="status" name="status" class="input input-bordered">
                            <option value="open" {{ old('status') == 'open' ? 'selected' : '' }}>Open</option>
                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="closed" {{ old('status') == 'closed' ? 'selected' : '' }}>Closed</option>
                        </select>
                        @error('status')
                            <p class="  text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-control">
                        <label class="label" for="priority">
                            <span class="label-text">Priority</span>
                        </label>
                        <select id="priority" name="priority" class="input input-bordered">
                            <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
                            <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                            <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
                        </select>
                        @error('priority')
                            <p class="  text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-control">
                        <label class="label" for="category">
                            <span class="label-text">Category</span>
                        </label>
                        <select id="category" name="category" class="input input-bordered">
                            <option value="bug" {{ old('category') == 'bug' ? 'selected' : '' }}>Bug</option>
                            <option value="feature" {{ old('category') == 'feature' ? 'selected' : '' }}>Feature</option>
                            <option value="task" {{ old('category') == 'task' ? 'selected' : '' }}>Task</option>
                        </select>
                        @error('category')
                            <p class="  text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-control">
                        <label class="label" for="assignee">
                            <span class="label-text">Assignee</span>
                        </label>
                        <select id="assignee" name="assignee" class="input input-bordered">
                            <option value="">Unassigned</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}"
                                    {{ old('assignee') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                        @error('assignee')
                            <p class="  text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-control">
                        <label class="label" for="tags">
                            <span class="label-text">Tags</span>
                        </label>
                        <input type="text" id="tags" placeholder="tags" name="tags" class="input input-bordered"
                            value="{{ old('tags') }}">
                        @error('tags')
                            <p class="  text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-control">
                        <label class="label" for="attachments">
                            <span class="label-text">Attachments</span>
                        </label>
                        <input type="file" id="attachments" name="attachments[]" class="input input-bordered" multiple>
                        @error('attachments')
                            <p class="  text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-control">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}
