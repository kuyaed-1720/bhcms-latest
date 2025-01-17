<script setup>
import DashboardCard from '@/Components/DashboardCard.vue';
import { usePage } from '@inertiajs/vue3';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import ButtonLink from '@/Components/ButtonLink.vue';

const { props } = usePage();
const totalUsers = props.totalUsers;
const activeUsers = props.activeUsers;
const activeUsersInPercent = props.activeUsersInPercent;
</script>

<template>
	<div>
		<div class="p-6 bg-white border-b border-gray-200">
			<h1 class="mt-2 text-2xl font-medium text-gray-900">Welcome to BHCMS!</h1>

			<p class="mt-2 text-gray-500 leading-relaxed`border-b border-gray-900">BHCMS is a system that provides you a simple platform for managing your services in the barangay health center.</p>
		</div>

		<div class="bg-gray-200 bg-opacity-25 flex flex-col lg:flex-row justify-evenly py-2 border-b border-gray-200">
			<DashboardCard class="border-b border-gray-200 lg:border-r">
				<div class="flex flex-row">
					<div class="w-6/12 flex flex-col">
						<i class="bi bi-person-circle"></i>
						<p class="text-5xl">{{ totalUsers }}</p>
						<p class="text-xl mt-5">Users</p>
					</div>
					<div class="w-6/12 flex flex-col items-end">
						<i class="bi bi-three-dots"></i>
						<p>{{ activeUsers['thisWeek'] }} ({{ activeUsersInPercent['thisWeek'] }}%)</p>
						<p>Active users this week</p>
						<button
							class="mt-4 px-4 py-2 bg-gray-800 border border-gray-300 rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"
						>
							See More
						</button>
					</div>
				</div>
			</DashboardCard>

			<DashboardCard class="border-b border-gray-200 lg:border-r">
				<div class="flex flex-row">
					<div class="w-6/12 flex flex-col">
						<i class="bi bi-person-circle"></i>
						<p class="text-5xl">{{ props.totalAppointments }}</p>
						<p class="text-xl mt-5">Appointments</p>
					</div>
					<div class="w-6/12 flex flex-col items-end">
						<i class="bi bi-three-dots"></i>
						<p>{{ props.appointmentsThisWeek }}</p>
						<p>Appointments This Month</p>
						<button
							class="mt-4 px-4 py-2 bg-gray-800 border border-gray-300 rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"
						>
							See More
						</button>
					</div>
				</div>
			</DashboardCard>

			<DashboardCard class="border-b border-gray-200 lg:border-r">
				<div class="flex flex-row">
					<div class="w-6/12 flex flex-col">
						<i class="bi bi-person-circle"></i>
						<p class="text-5xl">20</p>
						<p class="text-xl mt-5">Users</p>
					</div>
					<div class="w-6/12 flex flex-col items-end">
						<i class="bi bi-three-dots"></i>
						<p>+10%</p>
						<p>New users today</p>
						<button
							class="mt-4 px-4 py-2 bg-gray-800 border border-gray-300 rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"
						>
							See More
						</button>
					</div>
				</div>
			</DashboardCard>
		</div>
	</div>
</template>
