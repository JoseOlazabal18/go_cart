document.addEventListener('DOMContentLoaded', () => {
  const radios = document.querySelectorAll('.carousel input');
  let current = 0;

  setInterval(() => {
    radios[current].checked = false;
    current = (current + 1) % radios.length;
    radios[current].checked = true;
  }, 3500);
});