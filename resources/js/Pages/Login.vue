<template>

<div class="w-screen h-screen flex justify-center items-center bg-gray-100">
		<form @submit.prevent="login" class="p-10 bg-white rounded flex justify-center items-center flex-col shadow-md">
       
      <p class="mb-5 text-3xl uppercase text-gray-600">Login</p>
      <div v-if="errorMsg" class="text-sm px-3 py-1 bg-red-200 text-red-800 rounded-full mb-3">{{errorMsg}}</div>
 
			<input type="email" name="email" class="mb-5 px-3 py-2 w-80 focus:border-indigo-700 rounded border-2 outline-none" autocomplete="off" v-model="credentials.email" placeholder="Email" required>
			<input type="password" name="password" class="mb-5 px-3 py-2 w-80 focus:border-indigo-700 rounded border-2 outline-none" autocomplete="off" v-model="credentials.password" placeholder="Password" required>
			<button type="submit" v-if="!isLoading" @click="login" class="bg-indigo-500 hover:bg-indigo-400 text-white font-bold py-2 px-6 border-b-4 border-indigo-700 hover:border-indigo-500  transition ease-in-out rounded w-full" id="login">Login </button>
		<button v-else type="button" class="inline-flex items-center bg-indigo-400 text-white font-bold py-2 px-6 border-b-4 border-indigo-500 rounded transition ease-in-out duration-150">
  <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
  </svg>
  Logging In..
</button>


		</form> 
    </div>

</template>

<script>
import {mapGetters} from 'vuex';

export default {
  name: "Login" ,
  data(){
    return {
      credentials: {
        email:'',
        password:''
      }
    }
  }, 
  computed:{
 ...mapGetters({
    isLoading : 'user/isLoading', 
    errorMsg : 'user/errorMsg', 
 })
  },
  methods:{
    login(){
      if(this.credentials.email.trim().length && this.credentials.password.trim().length){
        this.$store.dispatch("user/loginUser", this.credentials);
      }
      else {
        this.$noty.warning("Give credentials to access.");
      }
      
    }
  }
};
</script>
