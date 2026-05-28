import './bootstrap';

import { createApp, h } from 'vue'
import { createInertiaApp, Head, Link } from '@inertiajs/vue3'
import Layout from './Layouts/Layout.vue'
import { ZiggyVue } from '../../vendor/tightenco/ziggy'

createInertiaApp({
  title: (title) => `${title} | TodoApp`,
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
    let page = pages[`./Pages/${name}.vue`]
    page.default.layout = page.default.layout || Layout
    return page
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .component('Head', Head)
      .component('Link', Link)
      .use(plugin)
      .use(ZiggyVue)
      .mount(el)
  },
  progress: {
    // The color of the progress bar...
    color: 'yellow',
    // Whether to include the default NProgress styles...
    includeCSS: true,
    // Whether the NProgress spinner will be shown...
    showSpinner: true,
  },
})
