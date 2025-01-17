<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';

// Access props passed from the Laravel controller
const { props } = usePage();
const health_workers = props.health_workers;
const user = props.user;
const patients = props.patients;
const role_id = props.user.role_id;

// Initialize the form object
const form = useForm({
	title: '',
	description: '',
	appointment_date: '',
	appointment_time: '',
	health_worker_id: '',
	patient_id: '',
});

if (role_id === 3) {
	form.patient_id = props.user.id;
} else if (role_id === 2) {
	form.health_worker_id = props.user.id;
}

// Dynamically determine availability
const canSelectHealthWorker = computed(() => role_id !== 2);
const canSelectPatient = computed(() => role_id !== 3);
</script>

<template>
	<AppLayout title="appointments/create">
		<!-- Header -->
		<template #header>
			<h2 class="text-xl font-bold text-gray-800 dark:text-gray-200 leading-tight">Dashboard</h2>
		</template>

		<!-- Page Content -->
		<div class="py-12">
			<!-- Welcome Section -->
			<div class="w-11/12 mx-auto mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-lg rounded-md">
				<h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Welcome to BHCMS Appointments Section!</h1>
				<p class="mt-2 text-gray-600 dark:text-gray-400">Schedule and manage appointments with ease.</p>
			</div>

			<!-- Appointment Form -->
			<div class="w-11/12 mx-auto mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-lg rounded-md">
				<form @submit.prevent="form.post(route('appointments.store'))" class="space-y-6">
					<!-- Title -->
					<div>
						<label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title:</label>
						<input
							id="title"
							v-model="form.title"
							type="text"
							required
							placeholder="Enter appointment title"
							class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-gray-900 dark:text-gray-300 dark:bg-gray-700"
						/>
					</div>

					<!-- Description -->
					<div>
						<label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description:</label>
						<textarea
							id="description"
							v-model="form.description"
							required
							placeholder="Enter appointment description"
							class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-gray-900 dark:text-gray-300 dark:bg-gray-700"
						></textarea>
					</div>

					<!-- Health Worker Selection -->
					<div v-if="canSelectHealthWorker">
						<label for="health_worker_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Select Health Worker:</label>
						<select
							id="health_worker_id"
							v-model="form.health_worker_id"
							required
							class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-gray-900 dark:text-gray-300 dark:bg-gray-700"
						>
							<option value="" disabled>Select a health worker</option>
							<option v-for="health_worker in health_workers" :key="health_worker.id" :value="health_worker.id">
								{{ health_worker?.user?.first_name }}
							</option>
						</select>
					</div>

					<!-- Patient Selection -->
					<div v-if="canSelectPatient">
						<label for="patient_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Select Patient:</label>
						<select
							id="patient_id"
							v-model="form.patient_id"
							required
							class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-gray-900 dark:text-gray-300 dark:bg-gray-700"
						>
							<option value="" disabled>Select a patient</option>
							<option v-for="patient in patients" :key="patient.id" :value="patient.id">{{ patient?.user?.first_name }}</option>
						</select>
					</div>

					<!-- Appointment Date -->
					<div>
						<label for="appointment_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Appointment Date:</label>
						<input
							id="appointment_date"
							v-model="form.appointment_date"
							type="date"
							required
							class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-gray-900 dark:text-gray-300 dark:bg-gray-700"
						/>
					</div>

					<!-- Appointment Time -->
					<div>
						<label for="appointment_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Appointment Time:</label>
						<input
							id="appointment_time"
							v-model="form.appointment_time"
							type="time"
							class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-gray-900 dark:text-gray-300 dark:bg-gray-700"
						/>
					</div>

					<!-- Submit Button -->
					<div>
						<button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
							Add Appointment
						</button>
					</div>
				</form>
			</div>
		</div>
	</AppLayout>
</template>
