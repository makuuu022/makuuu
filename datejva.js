const dateInput = document.getElementById('date');

dateInput.addEventListener('change', () => {
  const selectedDate = dateInput.value;
  console.log(`Selected date: ${selectedDate}`);
});