// import {calendar} from "@fullcalendar/core";
// // import interactionPlugin from "@fullcalendar/interaction";
// // import dayGridPlugin from "@fullcalendar/daygrid";
// // import timeGridPlugin from "@fullcalendar/timegrid";

// import "@fullcalendar/core/main.css";
// import "@fullcalendar/daygrid/main.css";
// import "@fullcalendar/timegrid/main.css";

import "./index.css";

window.onload = () => {
    let calendarElt = document.querySelector("#calendrier");

    let calendar = new FullCalendar.Calendar(calendarElt, {
        initialView: 'dayGridMonth',
        locale: 'fr',
        timeZone: 'Europe/Paris'
    });

    calendar.render(); //voir l'erreur avec yarn encore dev
}