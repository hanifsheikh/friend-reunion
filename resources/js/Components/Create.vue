<template>
<div class="container mx-auto my-5">
    <div class="rounded-lg  md:shadow-xl bg-white ">
   
  <div class="flex p-3 md:p-8 lg:p-8 flex-col md:flex-row items-center">
<form class="w-full" @submit.prevent>
 
  <div class="flex flex-wrap justify-center mb-6"> 
    <input id="fileSelectInput" type="file" class="hidden" @change="onFileSelected" accept="image/*" ref="fileSelectInput" />               
    <input type="file" class="hidden" @change="onFileSelected" accept="image/*" ref="fileCaptureInput" capture/>   
    <img  :src="photo_url" :alt="photo_url" class="lg:w-1/6 sm:w-full h-40 object-contain">
   
  <div class="w-full items-center mt-3"> 
    <div class="flex justify-center">
     <p v-if="photo_error" class="font-bold text-red-500 mb-3 text-xs italic">Photo is required!</p>
     </div>
  </div>

  <div class="w-full items-center mt-3">
     <div class="flex justify-center mb-5">
  <button  @click="$refs.fileSelectInput.click()" class="bg-white shadow-md hover:bg-gray-200 text-gray-800 font-bold py-1 px-3 rounded-l border-r-1">
     <img  src="/images/laptop.png" alt="/images/laptop.png" class="h-5 inline-flex object-contain"> From Device
  </button>
  <button  @click="$refs.fileCaptureInput.click()" class="bg-white shadow-md hover:bg-gray-200 text-gray-800 font-bold py-1 px-3 rounded-r">
  <img  src="/images/camera.png" alt="/images/camera.png" class="h-5 inline-flex object-contain">
    Camera 
    
  </button>
