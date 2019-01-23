<template>
    <div class="wrapper"s>
        <header>
            <router-link  :to="{ name: 'home' }" class="add"><i class="fas fa-arrow-left"></i></router-link>
        </header>
        <div v-if="error">
            {{error}}
        </div>

        <img :src="logo" :alt="name" id="logo-container" v-if="isView">

        <div id="input-form">
            <form action="#" @submit="checkForm">
                <div class="form-group">
                    <label for="name">Name: </label>
                    <input type="text" name="name" v-model="name">
                </div>
                <div class="form-group">
                    <label for="name">Email: </label>
                    <input type="text" name="email" v-model="email">
                </div>
                <div class="form-group">
                    <label for="name">Logo: </label>
                    <input type="file" name="logo" accept="image/*" id="logo" class="ghost-input">
                </div>
                <div class="form-group">
                    <label for="name">Website: </label>
                    <input type="text" name="website" v-model="website">
                </div>
                <div class="form-group">
                    <input type="submit" class="ghost-input">
                </div>
            </form>
        </div>

        <div v-if="isView">
            <section class="faux-table">
                <ul class="header">
                    <li>ID</li>
                    <li>Model</li>
                    <li>Description</li>
                    <li>Price</li>
                    <li>Created</li>
                </ul>
                <ul class="floated-row" v-for="asset in assets">
                    <li>{{ asset.id }}</li>
                    <li>{{ asset.model }}</li>
                    <li>{{ asset.description }}</li>
                    <li>{{ asset.price }}</li>
                    <li>{{ asset.created_at }}</li>
                </ul>
            </section>
        </div>
        <div class="clearfix"></div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                name: '',
                email: '',
                website: '',
                logo: '',
                assets: [],
                isView: false,
                error: '',
                url: 'http://localhost:8000/api/v1/companies',
                method: 'post',
            }
        },
        mounted() {
            this.checkIfView();
        },
        methods: {
            checkIfView() {
                if (this.$route.params.id){
                    this.isView = true
                    this.url = 'http://localhost:8000/api/v1/companies/'+this.$route.params.id
                    this.method = 'put'

                    this.getCompanyInfo(this.$route.params.id)
                    this.getCompanyAssets(this.$route.params.id)
                }
            },
            checkForm (e) {
                e.preventDefault()
                let fields = [
                    this.name,
                    this.email,
                    this.website
                ]

                let invalid = fields.filter(field => !field)

                if (invalid.length) {
                    this.error = "make sure all fields are field in"
                } else {
                    this.submitForm()
                }
            },
            submitForm () {
                axios({
                    url: 'http://localhost:8000/api/v1/companies/upload',
                    method: 'post',
                    data: this.getImage()
                }).then(results => {
                    this.sendRequest(results)
                })
            },
            sendRequest(results) {
                axios({
                    url: this.url,
                    method: this.method,
                    data: {
                        name: this.name,
                        email: this.email,
                        website: this.website,
                        logo: results.data.url
                    }
                }).then(() => {
                    // redirect to product list
                    this.$router.push('/');
                }).catch(err => {
                    this.error = "there was an error";
                    console.log('Error:',err)
                })
            },
            getImage () {
                let formData = new FormData();
                formData.append( 'logo', document.querySelector( '#logo' ).files[0] );

                return formData;
            },
            getCompanyInfo(id) {
                axios({
                    url: 'http://localhost:8000/api/v1/companies/'+id,
                    method: 'get',
                }).then(results => {
                    this.name = results.data.name
                    this.email = results.data.email
                    this.website = results.data.website
                    this.logo = results.data.logo
                })
            },
            getCompanyAssets(id) {
                axios({
                    url: 'http://localhost:8000/api/v1/companies/'+id+'/assets',
                    method: 'get',
                }).then(results => {
                    this.assets = results.data
                })
            }
        }
    }
</script>

<style>

</style>
