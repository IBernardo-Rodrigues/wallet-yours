import utils from './utils.js';

function ajaxGetAllUserTransaction(id) {

  const url =  `http://walletyours.infinityfreeapp.com/api/user/${id}/transaction`;

  return new Promise((resolve, reject) => {
    const ajax = new XMLHttpRequest();

    ajax.open("GET", url);
    ajax.setRequestHeader("Authorization", utils.getCookie("userToken"));

    ajax.onreadystatechange = () => {
      if (ajax.readyState == 4) {
        resolve(ajax.response);
      }
    }
    ajax.send();
  });
}

function ajaxGetCurrentUser() {
  const url = 'http://walletyours.infinityfreeapp.com/api/user/current-user';
  return new Promise( (resolve, reject) => {
    const ajax = new XMLHttpRequest();

    ajax.open("GET", url);
    const userToken = utils.getCookie("userToken");
    if (userToken) {

      ajax.setRequestHeader("Authorization", userToken);
    } else {
      reject("Error");
    }

    ajax.onreadystatechange = () => {
      if (ajax.readyState == 4) {
        resolve(ajax.response);
      }
    }

    ajax.send();
  });
}

function ajaxGetWeekUserTransaction(id) {

  const url = `http://walletyours.infinityfreeapp.com/api/user/${id}/transaction/week`;

  return new Promise( (resolve, reject) => {
    const ajax = new XMLHttpRequest();

    ajax.open("GET", url);
    ajax.setRequestHeader("Authorization", utils.getCookie("userToken"));

    ajax.onreadystatechange = () => {
      if (ajax.readyState == 4) {
        resolve(ajax.response);
      }
    }
    ajax.send();
  });
}

const userRequest = {
  ajaxGetAllUserTransaction,
  ajaxGetWeekUserTransaction,
  ajaxGetCurrentUser
}

export default userRequest;
