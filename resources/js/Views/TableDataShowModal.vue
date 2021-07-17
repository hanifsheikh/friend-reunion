<template>
 <div class="min-w-screen h-screen fixed  left-0 top-0 flex justify-center items-center inset-0 z-50 outline-none focus:outline-none bg-no-repeat bg-center bg-cover" id="modal-id">
   	<div class="absolute bg-black opacity-80 inset-0 z-0"></div>
    <div class="w-full  max-w-7xl p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
      <!--content-->
      <div class="">
        <!--body-->
  <div class="flex items-center h-60" >
    {{data.name}}
  </div>
   
        <!--footer-->
        <div class="p-3  mt-2 text-center space-x-4 md:block">
            <button @click="closeModal" class="bg-gray-300 hover:bg-gray-400 text-gray-500 font-bold py-1 px-5 border-b-4 border-gray-400 hover:border-gray-300  transition ease-in-out rounded">
                Close
            </button>         
           
       
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
 