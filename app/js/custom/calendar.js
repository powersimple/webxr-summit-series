function downloadICS(event) {
    const eventName = event.title;
    const eventDescription = event.description.replace(/<\/?[^>]+(>|$)/g, ""); // Strip HTML for ICS
    const startTime = formatICSDate(event.startTime);
    const endTime = formatICSDate(event.endTime);

    const icsData = [
        'BEGIN:VCALENDAR',
        'VERSION:2.0',
        'BEGIN:VEVENT',
        'SUMMARY:' + eventName,
        'DESCRIPTION:' + eventDescription,
        'DTSTART:' + startTime,
        'DTEND:' + endTime,
        'END:VEVENT',
        'END:VCALENDAR'
    ].join('\n');

    const blob = new Blob([icsData], {type: 'text/calendar'});
    const url = URL.createObjectURL(blob);
    const link = document.createElement('a');
    link.href = url;
    link.download = eventName + '.ics';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

function formatICSDate(date) {
    // Assuming date is in 'YYYYMMDDTHHMMSSZ' format
    return date;
}

function createCalendarEvent(event) {
    const eventName = encodeURIComponent(event.title);
    const eventDescription = encodeURIComponent(event.description); // HTML tags will be kept for URLs

    // Google Calendar URL
    const googleUrl = `https://www.google.com/calendar/render?action=TEMPLATE&text=${eventName}&dates=${event.startTime}/${event.endTime}&details=${eventDescription}&sf=true&output=xml`;

    // Display links
    document.body.innerHTML += `<a href="${googleUrl}" target="_blank" class="event-link">Add to Google Calendar</a>`;
    document.body.innerHTML += `<button onclick="downloadICS(event)" class="event-link">Download ICS File</button>`;
}
