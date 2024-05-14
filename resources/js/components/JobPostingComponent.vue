<template>
    <div>
        <h1>Job Posting Lists</h1>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Job Name</th>
                    <th>Job Description</th>
                    <th>Vacants</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in postingList" :key="item.id">
                    <td>{{ item.job_name }}</td>
                    <td>{{ item.job_description }}</td>
                    <td>{{ item.vacants }}</td>
                    <td>
                        <button class="btn btn-secondary btn-sm" @click="edit(item)"><i class="fa fa-edit"></i></button>
                        <button class="btn btn-danger btn-sm" @click="remove(item, index)"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Input Job Name" v-model="form.job_name">
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Input Job Description" v-model="form.job_description">
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Input vacants" v-model="form.vacants">
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <button class="btn btn-primary btn-sm" @click="submit"><i class="fa fa-plus"></i></button>
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table>
        <!-- Modal -->
        <div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Job Name</label>
                            <input type="text" class="form-control" placeholder="Input Job Name" v-model="formEdit.job_name">
                        </div>
                        <div class="form-group">
                            <label for="">Job Description</label>
                            <input type="text" class="form-control" placeholder="Input Job Description" v-model="formEdit.job_description">
                        </div>
                        <div class="form-group">
                            <label for="">Vacant</label>
                            <input type="text" class="form-control" placeholder="Input Vacants" v-model="formEdit.vacants">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click="save()">Save Changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['posting'],
        data() {
            return {
                postingList: this.posting,
                form: {
                    job_name: null,
                    job_description: null,
                    vacants: 0
                },
                formEdit: {
                    job_name: null,
                    job_description: null,
                    vacants: 0
                },
                selectedId: null
            }
        },
        methods: {
            submit() {
                const postingListArr = this.postingList;
                const vm = this;
                axios.post('/job_postings', this.form)
                    .then(function (response) {
                        console.log(response.data.data);
                        postingListArr.push(response.data.data);
                        vm.form.job_name = null;
                        vm.form.job_description = null;
                        vm.form.vacants = 0;
                    }).catch(function (error) {
                        console.log(error);
                        alert('Something went wrong');
                    });
            },
            remove(item, index) {
                const postingListArr = this.postingList;
                axios.delete(`/job_postings/${item.id}`)
                    .then(function (response){
                        console.log(response);
                        postingListArr.splice(index, 1);
                    }).catch(function (error){
                        console.log('error');
                    });
            },
            edit(item) {
                this.formEdit.job_name = item.job_name;
                this.formEdit.job_description = item.job_description;
                this.formEdit.vacants = item.vacants;
                this.selectedId = item.id;
                $('#editModal').modal('show');
            },
            save() {
                const vm = this;
                axios.put(`/job_postings/${vm.selectedId}`, this.formEdit)
                    .then(function (response){
                        alert('Job Posting has been successfully saved');
                        location.reload();
                    })
                    .catch(function (error) {
                        console.log(error);
                        console.log('testing');
                    });
            }
        }
    }
</script>