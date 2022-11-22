import utils from './modules/utils.js';
import userRequest from './modules/userRequest.js';

const $transactions = document.querySelector('.transactions');
const months = ["janeiro", "Fevereiro", "Março", "Abril", "Maio","Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"];

function returnHistoric(data) {
  const historic = {};

  for (let i = 0; i < data.length; i++) {
    const currentTransaction = data[i];
    const currentDate = (currentTransaction.date).split('-');
    currentDate.pop();
    const formatedDate = currentDate.join('-');
    const historicKeys = Object.keys(historic);

    if ( historicKeys.indexOf(formatedDate) == -1 ) {
      historic[formatedDate] = [currentTransaction];
      continue;
    }

    historic[formatedDate].unshift(currentTransaction);
  }

  return historic;
}

function createMothTransaction(title) {
  const classes = {
    monthTransaction: ['month-transaction'],
    monthTitle: ['text-dark', 'fs-4', 'opacity-50', 'fw-normal', 'ms-3', 'mt-3']
  }

  const monthTransaction = newElement('div', classes.monthTransaction);
  const monthTitle = newElement('h2', classes.monthTitle, title);

  monthTransaction.insertAdjacentElement('beforeend', monthTitle);

  return monthTransaction;
}

function createTransaction({description, price, date}) {
  const colorPrice = price >= 0 ? 'text-success' : 'text-danger';
  const classes = {
    transaction: ['transaction', 'mx-auto', 'mb-3', 'px-3', 'rounded-pill', 'd-flex', 'justify-content-between', 'align-items-center', 'gap-3'],
    transactionDescription: ['text-dark', 'fs-6', 'opacity-75', 'transaction-description', 'm-0', 'w-75'],
    transactionIcon: ['icon']
  }

  const attributes = {
    transactionIcon: {src: 'App/public/assets/svg/info-icon.svg', alt: 'infos'}
  }

  const transaction = newElement('div', classes.transaction);
  const transactionDescription = newElement('h3', classes.transactionDescription, description);
  const transactionIcon = newElement('img', classes.transactionIcon, '', attributes.transactionIcon, () => {
    showTransactionInfo(description, price, date);
  });

  transaction.insertAdjacentElement('beforeend', transactionDescription);
  transaction.insertAdjacentElement('beforeend', transactionIcon);

  return transaction;
}

function showTransactionInfo(description, price, date) {
  const $infoDescription = document.querySelector('.info-description');
  const $infoPrice = document.querySelector('.info-price');
  const $infoDate = document.querySelector('.info-date');
  const colorPrice = price >= 0 ? 'text-success' : 'text-danger';

  $infoDescription.textContent = `Descrição: ${description}`
  $infoPrice.textContent = `Preço: ${utils.formatMoney(price)}`
  $infoDate.textContent = `Data: ${utils.formatDate(date)}`

  utils.showModal('#modal-transaction-info');
}

function newElement(tagName, classes, textContent, attributes, listener) {
  const newElement = document.createElement(tagName);
  newElement.classList.add(...classes);
  newElement.textContent = textContent;

  if (attributes) {
    for (var attribute in attributes) {
      newElement.setAttribute(attribute, attributes[attribute]);
    }
  }

  if (listener) {
    newElement.addEventListener('click', listener);
  }

  return newElement;
}

function appInit() {
  userRequest.ajaxGetCurrentUser()
  .then( value => {
    const response = JSON.parse(value);
    const currentUser = response.data;

    userRequest.ajaxGetAllUserTransaction(currentUser.id)
    .then( value => {
        
      const response = JSON.parse(value);
      const transactions = response.data;
      const historic = returnHistoric(transactions);

      for (let transaction in historic) {
        const splittedDate = transaction.split('-');
        const currentMonth = new Date(splittedDate[0], splittedDate[1] - 1);
        const month = months[currentMonth.getMonth()];
        const newMonthTransactionElement = createMothTransaction(month);

        historic[transaction].forEach( item => {
          const newTransactionElement = createTransaction(item);

          newMonthTransactionElement.insertAdjacentElement('beforeend', newTransactionElement);
        });

        $transactions.insertAdjacentElement('beforeend', newMonthTransactionElement);
      }
    });
  });

}

appInit();
