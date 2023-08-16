<script setup>
// import {ref} from 'vue';
import {ref} from 'vue/dist/vue.esm-browser.prod';
import {getContent} from '../utils/axios';

const userInput = ref('');
const content = ref('');

getContent();

</script>

<template>
    <div>
    <form @submit.prevent="fetchContent">
      <label for="userInput">User Input:</label>
      <textarea id="userInput" v-model="userInput"></textarea>
      <button type="submit">Get Content</button>
    </form>
    <div v-if="content">{{ content }}</div>
  </div>
  
</template>