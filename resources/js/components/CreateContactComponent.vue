<template>
<div>
    <h1>Contacts</h1>
    <!-- on submit we call the createcontact method -->

    <form action="" @submit.prevent="createContact()">

        <div class="form-group">
            <label>Name*</label>
            <input v-model="contact.name" type="text" name="name" class="form-control" />
              <span v-if="errors.name" class="is-invalid"> {{errors.name[0]}} </span>
        </div>


          <div class="form-group">
               <label>Gender*</label>
            <v-select 
                v-model="contact.gender"
                placeholder="" 
                :options="genders" style="width: 100%;"
                :reduce="genders => genders.id" 
                label="gender_name">                                       
             </v-select>

                <span v-if="errors.gender" class="is-invalid"> {{errors.gender[0]}} </span>
                </div>

        <div class="form-group">
            <label>Email*</label>
            <input  v-model="contact.email" type="text" name="name" class="form-control" />
             <span v-if="errors.email" class="is-invalid"> {{errors.email[0]}} </span>
        </div>


        <div class="form-group">
            <label>Content*</label>
            <textarea  v-model="contact.content" type="text" name="name" class="form-control"> </textarea>
            <span v-if="errors.gender" class="is-invalid"> {{errors.content[0]}} </span>
        </div>

      
       <!-- if success is empty then we show the submit buttons and hide the success message -->
         <div class="form-group" v-if="!success">
            <button type="submit" name="submit" v-if="!loading" class="btn btn-sm btn-primary"> Submit information</button>
           <button type="button" v-if="loading" class="btn btn-sm btn-primary " disabled="disabled">Submitting...</button>
        </div>

        <div class="form-group" v-if="success">
            <div class="alert alert-success"> {{success}}</div>

        </div>


      </form>


      
</div>
</template>

<script>
    export default {
        //we get the genders prop passed from the blade file
          props: [
            'genders',       
        ],
        data: function(){
            //initialize the variables we'll need
           return {
               list: [],
               success: '',
               errors: [],
               loading: false,
               contact: {
                   id: '',
                   name: '',
                   email: '',
                   content: '',
                   gender: '',               
               }
           } 
        },
        methods: {
            //this method processes the data being submitted to the user
            createContact: function(){
             this.loading = true;
             let self = this;
             this.errors = [];
             this.success = '';
             let params = Object.assign({}, self.contact);
             axios.post('/api/contact/store',params)
             .then(function(response) {
                 if(response.data.status == "success"){
                    self.success = "information submitted succesfully";
                    self.contact.name = '';
                    self.contact.email = '';
                    self.contact.content = '';
                    self.contact.gender = '';
                    self.loading = false;
                 }
            
             })
             .catch(function(error){
                 self.loading = false;
                 self.errors = error.response.data.errors;
             });
            },
        }
    }
</script>
