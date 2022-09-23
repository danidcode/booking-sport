import './bootstrap';
import '../scss/App.scss'
import Alpine from 'alpinejs';
import.meta.glob([
    '../images/**',
    '../fonts/**',
  ]);
  
window.Alpine = Alpine;


Alpine.start();
