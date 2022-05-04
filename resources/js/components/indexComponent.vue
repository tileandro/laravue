<template>
    <div class="table-responsive">
        <h1>
            Tabela
            <button type="button" class="btn btn-outline-primary btn-sm btAtualizar" alt="Atuliazar Tabela" title="Atuliazar Tabela" @click="atualizarTabela()">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"></path>
                    <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"></path>
                </svg>
            </button>
        </h1>
        <table class="table table-hover table-striped">
            <thead style="background: #cfe2ff;">
                <th><div class="form-group text-center">CLASSIFICAÇÃO</div></th>
                <th><div class="form-group text-center">TIMES</div></th>
                <th><div class="form-group text-center">P</div></th>
                <th><div class="form-group text-center">J</div></th>
                <th><div class="form-group text-center">V</div></th>
                <th><div class="form-group text-center">E</div></th>
                <th><div class="form-group text-center">D</div></th>
                <th><div class="form-group text-center">GP</div></th>
                <th><div class="form-group text-center">GC</div></th>
                <th><div class="form-group text-center">SG</div></th>
                <th><div class="form-group text-center">%</div></th>
                <th><div class="form-group text-center">ÚLT.JOGOS</div></th>
            </thead>
            <tbody>
                <tr class="carregandoTabela">
                    <td colspan="12">
                        <div class="d-flex justify-content-center">
                            <div class="spinner-border" role="status">
                                <span class="sr-only"></span>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr v-for="(t, key) in times">
                    <th class="text-center align-middle"
                        :style="key < 4 ? 'background: rgb(182 227 182);' : key >= 4 && key < 6 ? 'background: rgb(225 226 255);' : key >= 6 && key < 12 ? 'background: #f2e7c3;' : key > 15 ? 'background: #eccccf;' : 'background: #ffffff'">
                            {{key = key + 1}}º
                            <template v-for="api in dadosApi" v-if="api.time.time_id !== t.id"></template>
                            <template v-else>
                                <template v-if="api.variacao_posicao < 0">
                                    <small style="color: red;font-size: 8px;vertical-align: super;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" fill="currentColor" class="bi bi-box-arrow-in-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                                        </svg>
                                        {{api.variacao_posicao}}
                                    </small>
                                </template>
                                <template v-else-if="api.variacao_posicao > 0">
                                    <small style="color: green;font-size: 8px;vertical-align: super;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" fill="currentColor" class="bi bi-box-arrow-in-up" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M7.646 4.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V14.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3z"/>
                                        </svg>
                                        {{api.variacao_posicao}}
                                    </small>
                                </template>
                                <template v-else>
                                    <small style="color: gray;font-size: 8px;vertical-align: super;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" fill="currentColor" class="bi bi-square-fill" viewBox="0 0 16 16">
                                            <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2z"/>
                                        </svg>
                                        {{api.variacao_posicao}}
                                    </small>
                                </template>
                            </template>
                            <small class="d-flex justify-content-center align-items-center" style="font-size: x-small;">
                                {{key <= 4 ? 'Libertadores' : key > 4 && key <= 6 ? 'Pré-Libertadores' : key <= 12 ? 'Sulamericana' : key > 16 ? 'Rebaixamento' : ''}}
                            </small>
                    </th>
                    <td class="text-center align-middle">
                        <img :src="t.escudo" width="30px">
                        <br/>
                        <span style="font-size: xx-small;">{{t.time}}</span>
                    </td>
                    <td class="text-center align-middle" style="background: #e6e7e9;">{{t.ponto}}</td>
                    <td class="text-center align-middle">{{t.jogo}}</td>
                    <td class="text-center align-middle" style="background: #e6e7e9;">{{t.vitoria}}</td>
                    <td class="text-center align-middle">{{t.empate}}</td>
                    <td class="text-center align-middle" style="background: #e6e7e9;">{{t.derrota}}</td>
                    <td class="text-center align-middle">{{t.gols_pro}}</td>
                    <td class="text-center align-middle" style="background: #e6e7e9;">{{t.gols_contra}}</td>
                    <td class="text-center align-middle">{{t.saldo_gols}}</td>
                    <td class="text-center align-middle" style="background: #e6e7e9;">
                        {{t.ponto ? Math.floor((t.ponto * 100) / (t.jogo * 3)) : 0}}%
                    </td>
                    <td class="text-center" style="vertical-align: middle;">
                        <template v-for="api in dadosApi" v-if="api.time.time_id !== t.id"></template>
                        <template v-else v-for="u in api.ultimos_jogos">
                            <template v-if="u == 'v'">
                                <span class="badge m-1" style="width: 15px;height: 15px;background: green;">&nbsp;</span>
                            </template>
                            <template v-else-if="u == 'd'">
                                <span class="badge m-1" style="width: 15px;height: 15px;background: red;">&nbsp;</span>
                            </template>
                            <template v-else>
                                <span class="badge m-1" style="width: 15px;height: 15px;background: gray;">&nbsp;</span>
                            </template>
                        </template>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
    export default {
        data(){
            return{
                times: [],
                dadosApi:[],
            }
        },
        created(){
            this.getTimes();
            this.apiCampeonato();
        },
        methods:{
            async getTimes(){
                await fetch('http://localhost/api/v1/tabela', {
                    headers: {'Content-Type': 'application/json', 'apiKey': 'base64:ZSH1CDeccLGyEno/bMaoOmzv7JdRmQ0Bun8fVzDbHGE='}
                })
                    .then(response => response.json())
                    .then((res) => {
                        $('.carregandoTabela').addClass('d-none');
                        this.times = res
                    })
                    .catch(err => console.log('Erro ao retornar tabela!'));
            },
            async atualizarTabela(){
                $('.carregandoTabela').removeClass('d-none');
                $('.btAtualizar').addClass('d-none');

                await fetch('http://localhost/api/v1/tabela', {
                    headers: {'Content-Type': 'application/json', 'apiKey': 'base64:ZSH1CDeccLGyEno/bMaoOmzv7JdRmQ0Bun8fVzDbHGE='}
                })
                .then(response => response.json())
                .then((res) => {
                    $('.carregandoTabela').addClass('d-none');
                    $('.btAtualizar').removeClass('d-none');
                    this.times = res
                })
                .catch(err => console.log('Erro ao retornar dados atualizados da tabela!'));

                await fetch('https://api.api-futebol.com.br/v1/campeonatos/10/tabela', {
                    headers: {'Content-Type': 'application/json', 'Authorization': 'Bearer live_53fb456a4c437fd59183fb7969f78c'}
                })
                .then(response => response.json())
                .then((res) => {
                    this.dadosApi = res
                })
                .catch(err => console.log('Erro ao retornar dados da API!'));
            },
            async apiCampeonato(){
                await fetch('https://api.api-futebol.com.br/v1/campeonatos/10/tabela', {
                    headers: {'Content-Type': 'application/json', 'Authorization': 'Bearer live_53fb456a4c437fd59183fb7969f78c'}
                })
                .then(response => response.json())
                .then((res) => {
                    this.dadosApi = res
                })
                .catch(err => console.log('Erro ao retornar dados da API!'));
            }
        }
    }
</script>
