let currentYear = new Date().getFullYear();
for (let year = currentYear - 20; year <= currentYear; year++) {
    let optionCurrYear = document.createElement("OPTION");
    let optionDateEnter = document.createElement("OPTION");
    document.getElementById("current-year").appendChild(optionCurrYear).innerHTML = year;
    document.getElementById("date-enter").appendChild(optionDateEnter).innerHTML = year;
}
