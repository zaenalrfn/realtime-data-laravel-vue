<script setup lang="ts">
import {ref} from "vue";
import { useForm } from "@inertiajs/vue3";
import { v4 as uuidv4 } from 'uuid';

type Message = {
    id: string,
    message: string,
    who: string,
}

const messages = ref<Message[]>([]);
const message = ref('');

const form = useForm({
    id: '',
    message: ''
})

window.Echo.private('messages').listen('MessageReceived', (e: any) => {
    if(!messages.value.find(msg => msg.id === e.id)) {
        messages.value.push(e);
    }
})

const handleSubmit = () => {
    const msg = {
         id: uuidv4(),
        message: message.value
    };
    messages.value.push({
        ...msg,
        who: 'You'
    });
    form.id = msg.id;
    form.message = msg.message;
    form.post(route('messages.store'), {
        onSuccess: () => {
            message.value = '';
        }
    });

}
</script>
<template>
  <ul>
    <li v-for="msg in messages" :key="msg.id">
      {{ msg.message }} - {{ msg.who }}
    </li>
  </ul>
  <form @submit.prevent="handleSubmit">
    <textarea v-model="message"></textarea>
    <button type="submit">Send Message</button>
  </form>
</template>

