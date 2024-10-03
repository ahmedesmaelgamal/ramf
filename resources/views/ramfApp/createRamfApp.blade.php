<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ramf App Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl leading-tight">
                {{ __('Ramf App Management') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-300">
                        <ul class="flex border-b border-gray-700">
                            <li class="mr-1">
                                <a class="bg-gray-700 inline-block py-2 px-4 text-gray-300 hover:text-white font-semibold" href="#tab1">Create Ramf App</a>
                            </li>
                            <li class="mr-1">
                                <a class="bg-gray-700 inline-block py-2 px-4 text-gray-300 hover:text-white font-semibold" href="#tab2">Create Version</a>
                            </li>
                            <li class="mr-1">
                                <a class="bg-gray-700 inline-block py-2 px-4 text-gray-300 hover:text-white font-semibold" href="#tab3">Show Ramf App</a>
                            </li>
                        </ul>
                        <div class="mt-4">
                            <div id="tab1">
                                <form action="{{ route('ramfapp.storeWeb') }}" method="POST" class="space-y-4">
                                    @csrf
                                    <div>
                                        <label for="ret_code" class="block text-sm font-medium text-gray-300">ret_code</label>
                                        <input type="text" class="mt-1 block w-full rounded-md bg-gray-700 border-gray-600 text-white-700 focus:border-indigo-500 focus:ring-indigo-500" id="ret_code" name="ret_code" required>
                                    </div>
                                    <div>
                                        <label for="ramf_app_name" class="block text-sm font-medium text-gray-300">ramf app name</label>
                                        <input type="text" class="mt-1 block w-full rounded-md bg-gray-700 border-gray-600 text-white-700 focus:border-indigo-500 focus:ring-indigo-500" id="ramf_app_name" name="ramf_app_name" required>
                                    </div>
                                    <div>
                                        <label for="ramf_app_version_id" class="block text-sm font-medium text-gray-300">Choose a version:</label>
                                        <select class="mt-1 block w-full rounded-md bg-gray-700 border-gray-600 text-white-700 focus:border-indigo-500 focus:ring-indigo-500" id="ramf_app_version_id" name="ramf_app_version_id" required>
                                            <option selected disabled>Choose the version</option>
                                            @foreach($ramfAppVersions as $version)
                                                <option value="{{ $version->id }}">{{ $version->app }} - {{ $version->web_api }}</option>
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

                                    <br>
                                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 border">Submit</button>
                                </form>
                            </div>
                            <div id="tab2" class="hidden">
                                <form action="{{ route('ramfapp.version.storeWeb') }}" method="POST" class="space-y-4">
                                    @csrf
                                    <div>
                                        <label for="app" class="block text-sm font-medium text-gray-300">App</label>
                                        <input type="text" class="mt-1 block w-full rounded-md bg-gray-700 border-gray-600 text-white-700 focus:border-indigo-500 focus:ring-indigo-500" id="app" name="app" required>
                                    </div>
                                    <div>
                                        <label for="web_api" class="block text-sm font-medium text-gray-300">Web API</label>
                                        <input type="text" class="mt-1 block w-full rounded-md bg-gray-700 border-gray-600 text-white-700 focus:border-indigo-500 focus:ring-indigo-500" id="web_api" name="web_api" required>
                                    </div>
                                    <div>
                                        <label for="built" class="block text-sm font-medium text-gray-300">Built</label>
                                        <input type="text" class="mt-1 block w-full rounded-md bg-gray-700 border-gray-600 text-white-700 focus:border-indigo-500 focus:ring-indigo-500" id="built" name="built" required>
                                    </div>
                                    <div>
                                        <label for="app_full_name" class="block text-sm font-medium text-gray-300">App Full Name</label>
                                        <textarea class="mt-1 block w-full rounded-md bg-gray-700 border-gray-600 text-white-700 focus:border-indigo-500 focus:ring-indigo-500" id="app_full_name" name="app_full_name" rows="3"></textarea>
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
                                <form action="{{ route('api.ramfapp.index') }}" method="get" class="space-y-4">
                                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 border">view ramf app list</button>
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
