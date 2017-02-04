$(document).ready(function() {
    $('select').material_select();
    $('.datepicker').pickadate({
        selectMonths: true,
        selectYears: 1,
        today: 'Денес',
        clear: 'Исчисти',
        close: 'ОК',
        monthsFull: ['Јануари', 'Февруари', 'Март', 'Април', 'Мај', 'Јуни', 'Јули', 'Август', 'Септември', 'Октомври', 'Ноември', 'Декември'],
        monthsShort: ['Јан', 'Феб', 'Мар', 'Апр', 'Мај', 'Јун', 'Јул', 'Авг', 'Сеп', 'Окт', 'Ное', 'Дек'],
        weekdaysFull: ['Недела', 'Понеделник', 'Вторник', 'Среда', 'Четврток', 'Петок', 'Сабота'],
        weekdaysShort: ['Нед', 'Пон', 'Вто', 'Сре', 'Чет', 'Пет', 'Саб'],
        formatSubmit: 'yyyy-mm-dd'
    });
    $('.timepicker').pickatime({
        default: 'now',
        twelvehour: false, // promeni vo 12 casoven AM/PM casovnik od 24 casoven
        donetext: 'ОК',
        autoclose: false,
        vibrate: true // vibriraj go uredot koga se mesti saat
    });
});

function validateEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

class Errors {

    constructor() {
        this.errors = {};
    }

    has(field) {
        return this.errors.hasOwnProperty(field);
    }

    any() {
        return Object.keys(this.errors).length > 0;
    }

    get(field) {
        if (this.errors[field]) {
            return this.errors[field][0];
        }
    }

    record(errors) {
        this.errors = errors;
    }

    clear(field) {
        if (field) {
            delete this.errors[field];

            return;
        }

        this.errors = {};
    }
}


class Form {

    constructor(data) {
        this.originalData = data;

        for (let field in data) {
            this[field] = data[field];
        }

        this.errors = new Errors();
    }

    data() {
        let data = {};

        for (let property in this.originalData) {
            data[property] = this[property];
        }

        return data;
    }

    reset() {
        for (let field in this.originalData) {
            this[field] = '';
        }

        this.errors.clear();
    }

    post(url) {
        return this.submit('post', url);
    }

    get(url) {
        return this.submit('get', url);
    }

    put(url) {
        return this.submit('put', url);
    }

    patch(url) {
        return this.submit('patch', url);
    }

    delete(url) {
        return this.submit('delete', url);
    }

    submit(requestType, url) {
        return new Promise((resolve, reject) => {
                axios[requestType](url, this.data())
                    .then(response => {
                    this.onSuccess(response.data);
        resolve(response.data);

    })
    .catch(error => {
            this.onFail(error.response.data);

        reject(error.response.data);
    });
    });
    }

    onSuccess(data) {
        this.reset();
    }

    onFail(errors) {
        this.errors.record(errors);
    }
}

