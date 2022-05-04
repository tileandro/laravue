<template>
    <div class="form-group mb-3">
        <div class="alert alert-dismissible fade show mb-3 alert-warning d-none">
            Escolha uma rodada abaixo
            <button type="button" class="btn-close" @click="closeAlert()"></button>
        </div>
        <select class="form-select" id="selecionarRodada" name="selecionarRodada" @change="selecionarRodada()">
            <option value="" selected>Escolha uma rodada</option>
            <option v-for="r in numeroRodadas" :value="r">{{r}}ª Rodada</option>
        </select>
        <div class="table-responsive mt-3">
            <table class="table table-hover table-striped">
                <thead style="background: #cfe2ff;">
                    <th><div class="form-group text-center">RODADA</div></th>
                    <th><div class="form-group text-center">TIME CASA</div></th>
                    <th><div class="form-group text-center">PLACAR CASA</div></th>
                    <th><div class="form-group text-center">X</div></th>
                    <th><div class="form-group text-center">PLACAR VISITANTE</div></th>
                    <th><div class="form-group text-center">TIME VISITANTE</div></th>
                    <th><div class="form-group text-center">ESTÁDIO</div></th>
                    <th><div class="form-group text-center">DATA</div></th>
                    <th>
                        <div class="form-group text-center">
                            <button type="button" class="btn btn-primary btn-sm cadastrarjogo d-none" @click="modalJogo()" data-name="Cadastrar jogo">
                                Cadastrar jogos
                            </button>
                        </div>
                    </th>
                </thead>
                <tbody>
                    <tr class="carregandoTabela d-none">
                        <td colspan="9">
                            <div class="d-flex justify-content-center">
                                <div class="spinner-border" role="status">
                                    <span class="sr-only"></span>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <template v-for="j in jogos" v-if="j.error == true">
                        <tr>
                            <td colspan="9" class="text-center align-middle"><b>{{j.message}}</b></td>
                        </tr>
                    </template>
                    <template v-else>
                        <tr>
                            <td class="text-center align-middle"><b>{{j.rodada}} ª</b></td>
                            <td class="text-center align-middle">
                                <template v-for="time in times" v-if="j.id_time_casa !== time.id"></template>
                                <template v-else>
                                    <img :src="time.escudo" :alt="time.time" :title="time.time" width="30px">
                                </template>
                            </td>
                            <td class="text-center align-middle">{{j.placar_time_casa}}</td>
                            <td class="text-center align-middle">X</td>
                            <td class="text-center align-middle">{{j.placar_time_fora}}</td>
                            <td class="text-center align-middle">
                                <template v-for="time in times" v-if="j.id_time_fora !== time.id"></template>
                                <template v-else>
                                    <img :src="time.escudo" :alt="time.time" :title="time.time" width="30px">
                                </template>
                            </td>
                            <td class="text-center align-middle">{{j.estadio}}</td>
                            <td class="text-center align-middle">{{format_date(j.data_jogo)}}</td>
                            <td>
                                <div class="form-group text-center">
                                    <button type="button" class="btn btn-warning btn-sm mb-1" @click="modalEditarJogo(j.id, j.rodada, j.id_time_casa, j.id_time_fora, j.estadio, j.data_jogo)" data-toggle="modal" :data-id="j.id" data-name="Editar jogo">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                        </svg>
                                    </button>
                                    <button type="button" class="btn btn-outline-secondary btn-sm mb-1 inserirPlacar" @click="modalPlacarJogo(j.id, j.id_time_casa, j.placar_time_casa, j.id_time_fora, j.placar_time_fora)" data-toggle="modal" :data-id="j.id" data-name="Placar jogo">
                                        <img src="storage/escudos/ball-1.png"/>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>

        <div class="modal fade" id="modalCriarJogos" tabindex="-1" role="dialog" aria-labelledby="modalCriarJogosLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form id="createJogo" method="post" @submit="createJogo">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalCriarJogosLabel">Cadastrar Jogos</h5>
                            <button type="button" class="close" @click="modalJogo()" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Escolha uma rodada</label>
                                    <select class="form-select" id="cadastrarRodada" name="rodada" v-model="rodada" required>
                                        <option v-for="r in numeroRodadas" :value="r">{{r}}ª Rodada</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>Estádio</label>
                                    <input type="type" class="form-control" id="estadio" name="estadio" v-model="estadio"/>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-md-6">
                                    <label>Escolha o time da casa</label>
                                    <select class="form-select" id="id_time_casa" name="id_time_casa" v-model="id_time_casa" @change="escolherTimeCasa()" required>
                                        <option v-for="time in times" :value="time.id">{{time.time}}</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>Escolha o time visitante</label>
                                    <select class="form-select" id="id_time_fora" name="id_time_fora" v-model="id_time_fora" @change="escolherTimeFora()" required>
                                        <option v-for="time in times" :value="time.id">{{time.time}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <label>Data do jogo</label>
                                <div class="col-md-3">
                                    <label>Dia</label>
                                    <select class="form-select" id="dia" name="dia" v-model="dia" required>
                                        <option v-for="d in 31" :value="d <= 9 ? '0' + d : d">{{d <= 9 ? '0' + d : d}}</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Mês</label>
                                    <select class="form-select" id="mes" name="mes" v-model="mes" required>
                                        <option value="01">Janeiro</option>
                                        <option value="02">Fevereiro</option>
                                        <option value="03">Março</option>
                                        <option value="04">Abril</option>
                                        <option value="05">Maio</option>
                                        <option value="06">Junho</option>
                                        <option value="07">Julho</option>
                                        <option value="08">Agosto</option>
                                        <option value="09">Setembro</option>
                                        <option value="10">Outubro</option>
                                        <option value="11">Novembro</option>
                                        <option value="12">Dezembro</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Hora</label>
                                    <select class="form-select" id="hora" name="hora" v-model="hora" required>
                                        <option selected value="00">00</option>
                                        <option v-for="h in 23" :value="h <= 9 ? '0' + h : h">{{h <= 9 ? '0' + h : h}}</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Minuto</label>
                                    <select class="form-select" id="minuto" name="minuto" v-model="minuto" required>
                                        <option selected value="00">00</option>
                                        <option v-for="m in 59" :value="m <= 9 ? '0' + m : m">{{m <= 9 ? '0' + m : m}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="row container col-md-12">
                                <div class="d-flex justify-content-center mt-1 cadastrandoJogo d-none">
                                    <div class="spinner-border" role="status">
                                        <span class="sr-only"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" style="text-align:right;">
                                <button type="button" class="btn btn-outline-danger" @click="modalJogo()" data-dismiss="modal">Fechar</button>
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

        <div class="modal fade" id="modalEditarJogo" tabindex="-1" role="dialog" aria-labelledby="modalEditarJogoLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form id="editJogo" @submit="editJogo">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalEditarJogoLabel">Editar Jogo</h5>
                            <button type="button" class="close" @click="modalEditarJogo()" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Escolha uma rodada</label>
                                    <select class="form-select" v-model="edit_rodada" id="edit_rodada" name="rodada" required>
                                        <option v-for="r in numeroRodadas" :value="r">{{r}}ª Rodada</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>Estádio</label>
                                    <input type="type" class="form-control" v-model="edit_estadio" id="edit_estadio" name="estadio" required/>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-md-6">
                                    <label>Escolha o time da casa</label>
                                    <select class="form-select" v-model="edit_id_time_casa" id="edit_id_time_casa" name="id_time_casa" @change="escolherEditTimeCasa()" required>
                                        <option v-for="time in times" :value="time.id">{{time.time}}</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>Escolha o time visitante</label>
                                    <select class="form-select" v-model="edit_id_time_fora" id="edit_id_time_fora" name="id_time_fora" @change="escolherEditTimeFora()" required>
                                        <option v-for="time in times" :value="time.id">{{time.time}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <label>Data do jogo</label>
                                <div class="col-md-3">
                                    <label>Dia</label>
                                    <select class="form-select" v-model="edit_dia" id="edit_dia" name="dia" required>
                                        <option v-for="d in 31" :value="d <= 9 ? '0' + d : d">{{d <= 9 ? '0' + d : d}}</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Mês</label>
                                    <select class="form-select" v-model="edit_mes" id="edit_mes" name="mes" required>
                                        <option value="01">Janeiro</option>
                                        <option value="02">Fevereiro</option>
                                        <option value="03">Março</option>
                                        <option value="04">Abril</option>
                                        <option value="05">Maio</option>
                                        <option value="06">Junho</option>
                                        <option value="07">Julho</option>
                                        <option value="08">Agosto</option>
                                        <option value="09">Setembro</option>
                                        <option value="10">Outubro</option>
                                        <option value="11">Novembro</option>
                                        <option value="12">Dezembro</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Hora</label>
                                    <select class="form-select" v-model="edit_hora" id="edit_hora" name="hora" required>
                                        <option value="00" selected>00</option>
                                        <option v-for="h in 23" :value="h <= 9 ? '0' + h : h">{{h <= 9 ? '0' + h : h}}</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Minuto</label>
                                    <select class="form-select" v-model="edit_minuto" id="edit_minuto" name="minuto" required>
                                        <option value="00" selected>00</option>
                                        <option v-for="m in 59" :value="m <= 9 ? '0' + m : m">{{m <= 9 ? '0' + m : m}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="row container col-md-12">
                                <div class="d-flex justify-content-center mt-1 editandoJogo d-none">
                                    <div class="spinner-border" role="status">
                                        <span class="sr-only"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" style="text-align:right;">
                                <button type="button" class="btn btn-outline-danger" @click="modalEditarJogo()" data-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn-outline-primary modalBtn">Salvar</button>
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

        <div class="modal fade" id="modalPlacarJogo" tabindex="-1" role="dialog" aria-labelledby="modalPlacarJogoLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form id="placarJogo" @submit="placarJogo">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalPlacarJogoLabel">
                                <template v-for="time in times" v-if="edit_id_time_casa !== time.id"></template>
                                <template v-else>
                                    <span>Placar de {{time.time}} x</span>
                                </template>
                                <template v-for="time in times" v-if="edit_id_time_fora !== time.id"></template>
                                <template v-else>
                                    <span>{{time.time}}</span>
                                </template>
                            </h5>
                            <button type="button" class="close" @click="modalPlacarJogo()" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="col-md-12">
                                        <label class="mb-1">
                                            <template v-for="time in times" v-if="edit_id_time_casa !== time.id"></template>
                                            <template v-else>
                                                <img :src="time.escudo" :alt="time.time" :title="time.time" height="30px">
                                                <span>{{time.time}}</span>
                                            </template>
                                        </label>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="number" class="form-control" v-model="edit_placar_time_casa" id="edit_placar_time_casa" name="placar_time_casa" min="0" style="text-align: center;"/>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex justify-content-center align-items-center">X</div>
                                <div class="col-md-5">
                                    <div class="col-md-12">
                                        <label class="mb-1" style="text-align:right;display: block;">
                                            <template v-for="time in times" v-if="edit_id_time_fora !== time.id"></template>
                                            <template v-else>
                                                <span>{{time.time}}</span>
                                                <img :src="time.escudo" :alt="time.time" :title="time.time" height="30px">
                                            </template>
                                        </label>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="number" class="form-control" v-model="edit_placar_time_fora" id="edit_placar_time_fora" name="placar_time_fora" min="0" style="text-align: center;"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="row container col-md-12">
                                <div class="d-flex justify-content-center mt-1 placarJogo d-none">
                                    <div class="spinner-border" role="status">
                                        <span class="sr-only"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" style="text-align:right;">
                                <button type="button" class="btn btn-outline-danger" @click="modalPlacarJogo()" data-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn-outline-primary modalBtn">Salvar</button>
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
    import moment  from 'moment'
    moment.locale('pt-br')
    export default {
        data(){
            return{
                jogos: [],
                times:[],
                numeroRodadas: 38,
                rodada: null,
                id_time_casa: null,
                placar_time_casa: null,
                id_time_fora: null,
                placar_time_fora: null,
                estadio: null,
                data_jogo: null,
                dia: null,
                mes: null,
                ano: null,
                hora: null,
                minuto: null,
                edit_id: null,
                edit_rodada: null,
                edit_id_time_casa: null,
                edit_placar_time_casa: null,
                edit_id_time_fora: null,
                edit_placar_time_fora: null,
                edit_estadio: null,
                edit_dia: null,
                edit_mes: null,
                edit_ano: null,
                edit_hora: null,
                edit_minuto: null,
                msg: null,
                classe: null,
                id_casa: null,
                id_fora: null,
                placar_casa: null,
                placar_fora: null,
                edit_id_casa: null,
                edit_id_fora: null,
                edit_placar_casa: null,
                edit_placar_fora: null,
                ponto_casa: null,
                jogo_casa: null,
                vitoria_casa: null,
                empate_casa: null,
                derrota_casa: null,
                ponto_fora: null,
                jogo_fora: null,
                vitoria_fora: null,
                empate_fora: null,
                derrota_fora: null,
                time_casa: null,
                time_fora: null,
                gols_pro_casa: null,
                gols_contra_casa: null,
                saldo_gols_casa: null,
                gols_pro_fora: null,
                gols_contra_fora: null,
                saldo_gols_fora: null,
            }
        },
        created(){},
        methods:{
            closeAlert(){
                $('.alert-warning').addClass('d-none');
            },
            escolherTimeCasa(){
                this.time_casa = $( "#id_time_casa option:selected" ).text();
            },
            escolherTimeFora(){
                this.time_fora = $( "#id_time_fora option:selected" ).text();
            },
            escolherEditTimeCasa(){
                this.edit_time_casa = $( "#edit_id_time_casa option:selected" ).text();
            },
            escolherEditTimeFora(){
                this.edit_time_fora = $( "#edit_id_time_fora option:selected" ).text();
            },
            async selecionarRodada(){
                if(selecionarRodada.value !== ""){
                    $('.carregandoTabela, .cadastrarjogo').removeClass('d-none');
                    await fetch('http://localhost/api/v1/rodadas/' + selecionarRodada.value, {
                        headers: {'Content-Type': 'application/json', 'apiKey': 'base64:ZSH1CDeccLGyEno/bMaoOmzv7JdRmQ0Bun8fVzDbHGE='}
                    })
                        .then(response => response.json())
                        .then((res) => {
                            $('.carregandoTabela').addClass('d-none');
                            this.jogos = res
                        })

                    await fetch('http://localhost/api/v1/tabela', {
                        headers: {'Content-Type': 'application/json', 'apiKey': 'base64:ZSH1CDeccLGyEno/bMaoOmzv7JdRmQ0Bun8fVzDbHGE='}
                    })
                        .then(response => response.json())
                        .then((res) => {
                            this.times = res
                        })
                }
                else{
                    $('.alert-warning').removeClass('d-none')
                    $('.cadastrarjogo').addClass('d-none')
                }
            },

            async modalJogo(){
                $('#modalCriarJogos').modal('toggle');
                $('.btn-close, .close, .modal-open').click(function(){
                    $('.alert').hide();
                })
                $('.alert').hide();
                this.rodada = selecionarRodada.value;
                await fetch('http://localhost/api/v1/tabela', {
                    headers: {'Content-Type': 'application/json', 'apiKey': 'base64:ZSH1CDeccLGyEno/bMaoOmzv7JdRmQ0Bun8fVzDbHGE='}
                })
                .then(response => {
                    const data = response.json();
                    // check for error response
                    if (!response.ok) {
                        $('.cadastrandoJogo').addClass('d-none');
                        $('.alert').show();
                        this.classe = "danger",
                        this.msg = "Erro ao listar dados de cadastro!"
                        // get error message from body or default to response statusText
                        const error = (data && data.message) || response.statusText;
                        return Promise.reject(error);
                    }
                    //console.log(data);
                })
            },
            createJogo(e){
                e.preventDefault();
                $('.cadastrandoJogo').removeClass('d-none');
                const create = {
                    rodada: this.rodada,
                    id_time_casa: this.id_time_casa,
                    id_time_fora: this.id_time_fora,
                    estadio: this.estadio,
                    data_jogo: '2022-' + this.mes + '-' + this.dia + ' ' + this.hora + ':' + this.minuto + ':00'
                }

                const createJson = JSON.stringify(create);
                fetch('http://localhost/api/v1/rodadas', {
                    headers: {'Content-Type': 'application/json', 'apiKey': 'base64:ZSH1CDeccLGyEno/bMaoOmzv7JdRmQ0Bun8fVzDbHGE='},
                    method: "POST",
                    body: createJson
                })

                .then(response => {
                    const data = response.json();
                    // check for error response
                    if (!response.ok) {
                        $('.cadastrandoJogo').addClass('d-none');
                        $('.alert').show();
                        this.classe = "danger",
                        this.msg = "Erro ao realizar cadastro!"
                        // get error message from body or default to response statusText
                        const error = (data && data.message) || response.statusText;
                        return Promise.reject(error);
                    }
                    //console.log(data);
                    $('.cadastrandoJogo').addClass('d-none');
                    this.selecionarRodada();
                    this.id_time_casa = null;
                    this.id_time_fora = null;
                    this.estadio = null;
                    $('.alert').show();
                    this.classe = "success",
                    this.msg = this.time_casa + " x " + this.time_fora + " cadastrado com sucesso!"
                })
            },

            modalEditarJogo(id, rodada, id_time_casa, id_time_fora, estadio, data_jogo){
                $('#modalEditarJogo').modal('toggle');
                $('.alert').hide();
                $('.btn-close, .close, .modal-open').click(function(){
                    $('.alert').hide();
                })

                this.edit_id = id;
                this.edit_rodada = rodada;
                this.edit_id_time_casa = id_time_casa;
                this.edit_id_time_fora = id_time_fora;
                this.edit_estadio = estadio;
                if(data_jogo){
                    const dataCompleta = data_jogo.split('-');
                    this.edit_mes = dataCompleta[1];
                    const diaHora = dataCompleta[2].split(' ');
                    this.edit_dia = diaHora[0];
                    const horaMinuto = diaHora[1].split(':');
                    this.edit_hora = horaMinuto[0];
                    this.edit_minuto = horaMinuto[1];
                    $('#modalEditarJogo #edit_rodada').val(rodada);
                    $('#modalEditarJogo #edit_id_time_casa').val(id_time_casa);
                    $('#modalEditarJogo #edit_id_time_fora').val(id_time_fora);
                    $('#modalEditarJogo #edit_estadio').val(estadio);
                    $('#modalEditarJogo #edit_mes').val(this.edit_mes);
                    $('#modalEditarJogo #edit_dia').val(this.edit_dia);
                    $('#modalEditarJogo #edit_hora').val(this.edit_hora);
                    $('#modalEditarJogo #edit_minuto').val(this.edit_minuto);
                }
            },
            async editJogo(e){
                e.preventDefault();
                $('.editandoJogo').removeClass('d-none');
                const edit = {
                    rodada: this.edit_rodada,
                    id_time_casa: this.edit_id_time_casa,
                    id_time_fora: this.edit_id_time_fora,
                    estadio: this.edit_estadio,
                    data_jogo: '2022-' + this.edit_mes + '-' + this.edit_dia + ' ' + this.edit_hora + ':' + this.edit_minuto + ':00'
                }

                const editJson = JSON.stringify(edit);
                await fetch('http://localhost/api/v1/rodadas/' + this.edit_id, {
                    headers: {'Content-Type': 'application/json', 'apiKey': 'base64:ZSH1CDeccLGyEno/bMaoOmzv7JdRmQ0Bun8fVzDbHGE='},
                    method: "PUT",
                    body: editJson
                })

                .then(response => {
                    const data = response.json();
                    // check for error response
                    if (!response.ok) {
                        $('.editandoJogo').addClass('d-none');
                        $('.alert').show();
                        this.classe = "danger",
                        this.msg = "Erro ao realizar edição! "
                        // get error message from body or default to response statusText
                        const error = (data && data.message) || response.statusText;
                        return Promise.reject(error);
                    }
                    $('.editandoJogo').addClass('d-none');
                    $('.alert').show();
                    this.selecionarRodada();
                    this.classe = "success",
                    this.edit_time_casa = $( "#edit_id_time_casa option:selected" ).text();
                    this.edit_time_fora = $( "#edit_id_time_fora option:selected" ).text();
                    this.msg = this.edit_time_casa + " x " + this.edit_time_fora + " editado com sucesso!"
                })
            },

            modalPlacarJogo(id, id_time_casa, placar_time_casa, id_time_fora, placar_time_fora){
                $('#modalPlacarJogo').modal('toggle');
                $('.btn-close, .close, .modal-open').click(function(){
                    $('.alert').hide();
                })

                this.edit_id = id;
                this.edit_id_time_casa = id_time_casa;
                this.edit_placar_time_casa = placar_time_casa;
                this.edit_id_time_fora = id_time_fora;
                this.edit_placar_time_fora = placar_time_fora;
                $('#modalEditarJogo #edit_id_time_casa').val(id_time_casa);
                $('#modalEditarJogo #edit_placar_time_casa').val(placar_time_casa);
                $('#modalEditarJogo #edit_id_time_fora').val(id_time_fora);
                $('#modalEditarJogo #edit_placar_time_fora').val(placar_time_fora);
            },

            async placarJogo(e){
                e.preventDefault();
                $('.placarJogo').removeClass('d-none');
                $('.inserirPlacar').addClass('d-none');
                const placar = {
                    id: this.edit_id,
                    placar_time_casa: this.edit_placar_time_casa,
                    placar_time_fora: this.edit_placar_time_fora,
                }

                const placarJson = JSON.stringify(placar);
                await fetch('http://localhost/api/v1/rodadas/' + this.edit_id, {
                    headers: {'Content-Type': 'application/json', 'apiKey': 'base64:ZSH1CDeccLGyEno/bMaoOmzv7JdRmQ0Bun8fVzDbHGE='},
                    method: "PUT",
                    body: placarJson
                })

                .then(response => {
                    const data = response.json();
                    // check for error response
                    if (!response.ok) {
                        $('.placarJogo').addClass('d-none');
                        $('.alert').show();
                        this.classe = "danger",
                        this.msg = "Erro ao inserir placar! "
                        // get error message from body or default to response statusText
                        const error = (data && data.message) || response.statusText;
                        return Promise.reject(error);
                    }

                    if(this.edit_placar_time_casa > this.edit_placar_time_fora){
                        fetch('http://localhost/api/v1/times/' + this.edit_id_time_casa, {
                            headers: {'Content-Type': 'application/json', 'apiKey': 'base64:ZSH1CDeccLGyEno/bMaoOmzv7JdRmQ0Bun8fVzDbHGE='}
                        })
                        .then(response => response.json())
                        .then((res) => {
                            this.ponto_casa = res[0].ponto;
                            this.jogo_casa = res[0].jogo;
                            this.vitoria_casa = res[0].vitoria;
                            this.empate_casa = res[0].empate;
                            this.derrota_casa = res[0].derrota;

                            const updateCasa = {
                                ponto: this.ponto_casa + 3,
                                jogo: this.jogo_casa + 1,
                                vitoria: this.vitoria_casa + 1
                            }
                            const updateJsonCasa = JSON.stringify(updateCasa);
                            fetch('http://localhost/api/v1/times/' + res[0].id, {
                                headers: {'Content-Type': 'application/json', 'apiKey': 'base64:ZSH1CDeccLGyEno/bMaoOmzv7JdRmQ0Bun8fVzDbHGE='},
                                method: 'PUT',
                                body: updateJsonCasa
                            })
                                .then(response => response.json())
                                .then((res) => {
                                })
                        })

                        fetch('http://localhost/api/v1/times/' + this.edit_id_time_fora, {
                            headers: {'Content-Type': 'application/json', 'apiKey': 'base64:ZSH1CDeccLGyEno/bMaoOmzv7JdRmQ0Bun8fVzDbHGE='}
                        })
                        .then(response => response.json())
                        .then((res) => {
                            this.ponto_fora = res[0].ponto;
                            this.jogo_fora = res[0].jogo;
                            this.vitoria_fora = res[0].vitoria;
                            this.empate_fora = res[0].empate;
                            this.derrota_fora = res[0].derrota;
                            this.time_fora = res[0].time;

                            const updateFora = {
                                jogo: this.jogo_fora + 1,
                                derrota: this.derrota_fora + 1
                            }
                            const updateJsonFora = JSON.stringify(updateFora);
                            fetch('http://localhost/api/v1/times/' + res[0].id, {
                                headers: {'Content-Type': 'application/json', 'apiKey': 'base64:ZSH1CDeccLGyEno/bMaoOmzv7JdRmQ0Bun8fVzDbHGE='},
                                method: 'PUT',
                                body: updateJsonFora
                            })
                            .then(response => response.json())
                            .then((res) => {
                            })
                        })
                    }
                    if(this.edit_placar_time_casa < this.edit_placar_time_fora){
                        fetch('http://localhost/api/v1/times/' + this.edit_id_time_casa, {
                            headers: {'Content-Type': 'application/json', 'apiKey': 'base64:ZSH1CDeccLGyEno/bMaoOmzv7JdRmQ0Bun8fVzDbHGE='}
                        })
                        .then(response => response.json())
                        .then((res) => {
                            this.ponto_casa = res[0].ponto;
                            this.jogo_casa = res[0].jogo;
                            this.vitoria_casa = res[0].vitoria;
                            this.empate_casa = res[0].empate;
                            this.derrota_casa = res[0].derrota;
                            this.time_casa = res[0].time;

                            const updateCasa = {
                                jogo: this.jogo_casa + 1,
                                derrota: this.derrota_casa + 1
                            }
                            const updateJsonCasa = JSON.stringify(updateCasa);
                            fetch('http://localhost/api/v1/times/' + res[0].id, {
                                headers: {'Content-Type': 'application/json', 'apiKey': 'base64:ZSH1CDeccLGyEno/bMaoOmzv7JdRmQ0Bun8fVzDbHGE='},
                                method: 'PUT',
                                body: updateJsonCasa
                            })
                                .then(response => response.json())
                                .then((res) => {
                                })
                        })

                        fetch('http://localhost/api/v1/times/' + this.edit_id_time_fora, {
                            headers: {'Content-Type': 'application/json', 'apiKey': 'base64:ZSH1CDeccLGyEno/bMaoOmzv7JdRmQ0Bun8fVzDbHGE='}
                        })
                        .then(response => response.json())
                        .then((res) => {
                            this.ponto_fora = res[0].ponto;
                            this.jogo_fora = res[0].jogo;
                            this.vitoria_fora = res[0].vitoria;
                            this.empate_fora = res[0].empate;
                            this.derrota_fora = res[0].derrota;
                            this.time_fora = res[0].time;

                            const updateFora = {
                                ponto: this.ponto_fora + 3,
                                jogo: this.jogo_fora + 1,
                                vitoria: this.vitoria_fora + 1
                            }
                            const updateJsonFora = JSON.stringify(updateFora);
                            fetch('http://localhost/api/v1/times/' + res[0].id, {
                                headers: {'Content-Type': 'application/json', 'apiKey': 'base64:ZSH1CDeccLGyEno/bMaoOmzv7JdRmQ0Bun8fVzDbHGE='},
                                method: 'PUT',
                                body: updateJsonFora
                            })
                            .then(response => response.json())
                            .then((res) => {
                            })
                        })
                    }
                    if(this.edit_placar_time_casa == this.edit_placar_time_fora){
                        fetch('http://localhost/api/v1/times/' + this.edit_id_time_casa, {
                            headers: {'Content-Type': 'application/json', 'apiKey': 'base64:ZSH1CDeccLGyEno/bMaoOmzv7JdRmQ0Bun8fVzDbHGE='}
                        })
                        .then(response => response.json())
                        .then((res) => {
                            this.ponto_casa = res[0].ponto;
                            this.jogo_casa = res[0].jogo;
                            this.vitoria_casa = res[0].vitoria;
                            this.empate_casa = res[0].empate;
                            this.derrota_casa = res[0].derrota;
                            this.time_casa = res[0].time;

                            const updateCasa = {
                                ponto: this.ponto_casa + 1,
                                jogo: this.jogo_casa + 1,
                                empate: this.empate_casa + 1
                            }
                            const updateJsonCasa = JSON.stringify(updateCasa);
                            fetch('http://localhost/api/v1/times/' + res[0].id, {
                                headers: {'Content-Type': 'application/json', 'apiKey': 'base64:ZSH1CDeccLGyEno/bMaoOmzv7JdRmQ0Bun8fVzDbHGE='},
                                method: 'PUT',
                                body: updateJsonCasa
                            })
                                .then(response => response.json())
                                .then((res) => {
                                })
                        })

                        fetch('http://localhost/api/v1/times/' + this.edit_id_time_fora, {
                            headers: {'Content-Type': 'application/json', 'apiKey': 'base64:ZSH1CDeccLGyEno/bMaoOmzv7JdRmQ0Bun8fVzDbHGE='}
                        })
                        .then(response => response.json())
                        .then((res) => {
                            this.ponto_fora = res[0].ponto;
                            this.jogo_fora = res[0].jogo;
                            this.vitoria_fora = res[0].vitoria;
                            this.empate_fora = res[0].empate;
                            this.derrota_fora = res[0].derrota;
                            this.time_fora = res[0].time;

                            const updateFora = {
                                ponto: this.ponto_fora + 1,
                                jogo: this.jogo_fora + 1,
                                empate: this.empate_fora + 1
                            }
                            const updateJsonFora = JSON.stringify(updateFora);
                            fetch('http://localhost/api/v1/times/' + res[0].id, {
                                headers: {'Content-Type': 'application/json', 'apiKey': 'base64:ZSH1CDeccLGyEno/bMaoOmzv7JdRmQ0Bun8fVzDbHGE='},
                                method: 'PUT',
                                body: updateJsonFora
                            })
                            .then(response => response.json())
                            .then((res) => {
                            })
                        })
                    }

                    //Gols Pro, contra e saldo de gols time da casa
                    fetch('http://localhost/api/v1/times/' + this.edit_id_time_casa, {
                        headers: {'Content-Type': 'application/json', 'apiKey': 'base64:ZSH1CDeccLGyEno/bMaoOmzv7JdRmQ0Bun8fVzDbHGE='}
                    })
                    .then(response => response.json())
                    .then((res) => {
                        this.gols_pro_casa = res[0].gols_pro;
                        this.gols_contra_casa = res[0].gols_contra;
                        this.saldo_gols_casa = res[0].saldo_gols;

                        const updateGolsCasa = {
                            gols_pro: (parseInt(this.gols_pro_casa) + parseInt(this.edit_placar_time_casa)),
                            gols_contra: (parseInt(this.gols_contra_casa) + parseInt(this.edit_placar_time_fora)),
                            saldo_gols: (parseInt(this.gols_pro_casa) + parseInt(this.edit_placar_time_casa)) - (this.gols_contra_casa + parseInt(this.edit_placar_time_fora))
                        }
console.log('Time da casa ')
console.log(updateGolsCasa)
                        const updateJsonGolsCasa = JSON.stringify(updateGolsCasa);
                        fetch('http://localhost/api/v1/times/' + this.edit_id_time_casa, {
                            headers: {'Content-Type': 'application/json', 'apiKey': 'base64:ZSH1CDeccLGyEno/bMaoOmzv7JdRmQ0Bun8fVzDbHGE='},
                            method: 'PUT',
                            body: updateJsonGolsCasa
                        })
                        .then(response => response.json())
                        .then((res) => {
                            $('.inserirPlacar').removeClass('d-none');
                        })
                    })

                    //Gols Pro, contra e saldo de gols time visitante
                    fetch('http://localhost/api/v1/times/' + this.edit_id_time_fora, {
                        headers: {'Content-Type': 'application/json', 'apiKey': 'base64:ZSH1CDeccLGyEno/bMaoOmzv7JdRmQ0Bun8fVzDbHGE='}
                    })
                    .then(response => response.json())
                    .then((res) => {
                        this.gols_pro_fora = res[0].gols_pro;
                        this.gols_contra_fora = res[0].gols_contra;
                        this.saldo_gols_fora = res[0].saldo_gols;

                        const updateGolsFora = {
                            gols_pro: (parseInt(this.gols_pro_fora) + parseInt(this.edit_placar_time_fora)),
                            gols_contra: (parseInt(this.gols_contra_fora) + parseInt(this.edit_placar_time_casa)),
                            saldo_gols: (parseInt(this.gols_pro_fora) + parseInt(this.edit_placar_time_fora)) - (this.gols_contra_fora + parseInt(this.edit_placar_time_casa))
                        }
console.log('Time visitante ')
console.log(updateGolsFora)
                        const updateJsonGolsFora = JSON.stringify(updateGolsFora);
                        fetch('http://localhost/api/v1/times/' + this.edit_id_time_fora, {
                            headers: {'Content-Type': 'application/json', 'apiKey': 'base64:ZSH1CDeccLGyEno/bMaoOmzv7JdRmQ0Bun8fVzDbHGE='},
                            method: 'PUT',
                            body: updateJsonGolsFora
                        })
                        .then(response => response.json())
                        .then((res) => {
                            $('.inserirPlacar').removeClass('d-none');
                        })
                    })

                    $('.placarJogo').addClass('d-none');
                    this.selecionarRodada();
                    $('.alert').show();
                    this.classe = "success",
                    this.edit_time_casa = $( "#edit_id_time_casa option:selected" ).text();
                    this.edit_time_fora = $( "#edit_id_time_fora option:selected" ).text();
                    this.msg = "Placar " + this.edit_time_casa + " x " + this.edit_time_fora + " inserido com sucesso!",
                    this.edit_placar_casa = null,
                    this.edit_placar_fora = null
                });
            },

            format_date(value){
                if (value) {
                return moment(String(value)).format('ddd DD/MM HH:mm')
                }
            }
        },
    }

</script>
