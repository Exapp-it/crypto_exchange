import Alpine from 'alpinejs'

import Modal from './auth/Modal.js'
import LoginComponent from "./auth/LoginComponent.js";
import ForgotComponent from "./auth/ForgotComponent.js";
import ResetComponent from "./auth/ResetComponent.js";
import RegisterComponent from './auth/RegisterComponent.js'
import SellComponent from './order/SellComponent.js';
import BuyComponent from './order/BuyComponent.js';
import OrderListComponent from './order/ListComponent.js';


document.addEventListener('alpine:init', async () => {
    Alpine.data('Modal', Modal);
    Alpine.data('Login', LoginComponent);
    Alpine.data('Forgot', ForgotComponent);
    Alpine.data('Reset', ResetComponent);
    Alpine.data('Register', RegisterComponent);
    Alpine.data('OrderSell', SellComponent);
    Alpine.data('OrderBuy', BuyComponent);
    Alpine.data('OrderList',  OrderListComponent);
});


Alpine.start();