import './bootstrap';

import { createApp, h } from 'vue';
import { createInertiaApp, Head, Link } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import MainLayout from './Layouts/MainLayout.vue';

createInertiaApp({
    title: title => `${title} - LaraVue App`,
    // resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        let page = pages[`./Pages/${name}.vue`]
        page.default.layout = page.default.layout || MainLayout
        return page;
    },
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) });

        // Register the plugin
        app.use(plugin);

        // Register Inertia.js components globally
        app.component('Link', Link);
        app.component('Head', Head);

        // Mount the element
        app.mount(el)
    },
});
