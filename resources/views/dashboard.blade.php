<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Home Page') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <header>
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Create Invoice') }}
                    </h2>
                </header>
                <form method="post" action="{{ route('upload-image') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                    <div>
                        <input class="form-control" type="file" name="image" id="image">
                    </div>
                </form>
                <div id="image-container" class="text-center mt-6">
                    <img id="uploaded-image" src="" alt="Uploaded Image" class="hidden max-w-full h-auto">
                    <button id="accept-button" class="hidden">✅</button>
                    <button id="reject-button" class="hidden">❌</button>
                </div>
            </div>
    
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-4 sm:p-8">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">ID</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Image</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($data as $image)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">{{ $image->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <img src="{{ asset("images/$image->name") }}" width="50px" class="rounded shadow">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('delete-image',['image'=>$image->id]) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    @section('js')
    
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const inputElement = document.querySelector('input[id="image"]');
            const pond = FilePond.create(inputElement);
            const imgElement = document.getElementById('uploaded-image');
            const acceptButton = document.getElementById('accept-button');
            const rejectButton = document.getElementById('reject-button');

            FilePond.setOptions({
                server: {
                    url: '/upload',
                    process: {
                        onload: (response) => {
                            const data = JSON.parse(response);
                            if (data.path) {
                                const fileName = data.path.split('/').pop(); 
                                imgElement.src = '/' + data.path; 
                                imgElement.style.display = 'block';
                                acceptButton.style.display = 'inline-block'; 
                                rejectButton.style.display = 'inline-block'; 

                                // Handle accept
                                acceptButton.onclick = () => {
                                    fetch('/accept-image', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                        },
                                        body: JSON.stringify({ fileName })
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.success) {
                                            location.reload();
                                        } else {
                                            console.error('Failed to accept image');
                                        }
                                    })
                                    .catch(error => console.error('Error:', error));
                                };

                                // Handle reject 
                                rejectButton.onclick = () => {
                                    fetch('/reject-image', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                        },
                                        body: JSON.stringify({ fileName })
                                    })
                                    .then(response => {
                                        if (response.ok) {
                                            console.log('Image rejected');
                                            imgElement.style.display = 'none'; 
                                            acceptButton.style.display = 'none'; 
                                            rejectButton.style.display = 'none'; 
                                        } else {
                                            console.error('Failed to reject image');
                                        }
                                    })
                                    .catch(error => console.error('Error:', error));
                                };
                            } else {
                                console.error('File upload failed');
                            }
                        },
                        onerror: (response) => {
                            console.error('File upload error:', response);
                        }
                    },
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }
            });
        });
    </script>
    @endsection
</x-app-layout>
