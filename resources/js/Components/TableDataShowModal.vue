<template>
 <div class="my-3 w-screen h-screen flex absolute left-0 top-0 flex justify-center items-center inset-0 z-50 outline-none focus:outline-none bg-no-repeat bg-center bg-cover" id="modal-id" style="backdrop-filter: blur(2px);">
   	<div class="fixed bg-black opacity-80 inset-0 z-0"></div>
    <div class="w-full max-w-3xl p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white">
          <div
          class="flex flex-row justify-between p-1 bg-white rounded-tl-lg rounded-tr-lg"
        > <svg
        @click="closeModal"
            class="w-6 h-6 ml-auto"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M6 18L18 6M6 6l12 12"
            ></path>
          </svg>
        </div>
      <!--content-->
   <div class="flex flex-wrap" v-if="data.data">
        <!--body--> 
   <div class="w-full md:w-1/2 lg:w-1/2 px-3 mb-6">     
   <img class="w-full rounded shadow-md border-8 border-white" :src="data.photo" alt="" v-if="data.photo">
    </div>
    <div class="w-full md:w-1/2 lg:w-1/2 px-3 mt-6">     
    <p class="font-light text-gray-600 py-1"> Name : <span class="font-medium">{{ data.data.name }}</span></p>
    <p class="font-light text-gray-600 py-1"> NID/Passport : <span class="font-medium">{{ data.data.nid }}</span></p>
    <p class="font-light text-gray-600 py-1"> Contact No : <span class="font-medium">{{ data.data.contact_no }}</span></p>
    <p class="font-light text-gray-600 py-1"> Alternative Contact No : <span class="font-medium">{{ data.data.alternative_contact_no }}</span></p>
    <p class="font-light text-gray-600 py-1"> Mailing Address : <span class="font-medium">{{ data.data.mailing_address }}</span></p>
    <p class="font-light text-gray-600 py-1"> Email Address : <span class="font-medium">{{ data.data.email_address }}</span></p>
    <p class="font-light text-gray-600 py-1"> Date of Birth : <span class="font-medium">{{ data.data.date_of_birth | moment("Do MMM YYYY") }}</span></p>
    <p class="font-light text-gray-600 py-1"> Marital Status : <span class="font-medium">{{ data.data.marital_status }}</span></p>
    <p class="font-light text-gray-600 py-1"> Marriage Anniversary : <span class="font-medium">{{ data.data.marriage_anniversary }}</span></p>
    <p class="font-light text-gray-600 py-1"> Spouse Name : <span class="font-medium">{{ data.data.spouse_name }}</span></p>
    <p class="font-light text-gray-600 py-1"> Childrens : <span class="font-medium">{{ data.data.no_of_children }}</span></p>
    <p class="font-light text-gray-600 py-1"> Educational Qualification : <span class="font-medium">{{ data.data.educational_qualification }}</span></p>
    <p class="font-light text-gray-600 py-1"> Professional Status : <span class="font-medium">{{ data.data.professional_status }}</span></p>
    <p class="font-light text-gray-600 py-1"> Religion : <span class="font-medium">{{ data.data.religion }}</span></p>
    <p class="font-light text-gray-600 py-1"> Blood Group : <span class="font-medium">{{ data.data.blood_group }}</span></p>
    <p class="font-light text-gray-600 py-1"> Presence of upcoming event : <span class="font-medium">{{ data.data.presence_of_upcoming_event ? "Yes" : "No"}}</span></p>
     
  </div>
 </div>
 </div>
    </div>
 

</template>

<script>  
  import {mapGetters} from 'vuex';
 
export default {
  name: "TableDataShowModal",   
  computed:{
    ...mapGetters({
      data : 'entry/selectedEntry',  
    })
  },
  methods:{
    closeModal(){
     this.$store.dispatch("entry/viewEntry", {});
     this.$store.dispatch("entry/closeModal");
    }
  }
 
};
</script>
 