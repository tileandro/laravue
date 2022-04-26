<template>
    <div class="table-responsive">
        <h1>
            Times
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
                <th>
                    <div class="form-group text-center">
                        <button type="button" class="btn btn-primary btn-sm btAtualizar" alt="Atuliazar Tabela" title="Atuliazar Tabela" @click="modalCadastrarTime()">
                            <i class="bi bi-plus-circle"></i> Cadastrar time
                        </button>
                    </div>
                </th>
            </thead>
            <tbody>
                <tr class="carregandoTabela">
                    <td colspan="13">
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
                    <td class="text-center align-middle">
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
                    <td class="text-center align-middle" style="background: #e6e7e9;">
                        <div class="form-group d-flex justify-content-center align-items-center">
                            <button type="button" class="btn btn-warning btn-sm m-1" alt="Editar time" title="Editar time" @click="atualizarTabela()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="modal fade" id="modalCadastrarTime" tabindex="-1" role="dialog" aria-labelledby="modalCadastrarTimeLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form id="createTime" enctype="multipart/form-data" @submit="createTime">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalCadastrarTimeLabel">Cadastrar Time</h5>
                            <button type="button" class="close" @click="modalCadastrarTime()" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="text" class="form-control" id="time" name="time" v-model="time" required>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label for="escudo">Escudo do time</label>
                                    <br/>
                                    <input type="file" class="form-control-file" id="escudo" name="escudo" @change="handleFileUpload" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="row container col-md-12">
                                <div class="d-flex justify-content-center mt-1 carregarTime d-none">
                                    <div class="spinner-border" role="status">
                                        <span class="sr-only"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" style="text-align:right;">
                                <button type="button" class="btn btn-outline-danger" @click="modalCadastrarTime()" data-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn-outline-primary modalBtn">Cadastrar</button>
                            </div>
                            <div class="row container col-md-12">
                                <div :class="'alert alert-dismissible fade show mb-3 alert-' + classe" v-show="msg" role="alert'">
                                    {{msg}}
                                    <button type="button" class="btn-close"></button>
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
    import axios from 'axios';
    export default {
        data(){
            return{
                times: [],
                dadosApi:[],
                msg: null,
                classe: null,
                time: null,
                escudo: null,
                file: null,
                size: null,
                type: null
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
            },
            async modalCadastrarTime(){
                $('#modalCadastrarTime').modal('toggle');
                this.getTimes();
                $('.btn-close, .close, .modal-open').click(function(){
                    $('.alert').hide();
                })
                $('.alert').hide();
            },
            handleFileUpload( e ){
                $('.alert').hide();
                this.file = e.target.files[0];
                this.size = e.target.files[0].size;
                this.type = e.target.files[0].type;
                if(this.type !== 'image/png' && this.type !== 'image/jpg' && this.type !== 'image/jpeg'){
                    $('.alert').show();
                    this.classe = "danger";
                    this.msg = 'Arquivo não permitido, arquivos de imagens permitidos (png, jpg ou jpeg)';
                    $('#escudo').val('')
                }
                if(this.size > 200000){
                    $('.alert').show();
                    this.classe = "danger";
                    this.msg = 'Imagem não pode ser maior que 200KB';
                    $('#escudo').val('')
                }
            },
            async createTime(e){
                e.preventDefault();
                $('.carregarTime').removeClass('d-none');
                let formData = new FormData();
                formData.append('time', this.time)
                formData.append('escudo', this.file)
                axios.post('http://localhost/api/v1/times', formData,{
                    headers: {
                        'apiKey': 'base64:ZSH1CDeccLGyEno/bMaoOmzv7JdRmQ0Bun8fVzDbHGE='
                    },
                })
                .then(res=>{
                    $('.carregarTime').addClass('d-none');
                    this.atualizarTabela();
                    $('.alert').show();
                    this.classe = "success",
                    this.msg = this.time + " cadastrado com sucesso!",
                    $('#time').val('');
                    this.size = null,
                    this.type = null
                })
                .catch(err=>{
                    $('.carregarTime').addClass('d-none');
                    $('.alert').show();
                    this.classe = "danger",
                    this.msg = "Erro ao realizar cadastro!"
                })
            }
        }
    }
</script>
