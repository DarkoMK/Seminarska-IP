$(document).ready(function() {
    $('select').material_select();
});
$('.datepicker').pickadate({
    selectMonths: true,
    selectYears: 1,
    today: 'Денес',
    clear: 'Исчисти',
    close: 'ОК',
    monthsFull: ['Јануари', 'Февруари', 'Март', 'Април', 'Мај', 'Јуни', 'Јули', 'Август', 'Септември', 'Октомври', 'Ноември', 'Декември'],
    monthsShort: ['Јан', 'Феб', 'Мар', 'Апр', 'Мај', 'Јун', 'Јул', 'Авг', 'Сеп', 'Окт', 'Ное', 'Дек'],
    weekdaysFull: ['Недела', 'Понеделник', 'Вторник', 'Среда', 'Четврток', 'Петок', 'Сабота'],
    weekdaysShort: ['Нед', 'Пон', 'Вто', 'Сре', 'Чет', 'Пет', 'Саб']
});
$('.timepicker').pickatime({
    default: 'now',
    twelvehour: false, // change to 12 hour AM/PM clock from 24 hour
    donetext: 'ОК',
    autoclose: false,
    vibrate: true // vibrate the device when dragging clock hand
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
       // alert(data.message); // temporary

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
            if(this.u_status)
                if(!this.i_idno)
                    this.iskluciUred();
                else
                    alert("Постои наредба за исклучување во иднина. Најпрвин избришете ја.");
            else
                if(!this.v_idno)
                    this.vkluciUred();
                else
                    alert("Постои наредба за вклучување во иднина. Најпрвин избришете ја.");
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
        }.bind(this), 2000);
    }
});

new Vue({
    el: '#listdev'
});

