<script setup>
import { Link } from '@inertiajs/inertia-vue3';
</script>

<template>
    <Link :href="'/'">
      <img class="logo" src="/assets/img/logo_mdv.svg">
    </Link>
</template>

<style>
.logo{
  width: 300px;
}
</style>
