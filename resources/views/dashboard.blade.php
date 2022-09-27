<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            To Do
        </h2>
        <table>
            <tr>
                <td>
                    <div>
                        <form action="{{ route('dashboard') }}" method="GET">
                            <input type="text" name="search" placeholder="Task's text" required/>
                            <button type="submit" class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">Search</button>
                            <div>
                                <label>Include completed tasks</label>
                                <input type="checkbox" name="completed_include" id="completed_include" value="true">
                            </div>
                        </form>
                    </div>
                </td>
                <td>
                    <div>
                        <form action="{{ route('dashboard') }}" method="GET">
                            <h2>Filters</h2>
                            <ul style="padding-left:0px">
                                <li style="display:inline">
                                    <label>
                                    Due Date filter
                                    </label>
                                    <input type="date"  name="due_date_time_filter"></li>
                                <li style="display:inline">
                                    <label>
                                        Completed filter
                                    </label>
                                    <input type="checkbox" name="completed_filter" id="completed_filter" value="true"></li>
                                <li style="display:inline">
                                    <button type="submit" class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">Filter</button>
                                </li>
                            </ul>
                        </form>
                    </div>
                </td>
            </tr>
        </table>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
                <div class="flex">
                    <div class="flex-auto text-2xl mb-4">Tasks List</div>

                    <div class="flex-auto text-right mt-2">
                        <a href="/task" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add new Task</a>
                    </div>
                </div>
                <table class="w-full text-md rounded mb-4">
                    <thead>
                    <tr class="border-b">
                        <th class="text-left p-3 px-5">Task</th>
                        <th class="text-left p-3 px-5">Due date time</th>
                        <th class="text-left p-3 px-5">Completed date time</th>
                        <th class="text-left p-3 px-5"></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tasks as $task)
                        <tr class="border-b hover:bg-orange-100">
                            <td class="p-3 px-5">
                                {{$task->text}}
                            </td>
                            <td class="p-3 px-5">
                                {{date('m/d/Y h:i a', strtotime($task->due_date_time))}}
                            </td>
                            <td class="p-3 px-5">
                                @if($task->completed_at !== null)
                                    {{date('m/d/Y h:i a', strtotime($task->completed_at))}}
                                @endif
                            </td>
                            <td class="p-3 px-5">
                                <form action="/task/complete/{{$task->id}}" class="inline-block">
                                    <button type="submit" name="completed" formmethod="POST" class="text-sm bg-green-500 hover:bg-green-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">Completed</button>
                                    {{ csrf_field() }}
                                </form>
                            </td>
                            <td class="p-3 px-5">

                                <a href="/task/{{$task->id}}" name="edit" class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">Edit</a>

                                <form action="/task/delete/{{$task->id}}" class="inline-block">
                                    <button type="submit" name="delete" formmethod="POST" onclick="return confirm('Are you sure you want to delete this task?');" class="text-sm bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">Delete</button>
                                    {{ csrf_field() }}
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $tasks->links() }}
            </div>
        </div>
    </div>

</x-app-layout>
