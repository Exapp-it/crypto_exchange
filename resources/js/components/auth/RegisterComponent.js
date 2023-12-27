import axios from "axios";

export default function RegisterComponent() {
    return {
        email: "",
        password: "",
        password_confirmation: "",
        errors: {
            login: "",
            email: "",
            password: "",
            password_confirmation: "",
        },
        message: {
            status: "",
            text: "",
        },
        showAlert: false,
        alertTimer: null,

        clearErrors() {
            this.errors = {
                email: "",
                password: "",
                password_confirmation: "",
            };
        },

        openAlert() {
            if (!this.showAlert) {
                this.showAlert = true;

                this.alertTimer = setTimeout(() => {
                    this.closeAlert();
                }, 5000);
            }
        },

        showError(message) {
            this.message.status = "error";
            this.message.text = message;
            this.openAlert();
        },

        clearAlertTimer() {
            clearTimeout(this.alertTimer);
        },

        closeAlert() {
            this.showAlert = false;
            this.clearAlertTimer();
        },

        redirect(url) {
            window.location.href = url;
        },

        handleRegistrationError(error) {
            if (error.response && error.response.status === 422) {
                const validationErrors = error.response.data.error;
                console.log(validationErrors)
                if (validationErrors instanceof Object) {
                    console.log(validationErrors);
                    this.processValidationErrors(validationErrors);
                } else {
                    this.showError(validationErrors);
                }
            } else {
                console.error('Ошибка при отправке запроса:', error);
            }

        },

        processValidationErrors(validationErrors) {
            this.clearErrors();
            Object.keys(validationErrors).forEach((field) => {
                if (field in this.errors) {
                    this.errors[field] = Array.isArray(validationErrors[field]) ? validationErrors[field][0] : "";
                } else {
                    this.showError(validationErrors[field]);
                }
            });
        },

        handleSuccessResponse(response) {
            this.message.status = response.data.status;
            this.message.text = response.data.message;
            this.openAlert();

            setTimeout(() => {
                this.closeAlert();
                this.redirect(routes.home);
            }, 1000);
        },

        async registerAction() {
            try {
                const response = await axios.post(routes.register, {
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation,
                    _token: csrfToken,
                });

                this.handleSuccessResponse(response);
            } catch (error) {
                this.handleRegistrationError(error);
            }
        },
    };
}
