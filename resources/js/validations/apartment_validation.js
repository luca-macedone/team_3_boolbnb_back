// recupero tutti i campi di input
const title_input_el = document.querySelector('#title');
const rooms_input_el = document.querySelector('#rooms');
const beds_input_el = document.querySelector('#beds');
const square_meters_input_el = document.querySelector('#square_meters');
const bathrooms_input_el = document.querySelector('#bathrooms');
const full_address_input_el = document.querySelector('#full_address');
const services_array_input_el = document.querySelectorAll('.services_input');

// recupero tutti i campi per restituire un errore
const title_error_el = document.querySelector('#title_error');
const rooms_error_el = document.querySelector('#rooms_error');
const beds_error_el = document.querySelector('#beds_error');
const square_meters_error_el = document.querySelector('#square_meters_error');
const bathrooms_error_el = document.querySelector('#bathrooms_error');
const full_address_error_el = document.querySelector('#full_address_error');
const services_error_el = document.querySelector('#services_error');

// recupero il form
// const apartment_creation_form = document.querySelector('#apartment_creation_form');
const apartment_creation_form_submit_btn = document.querySelector('button[type="submit"]');

// eseguo le validazioni
apartment_creation_form_submit_btn.addEventListener('click', e => {
    // resetto la stampa degli errori rendendoli invisibili
    title_error_el.classList.add('d-none');
    rooms_error_el.classList.add('d-none');
    beds_error_el.classList.add('d-none');
    square_meters_error_el.classList.add('d-none');
    bathrooms_error_el.classList.add('d-none');
    full_address_error_el.classList.add('d-none');
    services_error_el.classList.add('d-none');

    // console.log('sono nella validazione')

    // valido il titolo
    if (title_input_el.value.length <= 0 || title_input_el.value.length > 255) {
        // non rispetta le regole, lancio l'errore e blocco l'invio
        e.preventDefault();
        title_error_el.classList.remove('d-none');
        // title_error_el.innerHTML += ``;
    }
    // valido le stanze
    if (rooms_input_el.value !== '') {
        // console.log(rooms_input_el.value, 'sono nella validazione delle stanze')
        if (rooms_input_el.value <= 0) {
            // non rispetta le regole, lancio l'errore e blocco l'invio
            e.preventDefault();
            rooms_error_el.classList.remove('d-none');
            // rooms_error_el.innerHTML += ``;
        }
    }

    // valido i letti
    if (beds_input_el.value !== '') {
        // console.log(beds_input_el.value, 'sono nella validazione delle stanze')
        if (beds_input_el.value <= 0) {
            // non rispetta le regole, lancio l'errore e blocco l'invio
            e.preventDefault();
            beds_error_el.classList.remove('d-none');
            // beds_error_el.innerHTML += ``;
        }
    }

    // valido la metratura
    if (square_meters_input_el.value !== '') {
        // console.log(square_meters_input_el.value, 'sono nella validazione delle stanze')
        if (square_meters_input_el.value <= 7) {
            // non rispetta le regole, lancio l'errore e blocco l'invio
            e.preventDefault();
            square_meters_error_el.classList.remove('d-none');
            // square_meters_error_el.innerHTML += ``;
        }
    }

    // valido i bagni
    if (bathrooms_input_el.value !== '') {
        // console.log(bathrooms_input_el.value, 'sono nella validazione delle stanze')
        if (bathrooms_input_el.value <= 0) {
            // non rispetta le regole, lancio l'errore e blocco l'invio
            e.preventDefault();
            bathrooms_error_el.classList.remove('d-none');
            // bathrooms_error_el.innerHTML += ``;
        }
    }

    if (full_address_input_el.value.length <= 0 || full_address_input_el.value.length > 255) {
        e.preventDefault();
        full_address_error_el.classList.remove('d-none');
        // full_address_error_el.innerHTML += ``;
    }

    if (services_array_input_el.length < 1) {
        console.log(services_array_input_el)
        e.preventDefault();
        services_error_el.classList.remove('d-none');
        // services_error_el.innerHTML += ``
    }
});

// se tutto va bene lascio eseguire il form 