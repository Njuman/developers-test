<template>
    <div class="wrapper" v-bind:class="{'list-mode': isActive}">
        <header>
            <router-link  :to="{ name: 'new' }" class="add"><i class="fas fa-plus"></i></router-link>
            <a v-on:click="toggle(true)" class="show-list"><i class="fa fa-th-list"></i></a>
            <a v-on:click="toggle(false)" class="hide-list"><i class="fa fa-th"></i></a>
        </header>
        <div class="container">
            <div class="box" v-for="company in companies">
                <router-link :to="{ name: 'view', params: { id: company.id } }">
                    <img :src="company.logo" :alt="company.name">
                    <div class="content">
                        <div><b>Name: </b> {{ company.name }}</div>
                        <div><b>Email: </b>{{ company.email }}</div>
                        <div><b>Website: </b>{{ company.website }}</div>
                    </div>
                </router-link>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                companies: [],
                isActive: true
            }
        },
        mounted() {
            this.fetchCompany()
        },
        computed: {
        },
        methods: {
            fetchCompany() {
                let self = this
                return axios({
                    url: 'http://localhost:8000/api/v1/companies',
                    method: 'get',
                }).then(results => {
                    console.log('results', results.data)
                    self.companies = results.data || []
                })
            },
            toggle(value) {
                this.isActive = value;
            }
        }
    }
</script>

<style>

</style>