Vue.component('infoblock', {
    template: '#devinfoblock-template',
    props: {
        devid: { default: 'none' }
    },
    data: function () {
        return {
            form: new Form(),
            v_ime: 'none',
            v_vreme_vklucuvanje: '',
            i_ime: 'none',
            i_vreme_isklucuvanje: '',
            u_status: false,
            v_idno: false,
            i_idno: false
        }
    },
    methods: {
        setInfo: function () {
            this.form.get('/naredbi/ured/vklucen/' + this.devid).then(response => {
                if(response.uredStatus) {
                    this.v_ime = response.uredStatus.dal_naredba.name;
                    this.v_vreme_vklucuvanje = response.uredStatus.vreme_vklucuvanje;
                    this.u_status = response.uredStatus.ured.vklucena_sostojba;
                    let currdt = response.current_time.date;
                    if(currdt < this.v_vreme_vklucuvanje)
                        this.v_idno = true;
                    else
                        this.v_idno = false;
                }
            });
            this.form.get('/naredbi/ured/isklucen/' + this.devid).then(response => {
                if(response.uredStatus) {
                    this.i_ime = response.uredStatus.dal_naredba.name;
                    this.i_vreme_isklucuvanje = response.uredStatus.vreme_isklucuvanje;
                    this.u_status = response.uredStatus.ured.vklucena_sostojba;
                    let currdt = response.current_time.date;
                    if(currdt < this.i_vreme_isklucuvanje)
                        this.i_idno = true;
                    else
                        this.i_idno = false;
                }
            });
        },
        changeStatus: function () {
            if (this.u_status){
                if (!this.i_idno) {
                    this.iskluciUred();
                    Materialize.toast('Уредот е исклучен!', 4000);
                }else{
                    Materialize.toast('Постои наредба за исклучување во иднина. Најпрвин избришете ја.', 4000)
                    //alert("Постои наредба за исклучување во иднина. Најпрвин избришете ја.");
                    }
            }
            else {
                if (!this.v_idno) {
                    this.vkluciUred();
                    Materialize.toast('Уредот е вклучен!', 4000);
                } else
                    Materialize.toast('Постои наредба за вклучување во иднина. Најпрвин избришете ја.', 4000)
                //alert("Постои наредба за вклучување во иднина. Најпрвин избришете ја.");
            }
        },
        vkluciUred(){
            axios.post('/naredbi/ured/vkluci', {
                id_ured: this.devid,
            });
        },
        iskluciUred(){
            axios.post('/naredbi/ured/iskluci', {
                id_ured: this.devid,
            });
        }
    },
    created: function () {
        this.setInfo();

        setInterval(function () {
            this.setInfo();
        }.bind(this), 1300);
    }
});

if(window.location.pathname.indexOf("/pocetna") == 0)
    new Vue({
    el: '#listdev'
    });
