import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp, Head, Link } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

import Swal from 'sweetalert2'

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 2000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, app, props, plugin }) {
        let vueApp =  createApp({ render: () => h(app, props) });

        vueApp.config.globalProperties.$toast = Toast;
        vueApp.config.globalProperties.$axios = window.axios;
        vueApp.config.globalProperties.$swal = Swal;

        vueApp
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .component('InertiaHead', Head)
            .component('InertiaLink', Link)
            .mount(el);

        return vueApp;
    },
});

InertiaProgress.init({ color: '#4B5563' });