</div>

  </div>
   
  </div>
  
  <div class="flex flex-wrap mb-6">
    <div class="w-full md:w-1/2 lg:w-1/4 px-3 mb-6">     
      <label class="block text-gray-500 text-sm font-bold mb-2" for="name">
        Name <span class="text-red-500">*</span>
      </label>
      <input @input="checkRequired('name', 'text')" v-model="name" spellcheck="false" class="block appearance-none border border-gray-200 rounded w-full py-2 px-4 text-gray-500 leading-tight focus:outline-none focus:bg-white focus:border-indigo-500" id="name" type="text"> 
      <p v-if="name_error" class="text-red-500  mb-3 text-xs italic">Please fill out this field.</p>
    </div>
    <div class="w-full md:w-1/2 lg:w-1/4 px-3 mb-6">     
      <label class="block text-gray-500 text-sm font-bold mb-2" for="nid">
        NID/Passport No  <span class="text-red-500">*</span>
      </label>
      <input type="text" @input="checkRequired('nid', 'mixed')" v-model="nid" class="block appearance-none border rounded w-full py-2 px-4 text-gray-500 leading-tight focus:outline-none focus:bg-white focus:border-indigo-500" id="nid">
      <p v-if="nid_error" class="text-red-500  mb-3 text-xs italic">Please fill out this field.</p>
    </div>
    <div class="w-full md:w-1/2 lg:w-1/4 px-3 mb-6">     
      <label class="block text-gray-500 text-sm font-bold mb-2" for="contact-no">
        Contact No  <span class="text-red-500">*</span>
      </label>
      <input type="tel" @input="checkRequired('contact-no', 'number')" v-model="contact_no" class="block appearance-none border border-gray-200 rounded w-full py-2 px-4 text-gray-500 leading-tight focus:outline-none focus:bg-white focus:border-indigo-500" id="contact-no"> 
         <p v-if="contact_no_error" class="text-red-500  mb-3 text-xs italic">Please fill out this field.</p>
    </div>
    <div class="w-full md:w-1/2 lg:w-1/4 px-3 mb-6">     
      <label class="block text-gray-500 text-sm font-bold mb-2" for="alternative-contact-no">
       Alternative Contact No
      </label>
      <input v-model="alternative_contact_no" type="tel" @input="sanitize('alternative-contact-no', 'number')" class="block appearance-none border border-gray-200 rounded w-full py-2 px-4 text-gray-500 leading-tight focus:outline-none focus:bg-white focus:border-indigo-500" id="alternative-contact-no"> 
      </div> 

    <div class="w-full md:w-1/2 px-3 mb-6">     
      <label class="block text-gray-500 text-sm font-bold mb-2" for="mailing-address">
      Mailing Address  <span class="text-red-500">*</span>
      </label>
      <textarea v-model="mailing_address" @input="checkRequired('mailing-address', 'mixed')" spellcheck="false" class="block appearance-none border border-gray-200 rounded w-full py-2 px-4 text-gray-500 leading-tight focus:outline-none focus:bg-white focus:border-indigo-500" id="mailing-address" /> 
       <p v-if="mailing_address_error" class="text-red-500  mb-3 text-xs italic">Please fill out this field.</p>
      </div> 
          <div class="w-full md:w-1/2 lg:w-1/4 px-3 mb-6">     
      <label class="block text-gray-500 text-sm font-bold mb-2" for="email-address">
       Email Address  <span class="text-red-500">*</span>
      </label>
      <input v-model="email_address" @input="checkRequired('email-address', 'email')"  class="block appearance-none border border-gray-200 rounded w-full py-2 px-4 text-gray-500 leading-tight focus:outline-none focus:bg-white focus:border-indigo-500" id="email-address" type="email"> 
      <p v-if="email_address_error" class="text-red-500  mb-3 text-xs italic">Email is required. (Enter a valid email)</p>
      </div> 
          <div class="w-full md:w-1/2 lg:w-1/4 px-3 mb-6">
      <label class="block text-gray-500 text-sm font-bold mb-2" for="date-of-birth">
        Date of Birth  <span class="text-red-500">*</span>
      </label>
      <div class="relative">
        <input @input="checkRequired('date-of-birth', 'date')" v-model="date_of_birth" class="block appearance-none w-full  border border-gray-200 text-gray-500 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-indigo-500" id="date-of-birth" type="date">
        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-500">
          <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
        </div>
      </div>
       <p v-if="date_of_birth_error" class="text-red-500  mb-3 text-xs italic">Please select date of birth.</p>
    </div>
      <div class="w-full md:w-1/2 lg:w-1/4 px-3 mb-6">
      <label class="block text-gray-500 text-sm font-bold mb-2" for="marital-status">
        Marital Status 
      </label>
      <div class="relative">
        <select v-model="marital_status" class="block appearance-none w-full  border border-gray-200 text-gray-500 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-indigo-500" id="marital-status">
          <option value="Single">Single</option> 
          <option value="Married">Married</option>
        </select>
        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-500">
          <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
        </div>
      </div>
    </div>
       <div class="w-full md:w-1/2 lg:w-1/4 px-3 mb-6">     
      <label class="block text-gray-500 text-sm font-bold mb-2" for="marriage-anniversary">
       Marriage Anniversary
      </label>
      <input v-model="marriage_anniversary" class="block appearance-none border border-gray-200 rounded w-full py-2 px-4 text-gray-500 leading-tight focus:outline-none focus:bg-white focus:border-indigo-500" id="marriage-anniversary" type="text"> 
      </div> <div class="w-full md:w-1/2 lg:w-1/4  px-3 mb-6">     
      <label class="block text-gray-500 text-sm font-bold mb-2" for="spouse-name">
       Spouse Name
      </label>
      <input v-model="spouse_name"  spellcheck="false" class="block appearance-none border border-gray-200 rounded w-full py-2 px-4 text-gray-500 leading-tight focus:outline-none focus:bg-white focus:border-indigo-500" id="spouse-name" type="text"> 
      <!-- <p class="text-red-500  mb-3 text-xs italic">Please fill out this field.</p> -->
    </div>
          <div class="w-full md:w-1/2 lg:w-1/4 px-3 mb-6">     
      <label class="block text-gray-500 text-sm font-bold mb-2" for="no-of-childrens">
       No. Of Children
      </label>
      <input v-model="no_of_children" class="block appearance-none border border-gray-200 rounded w-full py-2 px-4 text-gray-500 leading-tight focus:outline-none focus:bg-white focus:border-indigo-500" id="no-of-childrens" type="number"> 
      </div>
            <div class="w-full md:w-1/2 lg:w-1/4 px-3 mb-6">
      <label class="block text-gray-500 text-sm font-bold mb-2" for="educational-qualification">
        Educational Qualification (Highest)
      </label>
      <div class="relative">
        <select v-model="educational_qualification" class="block appearance-none w-full  border border-gray-200 text-gray-500 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-indigo-500" id="educational-qualification">
          <option value="S.S.C">S.S.C</option>
          <option value="H.S.C">H.S.C</option>
          <option value="Bachelor">Bachelor</option>
          <option value="Masters">Masters</option>
          <option value="Doctorate">Doctorate</option>
          <option value="PhD.">PhD.</option>
          <option value="Others">Others</option> 
        </select>
        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-500">
          <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
        </div>
      </div>
    </div>
     <div class="w-full md:w-1/2 lg:w-1/4 px-3 mb-6">
      <label class="block text-gray-500 text-sm font-bold mb-2" for="professional-status">
        Professional Status
      </label>
      <div class="relative">
        <select v-model="professional_status" class="block appearance-none w-full  border border-gray-200 text-gray-500 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-indigo-500" id="professional-status">
          <option value="Unemployed">Unemployed </option>
          <option value="Private Service">Private Service</option>
          <option value="Govt. Service">Govt. Service</option>
          <option value="Politician">Politician</option>
          <option value="Doctor">Doctor</option>
          <option value="Lawyer">Lawyer</option>
          <option value="Defense">Defense</option>
          <option value="Others">Others</option> 
        </select>
        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-500">
          <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
        </div>
      </div>
    </div>
            <div class="w-full md:w-1/2 lg:w-1/4 px-3 mb-6">
      <label class="block text-gray-500 text-sm font-bold mb-2" for="religion">
        Religion
      </label>
      <div class="relative">
        <select v-model="religion" class="block appearance-none w-full  border border-gray-200 text-gray-500 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-indigo-500" id="religion">
          <option value="Islam">Islam </option>
          <option value="Hindu">Hindu</option>
          <option value="Christian">Christian</option>
          <option value="Buddhist">Buddhist</option>
          <option value="Jews">Jews</option>
          <option value="Other">Other</option> 
        </select>
        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-500">
          <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
        </div>
      </div>
    </div>
 <div class="w-full my-4">
   <p style="border-bottom:1px solid rgb(210, 210, 210);" ></p>
 </div>
    <div class="px-4 lg:w-1/2 md:w-full float-left">
     <p  class="text-md text-gray-700" > <span class="font-bold text-indigo-700">  Event date & time:</span> 24/07/2021 Saturday at 4:30 PM.</p>
     <p class="text-md text-gray-700"> <span class="font-bold text-indigo-700">Location: </span>Jatrabari, Dhaka.</p> 
     <p class="text-xs text-gray-500"> [ **Subject to the situation of the present condition and  pandemic observation**]</p>
  </div>
 <div class="w-full md:w-1/2 lg:w-1/4 px-3 mb-6 lg:ml-auto lg:mt-0 mt-5">
      <label class="block text-gray-500 text-sm font-bold mb-2" for="presence-of-upcoming-event">
        Presence of Upcoming Event
      </label>
      <div class="relative">
        <select v-model="presence_of_upcoming_event" class="block appearance-none w-full  border border-gray-200 text-gray-500 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-indigo-500" id="presence-of-upcoming-event">
          <option value="1">Yes </option>
          <option value="0">No</option> 
        </select>
        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-500">
          <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
        </div>
      </div>
    </div>
    
  </div>
  <div class="flex w-full justify-center">
    <button v-if="!saving" @click="submit" class="bg-indigo-500 hover:bg-indigo-400 text-white font-bold py-2 px-6 border-b-4 border-indigo-700 hover:border-indigo-500 transition ease-in-out rounded">
  Submit