if(window.location.pathname.indexOf("/naredbi") == 0)
    new Vue({
        el: '#listnaredbi',
        data:{
            form: new Form(),
            uredi: '',
            naredbi: '',
            dodaj: false,
            edit: false,
            naredba:[{
                ured_id: null,
                ured_ime: null,
                d_vk: null,
                t_vk: null,
                d_isk: null,
                t_isk: null
            }],
            serverTime: '',
            timeStrv: null,
            timeStri: null,
            nar_id: null
        },
        methods:{
            getUredi(){
                this.form.get('/naredbi/UserGetAllUredi').then(response => {
                    if(response) {
                        this.uredi = response;
                        //console.log(this.uredi);
                    }});
            },
            getNaredbi(){
              this.form.get('/naredbi/UserGetAllNaredbi').then(response => {
              if(response) {
                  this.naredbi = response;
              }});
              this.getUredi();
            },
            editNaredba(id_naredba, id_ured, vrk, vri){
                this.naredba.ured_id = id_ured;
                this.nar_id = id_naredba;
                if(vrk){
                    var vk = vrk.split(' ');
                    $("input[name=v_vklucuvanje_submit]").val(vk[0]);
                    document.getElementsByName("v_vklucuvanje")[0].placeholder=vk[0];
                    $("input[name=v_vklucuvanje]").val(vk[0]);
                    document.getElementsByName("t_vklucuvanje")[0].placeholder=vk[1];
                    $("input[name=t_vklucuvanje]").val(vk[1]);
                }
                if(vri){
                    var vi = vri.split(' ');
                    $("input[name=v_isklucuvanje_submit]").val(vi[0]);
                    document.getElementsByName("v_isklucuvanje")[0].placeholder=vi[0];
                    $("input[name=v_isklucuvanje]").val(vi[0]);
                    document.getElementsByName("t_isklucuvanje")[0].placeholder=vi[1];
                    $("input[name=t_isklucuvanje]").val(vi[1]);
                }

                this.edit = true;
                this.dodaj = true;
            },
            zacuvajNaredba(){

                this.naredba.d_vk = $("input[name=v_vklucuvanje_submit]").val();
                this.naredba.t_vk = $("input[name=t_vklucuvanje]").val();
                this.naredba.d_isk = $("input[name=v_isklucuvanje_submit]").val();
                this.naredba.t_isk = $("input[name=t_isklucuvanje]").val();

                if(this.naredba.ured_id){
                if ((this.naredba.d_vk && this.naredba.t_vk) || (this.naredba.d_isk && this.naredba.t_isk)){
                        this.timeStrv = this.naredba.d_vk + ' ' + this.naredba.t_vk;
                        this.timeStri = this.naredba.d_isk + ' ' + this.naredba.t_isk;
                        if((this.timeStrv > this.serverTime) || (this.timeStri > this.serverTime)) {
                            if (!(this.timeStrv > this.serverTime)) {
                                Materialize.toast('Вклучувањето не е во иднина. Ќе се игнорира.', 4000);
                                this.timeStrv = null;
                            }
                            if (!(this.timeStri > this.serverTime)) {
                                Materialize.toast('Исклучувањето не е во иднина. Ќе се игнорира.', 4000);
                                this.timeStri = null;
                            }
                            if(this.edit)
                                this.saveEditToDB();
                            else
                                this.saveToDB();
                        }else{
                            Materialize.toast('Мора да е идно време!', 4000);
                        }

                }else{
                    Materialize.toast('Морате да изберете нешто!', 4000);
                }
                }else{
                    Materialize.toast('Морате да изберете уред!', 4000);
                }
            },
            saveToDB(){
                this.dodaj = false;
                this.edit = false;
                axios.post('/naredbi/nova', {
                    id_ured: this.naredba.ured_id,
                    timeStrv: this.timeStrv,
                    timeStri: this.timeStri
                });
                Materialize.toast('Наредбата е зачувана!', 4000);
                this.getNaredbi();
                this.resetForm();
            },
            saveEditToDB(){
                this.dodaj = false;
                this.edit = false;
                axios.post('/naredbi/edit', {
                    id_naredba: this.nar_id,
                    id_ured: this.naredba.ured_id,
                    timeStrv: this.timeStrv,
                    timeStri: this.timeStri
                });
                Materialize.toast('Наредбата е изменета!', 4000);
                this.getNaredbi();
                this.resetForm();
            },
            setSrvTime(){
                this.form.get('/naredbi/getServerTime').then(response => {
                    if(response) {
                        this.serverTime = response;
                    }});
            },
            resetForm(){
                $("input[name=v_vklucuvanje_submit]").val('');
                $("input[name=v_vklucuvanje]").val('');
                $("input[name=t_vklucuvanje]").val('');
                $("input[name=v_isklucuvanje_submit]").val('');
                $("input[name=v_isklucuvanje]").val('');
                $("input[name=t_isklucuvanje]").val('');
                    this.naredba.ured_id = null;
                    this.naredba.ured_ime = null;
                    this.naredba.d_vk = null;
                    this.naredba.t_vk = null;
                    this.naredba.d_isk = null;
                    this.naredba.t_isk = null;
                document.getElementsByName("v_vklucuvanje")[0].placeholder='';
                document.getElementsByName("v_isklucuvanje")[0].placeholder='';
                document.getElementsByName("t_vklucuvanje")[0].placeholder='';
                document.getElementsByName("t_isklucuvanje")[0].placeholder='';
            },
            izbrisiNaredba(id_naredba, id_ured){
                axios.post('/naredbi/izbrisi', {
                    id_ured: id_ured,
                    naredba_id: id_naredba
                }).then(function (response) {
                    Materialize.toast('Наредбата е избришана.', 4000);
                }).catch(function (error) {
                    Materialize.toast('Се случи грешка!', 4000);
                    console.log(error);
                });
                this.getNaredbi();

            },
            addClick(){
                this.dodaj ? this.dodaj=false:this.dodaj=true;
                this.resetForm();
            }
        },
        created: function () {
            this.getNaredbi();
            this.setSrvTime();
            setInterval(function () {
                this.setSrvTime();
            }.bind(this), 60000);
        }
    });

new Vue({
    el: '#headerdiv',
    data:{
        showPwForm: false,
        l1: null,
        l2: null
    },
    methods:{
        zacuvajLozinka(){
            if(this.l1 && this.l2){
                if(this.l1 == this.l2){
                    axios.post('/korisnik/promeniLozinka', {
                        nova_lozinka: this.l1
                    })  .then(function (response) {
                        Materialize.toast('Лозинката е успешно променета!', 4000);
                        this.showPwForm = false;
                    })
                        .catch(function (error) {
                            Materialize.toast('Се случи грешка!', 4000);
                            this.showPwForm = false;
                        });
                }else{
                    Materialize.toast('Грешка. Лозинките мора да се совпаѓаат!', 4000);
                    this.showPwForm = false;
                }
            }else{
                Materialize.toast('Грешка. Морате да внесете лозинка!', 4000);
                this.showPwForm = false;
            }
        }
    }
});

