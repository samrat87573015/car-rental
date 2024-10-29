import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";
import { createPinia } from 'pinia';

createInertiaApp({
  progress: {
    color: 'rgb(99 102 241)',
    showSpinner: true,
  },
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true });
    return pages[`./Pages/${name}.vue`];
  },
  setup({ el, App, props, plugin }) {
    const pinia = createPinia();
    const app = createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(Toast)
      .use(pinia);
    
    app.mount(el); // Mount the app first

  },
});
