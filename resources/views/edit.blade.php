<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Edit Task</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles / Scripts -->

        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>

    <body class="px-10 font-sans antialiased dark:bg-black dark:text-white/50">

        <form method="POST" class="w-1/2" action="/{{ $task->id }}/edit">
            @csrf
            @method('PATCH')

            <!-- Email Address -->
            <div>
                <x-input-label for="task" :value="__('Task Name')" />
                <x-text-input id="task" class="mt-1 block w-1/2" type="text" name="task" :value="old('task') ?? $task->task"
                    autofocus />
                <x-input-error :messages="$errors->get('task')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4 w-full">
                <x-input-label for="status" :value="__('Status')" />

                <select name="status" id="status" class="mt-1 w-full rounded-sm bg-black p-2 text-white/50">
                    <option {{ old('status', $task->status) == 'Pending' ? 'selected' : '' }} value="Pending">Pending
                    </option>
                    <option {{ old('status', $task->status) == 'Done' ? 'selected' : '' }} value="Done">Done
                    </option>
                </select>

                <x-input-error :messages="$errors->get('status')" class="mt-2" />
            </div>

            <div class="mt-3 flex items-center gap-2">
                <div>
                    <a href="/"
                        class='rounded-md border border-white/70 bg-black px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white/80 transition duration-150 ease-in-out hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900 dark:text-white/80 dark:focus:bg-white dark:focus:ring-offset-gray-800 dark:active:bg-gray-300'>
                        {{ __('Cancel') }}
                    </a>
                </div>
                <x-primary-button>
                    {{ __('Update') }}
                </x-primary-button>
            </div>
            </div>
        </form>
    </body>

</html>
