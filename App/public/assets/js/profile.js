import utils from "./modules/utils.js";
import userRequest from "./modules/userRequest.js";

function fillTotalCard() {
  const $totalCard = document.querySelector('.total-card');
  const total = localStorage.getItem("wallet-yours-total");

  const formatedTotal = utils.formatMoney(total);

  $totalCard.textContent = formatedTotal;
}

function appInit() {
  userRequest.ajaxGetCurrentUser()
  .then( value => {
    const response = JSON.parse(value);
    const currentUser = response.data;

    const $username = document.querySelector('.username');
    const $email = document.querySelector('.email');
    const username = currentUser.username;
    const email = currentUser.email;

    $username.textContent = username;
    $email.textContent = email;
  });
  fillTotalCard();
}

appInit();
