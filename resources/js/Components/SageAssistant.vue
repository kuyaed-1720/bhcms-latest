<template>
	<div class="fixed bottom-8 right-8 bg-gray-800 text-white px-4 py-3 rounded-full shadow-lg flex items-center space-x-3" @click="sageReact" title="Click me for wisdom!">
		<div>
			<img src="/images/sage-avatar.png" alt="S.A.G.E." class="w-12 h-12 rounded-full" />
		</div>
		<div>
			<p class="text-sm font-bold">S.A.G.E. 🤖</p>
			<p class="text-xs italic">{{ sageMessage }}</p>
		</div>
	</div>
</template>

<script setup>
import { ref } from 'vue';

const sageMessage = ref('How can I assist you today?');

const sageReact = () => {
	const responses = [
		"Keep going! You're doing great. 🚀",
		'Oh no, canceling again? 😢',
		'Success is near—completing appointments feels awesome! 💪',
		'S.A.G.E. sees everything... and approves. 👀',
		"Need wisdom? I'm here for you. 🧠",
	];
	sageMessage.value = responses[Math.floor(Math.random() * responses.length)];
};
</script>

<style>
@keyframes bounce {
	0%,
	100% {
		transform: translateY(0);
	}
	50% {
		transform: translateY(-10px);
	}
}

.fixed:hover {
	animation: bounce 1s infinite;
}
</style>
