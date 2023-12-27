import Alpine from 'alpinejs'

import Modal from '../components/auth/Modal.js'
import LoginComponent from "../components/auth/LoginComponent.js";
import ForgotComponent from "../components/auth/ForgotComponent.js";
import ResetComponent from "../components/auth/ResetComponent.js";
import RegisterComponent from '../components/auth/RegisterComponent.js'
import SellComponent from '../components/trade/SellComponent.js';
import BuyComponent from '../components/trade/BuyComponent.js';
import OrderComponent from '../components/trade/OrderComponent.js';


document.addEventListener('alpine:init', async () => {
    Alpine.data('Modal', Modal);
    Alpine.data('Login', LoginComponent);
    Alpine.data('Forgot', ForgotComponent);
    Alpine.data('Reset', ResetComponent);
    Alpine.data('Register', RegisterComponent);
    Alpine.data('TradeSell', SellComponent);
    Alpine.data('TradeBuy', BuyComponent);
    Alpine.data('Order',  OrderComponent);
});


Alpine.start();