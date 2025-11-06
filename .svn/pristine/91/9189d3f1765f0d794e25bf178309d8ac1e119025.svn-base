function ajaxHandler(url, method = 'GET', data = null, headers = {}, onSuccess, onError) {
  const options = {
    url: url,
    method: method.toUpperCase(),
    headers: headers,
    dataType: 'json',
  };

  if (method.toUpperCase() === 'GET' && data) {
    options.data = data;
  } else if (data) {
    options.data = JSON.stringify(data);
    options.contentType = 'application/json';
    options.processData = false;
  }

  return $.ajax(options)
    .done(response => {
      if (onSuccess) onSuccess(response);
    })
    .fail((XHR) => {

      if (onError) {
        onError(XHR);
      } else {
        alert('An error occurred during the request. Please try again.');
      }
    });
}
