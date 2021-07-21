<template>
 <div>
      <!-- Header -->
      <div class="w-full flex items-center bg-gray-800 justify-between h-12 text-white z-10 shadow-xl">
        <div class="flex pl-3 w-50 h-12 bg-gray-800 dark:bg-gray-800 border-none">
        <ul class="flex mt-3">     
        <li class="ml-3 cursor-pointer">     
          <p @click="excelDownload" class="hover:opacity-50 transition ease-in-out duration-300"> <img  src="/images/excel.png" alt="/images/excel.png" class="h-5 inline-flex object-contain"> Excel Download</p> 
        </li>
     
       
      </ul>  
           </div>
        <div class="flex justify-between items-center h-12 bg-gray-800 dark:bg-gray-800 header-right">     
          
          <ul class="flex items-center">         
           <li class="mr-1">     
          <img src="/images/person.png" alt="/images/person.png" class="h-6 inline-flex object-contain -mt-1"><p class="inline-flex">  {{totalPersons}}</p> 
        </li>
            <li>
              <div class="block w-px h-6 mx-3 bg-gray-400 dark:bg-gray-700"></div>
            </li>
            <li>
              <a  @click="logout" class="flex items-center mr-4 hover:opacity-50 transition ease-in-out duration-300 cursor-pointer">
                <span class="inline-flex mr-1">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                </span>
                Logout
              </a>
            </li>
          </ul>
        </div>
      </div>
      <!-- ./Header -->
 
   <Table />
    <TableDataShowModal v-show="showModalActive"/>
    <TableDataDeleteModal v-show="deleteModalActive"/>
    
</div>
</template>

<script>
import axios from 'axios'
import Table from "../Components/Table.vue"
import TableDataShowModal from "../Components/TableDataShowModal.vue"
import TableDataDeleteModal from "../Components/TableDataDeleteModal.vue"
   import {mapGetters} from 'vuex';
export default {
  name: "Admin", 
  components:{
    Table,
     TableDataShowModal,
     TableDataDeleteModal
  },
  computed:{
    ...mapGetters({
      showModalActive : 'entry/showModalActive',  
      deleteModalActive : 'entry/deleteModalActive',  
      totalPersons : 'entry/totalPersons',  
    })
  },
  methods: {
    logout() {
      this.$store.dispatch("user/logout");
    },
     
    excelDownload(){
      axios({url: `./api/excel-download`,
    method:'GET',
    responseType:'blob'
        }).then(response => {  
     const downloadElement = document.createElement('a')
     const href = window.URL.createObjectURL(response.data)
     downloadElement.href = href
     downloadElement.download = 'entries.xlsx'
     document.body.appendChild(downloadElement)
     downloadElement.click()
     document.body.removeChild(downloadElement) // Download the complete removal of elements
     window.URL.revokeObjectURL(href) //  Relieve the blob
 })
    }
  },
};
</script>
