<template>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <th class="d-flex justify-content-center align-items-center">
                    <div class="form-group">
                        <button type="button" class="btn btn-outline-primary btn-sm btAtualizar" alt="Atuliazar Tabela" title="Atuliazar Tabela" @click="atualizarTabela()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"></path>
                                <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"></path>
                            </svg>
                        </button>
                        <div class="atualizarTabela d-none">
                            <div class="spinner-border" role="status">
                                <span class="sr-only"></span>
                            </div>
                        </div>
                    </div>
                </th>
                <th><div class="form-group" style="text-align: center;">Times</div></th>
                <th><div class="form-group" style="text-align: center;">Pontos</div></th>
                <th><div class="form-group" style="text-align: center;">Jogos</div></th>
                <th><div class="form-group" style="text-align: center;">Vitórias</div></th>
                <th><div class="form-group" style="text-align: center;">Empates</div></th>
                <th><div class="form-group" style="text-align: center;">Derrotas</div></th>
                <th class="d-flex justify-content-center align-items-center">
                    <div class="form-group">
                        <button type="button" class="btn btn-primary btn-sm btAtualizar" alt="Atuliazar Tabela" title="Atuliazar Tabela" @click="atualizarTabela()">
                            <i class="bi bi-plus-circle"></i> Cadastrar time
                        </button>
                    </div>
                </th>
            </thead>
            <tbody>
                <tr v-for="(t, key) in times">
                    <th style="vertical-align: middle;text-align: center;"
                        :class="key < 4 ? 'table-primary' : key >= 4 && key < 6 ? 'table-info' : key >= 6 && key < 12 ? 'table-warning' : key > 15 ? 'table-danger' : ''">
                            {{key = key + 1}}º
                            <small class="d-flex justify-content-center align-items-center" style="font-size: x-small;">
                                {{key <= 4 ? 'Libertadores' : key > 4 && key <= 6 ? 'Pré-Libertadores' : key <= 12 ? 'Sulamericana' : key > 16 ? 'Rebaixamento' : ''}}
                            </small>
                    </th>
                    <td style="vertical-align: middle;text-align:center">
                        <img :src="t.escudo" width="30px">
                        <br/>
                        <span style="font-size: xx-small;">{{t.time}}</span>
                    </td>
                    <td style="vertical-align: middle;text-align:center">{{t.ponto}}</td>
                    <td style="vertical-align: middle;text-align:center">{{t.jogo}}</td>
                    <td style="vertical-align: middle;text-align:center">{{t.vitoria}}</td>
                    <td style="vertical-align: middle;text-align:center">{{t.empate}}</td>
                    <td style="vertical-align: middle;text-align:center">{{t.derrota}}</td>
                    <td style="vertical-align: middle;text-align:center">
                        <div class="form-group d-flex justify-content-center align-items-center">
                            <button type="button" class="btn btn-warning btn-sm m-1" alt="Excluir time" title="Excluir time" @click="atualizarTabela()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                </svg>
                            </button>
                            <button type="button" class="btn btn-danger btn-sm m-1" alt="Editar time" title="Editar time" @click="atualizarTabela()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                </svg>
                            </button>
                        </div>
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
            }
        },
        created(){
            this.getTimes();
        },
        methods:{
            getTimes(){
                fetch('http://localhost/api/v1/tabela', {
                    headers: {'Content-Type': 'application/json', 'apiKey': 'base64:ZSH1CDeccLGyEno/bMaoOmzv7JdRmQ0Bun8fVzDbHGE='}
                })
                    .then(response => response.json())
                    .then((res) => {
                        $('.carregandoTabela').addClass('d-none');
                        this.times = res
                    })
            },
            atualizarTabela(){
                $('.atualizarTabela').removeClass('d-none');
                $('.btAtualizar').addClass('d-none');

                fetch('http://localhost/api/v1/tabela', {
                    headers: {'Content-Type': 'application/json', 'apiKey': 'base64:ZSH1CDeccLGyEno/bMaoOmzv7JdRmQ0Bun8fVzDbHGE='}
                })
                .then(response => response.json())
                .then((res) => {
                    $('.atualizarTabela').addClass('d-none');
                    $('.btAtualizar').removeClass('d-none');
                    this.times = res
                })
            }
        }
    }
</script>
