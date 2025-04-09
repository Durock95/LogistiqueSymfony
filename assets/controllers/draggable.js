
// document.addEventListener('DOMContentLoaded', () => {
//   const calendarEl = document.getElementById('calendar-holder');

//   const calendar = new FullCalendar.Calendar(calendarEl, {
//       defaultView: 'dayGridMonth',
//       locale: 'fr',
//       editable: true,
//       eventSources: [
//           {
//               url: '/fc-load-events',
//               method: 'POST',
//               extraParams: {
//                   filters: JSON.stringify({})
//               },
//               failure: () => {
//                   // alert('There was an error while fetching FullCalendar!');
//               },
//           },
//       ],
//       headerToolbar: {
//           start: 'prev,next today',
//           center: 'title',
//           end: 'dayGridMonth,timeGridWeek,timeGridDay'
//       },
     
//       timeZone: 'Europe/Paris',
//       // events: { data,raw },
      
//   });
calendar.on('eventChange', (e) => {
  let id = e.event.id;
  let url = `/api/${id}/edit`;
  let donnees = {
    "title": e.event.title,
    // "description: e.event.extentedProps.description,
    "start": e.event.start,
    "end": e.event.end,
    // "backgroundColor": e.event.backgroundColor,
    // "borderColor": e.event.borderColor,
    // "textColor": e.event.textColor,
    // "allDay": e.event.allDay
  }
//   // console.log(id, url);
//       fetch(url)
//       .then(response => console.log(response))
//       .then(response => response.ok ? response.json() : Promise.reject("Network error !"))
//       .then(response => addAlert(response.ok))
//       .catch(error => addAlert(error));

  let xhr = new XMLHttpRequest();

  xhr.open("PUT", url);
  xhr.send(JSON.stringify(donnees));
  console.log(donnees)
//})
  calendar.render();


// function addAlert(message) {
//   let alerts = document.querySelector('#alerts');
//   let wndw = document.createElement('div');
//   if (message === true) {
//     wndw.setAttribute("class", "success");
//   } else {
//     wndw.setAttribute("class", "error");
//   }
//   wndw.append(message);
//   alerts.append(wndw);
// }

// calendar.on('eventChange', (e) => {
//   let url = `/api/${e.event.id}/edit`;
//   let donnees = {
//     "title": e.event.title,
//     // "description: e.event.extentedProps.description,
//     "start": e.event.start,
//     "end": e.event.end,
//     // "backgroundColor": e.event.backgroundColor,
//     // "borderColor": e.event.borderColor,
//     // "textColor": e.event.textColor,
//     // "allDay": e.event.allDay
//   }
//   // console.log(id, url);
//       fetch(url)
//       .then(response => console.log(donnes))
//       .then(donnees => response.ok ? response.json() : Promise.reject("Network error !"))
//       .then(response => addAlert(response.ok))
//       .catch(error => addAlert(error));
// })
})

