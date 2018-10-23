<template>
    <!-- Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="createStudent">
            <div class="modal-body">
                <div class="form-group">
                  <div class="form-group">
                  <label for="exampleInputEmail1">Student ID</label>
                  <input type="text" class="form-control" v-model="std_id" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Student ID" required>
                </div>
                  <label for="exampleInputEmail1">Full Name</label>
                  <input type="text" class="form-control" v-model="std_name" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Full Name" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Class</label>
                  <input type="text" class="form-control" v-model="std_class" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Class" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Age</label>
                  <input type="number" class="form-control" v-model="std_age" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Age" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Address</label>
                  <textarea class="form-control" v-model="std_address" id="exampleFormControlTextarea1" rows="3" required></textarea>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
        </div>
      </div>
    </div>
</template>

<script>
    export default{
        mounted() {
            console.log('Component mounted.')
        },
        data(){
          return{
            std_id:'',
            std_name:'',
            std_class:'',
            std_age:'',
            std_address:'',
          }
        },
        methods:{
          createStudent(){
            axios.post('http://localhost:8000/stddata',{
            std_id:this.std_id,
            std_name:this.std_name,
            std_class:this.std_class,
            std_age:this.std_age,
            std_address:this.std_address,
            
          })
          .then(data=>this.$emit('stdRecord',data))
          .catch(error=>console.log(error));
          $('#addModal').modal('hide');
          this.std_id='';
          this.std_name='';
          this.std_class='';
          this.std_age='';
          this.std_address='';
          }
        }
    }
</script>
