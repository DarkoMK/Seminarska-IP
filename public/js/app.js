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