</button>
<button v-else type="button" class="inline-flex items-center bg-indigo-400 text-white font-bold py-2 px-6 border-b-4 border-indigo-500 rounded transition ease-in-out duration-150">
  <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
  </svg>
  Saving..
</button>
  </div>
 
</form> 
</div>
 </div>
   </div>
 
</template>

<script>
import axios from 'axios';
import image from '../assets/images/user.png';
export default {
  name: "Create", 
  data(){
return { 
  saving:false,
 form_submitted: false,
  name: '',
  name_error: false,
  nid: '',
  nid_error: false,
  contact_no: '',
  contact_no_error: false,
  alternative_contact_no: '',
  alternative_contact_no_error: false,
  mailing_address: '',
  mailing_address_error: false,
  email_address: '',
  email_address_error: false,
  date_of_birth: '',
  date_of_birth_error: false,
  selectedFile : null,
  photo_url : image,
  photo_error: false,
  marital_status: 'Single',
  marriage_anniversary: '',
  spouse_name: '',
  no_of_children: '',
  educational_qualification: 'S.S.C',
  professional_status: 'Unemployed',
  religion: 'Islam',
  presence_of_upcoming_event: 1
}
  },
  methods: {
    async saveData(){
   const config = {
        headers: {
          Accept: "application/json",
          "content-type": "multipart/form-data"
        }
      };
      const formData = new FormData();
      formData.append("name", this.name);
      formData.append("nid", this.nid);
      formData.append("contact_no", this.contact_no);
      formData.append("alternative_contact_no", this.alternative_contact_no);
      formData.append("mailing_address", this.mailing_address);
      formData.append("email_address", this.email_address);
      formData.append("date_of_birth", this.date_of_birth);
      formData.append("marital_status", this.marital_status);
      formData.append("marriage_anniversary", this.marriage_anniversary);
      formData.append("spouse_name", this.spouse_name);
      formData.append("no_of_children", this.no_of_children);
      formData.append("educational_qualification", this.educational_qualification);
      formData.append("professional_status", this.professional_status);
      formData.append("religion", this.religion);
      formData.append("presence_of_upcoming_event", this.presence_of_upcoming_event);   
      formData.append("photo", this.selectedFile);
      try{
          await axios.post("./api/store", formData, config)
          .then(response => {
          this.$noty.success('<b>' + response.data.name + "</b> has been registered!");   
          this.clearForm();
          }).catch(error => {
          let data  = error.response.data;
          for (const property in data) {
          this.$noty.warning(`${data[property]}`);
          }
          })
          }
      catch(exception){
        this.$noty.error(`Network problem, Try Again.`);
        this.saving = false;
      }
    },
     checkRequired(id, type){ 
      var input = document.getElementById(id); 
      var error = false;
      if(type == 'email'){
        var mailformat = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
         error =  mailformat.test(input.value) ? false : true;         
      }
      else if(type == 'date'){    
        error = !Date.parse(input.value) ? true : false; 
      }
      else {
        error =  !this.sanitize(id, type).length ?  true :  false;
      }   
      if(this.form_submitted){ 
      this.checkForm();    
      error ? ( input.classList.add("border-red-500"), input.classList.remove("border-gray-200"))   : (input.classList.remove("border-red-500") ,input.classList.add("border-gray-200"));
       }
 
      
    },
 
 checkForm(){      
       this.name_error = !this.name.trim() ?  true :  false;
       if(this.name_error){
         document.getElementById('name').classList.add("border-red-500");
       } 
       this.nid_error = !this.nid.trim()  ?  true :  false;
       if(this.nid_error){
         document.getElementById('nid').classList.add("border-red-500");
       } 
       this.contact_no_error = !this.contact_no.trim()  ?  true :  false; 
        if(this.contact_no_error){
         document.getElementById('contact-no').classList.add("border-red-500");
       } 
       this.mailing_address_error = !this.mailing_address.trim()  ?  true :  false; 
        if(this.mailing_address_error){
         document.getElementById('mailing-address').classList.add("border-red-500");
       } 
        var mailformat = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
       this.email_address_error = !this.email_address.trim() || !mailformat.test(this.email_address) ?  true :  false; 
        if(this.email_address_error){
         document.getElementById('email-address').classList.add("border-red-500");
       } 
       this.date_of_birth_error = !this.date_of_birth.trim()  ?  true :  false; 
        if(this.date_of_birth_error){
         document.getElementById('date-of-birth').classList.add("border-red-500");
       } 
       this.photo_error = !this.selectedFile ?  true :  false; 
    
    if(!this.name_error && !this.nid_error && !this.contact_no_error && this.mailing_address && !this.email_address_error && this.date_of_birth && this.selectedFile){
      return true;
    }
    
      
       },
    sanitize(id, type){
     var input = document.getElementById(id);  
    if(type == "text") {
      input.value = input.value.replace(/[^a-zA-Z ]/g, "").replace('.', '').replace(/[0-9]/g, '');
    if(id == "name") {
        this.name = input.value
    }
    }   
    else if(type == "mixed") { 
      if(id == "mailing-address") {
       this.mailing_address = input.value.trimStart()
    } 
    }
    else if(type == "number"){ 
      input.value = input.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1').replace(/\./g, ""); 

       if(id == "alternative-contact-no") {
       this.alternative_contact_no = input.value
    } 
       if(id == "contact-no") {
       this.contact_no = input.value
    } 
       if(id == "nid") {
       this.nid = input.value
    } 
    }  
     return input.value;
    },
 
  async  submit(){
  this.form_submitted = true;
  this.saving = true;
      if(this.checkForm()){
     await this.saveData();
      }
      else {
        this.$noty.warning("Fill all the required fields.")
      }
      this.saving = false;
    },
    onFileSelected(event) {
      this.selectedFile = event.target.files[0];
      this.photo_url = URL.createObjectURL(this.selectedFile);
    },
    clearForm(){
      document.getElementById("fileSelectInput").value = "";
       this.form_submitted = false;
        this.name = '';
        this.name_error = false;
        this.nid = '';
        this.nid_error = false;
        this.contact_no = '';
        this.contact_no_error = false;
        this.alternative_contact_no = '';
        this.alternative_contact_no_error = false;
        this.mailing_address = '';
        this.mailing_address_error = false;
        this.email_address = '';
        this.email_address_error = false;
        this.date_of_birth = '';
        this.date_of_birth_error = false;
        this.selectedFile =  null;
        this.photo_url =  image;
        this.photo_error = false;
        this.marital_status = 'Single';
        this.marriage_anniversary = '';
        this.spouse_name = '';
        this.no_of_children = '';
        this.educational_qualification = 'S.S.C';
        this.professional_status = 'Unemployed';
        this.religion = 'Islam';
        this.presence_of_upcoming_event = 1
    }
  }
};
</script>
