<template>
	<div class="card flex flex-col">
		<div class="card-title"><h3>Registrieren</h3></div>
		<div class="card-body flex flex-col">
			<form @submit="handleSubmit" class="flex flex-col">
				<input
					type="email"
					name=""
					id="regmail"
					placeholder="E-Mail"
					v-model="mail"
				/>
				<input
					type="password"
					name=""
					id="regpass"
					placeholder="Passwort"
					v-model="pass"
				/>
				<input
					type="password"
					name=""
					id="regpassconf"
					placeholder="Passwort bestätigen"
					v-model="passconf"
				/>
				<button type="submit">Registrieren</button>
			</form>
		</div>
	</div>
</template>

<script setup>
import { ref, inject } from 'vue';

const url = inject('url');
const mail = ref();
const pass = ref();
const passconf = ref();

const handleSubmit = async (e) => {
	e.preventDefault();

	if (pass.value !== passconf.value) {
		alert('Passwörter stimmen nicht überein.');
		return;
	}

	await registerUser();
};

const registerUser = async () => {
	const response = await fetch(`${url}/api/users`, {
		method: 'POST',
		headers: {
			'Content-Type': 'application/json',
		},
		body: JSON.stringify({
			email: mail.value,
			password: pass.value,
		}),
	});
};
</script>
