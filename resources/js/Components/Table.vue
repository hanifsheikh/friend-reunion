<template>
<div class="overflow-x-auto">
        <div class="bg-gray-100 flex items-center justify-center bg-gray-100 font-sans overflow-hidden">
            <div class="w-full px-4">
                <div class="bg-white shadow-md overflow-x-auto rounded my-6">
                    <table class="min-w-max w-full table-auto bg-white">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">Person</th>
                                <th class="py-3 px-3 text-left">NID/Passport</th>
                                <th class="py-3 px-3 text-center">Address</th>
                                <th class="py-3 px-3 text-center">Contact No.</th>
                                <th class="py-3 px-3 text-center">Email Address</th>
                                <th class="py-3 px-3 text-center">Date of Birth</th>
                                <th class="py-3 px-3 text-center">Actions</th>
                            </tr>
                        </thead>

                        <tbody v-if="tableData" class="text-gray-600 text-sm font-light">                        
                            <tr v-for="data in tableData" :key="data.id" class="border-b border-gray-200 hover:bg-gray-100">
                              <td class="px-6 py-1 text-left">
                                    <div class="flex items-center">
                                        <div class="mr-2">
                                            <img class="object-cover w-10 h-10 rounded-full hidden" :id="`entry-${data.id}-image`" :src="getPhoto(data.photo, data.id)"/>
                                         <img class="object-cover w-10 h-10 rounded-full" src="/images/image-loader.gif" :id="`entry-${data.id}-image-loader`"> 
                                        </div>
                                        <span class="font-medium">{{data.name}}</span>
                                    </div>
                                </td>
                                <td class="px-3 py-1 text-left whitespace-nowrap">
                                    <div class="flex items-center">                                      
                                        <span class="font-medium">{{data.nid}}</span>
                                    </div>
                                </td>
                                <td class="px-3 w-80 text-center">
                                    <div class="flex items-center justify-center">
                                         <span>{{data.mailing_address}}</span>
                                    </div>
                                </td>
                                <td class="px-3 py-1 text-center">
                                    <div class="flex items-center justify-center">
                                         <span class="font-medium">{{data.contact_no}}</span>
                                    </div>
                                </td>
                                <td class="px-3 py-1 text-center">
                                   <span class="font-medium">{{data.email_address}}</span>
                                </td>
                                <td class="px-3 py-1 text-center">
                                   <span class="font-medium">{{data.date_of_birth | moment("Do MMM YYYY")}}</span>
                                </td>
                                <td class="px-3 py-1 text-center">
                                    <div class="flex item-center justify-center">
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                            <svg @click="viewEntry(data)" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </div>
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                            <img :id="`entry-${data.id}-button`" @click="downloadPDF(data)" src="/images/pdf.svg" alt="" height="24"> 
                                            <img class="hidden" src="/images/loading.gif" :id="`entry-${data.id}-loader`" alt="" height="24"> 
                                        </div>
                                        <div class="w-4 transform hover:text-purple-500 hover:scale-110">
                                            <svg @click="deleteEntry(data)" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </div>
                                    </div>
                                </td>
                            </tr>  
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    
    </div>
</template>

<script> 
 import {mapGetters} from 'vuex';
import axios from 'axios';
export default {
    name: "Table",    
    computed:{
    ...mapGetters({
        isLoading : 'entry/isLoading', 
        errorMsg : 'entry/errorMsg', 
        tableData : 'entry/tableData'
    })
    }, 
  created(){
    this.fetchData();
  },
  methods:{
      viewEntry(data){
          var photo = document.getElementById(`entry-${data.id}-image`).src;
          var payload = {
              data:data,
              photo:photo
          }
         this.$store.dispatch("entry/viewEntry", payload);
      },
    fetchData(){
        this.$store.dispatch("entry/fetchData");
    },
    deleteEntry(data){
           var photo = document.getElementById(`entry-${data.id}-image`).src;
          var payload = {
              data:data,
              photo:photo
          }
        this.$store.dispatch("entry/deleteModal", payload);
    },
    getPhoto(photo, id){      
        axios({url: `./api/getPicture/${photo}`,
            method:'GET',
            responseType:'blob'
        }).then(response => {
            document.getElementById(`entry-${id}-image-loader`) ? document.getElementById(`entry-${id}-image-loader`).classList.add('hidden') : null; 
            var image = document.getElementById(`entry-${id}-image`);
            image.classList.remove('hidden')
            image.src = window.URL.createObjectURL(response.data);  
            });
    
    },
    downloadPDF(entry){ 
        if(entry){
        
        document.getElementById(`entry-${entry.id}-loader`).classList.remove('hidden');            
        document.getElementById(`entry-${entry.id}-button`).classList.add('hidden'); 
        axios({
            url: `./api/pdf-download/${entry.id}`,
            method:'GET',
            responseType:'blob'
        }).then(response => {
            document.getElementById(`entry-${entry.id}-loader`).classList.add('hidden');            
            document.getElementById(`entry-${entry.id}-button`).classList.remove('hidden'); 
            const url = window.URL.createObjectURL(new Blob([response.data]));
            const link = document.createElement('a');
            link.href = url;
            link.setAttribute('download',  entry.name + " - " + entry.nid + '.pdf');
            document.body.appendChild(link);
            link.click();
           
        });
        }
    }
  }
};
</script>
 