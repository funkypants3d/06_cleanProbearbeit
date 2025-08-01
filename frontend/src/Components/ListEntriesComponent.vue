<template>
	<h2>Gästebucheinträge</h2>
	<h4>Schreib gerne ebenfalls einen!</h4>
	<div class="card" v-for="entry in entries">
		<div class="card-title">
			<h3>{{ entry.author }}</h3>
		</div>
		<div class="card-body">
			<p>{{ entry.message }}</p>
		</div>
	</div>
</template>

<script setup>
import { ref, onMounted, inject } from 'vue';
const url = inject('url');
const entries = ref([]);

const getEntries = async () => {
	try {
		const response = await fetch(`${url}/api/entries`);
		if (response.ok) {
			const data = await response.json();
			entries.value = data;
		}
	} catch (error) {
		console.error(error);
	}
};

onMounted(() => {
	getEntries();
});
</script>
