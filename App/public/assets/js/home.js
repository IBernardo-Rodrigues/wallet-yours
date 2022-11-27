import utils from "./modules/utils.js";
import userRequest from "./modules/userRequest.js";
import transactionRequest from "./modules/transactionRequest.js";

const ctx = document.querySelector('#money-flow').getContext('2d');
const $inputPrice = document.querySelector('.input-price');
const $inputDescription = document.querySelector('.input-description');
const $btnSendData = document.querySelector('.btn-send-data');
const $graphSelect = document.querySelector('.graph-select');

// LISTENERS
$inputPrice.addEventListener('input', maskMoney);
$inputDescription.addEventListener('input', controlCharsLength);
$btnSendData.addEventListener('click', newTransactionRequest);
$graphSelect.addEventListener('change', changeGraphView);

let graphData = [0, 0, 0, 0, 0, 0, 0];
let myChart = null;

const data = {
  labels: ['Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab', 'Dom'],
  datasets: [{
    data: [0, 0, 0, 0, 0, 0, 0],
    label: 'Dia da semana',
    backgroundColor: 'transparent',
    borderColor: '#fff',
    tension: .3
  }]
}

const options = {
  plugins: {
    legend: false,
  },
  scales: {
    x: {
      grid: {
        display: false,
        color: '#f5f5f5'
      },
      ticks: {
        color: '#E3CDC1'
      }
    },
    y: {
      min: 0,
      max: 8000,
      ticks: {
        stepSize: 2000,
        callback: (value) => value/1000 + 'K',
        color: '#E3CDC1'
      },
      grid: {
        color: '#498DC9',
        borderDash: [10]
      }
    }
  }
}

const config = {
  type: 'line',
  data,
  options
}

function newTransactionRequest(e) {
  e.preventDefault();

  const $formNewTransaction = document.querySelector('.form-new-transaction');
  const formData = new FormData($formNewTransaction);
  const price = formData.get("price");
  let priceFloated = moneyToFloat(price)
  const description = formData.get("description");

  const isNegative = formData.get("is-negative");
  formData.delete("is-negative");

  if (Boolean(price) == true && Boolean(description) == true) {
    if (isNegative == "negative") {
      priceFloated *= -1;
    }

    formData.set("price", priceFloated);

    userRequest.ajaxGetCurrentUser()
    .then( value => {
      const response = JSON.parse(value);
      const currentUser = response.data;

      formData.set("idUser", currentUser.id);

      transactionRequest.ajaxPostTransaction(formData)
      .then( response => {
        const selectedGraph = $graphSelect.selectedIndex;
        response = JSON.parse(response);

        if (response.status == 200) {
          utils.showModal('#modal-success');
          appReload(selectedGraph);
        }
      })
    }, (value) => {
      window.location = 'http://localhost/wallet-yours/signin';
    })
    return;
  }

  utils.showModal('#modal-error');

}

function fillCards(response) {
  const $incomeCard = document.querySelector('.income-card');
  const $expenseCard = document.querySelector('.expense-card');
  const $totalCard = document.querySelector('.total-card');

  if (!response) {
    return;
  }

  const income = response.reduce((acc, currentTransaction) => {
    if (currentTransaction.price >= 0) {
      return acc + Number(currentTransaction.price);
    }
    return acc;
  }, 0);

  const expense = response.reduce((acc, currentTransaction) => {
    if (currentTransaction.price <= 0) {
      return acc + Number(currentTransaction.price);
    }
    return acc;
  }, 0);

  const total = income + expense;
  localStorage.setItem("wallet-yours-total", JSON.stringify(total));

  $totalCard.textContent = utils.formatMoney(total);
  $incomeCard.textContent = utils.formatMoney(income);
  $expenseCard.textContent = expense == 0 ? utils.formatMoney(0) : utils.formatMoney(expense*-1);
}

function moneyToFloat(value) {
  const filteredValue = value.replaceAll(/\D+/g, '').padStart(3, '0');
  const floatValue = filteredValue.slice(0, -2) + "." + filteredValue.slice(-2)

  return Number(floatValue);
}

function fillGraph(selectedGraph, response) {

  if (!response) {
   data.datasets[0].data = [0, 0, 0 ,0 ,0 , 0, 0];
  } else {
    response.forEach( currentTransaction => {
      const currentWeekDay = new Date(currentTransaction.date).getDay();

      if (selectedGraph == 0) {
        if (currentTransaction.price <= 0) {
          data.datasets[0].data[currentWeekDay] += Number(currentTransaction.price)*-1;
        }
      } else {
        if (currentTransaction.price >= 0) {
          data.datasets[0].data[currentWeekDay] += Number(currentTransaction.price);
        }
      }
    });
  }

  myChart = new Chart(ctx, config);
}

function maskMoney(e) {
  const value = e.target.value;
  const floatValue = moneyToFloat(value);

  const formatedValue = utils.formatMoney(floatValue);

  e.target.value = formatedValue;
}

function controlCharsLength(e) {
  const value = e.target.value;

  if (value.length >= 30) {
    let valueLimited = value.slice(0, 29);
    e.target.value = valueLimited;
  }
}

function changeGraphView() {
  const selectedGraph = $graphSelect.selectedIndex;

  appReload(selectedGraph);
}

function appReload(selectedGraph) {
  data.datasets[0].data = [0, 0, 0, 0, 0, 0, 0];
  myChart.destroy();

  appInit(selectedGraph);
}

function appInit(selectedGraph) {
  userRequest.ajaxGetCurrentUser()
  .then( value => {
    const response = JSON.parse(value);
    const currentUser = response.data;

    userRequest.ajaxGetWeekUserTransaction(currentUser.id)
    .then( value => {
      const response = JSON.parse(value);
      const transactions = response.data;


        fillGraph(selectedGraph, transactions);
        fillCards(transactions);
        return;


    });
  });
}

appInit(0);
