import { Calendar } from '@fullcalendar/core';
import interactionPlugin from '@fullcalendar/interaction';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import listPlugin from '@fullcalendar/list';

// import './index.css'; // this will create a calendar.css file reachable to 'encore_entry_link_tags'

document.addEventListener('DOMContentLoaded', () => {
  const calendarEl = document.getElementById('calendar-holder');

  const { eventsUrl } = calendarEl.dataset;

  const calendar = new Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    locale: 'fr', 
    editable: true,
    eventSources: [
      {
        url: eventsUrl,
        method: 'POST',
        extraParams: {
          filters: JSON.stringify({}) // pass your parameters to the subscriber
        },
        failure: () => {
          // alert('There was an error while fetching FullCalendar!');
        },
      },
    ],
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,timeGridDay',
    },
    timeZone: 'UTC',
    plugins: [interactionPlugin, dayGridPlugin, timeGridPlugin, listPlugin],
  });

  calendar.render();
});
