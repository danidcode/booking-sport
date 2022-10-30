document.addEventListener('DOMContentLoaded', () => {
    const calendar = new VanillaCalendar('#calendar', {
      settings: {
        lang: 'es',
      }
    });
    calendar.init();
  });