import {createApp} from 'vue/dist/vue.esm-bundler'
import ContactModal from "./components/ContactModal.vue";
import PaymentModal from "./components/PaymentModal.vue";

const app = createApp({
    components: {
        'component-contact-modal': ContactModal,
        'component-payment-modal': PaymentModal
    },
})

app.mount('#modals')
