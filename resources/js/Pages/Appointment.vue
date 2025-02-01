<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { computed } from 'vue';
import { router, usePage, Link } from '@inertiajs/vue3';

const { props } = usePage();
const appointments = props.appointments;
const meta = props.meta;
const user = props.user;
const filters = props.filters;

const total_appointments = props.total;

const pageNumbers = computed(() => {
	const total = meta.last_page;
	const current = meta.current_page;

	const start = Math.max(1, current - 2);
	const end = Math.min(total, current + 2);

	const numbers = [];
	for (let i = start; i <= end; i++) {
		numbers.push(i);
	}
	return numbers;
});

const goToPage = (page) => {
	if (page >= 1 && page <= meta.last_page) {
		router.get('/appointments', {
			...filters,
			page,
		});
	}
};
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
						<h1 class="mt-2 text-2xl font-medium text-gray-900 dark:text-white">Welcome to BHCMS
							Appointments
							Section!</h1>

						<p class="mt-2 text-gray-600 dark:text-gray-400 leading-relaxed`border-b border-gray-900">
							BHCMS Appointments is a system feature that provides easier way to schedule appointments in
							the
							field.
						</p>
					</div>
				</div>
			</div>
		</div>
		<div class="w-auto mx-8 flex items-center justify-between pl-4 py-2">
			<Link :href="route('appointments.create')"
				class="text-center flex items-center justify-center text-gray-500 w-48 h-8 dark:text-gray-300 dark:bg-orange-600 hover:underline">
			Create Appointment
			</Link>
			<div class="w-6/12 flex flex-row justify-between">
				<Link :href="route('appointments', { ...filters, status: '' })"
					:class="{ 'dark:bg-gray-300 dark:text-gray-900 text-white': !filters.status }"
					class="text-center rounded-xl flex items-center justify-center text-gray-500 w-24 h-8 dark:text-gray-300 dark:bg-gray-900 hover:underline">
				All
				</Link>
				<Link :href="route('appointments', { ...filters, status: 'pending' })"
					:class="{ 'dark:bg-gray-300 dark:text-gray-900 text-white': filters.status === 'pending' }"
					class="text-center rounded-xl flex items-center justify-center text-gray-500 w-24 h-8 dark:text-gray-300 dark:bg-gray-900 hover:underline">
				Pending
				</Link>
				<Link :href="route('appointments', { ...filters, status: 'cancelled' })"
					:class="{ 'dark:bg-gray-300 dark:text-gray-900 text-white': filters.status === 'cancelled' }"
					class="text-center rounded-xl flex items-center justify-center text-gray-500 w-24 h-8 dark:text-gray-300 dark:bg-gray-900 hover:underline">
				Cancelled
				</Link>
				<Link :href="route('appointments', { ...filters, status: 'completed' })"
					:class="{ 'dark:bg-gray-300 dark:text-gray-900 text-white': filters.status === 'completed' }"
					class="text-center rounded-xl flex items-center justify-center text-gray-500 w-24 h-8 dark:text-gray-300 dark:bg-gray-900 hover:underline">
				Completed
				</Link>
			</div>
		</div>
		<div class="relative flex flex-col w-auto overflow-hidden mx-8 mt-2 bg-white dark:bg-gray-200 shadow-xl">
			<div v-if="total_appointments == 0">No appointments yet.</div>
			<table v-else class="w-full text-left table-auto">
				<thead
					class="bg-gray-900 dark:bg-white border-b border-gray-900 dark:border-gray-300 text-gray-200 dark:text-gray-900">
					<tr>
						<th class="p-4 w-36 text-sm font-normal leading-none" v-if="user.role_id !== 3">RESIDENT</th>
						<!-- <th class="p-4 w-36 text-sm font-normal leading-none" v-if="user.role_id !== 2">BHW</th> -->
						<th class="p-4 w-48 text-sm font-normal leading-none">PURPOSE</th>
						<th class="p-4 w-36 text-sm font-normal leading-none">DATE</th>
						<th class="p-4 w-24 text-sm font-normal leading-none" v-if="!filters.status">STATUS</th>
						<th class="p-4 w-24 text-sm font-normal leading-none"
							v-if="!filters.status || filters.status === 'pending'">ACTION</th>
					</tr>
				</thead>
				<tbody>
					<tr class="hover:bg-gray-300" v-for="appointment in appointments" :key="appointment.id">
						<td class="p-4 text-sm text-gray-900 dark:text-gray-700" v-if="user.role_id !== 3">{{ appointment.patient_name }}</td>
						<!-- <td class="p-4 text-sm text-gray-900 dark:text-gray-700" v-if="user.role_id !== 2">{{ appointment.health_worker_name }}</td> -->
						<!-- <td class="p-4 text-sm text-gray-900 dark:text-gray-700">{{ appointment.title }}</td> -->
						<td class="p-4 text-sm text-gray-900 dark:text-gray-700 max-w-[30%]">
							<div class="h-16 overflow-auto text-ellipsis">
								{{ appointment.purpose }}
							</div>
						</td>
						<td class="p-4 text-sm text-gray-900 dark:text-gray-700">{{ appointment.appointment_date }}</td>
						<td class="p-4 text-sm text-gray-900 dark:text-gray-700" v-if="!filters.status">{{
							appointment.status }}
						</td>
						<td class="p-4 flex flex-row justify-between"
							v-if="!filters.status || filters.status === 'pending'">
							<p class="text-sm text-red-600">
								<a href="/appointments/cancel">
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentcolor"
										class="size-8">
										<path fill-rule="evenodd"
											d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-1.72 6.97a.75.75 0 1 0-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 1 0 1.06 1.06L12 13.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L13.06 12l1.72-1.72a.75.75 0 1 0-1.06-1.06L12 10.94l-1.72-1.72Z"
											clip-rule="evenodd" />
									</svg>
								</a>
							</p>
							<p v-if="user.role_id === 2" class="text-sm text-green-500">
								<a href="/appointments/complete">
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentcolor"
										class="size-8">
										<path fill-rule="evenodd"
											d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z"
											clip-rule="evenodd" />
									</svg>
								</a>
							</p>
						</td>
					</tr>
				</tbody>
			</table>
		</div>

		<!-- Pagination Links -->
		<div class="w-auto h-12 flex flex-col justify-between mx-8 mt-2">
			<div class="flex justify-between items-center space-x-2 mt-4">
				<button @click="goToPage(meta.current_page - 1)" :disabled="meta.current_page <= 1"
					class="px-4 py-2 bg-gray-300 hover:bg-gray-500 text-gray-700 dark:bg-gray-700 dark:text-gray-300 hover:dark:bg-gray-500 hover:text-white rounded disabled:opacity-50 disabled:cursor-not-allowed">
					Previous
				</button>

				<div class="flex justify-center space-x-2">
					<button v-for="page in pageNumbers" :key="page" @click="goToPage(page)" :class="[
						'px-4 py-2 rounded transition',
						page === meta.current_page
							? 'bg-gray-500 text-white dark:bg-gray-300 dark:text-gray-900'
							: 'bg-gray-200 hover:bg-gray-300 text-gray-700 dark:bg-gray-700 dark:text-gray-300 hover:dark:bg-gray-500',
					]">
						{{ page }}
					</button>
				</div>

				<button @click="goToPage(meta.current_page + 1)" :disabled="meta.current_page >= meta.last_page"
					class="px-4 py-2 bg-gray-300 hover:bg-gray-500 text-gray-700 hover:text-white dark:bg-gray-700 dark:text-gray-300 hover:dark:bg-gray-500 rounded disabled:opacity-50 disabled:cursor-not-allowed">
					Next
				</button>
			</div>
		</div>
	</AppLayout>
</template>
