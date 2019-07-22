<template>
    <div class="row col justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">

                    <div v-if="loading"
                         class="align-items-center justify-content-center d-flex w-100 h-100"
                         style="min-height:300px;"
                    >
                        <div class="loading center" >
                            <div class="spinner-border text-secondary" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    </div>
                    <div v-else-if="!loading && !error">
                        <h1 class="mb-2">{{ data.title }}</h1>
                        <hr />
                        <div class="col row">
                            <div class="col-md-8">
                                <doughnut-chart :values="values" :labels="labels"></doughnut-chart>
                            </div>
                            
                            <div class="col-md-4">
                                <table class="table table-borderless">
                                    <tr>
                                        <td>Number of Internal Links</td>
                                        <td>
                                            <strong>{{ data.internalLinks }}</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Number of External links</td>
                                        <td>
                                            <strong>{{ data.externalLinks}}</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Number of images</td>
                                        <td>
                                            <strong>{{ data.images }}</strong>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <hr />
                        <router-link class="btn btn-outline-info" to="/">
                            Back to form
                        </router-link>
                    </div>
                    <div v-else-if="!loading" class="text-center w-100">
                        <h3 class="text-center">{{ error }}</h3>
                        <hr />
                        <router-link class="btn btn-outline-info" to="/">
                            Back to form
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import doughnutChart from "./doughnutChart";
export default {
    data() {
        return {
            loading: true,
            values: false,
            labels: false,
            title: '',
            data: false,
            error: false
        };
    },
    components: {
        doughnutChart
    },
    mounted() {
        this.fetch();
    },

    methods: {
        async fetch() {
            try {
                let response = await axios.get(`/api/pages/${this.$route.params.id}`);

                this.data = response.data.data.result;
                this.labels = Object.keys(this.data).filter(item => item !== 'title');
                this.values = this.labels.map(key => this.data[key]);
                this.loading = false;

            } catch(error) {
                this.loading = false;
                this.error = error.response.data.message;
            }
        }
    }
};
</script>

<style scoped>
</style>