const datepicker = require('js-datepicker');

const maxDate = new Date();
maxDate.setFullYear(maxDate.getFullYear() - 15, 11, 31);

const minDate = new Date();
minDate.setFullYear(minDate.getFullYear() - 100, 0, 1);

const startDate = new Date();
startDate.setFullYear(startDate.getFullYear() - 20, 0, 1);

const picker = datepicker('#birth_date_picker', {
    onSelect: (instance, date) => {
        $('#birth_date').val(date.toISOString());
    },
    formatter: (input, date, instance) => {
        input.value = date.toLocaleDateString()
    },
    position: 'bl',
    startDay: 1,
    customDays: ['Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс'],
    customMonths: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
    overlayButton: 'Выбрать',
    overlayPlaceholder: 'Год (4 знака)',
    maxDate: maxDate,
    minDate: minDate,
    startDate: startDate
});

$(document).ready(function () {
    let form = document.getElementById('create_user');
    form.addEventListener(
        'submit',
        event => {
            if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        },
        false
    );

    $('#birth_date_picker').change(() => {
        $('#birth_date').val($('#birth_date_picker').val());
    });
});