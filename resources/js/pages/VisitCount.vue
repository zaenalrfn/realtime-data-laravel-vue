<script setup lang="ts">
import {ref} from "vue";
const count = ref(0);

window.Echo.channel('hello-world').listen('HelloWorld', (e) => {
  count.value++
})
</script>
<template>
    <div>visit count :  {{ count }}</div>
</template>
