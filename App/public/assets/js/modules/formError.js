function showPasswordError(errorMessage) {
  const $inputPassword = document.querySelector('.input-password');
  const $passwordErrorMessage = document.querySelector('.password-error-message');

  $passwordErrorMessage.textContent = errorMessage;
  invalidInput($inputPassword, $passwordErrorMessage);
}

function showNameError(errorMessage) {
  const $inputName = document.querySelector('.input-name');
  const $nameErrorMessage = document.querySelector('.name-error-message');

  $nameErrorMessage.textContent = errorMessage;
  invalidInput($inputName, $nameErrorMessage);
}

function showEmailError(errorMessage) {
  const $inputEmail = document.querySelector('.input-email');
  const $emailErrorMessage = document.querySelector('.email-error-message');

  $emailErrorMessage.textContent = errorMessage;
  invalidInput($inputEmail, $emailErrorMessage);
}

function showGeneralError(errorMessage) {
  const $errorMessageField = document.querySelector('.error-message');

  $errorMessageField.textContent = errorMessage;
}

function invalidInput(input, messageField) {
  input.classList.add('is-invalid');
  messageField.classList.add('invalid-feedback');
}

const formError = {
  showEmailError,
  showNameError,
  showPasswordError,
  showGeneralError,
  invalidInput
}

export default formError;
