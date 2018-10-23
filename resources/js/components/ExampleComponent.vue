<template>
  <div class="container mt-5 mb-5">
      <div v-if="message.length>0" class="alert alert-primary" role="alert">
        {{message}}
      </div>
      <div class="card">
        <h5 class="card-header">Student Info.
          <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addModal">
             Add Student
          </button>
        </h5>
        <div class="card-body">
          <table class="table table-sm">
            <thead>
              <tr class="table-secondary">
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Class</th>
                <th scope="col">Age</th>
                <th scope="col">Address</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr class="table-secondary" v-for="student in students.data">
                <td>{{student.std_id}}</td>
                <td>{{student.std_name}}</td>
                <td>{{student.std_class}}</td>
                <td>{{student.std_age}}</td>
                <td>{{student.std_address}}</td>
                <td><button type="button" @click="getRecord(student.id)" class="btn btn-link" data-toggle="modal" data-target="#editModal"><i class="fa fa-edit"></i></button>#
                  <button type="button" @click="deleterecord(student.id)" class="btn btn-link"><i class="fa fa-trash"></i></button>
                </td>
              </tr>
            </tbody>
          </table> 
          <pagination :data="students" @pagination-change-page="getResults"></pagination>
        </div>
      </div>
      <div id="modal">
        <addModal @stdRecord="refreshStudent"></addModal>
        <editModal :rec="editRec" @studentUpdated="updatedStudent"></editModal>
      </div>
  </div>
</template>

<script>
    Vue.component('addModal', require('./addModal.vue'));
    Vue.component('editModal', require('./editModal.vue'));
    Vue.component('pagination', require('laravel-vue-pagination'));
    export default{
        data(){
          return{
            editRec:{},
            errors:[],
            students:{},
            message:'',
          }
        },
        methods:{
          getResults(page = 1) {
            axios.get('http://localhost:8000/stddata?page=' + page)
              .then(response => {
                this.students = response.data;
              });
          },
          refreshStudent(data){
            this.students=data.data;
            this.message="Data inserted Successfully..........";
          },
          updatedStudent(data){
            this.students=data.data;
            $('#editModal').modal('hide');
            this.message="Data Updated Successfully..........";
          },
          getRecord(id){
            console.log(id);
            axios.get('http://localhost:8000/stddata/'+id+'/edit')
            .then(response=>this.editRec=response.data)
            .catch(error=>this.errors=error.response.data.errors)
          },
          deleterecord(id){
            const reply=confirm("Are you Sure.You want to delete student?");
            if(reply){
            axios.post('http://localhost:8000/stddata/'+id,{
              id:id,
              _method:'DELETE'
            })
            .then(response=>this.students=response.data)
            .catch(error=>this.errors=error.response.data.errors)
            this.message="Data Deleted Successfully..........";   
          }else{
            return
           
          }
          }
        },
        mounted() {
            console.log('Component mounted.')
        },
         created(){
            axios.get('http://localhost:8000/stddata')
            .then((response)=>this.students=response.data)
            .catch((error)=>console.log(error));
        }
    }
</script>
