<template>
    <div id="popup-request" aria-hidden="true" class="popup">
        <div class="popup__wrapper">
            <div :class="{disabled: sending}" class="popup__content">
                <div v-if="sending" class="spinner"></div>
                <button data-close type="button" class="popup__close">X</button>
                <form @submit.prevent="submit" method="POST" class="popup__form form">
                    <input id="request-popup" name="check" type="hidden" value=""/>
                    <input type="text" name="human" value="" style="position: absolute; left: -9999px; display: none;">
                    <div class="form__title title">Оставьте заявку на консультацию</div>
                    <div class="form__description">Мы свяжемся с вами и подберем удобное время встречи</div>
                    <div class="form__input">
                        <input v-model="payload.name" autocomplete="off" type="text" name="name" data-required data-error="Введите имя"
                               placeholder="Ваше имя" class="input"/>
                        <div v-if="errors.name" class="form__error">{{ errors.name[0] }}</div>
                    </div>
                    <div class="form__input">
                        <input v-model="payload.phone" autocomplete="off" type="text" name="phone" data-required data-error="Введите телефон"
                               placeholder="Ваш телефон" class="input"/>
                        <div v-if="errors.phone" class="form__error">{{ errors.phone[0] }}</div>
                    </div>
                    <div class="form__input">
                        <input v-model="payload.age" autocomplete="off" type="number" name="age" data-required data-error="Введите возраст"
                               placeholder="Возраст ребенка" class="input"/>
                        <div v-if="errors.age" class="form__error">{{ errors.age[0] }}</div>
                    </div>

                    <button onclick="document.getElementById('request-popup').value = 'only-human';" type="submit"
                            class="form__btn btn">Оставить заявку
                    </button>
                    <p class="form__accept">
                        Нажимая на кнопку я принимаю условия <a href="policy"
                                                                target="_blank">пользовательского
                        соглашения</a> и даю согласие на обработку персональных данных
                    </p>
                </form>
            </div>

        </div>
    </div>
    <div class="popup" aria-hidden="true" id="thanks">
        <div class="popup__wrapper">
            <div class="popup__content">
                <div class="popup__body thanks">
                    <div class="thanks__title title">Спасибо!</div>
                    <div class="thanks__text">Скоро мы свяжемся с вами.</div>
                    <button data-close type="button" class="popup__close">X</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>

import {ref} from "vue";
import axios from "axios";
import {flsModules} from "../files/modules";

const payload = ref({
    name: '',
    phone: '',
    age: ''
})
const errors = ref([])

const sending = ref(false)

const formSent = () => {
    if (flsModules.popup) {
        flsModules.popup.open('#thanks')
    }
    payload.value = {
        name: '',
        phone: '',
        age: ''
    }
}
const submit = () => {
    sending.value = true
    axios.post('/contact', payload.value)
        .then(response => {
            if (response.status === 200) {
                sending.value = false
                formSent()
            }
        })
        .catch(e => {
            if (e) {
                sending.value = false
            }
            errors.value = e.response.data.errors
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
