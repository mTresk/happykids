<template>
    <div id="popup-payment" aria-hidden="true" class="popup">
        <div class="popup__wrapper">
            <div class="popup__content">
                <button data-close type="button" class="popup__close">X</button>
                <form @submit.prevent="submit" class="popup__form form">
                    <div class="form__title title">Оплата за обучение в «Школе»</div>
                    <div class="form__input">
                        <input v-model="payload.amount" autocomplete="off" type="number" name="amount"
                               placeholder="Сумма платежа в рублях" class="input"/>
                        <div v-if="errors.amount" class="form__error">{{ errors.amount[0] }}</div>
                    </div>
                    <div class="form__input">
                        <input v-model="payload.name" autocomplete="off" type="text" name="name"
                               placeholder="ФИО ребенка" class="input"/>
                        <div v-if="errors.name" class="form__error">{{ errors.name[0] }}</div>
                    </div>
                    <div class="form__input">
                        <input v-model="payload.phone" autocomplete="off" type="text" name="phone"
                               placeholder="Ваш телефон" class="input"/>
                        <div v-if="errors.phone" class="form__error">{{ errors.phone[0] }}</div>
                    </div>
                    <button type="submit" class="form__btn btn">Перейти к оплате</button>
                    <p class="form__accept">
                        Нажимая на кнопку я принимаю условия <a href="policy"
                                                                target="_blank">пользовательского
                        соглашения</a> и даю согласие на обработку персональных данных
                    </p>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>

import {ref} from "vue";
import axios from "axios";
import {flsModules} from "../files/modules";

const payload = ref({
    amount: '',
    name: '',
    phone: ''
})
const errors = ref([])

const sending = ref(false)

const submit = () => {
    sending.value = true
    axios.post('/payments/create', payload.value)
        .then(response => {
            if (response.status === 200) {
                sending.value = false
                flsModules.popup.close()
            }
        })
        .catch(e => {
            if (e) {
                sending.value = false
            }
            errors.value = e.response.data.errors
            console.log(e.response.data.errors)
        })
}

</script>
<style scoped lang="scss">
.disabled {
    pointer-events: none;

    &::before {
        position: absolute;
        z-index: 1;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: #0d0a0a;
        opacity: 0.5;
        content: '';
        border-radius: 6px;
    }
}


.spinner {
    position: absolute;
    z-index: 10;
    top: 35%;
    left: 50%;
    color: #e3af7b;
    font-size: 20px;
    margin: 100px auto;
    width: 1em;
    height: 1em;
    border-radius: 50%;
    text-indent: -9999em;
    animation: load4 1.3s infinite linear;
    transform: translateX(-50%);
}

@-webkit-keyframes load4 {
    0%,
    100% {
        box-shadow: 0 -3em 0 0.2em, 2em -2em 0 0em, 3em 0 0 -1em, 2em 2em 0 -1em, 0 3em 0 -1em, -2em 2em 0 -1em, -3em 0 0 -1em, -2em -2em 0 0;
    }
    12.5% {
        box-shadow: 0 -3em 0 0, 2em -2em 0 0.2em, 3em 0 0 0, 2em 2em 0 -1em, 0 3em 0 -1em, -2em 2em 0 -1em, -3em 0 0 -1em, -2em -2em 0 -1em;
    }
    25% {
        box-shadow: 0 -3em 0 -0.5em, 2em -2em 0 0, 3em 0 0 0.2em, 2em 2em 0 0, 0 3em 0 -1em, -2em 2em 0 -1em, -3em 0 0 -1em, -2em -2em 0 -1em;
    }
    37.5% {
        box-shadow: 0 -3em 0 -1em, 2em -2em 0 -1em, 3em 0em 0 0, 2em 2em 0 0.2em, 0 3em 0 0em, -2em 2em 0 -1em, -3em 0em 0 -1em, -2em -2em 0 -1em;
    }
    50% {
        box-shadow: 0 -3em 0 -1em, 2em -2em 0 -1em, 3em 0 0 -1em, 2em 2em 0 0em, 0 3em 0 0.2em, -2em 2em 0 0, -3em 0em 0 -1em, -2em -2em 0 -1em;
    }
    62.5% {
        box-shadow: 0 -3em 0 -1em, 2em -2em 0 -1em, 3em 0 0 -1em, 2em 2em 0 -1em, 0 3em 0 0, -2em 2em 0 0.2em, -3em 0 0 0, -2em -2em 0 -1em;
    }
    75% {
        box-shadow: 0em -3em 0 -1em, 2em -2em 0 -1em, 3em 0em 0 -1em, 2em 2em 0 -1em, 0 3em 0 -1em, -2em 2em 0 0, -3em 0em 0 0.2em, -2em -2em 0 0;
    }
    87.5% {
        box-shadow: 0em -3em 0 0, 2em -2em 0 -1em, 3em 0 0 -1em, 2em 2em 0 -1em, 0 3em 0 -1em, -2em 2em 0 0, -3em 0em 0 0, -2em -2em 0 0.2em;
    }
}

@keyframes load4 {
    0%,
    100% {
        box-shadow: 0 -3em 0 0.2em, 2em -2em 0 0em, 3em 0 0 -1em, 2em 2em 0 -1em, 0 3em 0 -1em, -2em 2em 0 -1em, -3em 0 0 -1em, -2em -2em 0 0;
    }
    12.5% {
        box-shadow: 0 -3em 0 0, 2em -2em 0 0.2em, 3em 0 0 0, 2em 2em 0 -1em, 0 3em 0 -1em, -2em 2em 0 -1em, -3em 0 0 -1em, -2em -2em 0 -1em;
    }
    25% {
        box-shadow: 0 -3em 0 -0.5em, 2em -2em 0 0, 3em 0 0 0.2em, 2em 2em 0 0, 0 3em 0 -1em, -2em 2em 0 -1em, -3em 0 0 -1em, -2em -2em 0 -1em;
    }
    37.5% {
        box-shadow: 0 -3em 0 -1em, 2em -2em 0 -1em, 3em 0em 0 0, 2em 2em 0 0.2em, 0 3em 0 0em, -2em 2em 0 -1em, -3em 0em 0 -1em, -2em -2em 0 -1em;
    }
    50% {
        box-shadow: 0 -3em 0 -1em, 2em -2em 0 -1em, 3em 0 0 -1em, 2em 2em 0 0em, 0 3em 0 0.2em, -2em 2em 0 0, -3em 0em 0 -1em, -2em -2em 0 -1em;
    }
    62.5% {
        box-shadow: 0 -3em 0 -1em, 2em -2em 0 -1em, 3em 0 0 -1em, 2em 2em 0 -1em, 0 3em 0 0, -2em 2em 0 0.2em, -3em 0 0 0, -2em -2em 0 -1em;
    }
    75% {
        box-shadow: 0em -3em 0 -1em, 2em -2em 0 -1em, 3em 0em 0 -1em, 2em 2em 0 -1em, 0 3em 0 -1em, -2em 2em 0 0, -3em 0em 0 0.2em, -2em -2em 0 0;
    }
    87.5% {
        box-shadow: 0em -3em 0 0, 2em -2em 0 -1em, 3em 0 0 -1em, 2em 2em 0 -1em, 0 3em 0 -1em, -2em 2em 0 0, -3em 0em 0 0, -2em -2em 0 0.2em;
    }
}

</style>
