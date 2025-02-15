<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-semibold mb-6">Teacher Dashboard Overview</h2>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div
                class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 transition duration-300 hover:shadow-lg">
                <h3 class="text-lg font-semibold mb-2 text-primary dark:text-primary-dark">Total Users</h3>
                <p class="text-3xl font-bold">10,483</p>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">+12% from last month</p>
            </div>
            <div
                class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 transition duration-300 hover:shadow-lg">
                <h3 class="text-lg font-semibold mb-2 text-primary dark:text-primary-dark">Revenue</h3>
                <p class="text-3xl font-bold">$84,382</p>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">+8% from last month</p>
            </div>
            <div
                class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 transition duration-300 hover:shadow-lg">
                <h3 class="text-lg font-semibold mb-2 text-primary dark:text-primary-dark">Active Projects</h3>
                <p class="text-3xl font-bold">32</p>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">+3 new this week</p>
            </div>
            <div
                class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 transition duration-300 hover:shadow-lg">
                <h3 class="text-lg font-semibold mb-2 text-primary dark:text-primary-dark">Tasks Completed</h3>
                <p class="text-3xl font-bold">1,248</p>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">+18% from last week</p>
            </div>
        </div>

        <!-- Charts Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold mb-4 text-primary dark:text-primary-dark">Revenue Overview</h3>
                <div class="chart-placeholder h-64 rounded-md"></div>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold mb-4 text-primary dark:text-primary-dark">User Growth</h3>
                <div class="chart-placeholder h-64 rounded-md"></div>
            </div>
        </div>

        <!-- Recent Activities -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
            <h3 class="text-lg font-semibold p-6 border-b border-gray-200 dark:border-gray-700 text-primary dark:text-primary-dark">
                Recent Activities</h3>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                    <tr class="bg-gray-50 dark:bg-gray-700 text-left">
                        <th class="p-4 font-semibold text-gray-700 dark:text-gray-300">User</th>
                        <th class="p-4 font-semibold text-gray-700 dark:text-gray-300">Action</th>
                        <th class="p-4 font-semibold text-gray-700 dark:text-gray-300">Date</th>
                        <th class="p-4 font-semibold text-gray-700 dark:text-gray-300">Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="border-b border-gray-200 dark:border-gray-700">
                        <td class="p-4">John Doe</td>
                        <td class="p-4">Created a new project</td>
                        <td class="p-4">2023-06-15</td>
                        <td class="p-4"><span
                                class="px-2 py-1 bg-green-200 text-green-800 rounded-full text-sm">Completed</span>
                        </td>
                    </tr>
                    <tr class="border-b border-gray-200 dark:border-gray-700">
                        <td class="p-4">Jane Smith</td>
                        <td class="p-4">Updated profile information</td>
                        <td class="p-4">2023-06-14</td>
                        <td class="p-4"><span class="px-2 py-1 bg-blue-200 text-blue-800 rounded-full text-sm">In Progress</span>
                        </td>
                    </tr>
                    <tr class="border-b border-gray-200 dark:border-gray-700">
                        <td class="p-4">Mike Johnson</td>
                        <td class="p-4">Submitted a new task</td>
                        <td class="p-4">2023-06-13</td>
                        <td class="p-4"><span
                                class="px-2 py-1 bg-yellow-200 text-yellow-800 rounded-full text-sm">Pending</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-4">Sarah Williams</td>
                        <td class="p-4">Completed project milestone</td>
                        <td class="p-4">2023-06-12</td>
                        <td class="p-4"><span
                                class="px-2 py-1 bg-green-200 text-green-800 rounded-full text-sm">Completed</span>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
