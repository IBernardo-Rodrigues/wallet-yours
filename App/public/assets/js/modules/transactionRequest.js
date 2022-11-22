function ajaxPostTransaction(data) {
  const url = 'http://walletyours.infinityfreeapp.com/api/transaction';

  return new Promise( (resolve, reject) => {
    const ajax = new XMLHttpRequest();

    ajax.open("POST", url);

    ajax.onreadystatechange = () => {
      if (ajax.readyState == 4) {
        resolve(ajax.response);
      }
    }
    ajax.send(data);
  });
}

const transactionRequest = {
  ajaxPostTransaction
}

export default transactionRequest;
