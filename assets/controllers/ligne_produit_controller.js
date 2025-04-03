BASE_URL = '/commande/add';

function addAlert(message) {
  let alerts = document.querySelector('#alerts');
  let wndw = document.createElement('div');
  if (message === true) {
    wndw.setAttribute("class", "success");
  } else {
    wndw.setAttribute("class", "error");
  }
  wndw.append(message);
  alerts.append(wndw);
}

function add(btn) {
  let row = btn.parentNode.parentNode;
  let number = row.querySelector('[name="quantite"]').value;
  let id = row.querySelector('[name="produit_id"]').value;
  let url = `${BASE_URL}/${id}/${number}`;
  console.log(id, number, url);
      fetch(url)
      .then(response => response.ok ? response.json() : Promise.reject("Network error !"))
      .then(response => addAlert(response.ok))
      .catch(error => addAlert(error));
      // window.location.href = url;
}