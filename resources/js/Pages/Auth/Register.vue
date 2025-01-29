<script setup>
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import DateInput from '@/Components/DateInput.vue';
import NumberInput from '@/Components/NumberInput.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';

const { props } = usePage();
const puroks = props.puroks;
const roles = props.roles;

const form = useForm({
	first_name: '',
	middle_name: '',
	last_name: '',
	extension_name: '',
	birthday: new Date(),
	age: '',
	phone_number: '+63',
	purok_id: null,
	role_id: null,
	email: '',
	password: '',
	password_confirmation: '',
	terms: false,
});

const calculateAge = () => {
	const birthday = new Date(form.birthday);
	const today = new Date();
	let age = today.getFullYear() - birthday.getFullYear();
	const monthDifference = today.getMonth() - birthday.getMonth();
	if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < birthday.getDate())) {
		age--;
	}
	form.age = age;
};

const submit = () => {
	form.post(route('register'), {
		onFinish: () => form.reset('password', 'password_confirmation'),
	});
};
</script>

<template>
	<Head title="Register" />

	<AuthenticationCard>
		<template #logo>
			<AuthenticationCardLogo />
		</template>

		<form @submit.prevent="submit" class="grid grid-cols-2 gap-x-2">
			<div class="mt-4">
				<InputLabel for="first_name" value="First Name" />
				<TextInput id="first_name" v-model="form.first_name" type="text" class="mt-1 block w-full" required autofocus autocomplete="name" />
				<InputError class="mt-2" :message="form.errors.first_name" />
			</div>

			<div class="mt-4">
				<InputLabel for="middle_name" value="Middle Name" />
				<TextInput id="middle_name" v-model="form.middle_name" type="text" class="mt-1 block w-full" required autocomplete="name" />
				<InputError class="mt-2" :message="form.errors.middle_name" />
			</div>

			<div class="mt-4">
				<InputLabel for="last_name" value="Last Name" />
				<TextInput id="last_name" v-model="form.last_name" type="text" class="mt-1 block w-full" required autocomplete="name" />
				<InputError class="mt-2" :message="form.errors.last_name" />
			</div>

			<div class="mt-4">
				<InputLabel for="extension_name" value="Extension Name (optional)" />
				<TextInput id="extension_name" v-model="form.extension_name" type="text" class="mt-1 block w-full" autocomplete="name" />
				<InputError class="mt-2" :message="form.errors.extension_name" />
			</div>

			<div class="mt-4">
				<InputLabel for="birthday" value="Birthday" />
				<DateInput id="birthday" v-model="form.birthday" @change="calculateAge" type="date" class="mt-1 block w-full" required />
				<InputError class="mt-2" :message="form.errors.birthday" />
			</div>

			<div class="mt-4">
				<InputLabel for="age" value="Age" />
				<NumberInput id="age" v-model="form.age" type="number" class="mt-1 block w-full" required />
				<InputError class="mt-2" :message="form.errors.age" />
			</div>

			<div class="mt-4">
				<InputLabel for="phone_number" value="Phone Number" />
				<TextInput id="phone_number" v-model="form.phone_number" type="text" class="mt-1 block w-full" required autocomplete="tel" />
				<InputError class="mt-2" :message="form.errors.phone_number" />
			</div>

			<div class="mt-4">
				<InputLabel for="purok_id" value="Purok" />
				<select
					id="purok_id"
					v-model="form.purok_id"
					class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
					required
				>
					<option value="">Select a Purok</option>
					<option v-for="purok in puroks" :key="purok.id" :value="purok.id">
						{{ purok.name }}
					</option>
				</select>
				<InputError class="mt-2" :message="form.errors.purok_id" />
			</div>

			<div class="mt-4">
				<InputLabel for="email" value="Email" />
				<TextInput id="email" v-model="form.email" type="email" class="mt-1 block w-full" required autocomplete="username" />
				<InputError class="mt-2" :message="form.errors.email" />
			</div>

			<div class="mt-4">
				<InputLabel for="role_id" value="Role" />
				<select
					id="role_id"
					v-model="form.role_id"
					class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
					required
				>
					<option value="">Select a Role</option>
					<option v-for="role in roles" :key="role.id" :value="role.id">
						{{ role.name }}
					</option>
				</select>
				<InputError class="mt-2" :message="form.errors.role_id" />
			</div>

			<div class="mt-4">
				<InputLabel for="password" value="Password" />
				<TextInput id="password" v-model="form.password" type="password" class="mt-1 block w-full" required autocomplete="new-password" />
				<InputError class="mt-2" :message="form.errors.password" />
			</div>

			<div class="mt-4">
				<InputLabel for="password_confirmation" value="Confirm Password" />
				<TextInput id="password_confirmation" v-model="form.password_confirmation" type="password" class="mt-1 block w-full" required autocomplete="new-password" />
				<InputError class="mt-2" :message="form.errors.password_confirmation" />
			</div>

			<div class="flex items-center justify-end mt-4">
				<Link
					:href="route('login')"
					class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
				>
					Already registered?
				</Link>

				<PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Register</PrimaryButton>
			</div>
		</form>
	</AuthenticationCard>
</template>
