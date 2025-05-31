<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Recent Activities</h3>
                <ul class="mt-4 space-y-2">
                    <li class="flex items-center">
                        <span class="text-gray-600">User John Doe logged in.</span>
                        <span class="ml-auto text-sm text-gray-500">2 minutes ago</span>
                    </li>
                    <li class="flex items-center">
                        <span class="text-gray-600">User Jane Smith updated profile.</span>
                        <span class="ml-auto text-sm text-gray-500">10 minutes ago</span>
                    </li>
                    <li class="flex items-center">
                        <span class="text-gray-600">User Alice Johnson created a new post.</span>
                        <span class="ml-auto text-sm text-gray-500">30 minutes ago</span>
                    </li>
                    <li class="flex items-center">
                        <span class="text-gray-600">User Bob Brown deleted a comment.</span>
                        <span class="ml-auto text-sm text-gray-500">1 hour ago</span>
                    </li>
                    <li class="flex items-center">
                        <span class="text-gray-600">User Charlie Green logged out.</span>
                        <span class="ml-auto text-sm text-gray-500">2 hours ago</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</x-admin-layout>
