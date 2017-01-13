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
            axios.post('/naredbi/ured/vkluci/', {
                id_ured: this.devid,
            });
        },
        iskluciUred(){
            axios.post('/naredbi/ured/iskluci/', {
                id_ured: this.devid,
            });
        }
    },
    created: function () {
        this.setInfo();

        setInterval(function () {
            this.setInfo();
        }.bind(this), 1000);
    }
});

if(window.location.pathname == "/pocetna")
    new Vue({
    el: '#listdev'
    });
if(window.location.pathname == "/naredbi")
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
            serverTime: null,
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
            editNaredba(id_naredba, id_ured, vreme_vklucuvanje, vreme_isklucuvanje){
                this.naredba.ured_id = id_ured;
                this.nar_id = id_naredba;
                var vk = vreme_vklucuvanje.split(' ');
                var vi = vreme_isklucuvanje.split(' ');
                $("input[name=v_vklucuvanje_submit]").val(vk[0]);
                $("input[name=v_vklucuvanje]").val(vk[0]);
                $("input[name=t_vklucuvanje]").val(vk[1]);
                $("input[name=v_isklucuvanje_submit]").val(vi[0]);
                $("input[name=v_isklucuvanje]").val(vi[0]);
                $("input[name=t_isklucuvanje]").val(vi[1]);

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
                axios.post('/naredbi/nova/', {
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
                axios.post('/naredbi/edit/', {
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
            },
            izbrisiNaredba(id_naredba, id_ured){
                axios.post('/naredbi/izbrisi', {
                    id_ured: id_ured,
                    naredba_id: id_naredba
                });
                this.getNaredbi();
            }
        },
        created: function () {
            this.getNaredbi();
            this.setSrvTime();
        }
    });