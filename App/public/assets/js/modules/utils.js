
function formatMoney(value) {
   return Number(value).toLocaleString('pt-br', {
    style: 'currency',
    currency: 'BRL'
  });
}

function getCookie(cookieName) {
  const webCookies = document.cookie;
  const cookies = {};

  webCookies.split(";").forEach( currentCookie => {
    const [cookie, value] = currentCookie.split("=");
    cookies[cookie.trim()] = value;
  });

  return cookies[cookieName];
}

function formatDate(date) {
  // 2022-11-21
  date = date.split('-');
  return `${date[2]}/${date[1]}/${date[0]}`
}

function showModal(modalId) {
  let modal = new bootstrap.Modal(modalId);
  modal.show()
}

const utils = {
  formatMoney,
  getCookie,
  formatDate,
  showModal
}

export default utils;
