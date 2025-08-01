<template>
<div class="flex">
    <div class="title">
        <h1>Willkommen im Gästebuch!</h1>
        <p>Schau Dir die Einträge an, schreibe selbst einen, erstelle einen Account, melde Dich an und lösche anschließend Deinen Account wieder. </p>   
        <RouterLink to="list">Zu den Gästebucheinträgen</RouterLink>
    </div>
<CreateEntriesComponent />
<DeleteComponent/>
<LoginComponent />
<RegisterComponent/>
</div>


</template>

<script setup>
import CreateEntriesComponent from '@/Components/CreateEntriesComponent.vue';
import DeleteComponent from '@/Components/DeleteComponent.vue';
import LoginComponent from '@/Components/LoginComponent.vue';
import RegisterComponent from '@/Components/RegisterComponent.vue';

import { RouterLink } from 'vue-router';

</script>