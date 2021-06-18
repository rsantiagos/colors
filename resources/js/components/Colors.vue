<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card rounded mb-5">
                    <div class="card-header">Colores</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4"  v-for="color in colors" :key="color.id">
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
                colors: null
            }
        },
        mounted() {
            this.getColors();
        },
        methods: {
            async getColors() {
                try {
                    this.colors = (await axios.get('/api/color')).data;
                } catch (error) {
                    console.error(error);
                }

            }
        },
    }
</script>
