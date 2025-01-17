<!-- <template>
	<body class="bg-gray-100 p-10">
		<div class="overflow-x-auto bg-white shadow-md rounded-lg">
			<table class="min-w-full table-auto">
				<thead class="bg-gray-900 text-white">
					<tr>
						<th class="p-4 w-32 text-left">ID</th>
						<th class="p-4 w-40 text-left">Name</th>
						<th class="p-4 text-left">Description</th>
						<th class="p-4 w-32 text-left">Status</th>
					</tr>
				</thead>
				<tbody class="text-gray-700">
					<tr class="border-b">
						<td class="p-4">1</td>
						<td class="p-4">John Doe</td>
						<td class="p-4 flex-1">This is a sample description that takes up the remaining space in the row dynamically.</td>
						<td class="p-4">Active</td>
					</tr>
					<tr class="border-b">
						<td class="p-4">2</td>
						<td class="p-4">Jane Smith</td>
						<td class="p-4 flex-1">Another example description, showcasing how this column expands.</td>
						<td class="p-4">Inactive</td>
					</tr>
					<tr>
						<td class="p-4">3</td>
						<td class="p-4">Mark Johnson</td>
						<td class="p-4 flex-1">Yet another description to demonstrate the expanding behavior of this column.</td>
						<td class="p-4">Pending</td>
					</tr>
				</tbody>
			</table>
		</div>
	</body>
</template> -->
<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
</script>
<template>
	<AppLayout title="Appointment">
		<template #header>
			<h2 class="text-sm lg:text-xl text-gray-800 dark:text-gray-200 leading-tight">Dashboard</h2>
		</template>
		<div class="py-6">
			<div class="w-auto mx-8 mt-4 px-6 py-4 bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
				<div class="overflow-hidden sm:rounded-lg">
					<div class="p-6">
						<h1 class="mt-2 text-2xl font-medium text-gray-900 dark:text-white">Welcome to BHCMS Appointments Section!</h1>

						<p class="mt-2 text-gray-600 dark:text-gray-400 leading-relaxed`border-b border-gray-900">
							BHCMS Appointments is a system features that provides easier way to schedule appointments in the field.
						</p>
					</div>
				</div>
			</div>
		</div>
		<div class="w-auto mx-8 flex items-center justify-between pl-4 py-2">
			<h2 class="w-auto dark:text-white px-auto font-bold">Appointments</h2>
		</div>
		<div class="relative flex flex-col w-auto overflow-scroll mx-8 mt-2 bg-white dark:bg-gray-200 shadow-xl">
			<table class="w-full text-left table-auto min-w-max">
				<thead class="bg-gray-900 dark:bg-white border-b border-gray-900 dark:border-gray-300 text-gray-200 dark:text-gray-900">
					<tr>
						<!-- <th class="p-4 w-36 text-sm font-normal leading-none">PATIENT</th> -->
						<th class="p-4 w-36 text-sm font-normal leading-none">BHW</th>
						<th class="p-4 w-2/12 text-sm font-normal leading-none">TITLE</th>
						<th class="p-4 text-sm font-normal leading-none">DESCRIPTION</th>
						<th class="p-4 w-36 text-sm font-normal leading-none">DATETIME</th>
						<th class="p-4 w-24 text-sm font-normal leading-none">STATUS</th>
						<th class="p-4 w-24 text-sm font-normal leading-none">ACTION</th>
					</tr>
				</thead>
				<tbody>
					<tr class="hover:bg-gray-300">
						<!-- <td class="p-4 text-sm text-gray-900 dark:text-gray-700">John Doe</td> -->
						<td class="p-4 text-sm text-gray-900 dark:text-gray-700">Jane Smith</td>
						<td class="p-4 text-sm text-gray-900 dark:text-gray-700">Graduation 2025</td>
						<td class="p-4 flex-1 text-sm text-gray-900 dark:text-gray-700">Lorem ipsum dolor sit ametwfheuhufedfedv fsbvd</td>
						<td class="p-4 text-sm text-gray-900 dark:text-gray-700">2025-05-20 12:00:00</td>
						<td class="p-4 text-sm text-gray-900 dark:text-gray-700"></td>
						<td class="p-4 w-1 flex flex-row justify-between">
							<p class="text-sm text-red-600">
								<a href="/appointments/cancel">
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentcolor" class="size-8">
										<path
											fill-rule="evenodd"
											d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-1.72 6.97a.75.75 0 1 0-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 1 0 1.06 1.06L12 13.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L13.06 12l1.72-1.72a.75.75 0 1 0-1.06-1.06L12 10.94l-1.72-1.72Z"
											clip-rule="evenodd"
										/>
									</svg>
								</a>
							</p>
							<p class="text-sm text-green-500">
								<a href="/appointments/complete">
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentcolor" class="size-8">
										<path
											fill-rule="evenodd"
											d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z"
											clip-rule="evenodd"
										/>
									</svg>
								</a>
							</p>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</AppLayout>
</template>
