require('./bootstrap');

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue3'
import { InertiaProgress } from '@inertiajs/progress'
import { variantJS } from '@variantjs/vue'

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'The Lend List'

const app = createInertiaApp({
    title: (title) => `${title} – ${appName}`,
    resolve: (name) => import(`@/Pages/${name}`),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .mixin({ methods: { route }})
            .mount(el);
    },
})

app.use(variantJS)

InertiaProgress.init({ color: '#4B5563' })
