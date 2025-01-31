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
import { ref, watch } from 'vue';

const { props } = usePage();
const puroks = props.puroks;
const roles = props.roles;

const form = useForm({
	role_id: null,
	purok_id: null,
	fname: '',
	mname: '',
	lname: '',
	suffix: '',
	birthdate: '',
	age: '',
	sex: '',
	contact_no: '',
	email: '',
	password: '',
	password_confirmation: '',
	terms: false,
});

const calculateAge = () => {
	if (!form.birthdate) return;
	const birthdate = new Date(form.birthdate);
	const today = new Date();
	let age = today.getFullYear() - birthdate.getFullYear();
	const monthDifference = today.getMonth() - birthdate.getMonth();
	if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < birthdate.getDate())) {
		age--;
	}
	form.age = age;
};

watch(() => form.birthdate, calculateAge);

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
				<InputLabel for="fname" value="First Name" />
				<TextInput id="fname" v-model="form.fname" type="text" class="mt-1 block w-full" required autofocus
					autocomplete="name" />
				<InputError class="mt-2" :message="form.errors.fname" />
			</div>

			<div class="mt-4">
				<InputLabel for="mname" value="Middle Name" />
				<TextInput id="mname" v-model="form.mname" type="text" class="mt-1 block w-full" required
					autocomplete="name" />
				<InputError class="mt-2" :message="form.errors.mname" />
			</div>

			<div class="mt-4">
				<InputLabel for="lname" value="Last Name" />
				<TextInput id="lname" v-model="form.lname" type="text" class="mt-1 block w-full" required
					autocomplete="name" />
				<InputError class="mt-2" :message="form.errors.lname" />
			</div>

			<div class="mt-4">
				<InputLabel for="suffix" value="Suffix (optional)" />
				<TextInput id="suffix" v-model="form.suffix" type="text" class="mt-1 block w-full"
					autocomplete="name" />
				<InputError class="mt-2" :message="form.errors.suffix" />
			</div>

			<div class="mt-4">
				<InputLabel for="birthdate" value="Birthdate" />
				<DateInput id="birthdate" v-model="form.birthdate" type="date" class="mt-1 block w-full" required />
				<InputError class="mt-2" :message="form.errors.birthdate" />
			</div>

			<div class="mt-4">
				<InputLabel for="age" value="Age" />
				<NumberInput id="age" v-model="form.age" type="number" class="mt-1 block w-full" required />
				<InputError class="mt-2" :message="form.errors.age" />
			</div>

			<div class="mt-4">
				<InputLabel for="sex" value="Sex" />
				<select id="sex" v-model="form.sex"
					class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
					required>
					<option value="male">Male</option>
					<option value="female">Female</option>

				</select>
				<InputError class="mt-2" :message="form.errors.sex" />
			</div>

			<div class="mt-4">
				<InputLabel for="contact_no" value="Phone Number" />
				<TextInput id="contact_no" v-model="form.contact_no" type="text" class="mt-1 block w-full" required
					autocomplete="tel" />
				<InputError class="mt-2" :message="form.errors.contact_no" />
			</div>


			<div class="mt-4">
				<InputLabel for="purok_id" value="Purok" />
				<select id="purok_id" v-model="form.purok_id"
					class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
					required>
					<option value="" disabled>Select a Purok</option>
					<option v-for="purok in puroks" :key="purok.id" :value="purok.id">
						{{ purok.purok_name }}
					</option>
				</select>
				<InputError class="mt-2" :message="form.errors.purok_id" />
			</div>

			<div class="mt-4">
				<InputLabel for="email" value="Email" />
				<TextInput id="email" v-model="form.email" type="email" class="mt-1 block w-full" required
					autocomplete="username" />
				<InputError class="mt-2" :message="form.errors.email" />
			</div>

			<div class="mt-4">
				<InputLabel for="role_id" value="Role" />
				<select id="role_id" v-model="form.role_id"
					class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
					required>
					<option value="" disabled>Select a Role</option>
					<!-- <option value="1">Admin</option> -->
					<option value="2">Health Worker (BHW)</option>
					<option value="3">Resident</option>
					<!-- <option v-for="role in roles" :key="role.id" :value="role.id"> -->
					<!-- {{ role.name }} -->
					<!-- </option> -->
				</select>
				<InputError class="mt-2" :message="form.errors.role_id" />
			</div>

			<div class="mt-4">
				<InputLabel for="password" value="Password" />
				<TextInput id="password" v-model="form.password" type="password" class="mt-1 block w-full" required
					autocomplete="new-password" />
				<InputError class="mt-2" :message="form.errors.password" />
			</div>

			<div class="mt-4">
				<InputLabel for="password_confirmation" value="Confirm Password" />
				<TextInput id="password_confirmation" v-model="form.password_confirmation" type="password"
					class="mt-1 block w-full" required autocomplete="new-password" />
				<InputError class="mt-2" :message="form.errors.password_confirmation" />
			</div>

			<div class="flex items-center justify-end mt-4">
				<Link :href="route('login')"
					class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
				Already registered?
				</Link>

				<PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
					Register
				</PrimaryButton>
			</div>
		</form>
	</AuthenticationCard>
</template>
