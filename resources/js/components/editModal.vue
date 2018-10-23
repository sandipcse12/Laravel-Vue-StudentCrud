<template>
    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Student</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
           <form @submit.prevent="updateStudent">
            <div class="modal-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Student ID</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" v-model="rec.std_id" >
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Full Name</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" v-model="rec.std_name">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Class</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" v-model="rec.std_class">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Age</label>
                  <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" v-model="rec.std_age">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Address</label>
                  <textarea class="form-control" id="exampleFormControlTextarea1" v-model="rec.std_address" rows="3"></textarea>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Updated</button>
            </div>
          </form>
        </div>
      </div>
    </div>
</template>

<script>
    export default{
      props:['rec'],
      data(){
        return{
          success:'',
          errors:[],
        }
      },
      methods:{
        updateStudent(){
          axios.post('http://localhost:8000/stddata/'+this.rec.id,{
            'std_id':this.rec.std_id,
            'std_name':this.rec.std_name,
            'std_class':this.rec.std_class,
            'std_age':this.rec.std_age,
            'std_address':this.rec.std_address,
            '_method':'PUT'
          })
          .then(data=>{
            this.$emit('studentUpdated',data);
            this.success="Record added";
          })
          .catch(error=>this.errors=error.response.data.errors);
        }
      },
      mounted() {
         console.log('Component mounted.')
      }
    }
</script>
