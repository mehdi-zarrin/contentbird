<template>
    <div class="row col justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form class="needs-validation" novalidate @submit.prevent="handleSubmit">
                        <div class="form-group">
                            <label>
                                URL: <span class="text-danger">*</span> ( Please enter a valid url and hit submit )
                            </label>
                            <div class="input-group mb-3">
                                <input type="text" 
                                       class="form-control"
                                       placeholder="http://"
                                       v-model="url"
                                       value="http://"
                                       :class="formClass"
                                />
                                
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit" :disabled="loading">
                                        <template v-if="loading">
                                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                            Fetching site data, Please wait ...
                                        </template>
                                        <template v-else>
                                            Submit
                                        </template>
                                    </button>
                                </div>

                                <div class="invalid-feedback">
                                    {{ error }}
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import validate from 'validate.js';
    export default {
        data() {
            return {
                url: 'http://',
                loading: false,
                formClass: '',
                validUrl: false,
                error: ''
            }
        },
        methods: {

            async handleSubmit() {

                if(! this.validate(this.url)) return;

                try {
                    this.loading = true;
                    let response = await axios.post('/api/pages', {
                        url : this.url
                    });
                    this.loading = false;
                    this.$router.push(`/show/${response.data.data.id}`);

                } catch(error) {

                    this.loading = false;
                    this.error = error.response.data.message;
                    this.formClass = 'is-invalid';
                }

            },

            validate(value) {

                let result = validate({website: value}, {website: {url: true}});
                if(typeof result == 'undefined') {
                    return true;
                }
                this.error = 'Please enter a valid url';
                this.formClass = 'is-invalid';
                return false;
            },

        },

        watch: {
            url(value) {
                this.formClass = '';
            }
        }
    }
</script>

<style scoped>

</style>