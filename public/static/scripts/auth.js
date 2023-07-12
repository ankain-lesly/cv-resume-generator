// Import Token Component
console.log("Handling Registration");

$("#login_form").on("submit", function (e) {
  e.preventDefault();

  const data = {};
  data.username = e.target.username.value.trim();
  data.password = e.target.password.value.trim();

  // makeAjax("get", 'http://localhost:8500/api/test/', {});
  makeFetch("GET", "http://localhost:8500/api/test/", {});
});

function makeAjax(method, url, data) {
  console.log("Request..");
  let return_data;

  $.ajax({
    type: method,
    url: url,
    data: data,
    // dataType: "json"
    success: (res) => {
      console.log(res);
      console.log("Response..");
    },
  });

  console.log("End..");
}

async function makeFetch(method, url, data) {
  console.log("Request..");
  let return_data;

  const config = {
    method: method,
    headers: {
      // "Accept": "application/json",
      Accept: "*",
      // "Content-Type": "application/json",
    },
  };

  if (method.toUpperCase() !== "GET") config.body = JSON.stringify(data);

  const response = await fetch(url, config);

  console.log(response);

  return_data = await response.json();

  console.log(return_data);

  console.log("End..");
}
