import "./index.css";

window.onload = () => {
    let calendarElt = document.querySelector("#calendrier");

    let calendar = new FullCalendar.Calendar(calendarElt, {
        initialView: 'timeGridWeek',
        locale: 'fr',
        timeZone: 'Europe/Paris',
        headerToolbar: {
            left : 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek'
        }, //affichage des options du calendar
        buttonText: {
            today: "Aujourd'hui",
            month: 'Mois',
            week: 'Semaine',
            list: 'Liste'
        },
        nowIndicator: true, //indicateur du temps actuel

        // reservation: data , // version originale {{data|raw}} pour marquer la variable comme étant safe
        // /!\ problème d'affichage des données dans le calendrier

        editable: true,
        eventResizableFromStart: true // ces 2 propriétées permettent de faire des modifs directement dans le calendrier /!\ mais PAS dans la bdd
    });

    // calendar.on('eventChange', (e) =>{

    // }) //récupération des changements qui ont eu lieu dans le calendrier

    calendar.render(); //voir l'erreur avec yarn encore dev
}