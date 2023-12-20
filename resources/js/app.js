import '../css/app.css'
import Alpine from 'alpinejs'

import Modal from './components/auth/Modal.js'
import LoginComponent from "./components/auth/LoginComponent.js";
import ForgotComponent from "./components/auth/ForgotComponent.js";
import ResetComponent from "./components/auth/ResetComponent.js";
import RegisterComponent from './components/auth/RegisterComponent.js'


Alpine.data('Modal', Modal);
Alpine.data('Login', LoginComponent);
Alpine.data('Forgot', ForgotComponent);
Alpine.data('Reset', ResetComponent);
Alpine.data('Register', RegisterComponent);


Alpine.start();
