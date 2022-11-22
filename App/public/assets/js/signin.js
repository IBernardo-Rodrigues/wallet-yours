import utils from './modules/utils.js';
import formError from './modules/formError.js';

function errorController(errorCookie) {
  if (!errorCookie) {
    return;
  }

  const errorRoutes = {
    emailerror: formError.showEmailError,
    passworderror: formError.showPasswordError,
    error: formError.showGeneralError
  }

  let errorData = decodeURIComponent(errorCookie);
  errorData = JSON.parse(errorData);

  const errorFunction = errorRoutes[errorData.errorName];
  errorFunction(errorData.errorMessage);
}

errorController(utils.getCookie('signinError'));
