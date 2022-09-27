<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Task') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">

                <form method="POST" action="/task">
                    <div>
                        <label for="due_date_time">Due date for task</label>
                        <input type="datetime-local"  name="due_date_time">
                        @if ($errors->has('due_date_time'))
                            <span class="text-danger">{{ $errors->first('due_date_time') }}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <textarea name="text" class="bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full h-20 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white"  placeholder='Enter your task'></textarea>
                        @if ($errors->has('text'))
                            <span class="text-danger">{{ $errors->first('text') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Task</button>
                    </div>
                    {{ csrf_field() }}
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
