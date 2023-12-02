<template>

    <div class="Mycard">
        <div class="tabela">
            <!-- MODAL INSERIR -->
            <div v-if="modalShow">
                <transition name="modal">
                    <div class="modal-mask">
                        <div class="modal-wrapper">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Adicionar Pessoas</h5>
                                    </div>
                                    <div class="modal-body">
                                        <label class="">
                                            Nome:
                                            <input type="text" name="name" class="form-control"
                                                placeholder="Digite seu nome" v-model.trim="pessoa.nome">
                                        </label>
                                        <label class="">
                                            CPF:
                                            <input type="text" name=" " class="form-control"
                                                placeholder="Digite seu CPF" v-model.trim="pessoa.cpf">
                                        </label>
                                        <label class="">
                                            RG:
                                            <input type="text" name=" " class="form-control" placeholder="Digite seu RG"
                                                v-model.trim="pessoa.rg">
                                        </label>
                                        <label class="">
                                            Data de nascimento:
                                            <input type="text" name=" " class="form-control" placeholder="dd/MM/yyyy"
                                                v-model.trim="pessoa.data_nasc">
                                        </label>
                                        <label class="">
                                            sexo:
                                            <input type="text" name=" " class="form-control"
                                                placeholder="digite seu sexo" v-model.trim="pessoa.sexo">
                                        </label>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            @click="modalShow = false">Fechar</button>
                                        <button @click="Inserir()" type="button"
                                            class="btn btn-primary">Adicionar novo</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </transition>
            </div>



            <div class="d-flex justify-content-between">
                <p>

                    <strong class="tamanholetras">{{ nometabela }}</strong>
                    <span class="badge bg-primary bhh">{{ Itemsfiltrados.length }}</span>
                </p>

                <div class="botoes">
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group left-inner-addon">
                                <i class="bi bi-search"></i>
                                <input type="search" class="form-control" placeholder="Pesquisar por RG"
                                    v-model="rgprocura">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group left-inner-addon">
                                <i class="bi bi-search"></i>
                                <input type="search" class="form-control" placeholder="Pesquisar por CPF"
                                    v-model="cpfprocura">
                            </div>
                        </div>
                    </div>
                </div>

                <button @click="modalShow = true" class="btn btn-primary">Adicionar Pessoas</button>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>RG</th>
                        <th>Sexo</th>
                        <th>data_nasc</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                    <tr v-for="(user, i) in Itemsfiltrados" :key="user.id">
                        <td>{{ i + 1 }}</td>
                        <td>{{ user.nome }}</td>
                        <td>{{ user.cpf }}</td>
                        <td>{{ user.rg }}</td>
                        <td>{{ user.sexo }}</td>
                        <td>{{ user.data_nasc }}</td>
                        <td class="botoes">
                            <button @click="Deletar(user.id)" class="btn btn-danger">Deletar</button>
                            <button @click="AbrirModal(user.id)" class="btn btn-primary">Editar</button>
                        </td>
                    </tr>
                </tbody>

                <!-- MODAL UPDATE -->
                <div v-if="modalShow1">                    
                        <transition name="modal">
                            <div class="modal-mask">
                                <div class="modal-wrapper">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Atualizar Pessoa</h5>
                                            </div>
                                            <div class="modal-body">
                                                <label class="">
                                                    Nome:
                                                    <input type="text" class="form-control" v-model="pessoaAtualizar.nome">
                                                </label>
                                                <label class="">
                                                    CPF:
                                                    <input type="text" class="form-control" v-model.trim="pessoaAtualizar.cpf">
                                                </label>
                                                <label class="">
                                                    RG:
                                                    <input type="text" class="form-control" v-model.trim="pessoaAtualizar.rg">
                                                </label>
                                                <label class="">
                                                    Data de nascimento:
                                                    <input type="text" class="form-control" v-model.trim="pessoaAtualizar.data_nasc">
                                                </label>
                                                <label class="">
                                                    sexo:
                                                    <input type="text" class="form-control" v-model.trim="pessoaAtualizar.sexo">
                                                </label>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    @click="modalShow1 = false">Fechar</button>
                                                <button @click.prevent="Atualiazar(pessoaAtualizar.id)" type="button"
                                                    class="btn btn-primary">Salvar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </transition>                   
                </div>


            </table>
        </div>

    </div>

</template>

<!-- _______________________SCRIPT__________________________ --> 
 
<script>
import axios from 'axios';

