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
                <th><div class="form-group">Pontos</div></th>
                <th><div class="form-group">Jogos</div></th>
                <th><div class="form-group">Vitórias</div></th>
                <th><div class="form-group">Empates</div></th>
                <th><div class="form-group">Derrotas</div></th>
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
                    <td style="vertical-align: middle;text-align: center;">
                        <img :src="t.escudo" width="30px">
                        <br/>
                        <span style="font-size: xx-small;">{{t.time}}</span>
                    </td>
                    <td style="vertical-align: middle;">{{t.ponto}}</td>
                    <td style="vertical-align: middle;">{{t.jogo}}</td>
                    <td style="vertical-align: middle;">{{t.vitoria}}</td>
                    <td style="vertical-align: middle;">{{t.empate}}</td>
                    <td style="vertical-align: middle;">{{t.derrota}}</td>
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
