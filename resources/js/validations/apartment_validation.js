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

    // valido il titolo
    if (title_input_el.value.length <= 0 || title_input_el.value.length > 255) {
        throwErrorMessage(e, title_error_el);
    }
    // valido le stanze
    if (rooms_input_el.value !== '') {
        if (rooms_input_el.value <= 0) {
            throwErrorMessage(e, rooms_error_el);
        }
    }

    // valido i letti
    if (beds_input_el.value !== '') {
        if (beds_input_el.value <= 0) {
            throwErrorMessage(e, beds_error_el);
        }
    }

    // valido la metratura
    if (square_meters_input_el.value !== '') {
        if (square_meters_input_el.value <= 7) {
            throwErrorMessage(e, square_meters_error_el);
        }
    }

    // valido i bagni
    if (bathrooms_input_el.value !== '') {
        if (bathrooms_input_el.value <= 0) {
            throwErrorMessage(e, bathrooms_error_el);
        }
    }

    if (full_address_input_el.value.length <= 0 || full_address_input_el.value.length > 255) {
        throwErrorMessage(e, full_address_error_el);
    }

    if (services_array_input_el.length < 1) {
        const checked_services = document.querySelectorAll('input[type="checkbox"]:checked');
        console.log(checked_services);
        if (checked_services.length <= 0) {
            throwErrorMessage(e, services_error_el);
        }
    }
});

/**
 * Aux Function to stop the submit of the form and display the errors
 * @param {Event} event 
 * @param {HTMLElement} element 
 */
function throwErrorMessage(event, element) {
    event.preventDefault();
    element.classList.remove('d-none');
}

// se tutto va bene lascio eseguire il form 