export default {

    name: 'DashBoard', // exporta o componente   

    data() {
        return {
            modalShow: false,
            modalShow1: false,
            filtrados: [],
            cpfprocura: "",
            rgprocura: "",            
            

            pessoa: {
                nome: "",
                cpf: "",
                rg: "",
                data_nasc: "",
                sexo: "",
            },

            // variaveis do modal editar, o ideal seria criar o modal como componente e passar as props do v-for
            pessoaAtualizar: {
                nome: "",
                cpf: "",
                rg: "",
                data_nasc: "",
                sexo: "",
            },

        }
    },

    props: {
        objeto: {},
        nometabela: String,       

    },

    // FILTRO com computed 
    computed: {
        Itemsfiltrados() {
            let valores = [];
            valores = this.objeto.filter((item) => {
                return (
                    item.rg.toLowerCase().indexOf(this.rgprocura.toLowerCase()) > -1 &&
                    item.cpf.toLowerCase().indexOf(this.cpfprocura.toLowerCase()) > -1
                );
            });
            return valores;
        }
    },


    methods: {
        // Faz uma requisição rest e pega os dados do id que for passado e abre o modal
        AbrirModal(id) {
            this.modalShow1 = true;
            axios.get('/pessoa/achaum/'+id)
            .then(response=>{
                if (response.status == 200){
                    this.pessoaAtualizar = response.data;                    
                } else{
                    alert('Não existe essa pessoa')
                }
            }).catch(error=>{
                alert('error na requisiçao')
                console.log(error);
            })


        },
        // dentro do modal com os dados vai poder mudar e fazer um requsição rest de PUT
        Atualiazar(id) {
            if (this.pessoaAtualizar.nome != '' && this.pessoaAtualizar.sexo != '' && this.pessoaAtualizar.rg != '' 
            && this.pessoaAtualizar.cpf != ''){
                if (this.validarDate(this.pessoaAtualizar.data_nasc)){                
                    axios.put('/pessoa/'+id, {                                   
                        pessoa: this.pessoaAtualizar
                    })
                    .then(response=>{
                        if(response.status == 200){
                            this.$emit('itemchanged');
                            this.modalShow1 = false;
                            alert('atulizado');
                        }
                    }).catch(error=>{
                        console.log(error)
                        if (error.message.indexOf('1062')) {
                                this.modalShow1 = true; 
                                alert('CPF ou RG já existem')
                            }  
                    })
                }
            } else{
                alert('existe campos vazios')
            }

        },
        // Validar campos e data rest POST com o objeto
        Inserir() {
            if (this.pessoa.nome != '' && this.pessoa.sexo != '' && this.pessoa.rg != '' && this.pessoa.cpf != '') {
                if (this.validarDate(this.pessoa.data_nasc)) { 

                    axios.post('/pessoa/criar', {
                        pessoa: this.pessoa
                    })
                        .then(response => {
                            if (response.status == 201) {   
                                this.$emit('itemchanged');                             
                                this.modalShow = false;

                                this.pessoa.nome = "";                                
                                this.pessoa.cpf = "";                              
                                this.pessoa.rg = "";                                
                                this.pessoa.data_nasc = "";                                
                                this.pessoa.sexo = "";   

                                alert('Adicinado com sucesso');
                            }
                        })
                        // erro tratado
                        .catch(error => {
                            if (error.message.indexOf('1062')) {
                                this.modalShow = true; 
                                alert('CPF ou RG já existem')
                            }                           
                            console.log(error);
                        })
                }

            } else {
                alert('Existem campos vazios');
            }
        },

        // Requisição rest de deletar pelo ID
        Deletar(id) {
            axios.delete('/pessoa/'+id)
                .then(response=>{
                    if(response.status == 200){
                        this.$emit('itemchanged'); 
                        alert('Deletado com sucesso')
                    }
                })
                .catch(error=>{
                    alert('Erro ao excluir')
                    console.log(error);
                })
        },

        // VALIDAR DATA
        validarDate(date) {
            if (date == "") {
                alert('Preencha o campo com a data de entrada');
                return false;
            }
            // Verificar se o formato da data digitada está correto		
            var patternData = /^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/;
            if (!patternData.test(date)) {
                alert("Digite a data no formato Dia/Mês/Ano == 04/05/2005");
                return false;
            }
            return true;

        },

    },

}


</script>

<!-- _______________________STYLE__________________________ -->
 
<style scoped>
.Mycard {
    height: 100%;
    display: flex;
    justify-content: center;
    padding-top: 30px;


}

.tabela {
    width: fit-content;
    min-width: 995px;
    padding: 15px;
    border: 1px solid black;
    border-radius: 3px;
    height: 500px;
    overflow-y: scroll;
}

.botoes {
    display: flex;
    gap: 5px;
    align-items: center;

}

.tamanholetras {
    font-size: 20px;
}

.modal-mask {
    position: fixed;
    z-index: 9998;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, .5);
    display: table;
    transition: opacity .3s ease;
}

.modal-wrapper {
    display: table-cell;
    vertical-align: middle;
}

.left-inner-addon {
    position: relative;
}

.left-inner-addon i {
    position: absolute;
    padding: 10px 12px;
    pointer-events: none;
    color: #666;
}

.left-inner-addon input.form-control {
    padding-left: 30px;
}
</style>

