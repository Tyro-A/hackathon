const projectsUrl = 'https://docs.google.com/spreadsheets/d/1uepoy48fivERh2gxfnQluNFZKPQ46JRjYYibLhL2e_M/gviz/tq?gid=178449532';
const projectsOutput = document.querySelector('.projects');

fetch(projectsUrl).then(res => res.text()).then(rep => {
    // Parse the response
    const data = JSON.parse(rep.substr(47).slice(0, -2));
    const headers = data.table.cols.map(col => col.label); // Extract column headers

    // Convert rows into an array of objects
    const records = data.table.rows.map(row => {
        const obj = {};
        row.c.forEach((cell, index) => {
            obj[headers[index]] = cell ? cell.v : null; // Use null for empty cells
        });
        return obj;
    });

    // Log the records for debugging
    console.log(records);

    // Create a card for each record, excluding rows where approval is 0 or false
    records.forEach(record => {
        if (record["approval"] === 0 || record["approval"] === false) {
            return; // Skip unapproved records
        }

        // Create the card container
        const card = document.createElement('div');
        card.className = 'project-card bg-white shadow-md p-4 rounded mb-4';

        // Add the record data to the card
        headers.forEach(header => {
            const div = document.createElement('div');
            div.className = `field ${header}`;
            div.innerHTML = `<strong>${header}:</strong> ${record[header]}`;
            card.appendChild(div);
        });

        // Append the card to the projectsOutput container
        projectsOutput.appendChild(card);
    });
});
