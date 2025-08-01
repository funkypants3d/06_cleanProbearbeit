<template>
<RouterLink to="/">Zurück zur Startseite</RouterLink>
<ListEntriesComponent />
</template>

<script setup>
import ListEntriesComponent from '@/Components/ListEntriesComponent.vue';
import { RouterLink } from 'vue-router';

</script>