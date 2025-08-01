<template>
	<RouterView />
</template>

<script setup>
import { provide } from 'vue';
import { RouterView } from 'vue-router';

const url = 'http://localhost:8081';

provide('url', url);
</script>
