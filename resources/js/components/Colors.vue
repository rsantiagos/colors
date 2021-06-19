<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card rounded">
                    <div class="card-header text-center"><h1>Colores</h1></div>
                    <!-- <button @click="createColor">nuevo color</button> -->
                    <div class="row">
                        <div class="col-md-4 ms-md-auto">
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="addon-wrapping">Items por pagina</span>
                                <select class="form-select" v-model="per_page" aria-label="Default select example">
                                    <option value="6">6</option>
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 mb-3"  v-for="color in laravelData.data" :key="color.id">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title ">{{color.year}} </h5>
                                        <div class="card-text text-center">
                                            {{color.name}}
                                            <h3>{{color.color}}</h3>
                                        </div>
                                        <p class="card-text text-right text-bold">
                                            {{color.pantone}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <pagination :data="laravelData" @pagination-change-page="getColors" :limit="1" align="center" :show-disabled="true" >
                                    <span slot="prev-nav">&lt; Anterior</span>
                                    <span slot="next-nav">Siguiente &gt;</span>
                                </pagination>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                per_page: 6,
                laravelData: {}
            }
        },
        mounted() {
            this.getColors();
        },
        methods: {
            async getColors(page = 1) {
                try {
                    this.laravelData = (await axios.get('/api/color?page=' + page + '&per_page=' + this.per_page)).data;
                } catch (error) {
                    console.error(error);
                }

            },
            async createColor() {
                try {
                    let color = {
                        name: 'sand dollar',
                        color: '#DECDBE',
                        pantone: '13-1106',
                        year: '2006'
                    }
                    await axios.post('/api/color', color).data;
                    this.getColors();
                } catch (error) {
                    console.error(error);
                }

            }
        },
        watch:{
            per_page(){
                this.getColors();
            }
        }
    }
</script>
