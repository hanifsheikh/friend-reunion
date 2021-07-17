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
   <div class="flex flex-wrap">
        <!--body--> 
   <div class="w-full md:w-1/2 lg:w-1/2 px-3 mb-6">     
   <img class="w-full rounded shadow-md border-8 border-white" :src="data.photo" alt="" v-if="data.photo">
    </div>
    <div class="w-full md:w-1/2 lg:w-1/2 px-3 mt-6">     
    <p class="font-light text-gray-600 py-1"> Name : <span class="font-medium">{{ data.data ? data.data.name : null}}</span></p>
    <p class="font-light text-gray-600 py-1"> NID/Passport : <span class="font-medium">{{ data.data ? data.data.nid : null}}</span></p>
    <p class="font-light text-gray-600 py-1"> Contact No : <span class="font-medium">{{ data.data ? data.data.contact_no : null}}</span></p>
    <p class="font-light text-gray-600 py-1"> Alternative Contact No : <span class="font-medium">{{ data.data ? data.data.alternative_contact_no : null}}</span></p>
    <p class="font-light text-gray-600 py-1"> Mailing Address : <span class="font-medium">{{ data.data ? data.data.mailing_address : null}}</span></p>
    <p class="font-light text-gray-600 py-1"> Email Address : <span class="font-medium">{{ data.data ? data.data.email_address : null}}</span></p>
    <p class="font-light text-gray-600 py-1"> Date of Birth : <span class="font-medium">{{ data.data ? (data.data.date_of_birth ) : null}}</span></p>
    <p class="font-light text-gray-600 py-1"> Marital Status : <span class="font-medium">{{ data.data ? data.data.marital_status : null}}</span></p>
    <p class="font-light text-gray-600 py-1"> Marriage Anniversary : <span class="font-medium">{{ data.data ? data.data.marriage_anniversary : null}}</span></p>
    <p class="font-light text-gray-600 py-1"> Spouse Name : <span class="font-medium">{{ data.data ? data.data.spouse_name : null}}</span></p>
    <p class="font-light text-gray-600 py-1"> Childrens : <span class="font-medium">{{ data.data ? data.data.no_of_children : null}}</span></p>
    <p class="font-light text-gray-600 py-1"> Educational Qualification : <span class="font-medium">{{ data.data ? data.data.educational_qualification : null}}</span></p>
    <p class="font-light text-gray-600 py-1"> Professional Status : <span class="font-medium">{{ data.data ? data.data.professional_status : null}}</span></p>
    <p class="font-light text-gray-600 py-1"> Religion : <span class="font-medium">{{ data.data ? data.data.religion : null}}</span></p>
    <p class="font-light text-gray-600 py-1"> Blood Group : <span class="font-medium">{{ data.data ? data.data.blood_group : null}}</span></p>
    <p class="font-light text-gray-600 py-1"> Presence of upcoming event : <span class="font-medium">{{ data.data ? (data.data.presence_of_upcoming_event ? "Yes" : "No") : null}}</span></p>
     
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
      data : 'entry/showSelectedEntry',  
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
 