if(window.location.pathname.indexOf("/korisnici") == 0)
    new Vue({
        el: '#listkorisnici',
        data:{
            dodaj: false,
            form: new Form(),
            korisnici: null,
            kime: null,
            kemail: null,
            kpw: null,
            editK: false,
            kid: null,
        },
        methods:{
            resetForm(){
                /*$("input[name=ime]").val('');
                $("input[name=email]").val('');
                $("input[name=password]").val('');*/
                this.kid = null;
                this.kime = null;
                this.kemail = null;
                this.kpw = null;
                this.editK = false;
            },
            getKorisnici(){
                this.form.get('/korisnici/UserGetAllKorisnici').then(response => {
                    if(response) {
                        this.korisnici = response;
                    }});
            },
            zacuvajKorisnik(kid){
                if(this.kime && this.kemail && (this.kpw || this.editK)){
                    if(validateEmail(this.kemail)){
                        if(!this.editK){
                        this.form.get('/korisnici/UserExists/' + this.kemail).then(response => {
                            if(response) {
                               if(!response.postoi){
                                   axios.post('/korisnik/dodaj', {
                                       ime: this.kime,
                                       email: this.kemail,
                                       lozinka: this.kpw
                                   })  .then(function (response) {
                                       Materialize.toast('Корисникот е додаден!', 4000);
                                   }).catch(function (error) {
                                           Materialize.toast('Се случи грешка!', 4000);
                                           console.log(error);
                                       });
                                   this.getKorisnici();
                                   this.resetForm();
                               }
                               else{
                                   Materialize.toast('Грешка. e-mail-ot постои!', 4000);
                               }
                            }});
                        }else{
                            axios.post('/korisnik/izmeni', {
                                id: this.kid,
                                ime: this.kime,
                                email: this.kemail,
                                lozinka: this.kpw
                            })  .then(function (response) {
                                Materialize.toast('Корисникот е изменет!', 4000);
                            }).catch(function (error) {
                                Materialize.toast('Се случи грешка!', 4000);
                                console.log(error);
                            });
                            this.getKorisnici();
                            this.resetForm();
                            this.dodaj = false;
                        }
                    }
                    else{
                        Materialize.toast('Грешка. e-mail-ot е невалиден!', 4000);
                    }
                }else{
                    Materialize.toast('Грешка. Пополнете се!', 4000);
                }
            },
            izbrisiUser(kid){
                axios.post('/korisnik/izbrisi', {
                    k_id: kid
                })  .then(function (response) {
                    Materialize.toast('Корисникот е избришан!', 4000);
                }).catch(function (error) {
                    Materialize.toast('Се случи грешка!', 4000);
                    console.log(error);
                });
                this.getKorisnici();
            },
            editUser(kid){
                this.form.get('/korisnici/UserGetKorisnik/' + kid).then(response => {
                    if(response) {
                        this.kid = response[0].id;
                        this.kime = response[0].name;
                        this.kemail = response[0].email;
                        this.editK = true;
                        this.dodaj = true;
                    }}).catch(function (error) {
                        Materialize.toast('Се случи грешка!', 4000);
                    console.log(error);
                });
            },
            addClick(){
                this.dodaj ? this.dodaj=false:this.dodaj=true;
                this.resetForm();
            }
        },
        created(){
            this.getKorisnici();
        }
    });

if(window.location.pathname == '/kukji')
    new Vue({
        el: '#kukjadodaj',
        data:{
            dodaj: false,
            kime: null
        },
        methods:{
            zacuvajKukja(){

                axios.get('/kukji/postoi/' + this.kime).then(response => {
                    if(response) {
                        if(response.data.postoi == 0){
                            axios.put('/kukji/dodaj', {
                                ime: this.kime
                            })  .then(function (response) {
                                Materialize.toast('Куќата е додадена!', 4000);
                                location.reload();
                            }).catch(function (error) {
                                Materialize.toast('Се случи грешка!', 4000);
                                console.log(error);
                            });
                        }else{
                            Materialize.toast('Името постои!', 4000);
                        }
                    }});
            }
        }
    });