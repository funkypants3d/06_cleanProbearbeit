<template>
	<div class="card">
		<div class="card-title"><h3>Erstellen</h3></div>
		<div class="card-body flex flex-col">
			<h4>Schreib in unser Gästebuch.</h4>
			<form @submit="handleSubmit" class="flex flex-col">
				<input
					type="text"
					name=""
					id="author"
					placeholder="Name"
					v-model="author"
				/>
				<input
					type="text"
					name=""
					id="content"
					placeholder="Nachricht"
					v-model="content"
				/>
				<button type="submit">Erstellen</button>
			</form>
		</div>
	</div>
</template>

<script setup>
import { ref, inject } from 'vue';

const author = ref();
const content = ref();
const url = inject('url');

const handleSubmit = async (e) => {
	e.preventDefault();
	await sendEntry();
};

const sendEntry = async () => {
	try {
		const response = await fetch(`${url}/api/entries`, {
			method: 'POST',
			headers: {
				'Content-Type': 'application/json',
			},
			body: JSON.stringify({
				author: author.value,
				content: content.value,
			}),
		});

		console.log(response);

		if (response.ok) {
			alert('Erfolgreich!');
		} else {
			alert('Da ist was schief gelaufen. 😢');
		}
	} catch (error) {
		console.error(error);
	}
};
</script>
