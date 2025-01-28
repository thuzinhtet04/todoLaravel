<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Task Management</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles / Scripts -->

        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>

    <body class="px-10 font-sans antialiased dark:bg-black dark:text-white/50">

        <div class="flex items-center justify-between gap-5 p-5">

            <a href="/profile" class="inline-flex h-10 items-center gap-2">
                <div class="h-full overflow-hidden rounded-full">
                    <img class="h-full" src="{{ asset('storage/' . Auth::user()->image) }}" alt="">
                </div>
                <h4 class="capitalize">

                    {{ Auth::user()->name }}
                </h4>
            </a>
            <form action="/logout" method="POST">
                @csrf
                <button class="rounded border border-red-400 bg-white/20 px-2 py-1 text-red-700">Logout</button>
            </form>
        </div>

        <h1 class="text-center text-3xl text-yellow-700 dark:text-white"> Task Manager </h1>
        <div>
            <form action="/" class="mx-auto mt-5 flex w-1/2 items-center gap-3" method="POST">
                @csrf
                <input type="text" name="task" placeholder="Enter Task"
                    class="flex-1 rounded-lg border border-gray-300 bg-black p-2 text-white">
                <input type="hidden" name="status" value="Pending">

                <button class="rounded border border-blue-400 bg-black px-2 py-1 text-blue-700">Add Task</button>
            </form>
        </div>
        <div class="relative mx-auto overflow-x-auto p-10 shadow-md sm:rounded-lg">
            <table class="mx-auto w-1/2 text-left text-sm text-gray-500 rtl:text-right dark:text-gray-400">
                <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Task
                        </th>
                        <th scope="col" class="px-6 py-3">
                            status
                        </th>
                        <th scope="col" class="px-6 py-3 text-end">
                            Action
                        </th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                        <tr class="border-b border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-800">
                            <th scope="row"
                                class="whitespace-nowrap px-6 py-4 font-medium text-gray-900 dark:text-white">
                                {{ $task->task }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $task->status }}
                            </td>

                            <td class="flex items-center justify-end gap-2 px-6 py-4 text-end">
                                <a href="/{{ $task->id }}/edit"
                                    class="font-medium text-blue-600 hover:underline dark:text-blue-500">Edit</a>
                                <form action="/{{ $task->id }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button
                                        class="rounded border border-red-400 px-2 py-1 font-medium text-red-600 dark:text-red-500">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </body>

</html>
