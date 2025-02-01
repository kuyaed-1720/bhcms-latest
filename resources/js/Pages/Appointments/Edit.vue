<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';

// Access props passed from the Laravel controller
const { props } = usePage();
// const health_workers = props.health_workers;
const user = props.user;
const users = props.users;
// const patients = props.patients;
const role_id = props.user.role_id;

// Initialize the form object
const form = useForm({
	user_id: '',
	purpose: '',
	appointment_date: '',
	// appointment_time: '',
	// health_worker_id: '',
	// patient_id: '',
});

if (role_id === 3) {
	form.user_id = props.user.id;
}

// Dynamically determine availability
// const canSelectHealthWorker = computed(() => role_id !== 2);
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
				<h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Welcome to BHCMS Appointments Section!
				</h1>
				<p class="mt-2 text-gray-600 dark:text-gray-400">Schedule and manage appointments with ease.</p>
			</div>

			<!-- Appointment Form -->
			<div class="w-11/12 mx-auto mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-lg rounded-md">
				<form @submit.prevent="form.post(route('appointments.store'))" class="space-y-6">

					<!-- Description -->
					<div>
						<label for="purpose"
							class="block text-sm font-medium text-gray-700 dark:text-gray-300">Purpose:</label>
						<textarea id="purpose" v-model="form.purpose" required placeholder="Enter appointment purpose"
							class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-gray-900 dark:text-gray-300 dark:bg-gray-700"></textarea>
					</div>

					<!-- Patient Selection -->
					<div v-if="canSelectPatient">
						<label for="user_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Select
							Resident:</label>
						<select id="user_id" v-model="form.user_id" required
							class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-gray-900 dark:text-gray-300 dark:bg-gray-700">
							<option value="" disabled>Select a patient</option>
							<option v-for="patient in users" :key="patient.id" :value="patient.fname">
								{{ patient.id }}
							</option>
						</select>
					</div>

					<!-- Appointment Date -->
					<div>
						<label for="appointment_date"
							class="block text-sm font-medium text-gray-700 dark:text-gray-300">Appointment Date:</label>
						<input id="appointment_date" v-model="form.appointment_date" type="date" required
							class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-gray-900 dark:text-gray-300 dark:bg-gray-700" />
					</div>

					<!-- Submit Button -->
					<div>
						<button type="submit"
							class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
							Add Appointment
						</button>
					</div>
				</form>
			</div>
		</div>
	</AppLayout>
</template>
