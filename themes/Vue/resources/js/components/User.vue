<style>

</style>
<template>
    <div class="card">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Users</h3>
                        <div class="card-tools">
                            <button class="btn btn-success" @click="newModal">Add New <i
                                    class="fas fa-user-plus fa-fw"></i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Cell Phone</th>
                                <th>Updated Date</th>
                                <th>Actions</th>
                            </tr>
                            <tr v-for="user in users.data" :key="user.id">
                                <td>{{user.id}}</td>
                                <td>{{user.name}}</td>
                                <td>{{user.email}}</td>
                                <td>{{user.cell_phone}}</td>
                                <td>{{user.updated_at | humanReadbleDate}}</td>
                                <td>
                                    <a href="#" @click="editModal(user)">
                                        <i class="fa fa-edit blue"></i>
                                    </a>
                                    /
                                    <a href="#" @click="deleteUser(user.id)">
                                        <i class="fa fa-trash red"></i>
                                    </a>

                                </td>
                            </tr>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <pagination :data="users" :limit="3" @pagination-change-page="getResults"></pagination>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div><!-- /.row -->


        <!-- Modal -->
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Add New</h5>
                        <h5 class="modal-title" v-show="editmode" id="addNewLabel">Update User's Info</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? updateUser() : createUser()">
                        <div class="modal-body">
                            <div class="form-group">
                                <input v-model="form.name" type="text" name="name"
                                       placeholder="Name"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                                <has-error :form="form" field="name"></has-error>
                            </div>

                            <div class="form-group">
                                <input v-model="form.email" type="email" name="email"
                                       placeholder="Email Address"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                                <has-error :form="form" field="email"></has-error>
                            </div>

                            <div class="form-group">
                                <input v-model="form.cell_phone" type="text" name="cell_phone"
                                       placeholder="Cell Phone"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('cell_phone') }">
                                <has-error :form="form" field="cell_phone"></has-error>
                            </div>

                            <div class="form-group">
                                <input v-model="form.facebook" type="text" name="facebook"
                                       placeholder="Facebook Account"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('facebook') }">
                                <has-error :form="form" field="facebook"></has-error>
                            </div>

                            <div class="form-group">
                                <input v-model="form.web_site" type="email" name="web_site"
                                       placeholder="Web Site"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('web_site') }">
                                <has-error :form="form" field="web_site"></has-error>
                            </div>

                            <!--                            <div class="form-group">-->
                            <!--                                <textarea v-model="form.bio" name="bio" id="bio"-->
                            <!--                                          placeholder="Short bio for user (Optional)"-->
                            <!--                                          class="form-control" :class="{ 'is-invalid': form.errors.has('bio') }">-->

                            <!--                                </textarea>-->
                            <!--                                <has-error :form="form" field="bio"></has-error>-->
                            <!--                            </div>-->

                            <!--                            <div class="form-group">-->
                            <!--                                <select name="type" v-model="form.type" id="type" class="form-control"-->
                            <!--                                        :class="{ 'is-invalid': form.errors.has('type') }">-->
                            <!--                                    <option value="">Select User Role</option>-->
                            <!--                                    <option value="admin">Admin</option>-->
                            <!--                                    <option value="user">Standard User</option>-->
                            <!--                                    <option value="author">Author</option>-->
                            <!--                                </select>-->
                            <!--                                <has-error :form="form" field="type"></has-error>-->
                            <!--                            </div>-->

                            <div class="form-group">
                                <input v-model="form.password" type="password" name="password" id="password"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                                <has-error :form="form" field="password"></has-error>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button v-show="editmode" type="submit" class="btn btn-success">Update</button>
                            <button v-show="!editmode" type="submit" class="btn btn-primary">Create</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                editmode: false,
                users: {},
                form: new Form({
                    id: '',
                    name: '',
                    email: '',
                    password: '',
                    cell_phone: '',
                    facebook: '',
                    web_site: '',
                    updated_at: '',
                })
            }
        },
        methods: {
            getResults(page = 1) {
                axios.get('api/v1/users/?page=' + page)
                    .then(response => {
                        this.users = response.data;
                    });
            },
            loadUsers() {
                axios.get("api/v1/users")
                    .then(({data}) => (
                        this.users = data
                    ));
            },
            updateUser(){
                this.$Progress.start();
                // console.log('Editing data');
                this.form.put('api/v1/users/'+this.form.id)
                    .then(() => {
                        // success
                        $('#addNew').modal('hide');
                        swal(
                            'Updated!',
                            'Information has been updated.',
                            'success'
                        )
                        this.$Progress.finish();
                        Fire.$emit('AfterCreate');
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    });

            },
            editModal(user){
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(user);
            },
            newModal(){
                this.editmode = false;
                this.form.reset();
                $('#addNew').modal('show');
            },
            createUser() {
                this.$Progress.start();
                this.form.post('api/v1/users')
                    .then(({data}) => {

                        Fire.$emit('AfterCreate');

                        $('#addNew').modal('hide')
                        toast({
                            type: 'success',
                            title: 'User Created in successfully'
                        })
                        this.$Progress.finish();
                    })
                    .catch(() => {
                        this.$Progress.fail();
                        swal("Failed!", "There are someting wronge.", "warning");
                    })
            },
            deleteUser(id) {
                swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {

                    // Send request to the server
                    if (result.value) {
                        this.form.delete('api/v1/users/'+id).then(()=>{
                            swal(
                                'Deleted!',
                                'Your file has been deleted.',
                                'succ ess'
                            )
                            Fire.$emit('AfterCreate');
                        }).catch(()=> {
                            swal("Failed!", "There was something wronge.", "warning");
                        });
                    }
                })
            },
        },
        created() {
            this.loadUsers();
            Fire.$on('AfterCreate', () => {
                this.loadUsers();
            });
        }
    }
</script>
