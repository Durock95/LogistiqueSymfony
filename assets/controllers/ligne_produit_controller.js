BASE_URL = 'https://localhost:8000/commande/add/';
QUERY_PARAMS = "${id}/${quantite}";

function add() {
let link = document.querySelector('a');
let number = document.querySelector('quantite').value;
console.log(number);
document.addEventListener('mouseevent', () => {
    let row = new HTMLTableRowElement(document.querySelector('tr'));
    let init = {
      method: 'post',
      body: row,
       
    };
    fetch(BASE_URL, init)
    .then(response => response.ok ? response.json() : Promise.reject("Network error !"))
    .then()
    .catch(error => console.log(error.message));
    window.location = 'https://localhost:8000/commande/add/';

})
}