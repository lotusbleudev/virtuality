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