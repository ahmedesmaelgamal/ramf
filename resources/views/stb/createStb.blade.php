<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STB Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl leading-tight">
                {{ __('STB Management') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-300">
                        <ul class="flex border-b border-gray-700">
                            <li class="mr-1">
                                <a class="bg-gray-700 inline-block py-2 px-4 text-gray-300 hover:text-white font-semibold" href="#tab1">Create STB</a>
                            </li>
                            <li class="mr-1">
                                <a class="bg-gray-700 inline-block py-2 px-4 text-gray-300 hover:text-white font-semibold" href="#tab2">Create Version</a>
                            </li>
                            <li class="mr-1">
                                <a class="bg-gray-700 inline-block py-2 px-4 text-gray-300 hover:text-white font-semibold" href="#tab3">Show STB</a>
                            </li>
                        </ul>
                        <div class="mt-4">
                            <div id="tab1">
                                <form action="{{ route('stb.storeWeb') }}" method="POST" class="space-y-4">
                                    @csrf
                                    <div>
                                        <label for="ret_code" class="block text-sm font-medium text-gray-300">ret_code</label>
                                        <input type="text" class="mt-1 block w-full rounded-md bg-gray-700 border-gray-600 text-white-700 focus:border-indigo-500 focus:ring-indigo-500" id="ret_code" name="ret_code" required>
                                    </div>
                                    <div>
                                        <label for="stb_name" class="block text-sm font-medium text-gray-300">stb_name</label>
                                        <input type="text" class="mt-1 block w-full rounded-md bg-gray-700 border-gray-600 text-white-700 focus:border-indigo-500 focus:ring-indigo-500" id="stb_name" name="stb_name" required>
                                    </div>
                                    <div>
                                        <label for="stb_version_id" class="block text-sm font-medium text-gray-300">Choose a version:</label>
                                        <select class="mt-1 block w-full rounded-md bg-gray-700 border-gray-600 text-white-700 focus:border-indigo-500 focus:ring-indigo-500" id="stb_version_id" name="stb_version_id" required>
                                            <option selected disabled>Choose the version</option>
                                            @foreach($stbVersions as $version)
                                                <option value="{{ $version->id }}">{{ $version->stb }} - {{ $version->web_api }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label for="serial" class="block text-sm font-medium text-gray-300">serial</label>
                                        <input type="text" class="mt-1 block w-full rounded-md bg-gray-700 border-gray-600 text-white-700 focus:border-indigo-500 focus:ring-indigo-500" id="serial" name="serial" required>
                                    </div>
                                    <div>
                                        <label for="download_link" class="block text-sm font-medium text-gray-300">Download link</label>
                                        <input type="text" class="mt-1 block w-full rounded-md bg-gray-700 border-gray-600 text-white-700 focus:border-indigo-500 focus:ring-indigo-500" id="download_link" name="download_link" required>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="checkbox" class="rounded bg-gray-700 border-gray-600 text-indigo-600 focus:ring-indigo-500 h-4 w-4" id="card_inserted" name="card_inserted" value="1">
                                        <label for="card_inserted" class="ml-2 block text-sm text-gray-300">card_inserted</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="checkbox" class="rounded bg-gray-700 border-gray-600 text-indigo-600 focus:ring-indigo-500 h-4 w-4" id="channels_exist" name="channels_exist" value="1">
                                        <label for="channels_exist" class="ml-2 block text-sm text-gray-300">channels_exist</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="checkbox" class="rounded bg-gray-700 border-gray-600 text-indigo-600 focus:ring-indigo-500 h-4 w-4" id="streaming_channel" name="streaming_channel" value="1">
                                        <label for="streaming_channel" class="ml-2 block text-sm text-gray-300">streaming_channel</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="checkbox" class="rounded bg-gray-700 border-gray-600 text-indigo-600 focus:ring-indigo-500 h-4 w-4" id="events" name="events" value="1">
                                        <label for="events" class="ml-2 block text-sm text-gray-300">events</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="checkbox" class="rounded bg-gray-700 border-gray-600 text-indigo-600 focus:ring-indigo-500 h-4 w-4" id="sleep" name="sleep" value="1">
                                        <label for="sleep" class="ml-2 block text-sm text-gray-300">sleep</label>
                                    </div>
                                    <br>
                                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 border">Submit</button>
                                </form>
                            </div>
                            <div id="tab2" class="hidden">
                                <form action="{{ route('stb.version.storeWeb') }}" method="POST" class="space-y-4">
                                    @csrf
                                    <div>
                                        <label for="stb" class="block text-sm font-medium text-gray-300">STB</label>
                                        <input type="text" class="mt-1 block w-full rounded-md bg-gray-700 border-gray-600 text-white-700 focus:border-indigo-500 focus:ring-indigo-500" id="stb" name="stb" required>
                                    </div>
                                    <div>
                                        <label for="version" class="block text-sm font-medium text-gray-300">version</label>
                                        <input type="text" class="mt-1 block w-full rounded-md bg-gray-700 border-gray-600 text-white-700 focus:border-indigo-500 focus:ring-indigo-500" id="version" name="version" required>
                                    </div>
                                    <div>
                                        <label for="date" class="block text-sm font-medium text-gray-300">date</label>
                                        <input type="date" class="mt-1 block w-full rounded-md bg-gray-700 border-gray-600 text-white-700 focus:border-indigo-500 focus:ring-indigo-500" id="date" name="date" required>
                                    </div>
                                    <div>
                                        <label for="web_api" class="block text-sm font-medium text-gray-300">Web API</label>
                                        <input type="text" class="mt-1 block w-full rounded-md bg-gray-700 border-gray-600 text-white-700 focus:border-indigo-500 focus:ring-indigo-500" id="web_api" name="web_api" required>
                                    </div>
                                    <div>
                                        <label for="base_struct" class="block text-sm font-medium text-gray-300">Base Struct</label>
                                        <input type="text" class="mt-1 block w-full rounded-md bg-gray-700 border-gray-600 text-white-700 focus:border-indigo-500 focus:ring-indigo-500" id="base_struct" name="base_struct" required>
                                    </div>
                                    <div>
                                        <label for="comment" class="block text-sm font-medium text-gray-300">Comment</label>
                                        <textarea class="mt-1 block w-full rounded-md bg-gray-700 border-gray-600 text-white-700 focus:border-indigo-500 focus:ring-indigo-500" id="comment" name="comment" rows="3"></textarea>
                                    </div>
                                    <br>
                                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 border">Create Version</button>
                                </form>
                            </div>
                            <div id="tab3" class="hidden">
                                    <form action="{{ route('api.stb.index') }}" method="get" class="space-y-4">
                                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 border">view STB list</button>
                                    </form>
                                <!-- Add your STB listing table here -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const tabs = document.querySelectorAll('ul li a');
            tabs.forEach(tab => {
                tab.addEventListener('click', (e) => {
                    e.preventDefault();
                    const targetId = e.target.getAttribute('href').substring(1);
                    document.querySelectorAll('div[id^="tab"]').forEach(content => {
                        content.classList.add('hidden');
                    });
                    document.getElementById(targetId).classList.remove('hidden');
                    tabs.forEach(t => t.classList.remove('bg-gray-700'));
                    e.target.classList.add('bg-gray-700');
                });
            });
        });
    </script>
</body>
</html>
