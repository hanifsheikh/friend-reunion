<template>
    <div v-if="data.data"
        class="my-3 w-screen h-screen flex absolute left-0 top-0 flex justify-center items-center inset-0 z-50 outline-none focus:outline-none bg-no-repeat bg-center bg-cover"
        id="modal-id"
        style="backdrop-filter: blur(2px);"
    >
        <div class="fixed bg-black opacity-80 inset-0 z-0"></div>

        <div
            class="w-full max-w-md p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white"
        > 
            <div class="flex items-center justify-center">
                <div class="flex w-full justify-center items-center px-3 mb-1">
                    <img
                        class="w-60 h-60 object-cover rounded shadow-md border-8 border-white"
                        :src="data.photo"
                        alt=""
                        v-if="data.photo"
                    />
                </div>
            </div>
            <div class="flex w-full items-center justify-center px-3">
                <p
                    class="text-gray-600 py-2 items-center justify-center font-bold"
                >
                    {{ data.data.name }}
                </p>
            </div>
                   <!--footer-->
        <div class="flex w-full p-3 mt-2 justify-between" v-if="!isDeleting">
            <button  @click="closeModal" class="mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">
                Cancel
            </button>            
            <button @click="destroyData(data.data.id)" class="mb-2 md:mb-0 bg-red-500 border border-red-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white transition ease-in-out rounded-full hover:shadow-lg hover:bg-red-600">Delete</button>
        </div>
         <div class="flex w-full p-3  mt-2 justify-center items-center" v-else>           
            <button  class="inline-flex items-center m-auto mb-2 md:mb-0 bg-gray-300 border border-gray-300 px-5 py-2 text-sm font-medium tracking-wider text-white transition ease-in-out rounded-full">
                  <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
  </svg>Deleting..</button>
       
        </div>
        </div>
      
    </div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
    name: "TableDataDeleteModal",
    computed: {
        ...mapGetters({
            data: "entry/selectedEntry",
            isDeleting: "entry/isDeleting"
        })
    },
    methods: {
        closeModal() {
            this.$store.dispatch("entry/deleteModal", {});
            this.$store.dispatch("entry/closeModal");
        },
        destroyData(payload) {
            this.$store.dispatch("entry/destroyData", payload);
        }
    }
};
</script>
