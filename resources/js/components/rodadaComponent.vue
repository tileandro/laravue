<template>
    <div class="form-group mb-1">
        <h1>
            Jogos
            <button type="button" class="btn btn-outline-primary btn-sm btRodada" alt="Atuliazar Rodada" title="Atuliazar Rodada" @click="atualizarRodada()">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"></path>
                    <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"></path>
                </svg>
            </button>
        </h1>
        <div class="alert alert-dismissible fade show mb-3 alert-warning d-none" role="alert'">
            Escolha uma rodada abaixo
            <button type="button" class="btn-close" @click="closeAlert()"></button>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <th class="d-flex justify-content-center align-items-center">
                        <div class="form-group col-md-12">
                            <select class="form-control form-control-sm" id="selecionarRodada" name="selecionarRodada" @change="selecionarRodada()">
                                <option value="" selected>Escolha uma rodada</option>
                                <option v-for="r in numeroRodadas" :value="r">{{r}}ª Rodada</option>
                            </select>
                            <div class="d-flex justify-content-center mt-3 carregandoRodada d-none">
                                <div class="spinner-border" role="status">
                                    <span class="sr-only"></span>
                                </div>
                            </div>
                        </div>
                    </th>
                </thead>
                <tbody>
                    <tr v-for="rodada in rodadas" v-if="rodada.error == true">
                        <td class="d-flex justify-content-center align-items-center" style="border: none;background: #eee;">
                            <b>{{rodada.message}}</b>
                        </td>
                    </tr>
                    <tr v-for="rodada in rodadas" v-if="rodada.error !== true">
                        <td class="d-flex justify-content-center align-items-center" style="border: none;background: #eee;">
                            <b style="text-align:center;font-size:12px;">{{format_date(rodada.data_jogo)}} - {{rodada.estadio}}</b>
                        </td>
                        <td class="d-flex justify-content-center align-items-center">
                            <template v-for="time in times" v-if="rodada.id_time_casa !== time.id"></template>
                            <template v-else>
                                <span style="margin-right:10px;text-align:center;font-size:xx-small;">
                                    <img :src="time.escudo" :alt="time.time" :title="time.time" class="timeEscudos" height="27px">
                                    <br/>
                                    {{time.time}}
                                </span>
                            </template>
                            {{rodada.placar_time_casa}} <span style="margin: 0 10px;">x</span> {{rodada.placar_time_fora}}
                            <template v-for="time in times" v-if="rodada.id_time_fora !== time.id"></template>
                            <template v-else>
                                <span style="margin-left:10px;text-align:center;font-size:xx-small;">
                                    <img :src="time.escudo" :alt="time.time" :title="time.time" class="timeEscudos" height="27px">
                                    <br/>
                                    {{time.time}}
                                </span>
                            </template>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<script>
    import moment  from 'moment'
    moment.locale('pt-br')
    export default {
        data(){
            return{
                rodadas: [],
                times: [],
                numeroRodadas: 38,
            }
        },
        methods:{
            closeAlert(){
                $('.alert-warning').addClass('d-none');
            },
            selecionarRodada(){
                if(selecionarRodada.value !== ""){
                    $('.carregandoRodada').removeClass('d-none');
                    fetch('http://localhost/api/v1/rodadas/' + selecionarRodada.value, {
                        headers: {'Content-Type': 'application/json', 'apiKey': 'base64:ZSH1CDeccLGyEno/bMaoOmzv7JdRmQ0Bun8fVzDbHGE='}
                    })
                        .then(response => response.json())
                        .then((res) => {
                            $('.carregandoRodada').addClass('d-none');
                            this.rodadas = res
                        })

                    fetch('http://localhost/api/v1/tabela', {
                        headers: {'Content-Type': 'application/json', 'apiKey': 'base64:ZSH1CDeccLGyEno/bMaoOmzv7JdRmQ0Bun8fVzDbHGE='}
                    })
                        .then(response => response.json())
                        .then((res) => {
                            this.times = res
                        })
                }else{
                    $('.alert-warning').removeClass('d-none');
                }
            },
            atualizarRodada(){
                if(selecionarRodada.value !== ""){
                    $('.carregandoRodada').removeClass('d-none');
                    fetch('http://localhost/api/v1/rodadas/' + selecionarRodada.value, {
                        headers: {'Content-Type': 'application/json', 'apiKey': 'base64:ZSH1CDeccLGyEno/bMaoOmzv7JdRmQ0Bun8fVzDbHGE='}
                    })
                    .then(response => response.json())
                    .then((res) => {
                        $('.carregandoRodada').addClass('d-none');
                        this.rodadas = res
                    })
                }else{
                    $('.alert-warning').removeClass('d-none');
                }
            },

            format_date(value){
                if (value) {
                return moment(String(value)).format('ddd DD/MM HH:mm')
                }
            },
        }
    }
</script>
