import axios from 'axios';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Enable Alpine.js for Blade components (dropdowns, nav, etc.)

