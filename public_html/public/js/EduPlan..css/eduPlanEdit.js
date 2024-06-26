const inputCurrentYear = document.getElementById('current-year');
const inputDateEnter = document.getElementById('date-enter');

inputCurrentYear.addEventListener('input', FilterNumericInput);
inputDateEnter.addEventListener('input', FilterNumericInput);

function FilterNumericInput() {
    const filteredValue = this.value.replace(/\D/g, '');
    this.value = filteredValue;
}
